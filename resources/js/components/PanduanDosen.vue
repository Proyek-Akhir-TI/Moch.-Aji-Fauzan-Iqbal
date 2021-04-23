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
                                    <button type="submit" @click.prevent="unduhPanduan"
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
            unduhPanduan() {
                this.$Progress.start();
                this.form.put('api/panduan')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
            }
        },
        created() {
            axios.get("api/usulan")
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
