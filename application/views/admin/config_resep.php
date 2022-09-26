
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content" style="height: 625px;">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Config Resep</a></li>
                </ol>
            </nav>
          </div>
      </div> 
      <form action="" method="POST">
              <div class="row mx-auto">


                <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">
                        <h4>Umum</h4>
                          </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-xs-12">
                            <label>Nama Faskes *</label>
                            <input type="text" class="form-control" value="<?= $resep->nama_faskes ?>" name="nama_faskes" required placeholder="Nama Faskes">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-xs-12">
                            <label>Website</label>
                            <input type="text" class="form-control" name="website" value="<?= $resep->website ?>" placeholder="cth: indihealth.com atau https://indihealth.com">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-xs-12">
                            <label>Alamat Lengkap *</label>
                            <textarea  class="form-control" rows="3" name="alamat" required placeholder="Alamat Lengkap"><?= $resep->alamat ?></textarea>
                          </div>
                        </div>
                      </div>
                  </div>
                 <div class="card">
                    <div class="card-header">
                        <h4>Kontak</h4>
                          </div>
                           <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 col-xs-12">
                            <label>No Hp*</label>
                            <input type="text" value="<?= $resep->no_wa ?>" class="form-control" name="no_wa" placeholder="cth: 0819392123">
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label>No Telp</label>
                            <input type="text" value="<?= $resep->no_telp ?>" class="form-control"  name="no_telp" placeholder="cth: (022)-90030">
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label>No Fax</label>
                            <input type="text" value="<?= $resep->fax ?>" class="form-control" name="fax"  placeholder="cth: (022)-90032">
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?= $resep->email ?>" name="email"  placeholder="cth: info@indihealth.com">
                          </div>
                        </div>
                      </div>
                </div>  

                <div class="card">
                
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-8 col-xs-12">
                            <label>Logo Faskes</label>
                            <input type="file" name="logo"  class="form-control" >
                          </div>
                        </div>
                      </div>
                </div>
                </div>
                 <div class="col-md-2 col-sm-12">
                  <button type="submit" class="btn btn-success btn-block">Simpan</button>
                </div> <div class="col-md-2 col-sm-12">
                  <a href="#" class="btn btn-primary btn-block">Pratinjau</a>
                </div>
            </div>
          </form>
          </div>
    </div> 
