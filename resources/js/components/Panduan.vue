<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Berkas Panduan</div>

                    <div class="card-body">
                        <form class="form-horizontal" @submit.prevent="createPanduan()">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="file" name="file" class="form-input"
                                    v-on:change="onFileChange">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    <button type="submit" @click.prevent="createPanduan"
                                    class="btn btn-success">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card card-body col-md-8 table-responsive p-0">
        <table class="table table-hover">
            <tr>
                <th>File name</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>{{panduan.panduan}}</td>
                <td>
                    <form v-on:submit.prevent="download(panduan.panduan)">
                        <button class="btn btn-primary" type="submit">Download</button>
                    </form>
                </td>
            </tr>
        </table>
        </div>
        </div>
        
    </div>


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
            this.loadPanduan();
        },

        methods: {

            async loadPanduan(){
               await axios.get("api/panduan").then((res) => {
                   this.panduan = {
                       id: res.data.id,
                       panduan: res.data.file
                   }
               });
            },
            download(file){
                axios.get('api/downloadpanduan/'+file, {responseType: 'arraybuffer'}).then(res=>{
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
        
                 axios.post('api/panduan', formData, config)
                .then((res)=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast.fire({
                        type: 'success',
                        title: 'Panduan Created in successfully'
                    })
                    this.loadPanduan();

                    this.$Progress.finish();
                })
                .catch(()=>{

                })
                
                }
        },
        created() {

            Fire.$on('AfterCreate',()=>{
            this.loadPanduan();
            });
        }
    }

    
</script>
