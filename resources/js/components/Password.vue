<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 250px;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">

                    <div class="card-header">Ubah Password</div>
                    <div class="card-body">
                        <!-- I'm an example component. -->
                        <form class="form-horizontal">
                            
                                <!-- <div class="form-group">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    
                                    <div class="col-sm-12">
                                        <input type="name" v-model="form.name" id="inputName"
                                        placeholder="Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    
                                    <div class="col-sm-12">
                                        <input v-model="form.email" type="email" id="inputEmail"
                                        placeholder="Email Address"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bio" class="col-sm-2 col-form-label">
                                        Short bio for user <i>(Optional)</i>
                                    </label>
                                    
                                    <div class="col-sm-12">
                                        <textarea v-model="form.bio" id="bio"
                                        placeholder="Bio" class="form-control">
                                        </textarea>
                                        <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="photo" class="col-sm-2 col-form-label">Profile Photo</label>
                                    <div class="col-sm-12">
                                    <input type="file" @change="updateProfile" name="photo" class="form-input">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 col-form-label">Password</label>
                                    
                                    <div class="col-sm-12">
                                        <input v-model="form.password" type="password"
                                        id="password" placeholder="Password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="offset-col-sm-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit"
                                    class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    id : '',
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                    bio : '',
                    photo : ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {

            getProfilePhoto() {
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo;
                return photo;
                // return "img/profile/"+ this.form.photo;
            },
            updateInfo() {
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.form.reset();
                    toast.fire({
                            type: 'success',
                            title: 'Password has been changed'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
            },
            updateProfile(e) {
                // console.log('uploading');
                let file = e.target.files[0];
                console.log(file);
                let reader = new FileReader();
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result)
                    this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                }
                
            }
        },
        created() {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
