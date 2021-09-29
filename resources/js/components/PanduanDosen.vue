<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header text-center">
                    <strong>Panduan Poliwangi | PRESS</strong>
                </div>

                    <div class="card-body">
                        <form class="form-horizontal">
                            <!-- <div class="form-group">
                                <div class="col-sm-12">
                                    Panduan Poliwangi | PRESS
                                </div>
                            </div> -->
                            <div class="form-group text-center">
                                <div class="col-sm-12">
                                    <button type="submit" @click.prevent="downloadPanduan"
                                    class="btn btn-success">
                                    <i class="fas fa-download nav-icon"></i>
                                    Unduh Panduan
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- <input type="file">
                        <div class="modal-footer">
                            <button class="btn btn-success ml-auto" type="submit">Upload</button>
                        </div> -->
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
                file:""
            }
        },
        mounted() {
            this.panduanLoad()
        },

        methods: {
            async panduanLoad(){
                await axios.get('api/panduan')
                .then(res=>{
                    this.file = res.data.file
                })
            },
            async downloadPanduan(){
                axios.get('api/downloadpanduan/'+this.file, {responseType: 'arraybuffer'}).then(res=>{
                     let blob = new Blob([res.data], {type:'application/*'})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = this.file
                        link._target = 'blank'
                        link.click();
                })
            }
        }
    }
</script>
