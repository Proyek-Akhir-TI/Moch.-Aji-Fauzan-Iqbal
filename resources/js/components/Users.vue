<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                      Add New 
                      <i class="fa fa-user-plus fa-fw"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <!-- <th>No.</th> -->
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Tipe</th>
                      <th>Registered At</th>
                      <th>#</th>
                    </tr>
                  
                    <!-- <tr v-for="(user, index) in reverseUsers" :key="index++"> -->
                         <!-- index berdasarkan index array nya -->

                    <tr v-for="user in users.data" :key="user.id">

                      <!-- <td>{{index}}</td> -->
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(user)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          /
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
                <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputName" class="col-form-label">Nama</label>

                            <input v-model="form.name" type="text" name="name"
                                placeholder="Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-form-label">Email</label>

                            <input v-model="form.email" type="email" name="email"
                                placeholder="Email Address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="bio" class="col-form-label">Bio</label>

                            <textarea v-model="form.bio" id="bio" name="bio"
                                placeholder="Short bio for user (Optional)"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                            </textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-form-label">Tipe</label>

                            <select v-model="form.type" id="type" name="type"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="">Select User Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="reviewer">Reviewer</option>
                            </select>
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">
                                    Password
                            </label>

                            <input v-model="form.password" type="password" name="password" id="password"
                                placeholder="Password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
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
                editmode: false,
                // users : {
                //     data: [] 
                // },
                // vue biar bisa baca kalau dikasih function tertentu karena ini tadinya kan diambil dari HTTP-GET
                users : {},
                form: new Form({
                    id : '',
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                    bio : ''
                    // photo : ''
                })
            }
        },

        // computed: { // computed ini variable dynamic bisa reactive kalau data berubah
        //     reverseUsers() {
        //         // isi array dipotong per index nya terus disusun lagi dengan terbalik
        //        return this.users.data.slice().reverse()
        //     }
        // },
        
        methods: {
            getResults(page = 1) {
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		    },
            updateUser() {
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/user/'+this.form.id)
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
            editModal(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id) {
                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'

                // }).then(( response ) => {
                    // kecuali gini, namanya destructuring (langusng ngambil variabel isinya)
                    // jadi bisa ditulis res.value atau langsung variabel isinya {value}
                    // biar singkat aja
                    // misal kamu puyna object thisIsObjectVariabel
                    // thisIsObjectVariabel = { id: 1, name: "satu" }
                    // kalau mau panggil object name ribet harus nulis nama variabel nya dulu
                    // contoh : thisIsObjectVariabel.name
                    // kalau pake destructuring singkat
                    // contoh : { name }
                    // udah gitu aja tanpa dituliskan nama variabel nya
                    // ini dikecualikan kalau emang isinya yang dipanggil aja yang dipake
                    // misal disini kamu masih butuh object lain yang didalem thisIsObjectVariabel katakanlah id nya
                    // contoh : thisIsObjectVariabel.id
                    // kalau pake destructuring { name } ini tadi kamu gk bisa manggil thisIsObjectVariabel.id
                    // alternatifnya gini
                    // { name, id }
                    // artinya manggil thisIsObjectVariabel.name dan thisIsObjectVariabel.id
                    // gunakan kalau emang sedikit yang dibutuhkan, kalau banyak ya langsung nama variabel nya aja gpp

                }).then((result) => {

                    // send request to the server
                        // console.log(response);
                        // kalau pencet cancel kan gaada object response.value
                        // adanya pas pencet OK baru keluar response.value

                    // if (response.value) { // kebiasaan nulis res = response biar singkat
                    // kalo response.value ambek value sama aja kan ya ?
                    // intinya pake destructuring lebih singkat tapi dikhususkan : { value } <= ada kurungan kurawal
                    
                    if (result.value) {

                        axios.delete('api/user/'+id).then(()=>{
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
            loadUsers() {
                if(this.$gate.isAdmin()){
                    axios.get("api/user").then(({ data }) => (this.users = data));
                }
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/user')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast.fire({
                            type: 'success',
                            title: 'User Created in successfully'
                        })

                    this.$Progress.finish();

                })
                .catch(() => {

                })
                
            }
        },

        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {

                })
            })
            this.loadUsers();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
            // setInterval(() => this.loadUsers(), 3000);
        }

        // mounted() {
        //     console.log('Component mounted.')
        // }
    }
</script>
