<template>
    <div class="container">
    <div class="row mt-5">
    <div class="col-md-12">
       
    <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
            
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Upload Draft</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                
                
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Penulis">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputJudul" class="col-sm-2 col-form-label">Judul Draft</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputJudul" placeholder="Judul Drafft">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Tgl\Bln\Thn</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputBio" placeholder="Masukan tgl\bln\thn">
                        </div>
                      </div>
                          <div class="form-group row">
                        <label for="File" class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-input" name="File">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Upload</button>
                          <button @click.prevent="cancelInfo" type="submit" class="btn btn-info">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

    </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
