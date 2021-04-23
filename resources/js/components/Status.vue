<template>
    <div class="container">
        <!-- <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Tabel Usulan</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul Berkas</th>
                                    <th>Dosen</th>
                                    <th>Created at</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> -->
    
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Status Usulan</h3>

                <!-- <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                    Add New
                    <i class="fas fa-file-upload"></i>
                  </button>
                </div> -->

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th>ID</th> -->
                      <th>Judul</th>
                      <th>Registered At</th>
                      <th>Status</th>
                      <!-- <th>Deskripsi</th> -->
                      <!-- <th>User</th> -->
                      <!-- <th>File</th> -->
                      
                      <!-- <th>Modify</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="usulan in usulan.data" :key="usulan.id">
                      <!-- <td>{{usulan.id}}</td> -->
                      <td>{{usulan.judul}}</td>
                      <td>{{usulan.created_at | myDate}}</td>
                      <td>{{usulan.status}}</td>
                      <!-- <td>{{usulan.deskripsi}}</td> -->
                      <!-- <td>{{usulan.name}}</td> -->
                      <!-- <td>{{usulan.file}}</td> -->
                      
                      <!-- <td>
                          <a href="#">
                              <i class="fa fa-edit blue"></i>
                              Check
                          </a>
                          /
                          <a href="#">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td> -->
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="usulan" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
            <div class="modal fade" v-show="!editmode" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">AddNew</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUsulan() : createUsulan()">
                <div class="modal-body">
                    <div class="form-group">
                            <label for="inputJudul" class="col-form-label">Judul</label>

                            <input v-model="form.judul" type="text" name="judul"
                                placeholder="Judul"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('judul') }">
                            <has-error :form="form" field="judul"></has-error>
                    </div>
                    <div class="form-group">
                            <label for="inputDeskripsi" class="col-form-label">Deskripsi</label>

                            <input v-model="form.deskripsi" name="deskripsi"
                                placeholder="Deskripsi"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('deskripsi') }">
                            <has-error :form="form" field="deskripsi"></has-error>
                    </div>
                    <div class="form-group">
                              <label for="file" class="col-form-label">Upload File</label>
                                    
                              <div class="col-sm-12">
                                  <input type="file" name="file" class="form-input">
                              </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
                </form>
                </div>
            </div>
            </div>

    </div>
</template>

<script>
    export default {
      data() {
        return {
          editmode : false,
          usulan : {},
          form: new Form({
            id : '',
            judul : '',
            deskripsi : '',
            dosen : '',
            file : ''
          })
        }
      },
      methods: {
        getResults(page = 1) {
          axios.get('api/usulan_dosen?page=' + page)
            .then(response => {
              this.usulan = response.data;
            });
		    },
        newModal(){
          this.form.reset();
          $('#addNew').modal('show');
        },
        loadUsulan(){
          axios.get("api/usulan").then(({ data }) => this.usulan = data);
        },
        createUsulan() {
          this.$Progress.start();
          this.form.post('api/usulan')
          .then(()=>{
              Fire.$emit('AfterCreate');
              $('#addNew').modal('hide')

              toast.fire({
                type: 'success',
                title: 'Usulan Created in successfully'
              })

              this.$Progress.finish();
          })
          .catch(()=>{

          })
          
        }
      },
      created() {
        this.loadUsulan();
        Fire.$on('AfterCreate',()=>{
          this.loadUsulan();
        });
      } 
      // mounted() {
      //   console.log('Component mounted.')
      //   this.loadUsulan();
      // }
    }
</script>
