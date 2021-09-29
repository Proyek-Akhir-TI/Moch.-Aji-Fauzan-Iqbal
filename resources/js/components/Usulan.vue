<template>
    <div class="container">
      <div v-if="!$gate.isAdmin()">
        <not-found></not-found>
      </div>
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
    
        <div class="row mt-5" v-if="$gate.isAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Usulan</h3>

                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  </div>
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
                        <!-- <option value="2">Direview</option> -->
                        <option value="3">Diterima</option>
                        <option value="4">Ditolak</option>
                        <!-- <option value="5">Sudah Direview</option> -->
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
                <div class="col-lg-3 col-3">
                  <div class="form-group">
                    <label for="inputDeskripsi" class="col-form-label">Cari Berdasarkan Range</label>
                      <div class="small-box bg-info" style="background-color: #343a40 !important;">
                        <div class="inner">
                            <select @change="filter_range()" v-model="filter['range']" class="form-control" name="filter_range" id="filter_range">
                              <option value="minggu">1 Minggu</option>
                              <option value="bulan">1 Bulan</option>
                              <option value="tahun">1 Tahun</option>
                            </select>
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
                      <th>Judul</th>
                      <!-- <th>Deskripsi</th> -->
                      <th>User</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <!-- <th>Tanggal Upload</th> -->
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(usulan,index) in usulan.data" :key="usulan.id">
                      <td>{{index+1}}</td>
                      <td>{{usulan.judul}}</td>
                      <!-- <td>{{usulan.deskripsi}}</td> -->
                      <td>{{usulan.user_upload}}</td>
                      <!-- <td>{{usulan.file}}</td> -->
                      <td>{{ usulan.kategori }}</td>
                      <!-- <td>{{usulan.nama_status}}</td> -->
                       <td>
                        <span class="badge badge-primary" v-if="usulan.status==1">Pengajuan</span>
                        <span class="badge badge-warning" v-if="usulan.status==2||usulan.status==5">Direview</span>
                        <span class="badge badge-success" v-if="usulan.status==3">Diterima</span>
                        <span class="badge badge-danger" v-if="usulan.status==4">Ditolak</span>
                      </td>
                      <!-- <td>{{usulan.created_at | myDate}}</td> -->
                      <td>{{ usulan.created_at }}</td>
                      <td>
                          <a href="#" @click="editModal(usulan)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          /
                          <a href="#" @click="deleteUsulan(usulan.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
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
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUsulan() : createUsulan()">
                <div class="modal-body">
                    <div class="form-group">
                            <label for="inputJudul" class="col-form-label">Judul</label>
                            <input  disabled v-model="form.judul" type="text" name="judul"
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
                      <label>Dosen Reviewer</label>
                      <select multiple name="id_reviewer" id="id_reviewer" v-model="form.id_reviewer" class="form-control" :class="{'is-invalid': form.errors.has('id_reviewer')}">
                           <option value="0">Pilih Dosen Reviewer</option>
                           <option v-for="reviewer in reviewers" :value="reviewer.id" :key="reviewer.value"> 
                               {{ reviewer.name }} 
                               </option>
                        </select>
                        <has-error :form="form" field="id_reviewer"></has-error>
                    </div>
                    <div class="form-group" v-show="editmode">
                      <label>File Revisi</label>
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
                    <div class="form-group" v-show="editmode">
                      <label>Reviewer</label>
                      <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(list_reviewer,index) in list_reviewers" :value="list_reviewer.id" :key="list_reviewer.value">
                          <th scope="row">{{index+1}}</th>
                          <td>{{ list_reviewer.name }}</td>
                          <td><a href="#" @click="deleteReviewer(list_reviewer.id_post,list_reviewer.id_usulan)">
                              <i class="fa fa-trash red"></i>
                          </a> </td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                    <div class="form-group" v-show="editmode">
                      <label>Nilai Rekomendasi</label>
                      <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nama</th>
                          <th scope="col">Abstrak</th>
                          <th scope="col">Isi</th>
                          <th scope="col">Kesimpulan</th>
                          <th scope="col">Rekomendasi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="list_nilai in list_nilais" :value="list_nilai.id" :key="list_nilai.value">
                          <td>{{ list_nilai.nama_reviewer }}</td>
                          <td>{{ list_nilai.abstrak }}</td>
                          <td>{{ list_nilai.isi }}</td>
                          <td>{{ list_nilai.kesimpulan }}</td>
                          <td>{{ list_nilai.rekomendasi }}</td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                    <div class="form-group" v-show="editmode">
                      <label>File Dari Reviewer</label>
                      <table class="table" style="display: block;overflow: scroll;">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Reviewer</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Download</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(fileuploadd,index) in fileuploadsreview" :value="fileuploadd.id" :key="fileuploadd.value">
                          <th scope="row">{{index+1}}</th>
                          <td>{{ fileuploadd.name }}</td>
                          <td>{{ fileuploadd.created_at | myDate }}</td>
                          <td><a href="#" @click="download(fileuploadd.file)">{{fileuploadd.file}}</a></td>
                        </tr>
                      </tbody>
                      </table>
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
                    <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select v-model="form.status" id="status" name="status"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                <option value="0">Pilih Status</option>
                                <option value="1">Pengajuan</option>
                                <option value="2">Direview</option>
                                <option value="3">Diterima</option>
                                <option value="4">Ditolak</option>
                                <option value="5">Sudah Direview</option>
                                <option value="6">Copy Editing</option>
                                <!-- <option value="author">Author</option> -->
                            </select>
                            <has-error :form="form" field="status"></has-error>
                      </div>
                    <!-- <div class="form-group">
                              <label for="file" class="col-form-label">Upload File</label>
                              <div class="col-sm-12">
                                  <input type="file" name="file" class="form-input" v-on:change="onFileChange">
                              </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Save</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <!-- <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button> -->
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
          reviewers : {},
          list_reviewers : {},
          list_nilais : {},
          list_statuss :{},
          fileuploads: {},
          fileuploadsreview: {},
          filter : {},
          kategoris : {},
          form: new Form({
            id : '',
            judul : '',
            deskripsi : '',
            file : '',
            status : '',
            id_reviewer : [],
            abstrak : '',
            isi : '',
            kesimpulan : '',
            rekomendasi: '',
          })
        }
      },
      methods: {
        updateUsulan() {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/usulan/'+this.form.id)
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
        getResults(page = 1) {
          axios.get('api/usulan_admin?page=' + page)
            .then(response => {
              this.usulan = response.data;
            });
		    },
        loadListReviewer(id){
          axios.get("api/list_reviewer/"+id).then (({ data }) => this.list_reviewers = data);
        },
        loadListNilai(id){
          axios.get("api/list_reviewer_nilai/"+id).then (({ data }) => this.list_nilais = data);
        },
        loadKategori(){
          axios.get("api/kategori").then(({ data }) => this.kategoris = data);
        },
        loadFile(id){
          axios.get("api/fileupload/"+id).then (({ data }) => this.fileuploads = data);
        },
        loadStatus(id){
          axios.get("api/getliststatus/"+id).then (({ data }) => this.list_statuss = data);
        },
        loadFileReview(id){
          axios.get("api/getfileuploadreviewer/"+id).then (({ data }) => this.fileuploadsreview = data);
        },
        deleteReviewer(id,id_usulan){
          console.log(id_usulan);
           swal.fire({
                    title: "Yakin?",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/usulanReviewer/'+id)
                        this.loadListReviewer(id_usulan);
                    }
                })
            
        },
        rekomendasi(){
          var cek = $("#status option:selected").val();
          if(cek == 4){
            console.log('rekomendasi');
          }
          
        },
        newModal(){
          this.editmode = false;
          this.form.reset();
          $('#addNew').modal('show');
        },
        editModal(usulan){
          this.editmode = true;
          this.form.reset();
          this.loadFile(usulan.id)
          this.loadStatus(usulan.id)
          $('#addNew').modal('show');
          this.loadFileReview(usulan.id);
          this.loadReviewer(usulan.id_user);
          this.form.fill(usulan);
          this.loadListReviewer(usulan.id);
          this.loadListNilai(usulan.id);
        },
        deleteUsulan(id){
          swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {

                        this.form.delete('api/usulan/'+id).then(()=>{
                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            Fire.$emit('AfterCreate');
                            
                        }).catch(()=>{
                            swal.fire("Failed!", "There was something wronge.", "warning");
                        });
                    }
                })
        },
        async loadReviewer(id){
          await axios.get("api/reviewer/"+id).then(({ data }) => this.reviewers = data);
        },
        loadUsulan(){
          axios.get("api/usulan_admin").then(({ data }) => this.usulan = data);
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
                formData.append('id_reviewer', this.form.id_reviewer);
                formData.append('status', this.form.status);
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
          
        },
        filter_tanggal(){
          axios.get('api/filter_tanggal/' + this.filter.tanggal)
            .then(response => {
              this.usulan = response.data;
            });
        },
        filter_status(){
          console.log(this.filter.status)
          axios.get('api/filter_status/' + this.filter.status)
            .then(response => {
              this.usulan = response.data;
            });
        },
        filter_kategori(){
          console.log(this.filter.kategori)
          axios.get('api/filter_kategori/' + this.filter.kategori)
            .then(response => {
              this.usulan = response.data;
            });
        },
        cari_judul(){
          console.log(this.filter.judul)
          if(this.filter.judul) {
            axios.get('api/filter_judul/' + this.filter.judul)
            .then(response => {
              this.usulan = response.data;
            });
          } else {
            axios.get('api/usulan_admin')
            .then(response => {
              this.usulan = response.data;
            });
          }
          
        },
        filter_range(){
          axios.get('api/filter_range/' + this.filter.range)
            .then(response => {
              this.usulan = response.data;
            });
        }
      },
      created() {
        this.loadUsulan();
        this.loadKategori();
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
