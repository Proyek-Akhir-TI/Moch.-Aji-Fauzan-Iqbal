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
                <div class="row">
                <div class="col-lg-3 col-3">
                  <div class="form-group">
                    <label for="inputDeskripsi" class="col-form-label">Cari Berdasarkan Tanggal</label>
                      <div class="small-box bg-info" style="background-color: #343a40 !important;">
                        <div class="inner">
                            <input type="date" v-model="filter['tanggal']" class="form-control" id="filter_tanggal" name="filter_tanggal" @change="filter_tanggal()">
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-3">
                  <div class="form-group">
                  <label for="inputDeskripsi" class="col-form-label">Cari Berdasarkan Status</label>
                  <div class="small-box bg-info" style="background-color: #343a40 !important;">
                    <div class="inner">
                      <select @change="filter_status()" v-model="filter['status']" class="form-control" name="filter_status" id="filter_status">
                        <option value="0" selected>Pilih Status</option>
                        <option value="1">Pengajuan</option>
                        <option value="2">Direview</option>
                        <option value="3">Diterima</option>
                        <option value="4">Ditolak</option>
                        <option value="5">Sudah Direview</option>
                        <option value="6">Copy Editing</option>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-lg-3 col-3">
                  <div class="form-group">
                  <label for="inputDeskripsi" class="col-form-label">Cari Berdasarkan Kategori</label>
                  <div class="small-box bg-info" style="background-color: #343a40 !important;">
                    <div class="inner">
                      <select @change="filter_kategori()" v-model="filter['kategori']" class="form-control" name="filter_kategori" id="filter_kategori">
                        <option value="0" selected>Semua Kategori</option>
                        <option v-for="kategori in kategoris.data" :value="kategori.id" :key="kategori.value"> 
                               {{ kategori.kategori }} 
                        </option>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-lg-3 col-3">
                  <div class="form-group">
                  <label for="inputDeskripsi" class="col-form-label">Cari Berdasarkan Judul</label>
                  <div class="small-box bg-info" style="background-color: #343a40 !important;">
                    <div class="inner">
                      <input type="text" v-model="filter['judul']" class="form-control" @keyup="cari_judul()" placeholder="Masukkan kata kunci judul">
                    </div>
                  </div>
                  </div>
                </div>
              </div>

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
                      <!-- <th>Tanggal Upload</th> -->
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
                      <!-- <td>{{usulan.created_at | myDate}}</td> -->
                      <!-- <td>{{usulan.nama_status}}</td> -->

                       <td>
                        <span class="badge badge-primary" v-if="usulan.status==1">Belum Direview</span>
                        <span class="badge badge-warning" v-if="usulan.status==2">Sudah Direview</span>
                        <span class="badge badge-success" v-if="usulan.status==3">Sudah Direview</span>
                        <span class="badge badge-danger" v-if="usulan.status==4">Sudah Direview</span>
                        <span class="badge badge-success" v-if="usulan.status==5">Sudah Direview</span>
                      </td>
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
                <form @submit.prevent="editmode ? updateUsulan() : createUsulan()" id="usulan">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select disabled name="id_kategori" id="id_kategori" v-model="form.id_kategori" class="form-control" :class="{'is-invalid': form.errors.has('id_kategori')}">
                           <option value="">Pilih Kategori</option>
                           <option v-for="kategori in kategoris.data" :value="kategori.id" :key="kategori.value"> 
                               {{ kategori.kategori }} 
                               </option>
                        </select>
                        <has-error :form="form" field="id_kategori"></has-error>
                    </div>
                    <div class="form-group">
                            <label for="inputJudul" class="col-form-label">Judul</label>
                            <input disabled v-model="form.judul" type="text" name="judul"
                                placeholder="Judul"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('judul') }">
                            <has-error :form="form" field="judul"></has-error>
                    </div>
                    <div class="form-group">
                            <label for="inputDeskripsi" class="col-form-label">Deskripsi</label>
                            <textarea disabled v-model="form.deskripsi" name="deskripsi"
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
                              <label for="file" class="col-form-label">Upload File Tambahan Reviewer</label>
                              <div class="col-sm-12">
                                  <input type="file" name="file" class="form-input" v-on:change="onFileChange">
                              </div>
                    </div>

                    <div class="form-group" v-show="editmode">
                      <label>File Reviewer</label>
                      <table class="table" style="display: block;overflow: scroll;">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">File</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Download</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(fileupload,index) in fileuploads" :value="fileupload.id" :key="fileupload.value">
                          <th scope="row">{{index+1}}</th>
                          <td>{{ fileupload.file }}</td>
                          <td>{{ fileupload.created_at | myDate }}</td>
                          <td><a href="#" @click="download(fileupload.file)">{{fileupload.file}}</a></td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                    

                    <div class="form-group">
                            <label for="nilaiAbstrak" class="col-form-label">Nilai Abstrak</label>
                            <input v-model="form.abstrak" type="number" name="abstrak"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('abstrak') }">
                            <has-error :form="form" field="abstrak"></has-error>
                    </div>

                     <div class="form-group">
                            <label for="nilaiIsi" class="col-form-label">Nilai Isi</label>
                            <input v-model="form.isi" type="number" name="isi"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('isi') }">
                            <has-error :form="form" field="isi"></has-error>
                    </div>

                    <div class="form-group">
                            <label for="nilaiKesimpulan" class="col-form-label">Nilai Kesimpulan</label>
                            <input v-model="form.kesimpulan" type="number" name="kesimpulan"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('kesimpulan') }">
                            <has-error :form="form" field="kesimpulan"></has-error>
                    </div>

                    <div class="form-group">
                            <label for="rekomendasi" class="col-form-label">Rekomendasi</label>
                            <select v-model="form.rekomendasi" id="rekomendasi" name="rekomendasi"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('rekomendasi') }">
                                <option value="belum">-- Pilih --</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            <has-error :form="form" field="status"></has-error>
                      </div>
                      <div class="form-group" v-show="editmode">
                      <label>Riwayat Status</label>
                      <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(list_status) in list_statuss" :value="list_status.id" :key="list_status.value">
                          <td>{{ list_status.tanggal | myDate }}</td>
                          <td>{{ list_status.nama_status }}</td>
                        </tr>
                      </tbody>
                      </table>
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
          fileuploads: {},
          list_statuss :{},
          filter : {},
          kategoris : {},
          form: new Form({
            id : '',
            judul : '',
            deskripsi : '',
            id_kategori : '',
            status_catatan : '',
            isi: '',
            file: '',
            abstrak: '',
            kesimpulan: '',
            rekomendasi: '',
          })
        }
      },
      created(){
        console.log(this.form)
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

                // this.form.put('api/usulanReviewer/'+this.form.id)

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();

                formData.append('id', this.form.id);
                formData.append('file', this.file);
                formData.append('judul', this.form.judul);
                formData.append('deskripsi', this.form.deskripsi);
                formData.append('id_kategori', this.form.id_kategori);
                formData.append('status_catatan', this.form.status_catatan);
                formData.append('isi', this.form.isi);
                formData.append('abstrak', this.form.abstrak);
                formData.append('kesimpulan', this.form.kesimpulan);
                formData.append('rekomendasi', this.form.rekomendasi);
                formData.append("_method", "PUT");
                
                axios.post('/api/updateusulanreviewer/'+this.form.id, formData, config)

                .then((res) => {
                  console.log(res.data)
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
          this.loadFile(usulan.id)
          this.editmode = true;
          $('#addNew').modal('show');
          this.loadStatus(usulan.id)
          this.form.fill(usulan);
          this.loadUsulan();
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
        loadFile(id){
          axios.get("api/fileuploadreviewer/"+id).then (({ data }) => this.fileuploads = data);
        },
        loadStatus(id){
          axios.get("api/getliststatus/"+id).then (({ data }) => this.list_statuss = data);
        },
        download(file){
          axios.get('api/download/usulan/'+file, {responseType: 'arraybuffer'}).then(res=>{
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
          
        },
        filter_tanggal(){
          axios.get('api/dosen_tanggal/' + this.filter.tanggal)
            .then(response => {
              this.usulan = response.data;
            });
        },
        filter_status(){
          console.log(this.filter.status)
          axios.get('api/dosen_status/' + this.filter.status)
            .then(({ data }) => this.usulan = data);
        },
        filter_kategori(){
          console.log(this.filter.kategori)
          axios.get('api/dosen_kategori/' + this.filter.kategori)
            .then(response => {
              this.usulan = response.data;
            });
        },
        cari_judul(){
          console.log(this.filter.judul)
          if(this.filter.judul) {
            axios.get('api/dosen_judul/' + this.filter.judul)
            .then(response => {
              this.usulan = response.data;
            });
          } else {
            axios.get('api/usulan_admin')
            .then(response => {
              this.usulan = response.data;
            });
          }
          
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
