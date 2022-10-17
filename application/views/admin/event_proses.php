
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
              <h3 class="page-title">Event {{Nama_Event}}</h3>
          </div>
          <div class="col-sm-12 col-12">
              <h7 class="page-subtitle">Event</h7>
          </div>
      </div>  
      
            
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8 col-xs-12">
                <div id="monitoring"></div>
              </div> 
              <div class="col-md-4 col-xs-12">
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
  
  <script src='https://meet.jit.si/external_api.js'></script>
  <script type="text/javascript">
$(document).ready(function(){
  const domain = 'meet.jit.si';
  const options = {
    roomName: 'PickAnAppropriateMeetingNameHere',
        width: "100%",
        height: 400,
        parentNode: document.querySelector('#monitoring')
    };
const api = new JitsiMeetExternalAPI(domain, options);
})

  </script>
  <?php echo $this->session->flashdata('msg_edit_pasien') ? "<script>alert('".$this->session->flashdata('msg_edit_pasien')."')</script>" : ''; ?>
  <?php echo $this->session->flashdata('msg_hps_pasien') ? "<script>alert('".$this->session->flashdata('msg_hps_pasien')."')</script>" : ''; ?>


