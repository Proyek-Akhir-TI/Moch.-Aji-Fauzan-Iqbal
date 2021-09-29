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

        <!-- Modal Cookie -->
        <div class='modal fade' id='myModal'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title'>
                          <strong>Pengajuan</strong>
                        </h4>
                    </div>
                    <!-- / modal-header -->

                    <div class='modal-body cekagrement'>

                      <h6> Anda harus membaca dan mengetahui bahwa anda telah menyetujui persyaratan dibawah ini sebelum melakukan pengajuan:<p></p></h6>
                      
                            <input class='modal-check' name='modal-check' type="checkbox"> kiriman belum diterbitkan sebelumnya<p></p>
                            <input class='modal-check' name='modal-check' type="checkbox"> file kiriman dalam bentuk file word dan/atau pdf<p></p>
                            <input class='modal-check' name='modal-check' type="checkbox"> semua tabel, gambar ataupun rumus harus mengacu pada paragraf<p></p>
                            <input class='modal-check' name='modal-check' type="checkbox"> semua kata, kalimat, dan tanda baca sesuai dengan tata bahasa dan semua daftar Pustaka telah direferensikan dalam paragraf. ( daftar perpustakaan terbaru dan paling relevan dari jurnal terpercaya)<p></p>
                            <h6> HAK CIPTA<p></p></h6>
                            <h6>Penulis memberikan hak cipta atau lisensi gak publikasi dalam artikelnya ke Poliwangi Press. Dan penulis bertanggung jawab untuk mendapatkan izin untuk mereproduksi materi hak cipta dari sumber lain:<p></p></h6>
                            <input class='modal-check' name='modal-check' type="checkbox"> Ya, saya setuju untuk memenuhi persyaratan hak cipta<p></p>
                            <input class='modal-check' name='modal-check' type="checkbox">  Ya, saya setuju data saya dikumpulkan dan disimpan sesuai dengan pernyataan privasi<p></p>

                    </div>
                    <!-- / modal-body -->
                   <div class='modal-footer'>
                       <div class="checkbox pull-right">
                        <button  type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button disabled type="button" class="btn btn-sm btn-primary accetsarat" data-dismiss="modal" aria-hidden="true">Simpan&Lanjutkan</button>
                        </div>
                        <!--/ checkbox -->
                  </div>
                  <!--/ modal-footer -->
                </div>
                <!-- / modal-content -->
          </div>
          <!--/ modal-dialog -->
        </div>
        <!-- / modal -->

        <!-- Modal -->
    
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Usulan</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="agrementSyarat">
                    Add New
                    <i class="fas fa-file-upload"></i>
                  </button>
                </div>

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
                      <th>NO</th>
                      <th>Judul</th>
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <!-- <th>Tanggal Upload</th> -->
                      <!-- <td>Reviewer</td> -->
                      <th>Status</th>
                      <th>Lihat Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(usulan,index) in usulan.data" :key="usulan.id">
                      <td>{{index+1}}</td>
                      <td>{{usulan.judul}}</td>
                      <td>{{usulan.created_at}}</td>
                      <td>{{usulan.kategori}}</td>
                      <!-- <td>{{usulan.file}}</td> -->
                      <!-- <td>{{usulan.created_at | myDate}}</td> -->
                      <!-- <td>{{usulan.reviewer}}</td> -->
                      <!-- <td>{{usulan.nama_status}}</td> -->
                       <td>
                        <span class="badge badge-primary" v-if="usulan.status==1">Pengajuan</span>
                        <span class="badge badge-warning" v-if="usulan.status==2">Direview</span>
                        <span class="badge badge-success" v-if="usulan.status==3">Diterima</span>
                        <span class="badge badge-warning" v-if="usulan.status==5">Sudah Direview</span>
                        <span class="badge badge-danger" v-if="usulan.status==4">Ditolak</span>
                        <span class="badge badge-success" v-if="usulan.status==6">Copy Editing</span>
                      </td>
                      <td>
                          <a href="#" @click="editModal(usulan)">
                            Lihat Detail
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">AddNew</h5>
                    <!-- <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUsulan() : createUsulan()" id="usulan">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="kategori" class="col-form-label">Kategori</label>
                      <select name="id_kategori" id="id_kategori" v-model="form.id_kategori" class="form-control" :class="{'is-invalid': form.errors.has('id_kategori')}">
                           <option value="editmode? 'null':''">Pilih Kategori</option>
                           <option v-for="kategori in kategoris.data" :value="kategori.id" :key="kategori.value"> 
                               {{ kategori.kategori }} 
                               </option>
                        </select>
                        <has-error :form="form" field="id_kategori"></has-error>
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
                              <label for="file" class="col-form-label">Upload File</label>
                              <div class="col-sm-12">
                                  <input type="file" name="file" class="form-input" v-on:change="onFileChange">
                              </div>
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
                      <label>Catatan</label>
                      <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nama Reviewer</th>
                          <th scope="col">Catatan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="list_catatan in list_catatans" :value="list_catatan.id" :key="list_catatan.value">
                          <td>{{ list_catatan.reviewer }}</td>
                          <td>{{ list_catatan.status_catatan }}</td>
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
require('jquery.cookie')

    export default {
      data() {
        return {
          editmode : false,
          usulan : {},
          kategoris : {},
          catatans : {},
          fileuploads: {},
          list_statuss :{},
          fileuploadsreview: {},
          list_catatans : {},
          filter : {},
          kategoris : {},
          form: new Form({
            id : '',
            judul : '',
            deskripsi : '',
            file : '',
            id_kategori : '',
            status : '',
            status_catatan : '',
            rekomendasi : '',
          })
        }
      },
      methods: {
        updateUsulan() {
                this.$Progress.start();
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                formData.append('id', this.form.id);
                formData.append('file', this.file);
                formData.append('judul', this.form.judul);
                formData.append('deskripsi', this.form.deskripsi);
                formData.append('id_kategori', this.form.id_kategori);
                formData.append("_method", "PUT");
                
                axios.post('/api/updateusulan/'+this.form.id, formData, config)

                // this.form.put('api/usulanDosen/'+this.form.id)
                .then((res) => {
                    console.log(res)
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
          axios.get('api/usulanDosen?page=' + page)
            .then(response => {
              this.usulan = response.data;
            });
		    },
        loadListCatatan(id){
          axios.get("api/list_catatan/"+id).then (({ data }) => this.list_catatans = data);
        },
        rekomendasi(){
          var cek = $("#status option:selected").val();
          if(cek == 3){
            $('#is_rekomendasi').show();
          }
        },
        newModal(){
          this.editmode = false;
          this.form.reset();
          this.loadKategori();
          $('#addNew').modal('show');
        },
        editModal(usulan){
          this.rekomendasi();
          this.loadFile(usulan.id)
          this.editmode = true;
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(usulan);
          this.loadListCatatan(usulan.id);
          this.loadKategori();
          this.loadStatus(usulan.id)
          this.loadFileReview(usulan.id);
          if(usulan.status == 4 || usulan.status == 6){
            $("#usulan :input").prop("disabled", true);
          }
        },
        loadUsulan(){
          axios.get("api/usulanDosen").then(({ data }) => this.usulan = data);
        },
        loadKategori(){
          axios.get("api/kategori").then(({ data }) => this.kategoris = data);
        },
        loadCatatan(){
          axios.get("api/catatan").then(( { data } ) => this.catatan = data);
        },
        loadFile(id){
          axios.get("api/fileupload/"+id).then (({ data }) => this.fileuploads = data);
        },
        loadFileReview(id){
          axios.get("api/getfileuploadreviewer/"+id).then (({ data }) => this.fileuploadsreview = data);
        },
        loadStatus(id){
          axios.get("api/getliststatus/"+id).then (({ data }) => this.list_statuss = data);
        },
        loadKategori(){
          axios.get("api/kategori").then(({ data }) => this.kategoris = data);
        },
        download(file){
          //  axios.get("api/kategori").then(({ data }) => this.kategoris = data);
          // console.log()
          // axios.get('api/kategori', {responseType: 'arraybuffer'}).then(res=>{
          //   let blob = new Blob([res.data], {type:'application/pdf'})
          //   let link = document.createElement('a')
          //   link.href = window.URL.createObjectURL(blob)
          //   link.download = file
          //   link._target = 'blank'
          //   link.click();
          window.open('api/filedownload/'+file, '_blank');
          // axios.get("api/kategori/"+file);
          // })
          // axios({
          //     url: 'api/kategori',
          //     data : {file:file},
          //     method: 'POST',
          //     responseType: 'arraybuffer',
          // }).then((response) => {
          //     let blob = new Blob([response.data], {type:'application/pdf'})
          //     let link = document.createElement('a')
          //     link.href = window.URL.createObjectURL(blob)
          //     link.download = file
          //     link._target = 'blank'
          //     link.click();
          // });
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
                formData.append('rekomendasi', this.form.rekomendasi);
                axios.post('/api/usulanDosen', formData, config)
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
        agrementSyarat(){
          var my_cookie = $.cookie($('.modal-check').attr('name'));
          if (my_cookie && my_cookie == "true") {
              $(this).prop('checked', my_cookie);
              this.newModal()
              console.log('checked checkbox');
          }
          else{
              $('#myModal').modal('show');
              console.log('uncheck checkbox');
          }

          $(".modal-check").change(function() {
          if($('.cekagrement input:checkbox:not(":checked")').length == 0){
            $('.accetsarat').attr('disabled',false)
            }else{
            $('.accetsarat').attr('disabled',true)

            }
          })

          $('.accetsarat').click(()=>{
            $.cookie($('.modal-check').attr("name"), $('.modal-check').prop('checked'), {
                  path: '/',
                  expires: 1
              });
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
