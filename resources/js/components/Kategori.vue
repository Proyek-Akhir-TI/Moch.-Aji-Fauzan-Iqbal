<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Kategori</h3>
                
                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                      Tambah 
                      <i class="fas fa-plus-circle"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Kategori</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="kategori in kategori" :key="kategori.id">
                      <td>{{kategori.id}}</td>
                      <td>{{kategori.kategori}}</td>
                      <td>
                        <a href="#" @click="editModal(kategori)">
                          <i class="fa fa-edit"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit Kategori</h5>
                <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form @submit.prevent="editmode ? updateKategori() : createKategori()">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="inputName" class="col-form-label"></label>
                    <input v-model="form.kategori" type="text" name="kategori" placeholder="Kategori"            
                      class="form-control" :class="{ 'is-invalid': form.errors.has('kategori') }">
                      <has-error :form="form" field="kategori"></has-error>          
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                  <button v-show="editmode" type="submit" class="btn btn-primary">Simpan</button>
                  <button v-show="!editmode" type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.Modal -->

    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode : false,
                kategori : {},
                form: new Form({
                    id : '',
                    kategori : ''
                })
            }
        },
        methods: {
          updateKategori(){
            this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/kategori/'+this.form.id)
                .then(() => {
                    // success
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
          editModal(kategori){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(kategori);
          },
          newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },
          loadKategori(){
            axios.get("api/kategori").then(({ data }) => this.kategori = data.data);
          },
          createKategori(){
            this.$Progress.start();
            this.form.post('api/kategori')
            .then(()=>{
              Fire.$emit('AfterCreate');
              $('#addNew').modal('hide')

              toast.fire({
                type: 'success',
                title: 'Kategori Berhasil ditambah'
              })

              this.$Progress.finish();
            })
            .catch(()=>{

            })
            
          }
        },
        created() {
            this.loadKategori();
            Fire.$on('AfterCreate',()=>{
              this.loadKategori();
            });
        }
    }
</script>
