<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Berkas Panduan</div>

                    <div class="card-body">
                        <form class="form-horizontal" @submit.prevent="editmode ? updatePanduan() : createPanduan()">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="file" name="file" class="form-input"
                                    v-on:change="onFileChange">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <button type="submit" @click.prevent="updatePanduan"
                                    class="btn btn-success" v-on:change="onFileChange">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div>
        <h1>Vue.js + Laravel</h1>

        <form v-on:submit.prevent="uploadFile">
            <md-field>
                <label>Select file</label>
                <md-file  name="file" v-on:change="onSelectFile" />
            </md-field>

            <md-button type="submit" class="md-raised md-accent">Upload</md-button>
        </form>
        <hr>

        <table>
            <tr>
                <th>File name</th>
                <th>Actions</th>
            </tr>
            <tr v-for="panduan in panduan" :key="panduan.id">

                <td>file</td>
                <td>
                    <form v-on:submit.prevent="downloadFile(file)">
                        <md-button class="md-raised md-danger" type="submit">Download</md-button>
                    </form>

                    <form v-on:submit.prevent="deleteFile(file)">
                        <md-button class="md-raised md-danger" type="submit">Delete</md-button>
                    </form>
                </td>
            </tr>
        </table>
    </div> -->
</template>

<script>
    export default {
        data() {
            return {
                panduan : {},
                form: new Form({
                    id : '',
                    file : '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            updatePanduan() {
                this.$Progress.start();
                this.form.post('api/panduan'+this.form.id)
                .then(()=>{
                    $('#addNew').modal('hide');
                    swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                    
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
            },
            deletePanduan(id){
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

                                this.form.delete('api/panduan/'+id).then(()=>{
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
            loadPanduan(){
                axios.get("api/panduan").then(({ data }) => this.panduan = data.data);
            },
            download(file){
                axios.get('/download/panduan/'+file, {responseType: 'arraybuffer'}).then(res=>{
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
            createPanduan() {
                this.$Progress.start();
                const config = {
                            headers: { 'content-type': 'multipart/form-data' }
                        }
            
                        let formData = new FormData();
                        formData.append('file', this.file);
        
                        axios.post('/api/panduan', formData, config)
                // this.form.post('api/usulan')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast.fire({
                        type: 'success',
                        title: 'Panduan Created in successfully'
                    })

                    this.$Progress.finish();
                })
                .catch(()=>{

                })
                
                }
        },
        created() {
            // axios.get("api/panduan")
            // .then(({ data }) => (this.form.fill(data)));

            this.loadPanduan();
            Fire.$on('AfterCreate',()=>{
            this.loadPanduan();
            });
        }
    }

    
</script>
