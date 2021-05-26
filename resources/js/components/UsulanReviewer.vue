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
                <h3 class="card-title">Usulan Perlu Direview</h3>

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
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Judul</th>
                      <th>Deskripsi</th>
                      <th>File</th>
                      <th>Tanggal Upload</th>
                      <th>Status</th>
                      <th>Lihat Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(usulan,index) in usulan.data" :key="usulan.id">
                      <td>{{index+1}}</td>
                      <td>{{usulan.kategori}}</td>
                      <td>{{usulan.judul}}</td>
                      <td>{{usulan.deskripsi}}</td>
                      <td><a href="#" @click="download(usulan.file)">{{usulan.file}}</a></td>
                      <!-- <td>{{usulan.file}}</td> -->
                      <td>{{usulan.created_at | myDate}}</td>
                      <td>{{usulan.nama_status}}</td>
                      <td>
                          <a href="#" @click="editModal(usulan)">
                            Tambahkan Catatan
                              <i class="fa fa-info-circle"></i>
                          </a>
                      </td>
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
                    <!-- <h5 class="modal-title" v-show="!editmode" id="addNewLabel">AddNew</h5> -->
                    <!-- <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUsulan() : createUsulan()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="id_kategori" id="id_kategori" v-model="form.id_kategori" class="form-control" :class="{'is-invalid': form.errors.has('id_kategori')}">
                           <option value="">Pilih Kategori</option>
                           <option v-for="kategori in kategoris" :value="kategori.id" :key="kategori.value"> 
                               {{ kategori.kategori }} 
                               </option>
                        </select>
                        <has-error :form="form" field="id_reviewer"></has-error>
                    </div>
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
                            <label for="inputCatatan" class="col-form-label">Catatan</label>
                            <textarea v-model="form.status_catatan" name="status_catatan"
                                placeholder="Catatan"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('status_catatan') }">
                            </textarea>
                            <has-error :form="form" field="status_catatan"></has-error>
                    </div>
                    <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select v-model="form.status" id="status" name="status"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                <option value="">Pilih Status</option>
                                <option value="1">Pengajuan</option>
                                <option value="2">Direview</option>
                                <option value="3">Diterima</option>
                                <option value="4">Ditolak</option>
                                <!-- <option value="author">Author</option> -->
                            </select>
                            <has-error :form="form" field="status"></has-error>
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
          kategoris : {},
          catatans : {},
          form: new Form({
            id : '',
            judul : '',
            deskripsi : '',
            id_kategori : '',
            status_catatan : '',
            status: '',
          })
        }
      },
      methods: {
        updateUsulan() {
                this.$Progress.start();
                // const config = {
                //     headers: { 'content-type': 'multipart/form-data' }
                // }
                // let formData = new FormData();
                // formData.append('id', this.form.id)
                // formData.append('file', this.form.file);
                // formData.append('judul', this.form.judul);
                // formData.append('deskripsi', this.form.deskripsi);
                // formData.append('id_kategori', this.form.id_kategori);
                // axios.put('/api/usulanReviewer/'+this.form.id, formData, config)

                this.form.put('api/usulanReviewer/'+this.form.id)
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
          axios.get('api/usulanReviewer?page=' + page)
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
          axios.get("api/usulanReviewer").then(({ data }) => this.usulan = data);
        },
        loadKategori(){
          axios.get("api/kategori").then(({ data }) => this.kategoris = data);
        },
        loadCatatan(){
          axios.get("api/catatan").then(( { data } ) => this.catatan = data);
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
                formData.append('id_kategori', this.form.id_kategori);
                axios.post('/api/usulanReviewer', formData, config)
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
        this.loadKategori();
        Fire.$on('AfterCreate',()=>{
          this.loadUsulan();
        });
      } 
    }
</script>
