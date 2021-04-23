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
                <h3 class="card-title">Tabel Usulan</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                    Add New
                    <i class="fas fa-file-upload"></i>
                  </button>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th>ID</th> -->
                      <th>Judul</th>
                      <!-- <th>Deskripsi</th> -->
                      <th>User</th>
                      <th>File</th>
                      <th>Registered At</th>
                      <!-- <th>Modify</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="usulan in usulan.data" :key="usulan.id">
                      <!-- <td>{{usulan.id}}</td> -->
                      <td>{{usulan.judul}}</td>
                      <!-- <td>{{usulan.deskripsi}}</td> -->
                      <td>{{usulan.name}}</td>
                      <td><a href="#" @click="download(usulan.file)">{{usulan.file}}</a></td>
                      <!-- <td>{{usulan.file}}</td> -->
                      <td>{{usulan.created_at | myDate}}</td>
                      <!-- <td>
                          <a href="#">
                              <i class="fa fa-edit blue"></i>
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
            <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">AddNew</h5>
                    <!-- <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit</h5> -->
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

                            <textarea v-model="form.deskripsi" name="deskripsi"
                                placeholder="Deskripsi"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('deskripsi') }">
                            </textarea>
                            <has-error :form="form" field="deskripsi"></has-error>
                    </div>
                    <div class="form-group">
                              <label for="file" class="col-form-label">Upload File</label>
                                    
                              <div class="col-sm-12">
                                  <input type="file" name="file" class="form-input" v-on:change="onFileChange">
                              </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Create</button> -->
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    <!-- <button type="submit" class="btn btn-primary">Create</button> -->
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
        updateUsulan() {
                this.$Progress.start();
                this.form.put('api/usulan/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide');
                    swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
        getResults(page = 1) {
          axios.get('api/usulan_dosen?page=' + page)
            .then(response => {
              this.usulan = response.data;
            });
		    },
        newModal(){
          this.editmode = false;
          this.form.reset();
          $('#addNew').modal('show');
        },
        editModal(usulan){
          this.editmode = true;
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(usulan);
        },
        loadUsulan(){
          axios.get("api/usulan").then(({ data }) => this.usulan = data);
        },
        download(file){
          axios.get('/download/usulan/'+file, {responseType: 'arraybuffer'}).then(res=>{
            let blob = new Blob([res.data], {type:'application/*'})
            let link = document.createElement('a')
            link.href = window.URL.createObjectURL(blob)
            link.download = file
            link._target = 'blank'
            link.click();
          })
        },
        onFileChange(e){
          console.log(e.target.files[0]);
          this.file = e.target.files[0];
        },
        createUsulan() {
          this.$Progress.start();
          const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('judul', this.form.judul);
                formData.append('deskripsi', this.form.deskripsi);
   
                axios.post('/api/usulan', formData, config)
          // this.form.post('api/usulan')
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
