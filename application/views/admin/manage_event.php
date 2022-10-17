
    <!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-4">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('admin/pasien') ?>" class="text-black font-bold-7">Event Monitoring Management</a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Event Monitoring Management</h3>
          </div>
          <div class="col-sm-12 col-12">
              <h7 class="page-subtitle">Event</h7>
          </div>
      </div>  
      
            
        <div class="row">
          <div class="col-md-12">
           
            <div class="bg-tab p-3">
              <div class="tab-pane show pt-3" id="admin">   
                <div class="col-md-12">
                  <a href="#" class="btn btn-primary">Buat Event</a>
                  <div class="box">
                      <div class="container-1">
                          <span class="icon"><i class="fa fa-search font-16 text-tele"></i></span>
                          <input type="search" id="search" style="background: #ffffff !important;" placeholder="Cari Event Disini" />
                      </div>
                    </div>
                  <div class="table-responsive pt-4">
                    <table class="table table-bordered table-hover custom-table mb-0" id="table_pasien">
                      <thead class="text-tr">
                        <tr class="text-center">
                          <th class="text-left">No</th>
                          <th>Nama Event</th>
                          <th>Tanggal Mulai</th>
                          <th>Tanggal Selesai</th>
                          <th>Alamat</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="font-14">
                        <tr>
                          <td>1</td>
                          <td>Event Cirebon</td>
                          <td>2022-10-13</td>
                          <td>2022-10-20</td>
                          <td><button type="button" class="btn btn-success btn-sm btn-block">Lihat</button></td>
                          <td align="center"><span class="badge badge-success">Berlangsung</span></td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="" class="btn btn-primary btn-sm">Mulai</a>
                            <a href="" class="btn btn-warning btn-sm">Ubah</a>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
                          </div>

                          </td>
                        </tr>
                        </tbody>
                    </table> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-modal-header p-3">Hapus Data Pasien</h5>
      </div>
      <form method="post" action="<?php echo base_url('admin/Pasien/hapusPasien/'.$pasien->id);?>">
      <div class="modal-body font-modal-body">
          <p class="p-3">Anda yakin ingin menghapus data pasien <b id="nama"></b> ?</p>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
          <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  
  <?php echo $this->session->flashdata('msg_edit_pasien') ? "<script>alert('".$this->session->flashdata('msg_edit_pasien')."')</script>" : ''; ?>
  <?php echo $this->session->flashdata('msg_hps_pasien') ? "<script>alert('".$this->session->flashdata('msg_hps_pasien')."')</script>" : ''; ?>


