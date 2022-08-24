<!-- Main content -->
  <div class="page-wrapper">
    <div class="content">
      <div class="row mb-3">
        <div class="col-sm-12 col-12 ">
          <nav aria-label="">
              <ol class="breadcrumb" style="background-color: transparent;">
                  <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard');?>"class="text-black">Dashboard</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/Teleconsultasi');?>"class="text-black">Jadwal Telekonsultasi</a></li>
                  <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Proses Telekonsultasi</a></li>
              </ol>
          </nav>
        </div>
        <div class="col-sm-12 col-12">
            <h3 class="page-title">Proses Telekonsultasi</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-md-7">
          <div class="card card-5 p-1 px-4 pt-3 pb-5">
            <ul class="nav nav-tabs-konsul nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#bottom-tab2" data-toggle="tab">Video</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab1" data-toggle="tab">Chat</a></li>
            </ul>
            
            <div class="tab-content">
                        <div class="tab-pane show" id="bottom-tab1">
                            <div class="">
                                <div class="col-lg-9 message-view chat-view">
                                    <div class="chat-window">
                                        <div class="card-box">
                                            <div class="chat-contents chat-content-wrap">
                                                <div class="chat-wrap-inner">
                                                    <div class="chat-box">
                                                        <div class="chats" id="messages">
                                                            <!--<div class="chat chat-right">
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>Hello. What can I do for you?</p>
                                                                                    <span class="chat-time">8:30 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat-line">
                                                                        <span class="chat-date">October 8th, 2015</span>
                                                                    </div>
                                                                    <div class="chat chat-right">
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>Where?</p>
                                                                                    <span class="chat-time">8:35 am</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content">
                                                                                    <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                                                                    <span class="chat-time">8:42 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat chat-left">
                                                                        <div class="chat-avatar">
                                                                            <a href="#" class="avatar">
                                                                                <img alt="<?php //echo $pasien->name 
                                                                                            ?>" src="<?php //echo base_url('assets/dashboard/img/patient-thumb-02.jpg');
                                                                                                                                ?>" class="img-fluid rounded-circle">
                                                                            </a>
                                                                        </div>
                                                                        <div class="chat-body">
                                                                            <div class="chat-bubble">
                                                                                <div class="chat-content img-content">
                                                                                    <div class="chat-img-group clearfix">
                                                                                        <p>Uploaded 3 Images</p>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">placeholder.jpg</div>
                                                                                                <div class="chat-file-desc">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                        <a class="chat-img-attach" href="#">
                                                                                            <img width="182" height="137" alt="" src="assets/img/placeholder.jpg">
                                                                                            <div class="chat-placeholder">
                                                                                                <div class="chat-img-name">placeholder.jpg</div>
                                                                                                <div class="chat-file-desc">842 KB</div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                    <span class="chat-time">9:00 am</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>-->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-footer">
                                          <?= form_open_multipart('', 'id="form-message"'); ?> 
                                                <div class="message-bar">
                                                    <div class="message-inner">
                                                        <label class="images-upload px-3 mt-2">
                                                            <img src="<?php echo base_url('assets/dashboard/img/file.png'); ?>" alt="">
                                                            <input id="attachment_label" type="file" name="attachment" accept=".jpg,.jfif,.jpeg,.png,.txt,.docx,.doc,.pdf">
                                                        </label>
                                                        <div class="message-area">
                                                            <div class="input-group">
                                                                <textarea class="form-control" name="message" placeholder="Type message..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-send-mess mt-2" id="send">
                                                      <img src="<?php echo base_url('assets/dashboard/img/send.png'); ?>" width="20" height="auto" alt="">
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9" id="attachment_name">

                                                    </div>
                                                </div>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="bottom-tab2">
                          <div class="row my-2 px-3">
                            <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="mb-2 btn btn-konsul" id="panggil" data-id-pasien="<?php echo $pasien->id ?>" data-id-jadwal-konsultasi="<?php echo $id_jadwal_konsultasi ?>"><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button> -->
                            <button type="button" id="call-btn" class="mb-2 btn btn-konsul"><img src="<?php echo base_url('assets/dashboard/img/phone-call.png'); ?>" alt=""> Hubungi Pasien</button>
                            <!-- <button type="button" class="btn btn-konsul mx-3 d-mobile-none_" id="btn-stop" data-id-jadwal-konsultasi='<?php echo $id_jadwal_konsultasi ?>' data-id-pasien="<?php echo $pasien->id ?>"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>  -->  
                            <button type="button" class="btn btn-konsul mx-3 d-mobile-none_" id="btn-stop-call"><img src="<?php echo base_url('assets/dashboard/img/end-call.png'); ?>" alt=""> Akhiri Panggilan</button>
                            

                                  <!-- Modal -->
                                  <div class="modal fade" id="memanggil" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" >
                                          <div class="modal-content" style="width: 400px">
                                              <div class="modal-header">
                                                  <p class="modal-title font-24" id="ring_text"></p>
                                              </div>
                                              <div class="modal-body" align="center">
                                                  <i class="fa fa-phone fa-5x text-tele">....</i>
                                                  <div class="mt-5">
                                                    <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!--modal-->

                                </div>
                            <div class="">
                                <div id="meet" width="800" height="700" style="background: #000;"></div>
                                <!-- <video autoplay id="video-other" style="background-color: #000;" width="100%" height="100%"></video>                  
                                          <video autoplay id="video-ku" style="background-color: #000; position: absolute; bottom: 75px; right: 8px; width: 40%; height: 40%;"></video> -->
                            </div>
                        </div>
                    </div>
          </div>



          <!--card diagnosa-->
          <div class="card card-5 p-2 px-4">
            <?= form_open('','id="formKonsultasi_2"'); ?>
              <p class="py-2 font-12">Diagnosa</p>
              <div class="col-md-12" id="diagnosis">
                  <div class="form-group row">
                    <select id='diagnosis' name='diagnosis' style="width: 100%">
                        <option value='0'>-- Pilih Diagnosa --</option>
                    </select>
                    <!-- <textarea class="form-control" rows="5" placeholder="diagnosa dokter" name="diagnosis"><?php //if($diagnosis){ echo $diagnosis->diagnosis; } 
                                                                                                                                ?></textarea> -->
                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>" required>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <p class="font-12">Resep</p>  
                </div>
                <div class="col-md-3">
                  <button class="btn btn-resep float-right" type="button" data-toggle="modal" data-target="#ModalResep" id="add">+ Tambah Resep Pasien </button>
                </div>
              </div>
              <div class="row">
                <div class="table-responsive p-3">
                    <table class="table table-border table-hover custom-table mb-0">
                        <thead class="font-12">
                            <tr class="text-abu">
                                <td>Nama Obat</td>
                                <td>Jumlah</td>
                                <td>Aturan Pakai</td>
                                <td>Aksi</td>
                            </tr>
                         </thead>
                        <tbody id="listResep">
                        </tbody>
                    </table>
                </div>
                <div id="resepDokter"></div>
              </div>
              <input type="hidden" name="id_pasien" value=<?php echo $pasien->id ?>>
              <input type="hidden" name="id_jadwal_konsultasi" value=<?php echo $id_jadwal_konsultasi ?>>
             <?= form_close(); ?>
          </div>
        </div>


        <!-- batas col-md-7 -->
        <div class="col-md-5">
          <div class="card card-5 p-2 px-4">
              <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Data Pasien</p>
            <div class="row">
               <?php
                if ($pasien->foto) {
                    $foto = base_url('assets/images/users/' . $pasien->foto);
                } else {
                    $foto = base_url('assets/telemedicine/img/default.png');
                }
                ?>
              <div class="col-md-2"><img src="<?php echo $foto; ?>" width="41" height="41" class="border-radius-50"></div>
              <div class="col-md-9">
                <span class="font-14"><?php echo ucwords($pasien->name) ?></span><br>
                <span class="font-11"><?php echo $pasien->age == '2020' ? '-' : $pasien->age . ' Tahun' ?></span>
              </div>
            </div>
          </div>

          <?= form_open('', 'id="formKonsultasi"'); ?> 
            <div class="card card-5 p-2 px-4">
                <p style="border-bottom: 1px solid #DEDEDE;" class="py-2 font-12">Assesment Pasien</p>
              <div class="row mb-5">
                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="form-group form-focus-asses">
                        <label class="focus-label">Berat Badan</label>
                        <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->berat_badan;} ?>" name="berat_badan" placeholder="Isi Berat Badan Disini" required>
                        <label class="focus-label-right">Kg</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="form-group form-focus-asses">
                        <label class="focus-label">Tinggi Badan</label>
                        <input type="number" class="form-control floating" value="<?php if ($assesment) {echo $assesment->tinggi_badan;} ?>" name="tinggi_badan" placeholder="Isi Tinggi Badan Disini" required>
                        <label class="focus-label-right">Cm</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="form-group form-focus-asses">
                        <label class="focus-label">Tekanan Darah</label>
                        <input type="text" class="form-control floating" name="tekanan_darah" value="<?php if ($assesment && !$old_assesment) { echo $assesment->tekanan_darah; } ?>" placeholder="Isi Tekanan Darah Disini">
                        <label class="focus-label-right">mmHg</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="form-group form-focus-asses">
                        <label class="focus-label">Suhu</label>
                        <input type="text" class="form-control floating" name="suhu" value="<?php if ($assesment && !$old_assesment) { echo $assesment->suhu; } ?>"placeholder="Isi Suhu Disini">
                        <label class="focus-label-right">Celcius</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <div class="form-group font-12">
                        <label for="" class="text-abu col-form-label">Merokok</label><br>
                        <label class="radio-inline">
                            <input required type="radio" name="merokok" id="merokok-1" value=1 <?php if ($assesment) { if ($assesment->merokok) { echo "checked";}} ?>> Ya
                        </label><br>
                        <label class="radio-inline">
                            <input required type="radio" name="merokok" id="merokok-0" value=0 <?php if ($assesment) {if (!$assesment->merokok) {echo "checked";}} ?>> Tidak
                        </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                      <div class="form-group font-12">
                          <label for="" class="text-abu col-form-label">Di Rawat</label><br>
                           <label class="radio-inline">
                              <input required type="radio" name="dirawat" id="dirawat-1" value=1 <?php if ($assesment) { if ($assesment->dirawat) {  echo "checked"; } } ?>> Pernah
                          </label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="dirawat" id="dirawat-0" value=0 <?php if ($assesment) { if (!$assesment->dirawat) {  echo "checked"; } } ?>> Tidak Pernah
                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="mb-3">
                      <div class="form-group font-12">
                          <label for="" class="text-abu col-form-label">Minum Alkohol</label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="alkohol" id="alkohol-1" value=1 <?php if ($assesment) { if ($assesment->alkohol) { echo "checked"; } } ?>> Ya
                          </label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="alkohol" id="alkohol-0" value=0 <?php if ($assesment) { if (!$assesment->alkohol) { echo "checked"; } } ?>> Tidak
                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                      <div class="form-group font-12">
                          <label for="" class="text-abu col-form-label">Kecelakaan</label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="kecelakaan" id="kecelakaan-1" value=1 <?php if ($assesment) { if ($assesment->kecelakaan) { echo "checked"; } } ?>> Pernah
                          </label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="kecelakaan" id="kecelakaan-0" value=0 <?php if ($assesment) { if (!$assesment->kecelakaan) {  echo "checked"; } } ?>> Tidak Pernah
                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <div class="mb-3">
                      <div class="form-group font-12">
                          <label for="" class="text-abu col-form-label">Operasi</label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="operasi" id="operasi-1" value=1 <?php if ($assesment) { if ($assesment->operasi) { echo "checked"; } } ?>> Pernah
                          </label><br>
                          <label class="radio-inline">
                              <input required type="radio" name="operasi" id="operasi-0" value=0 <?php if ($assesment) { if (!$assesment->operasi) { echo "checked"; } } ?>> Tidak Pernah
                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-5 pb-5">
                      <div class="form-group form-focus-asses">
                          <label class="focus-label">Keluhan</label>
                          <textarea required rows="4" class="font-12 form-control floating" name="keluhan"><?php if ($assesment && !$old_assesment) { echo $assesment->keluhan; } ?></textarea>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          <?= form_close(); ?>
          <!-- <button type="button" class="btn-selesai-tele">Selesai</button> -->
        </div>
      </div>
    </div>
  </div>



<div class="modal fade" id="ModalResep" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: auto;">
            <div class="modal-header">
                <p class="modal-title font-14 font-bold-7" id="exampleModalLabel">Tambah Resep</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('', 'id="formResepDokter"'); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="font-12 col-form-label">Pilih Obat </label> 
                                    <?php foreach ($list_obat as $obat) { ?>
                                        <div id="obat-<?php echo $obat->id ?>" style="display: none"><?php echo $obat->unit ?></div>
                                    <?php } ?>
                                    <select name="id_obat" id="obat" class="form-control 
                                                    form-control-sm" onchange="obat_onchange();" required>
                                        <option disabled selected value="">Pilih Obat</option>
                                        <?php foreach ($list_obat as $obat) { ?>
                                            <option value="<?php echo $obat->id ?>"><?php echo $obat->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="font-12 col-form-label">Jumlah Obat</label>
                                    <input type="number" min=1 max=100 name="jumlah_obat" class="form-control form-control-sm" id="unit" placeholder="Jumlah" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="font-12 col-form-label">Aturan Pakai</label> 
                                    <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Aturan Pakai" required>
                                </div>
                            </div>
                            <input type="hidden" name="satuan_obat" id="satuan_obat" value="">
                        </div>
            </div>
            <div class="modal-footer">
              <div class="float-left">
                <button id="buttonTambahResep" class="btn btn-simpan-sm">Simpan</button>
                <button type="button" class="btn btn-batal-sm mr-3" data-dismiss="modal">Batal</button>
              </div>
            </div>
             <?= form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="pasienError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 300px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pasien Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pasien <b><?php echo ucwords($pasien->name) ?></b> tidak dapat menerima panggilan saat ini, karena belum mengizinkan notifikasi di devicenya. <br />
                No HP Pasien: <b><?php echo $pasien->telp ?></b><br />
                Email Pasien: <b><?php echo $pasien->email ?></b>
            </div>
            <div class="modal-footer">
                <div class="float-left">
                <button type="button" class="btn btn-batal-sm mr-3" data-dismiss="modal">Batal</button>
              </div>
            </div>
        </div>
    </div>
</div>

<script>

        firebase
              .database()
              .ref("assesment/<?= md5($pasien->id."_".$id_jadwal_konsultasi)?>")
              .once("value", function (snapshot) {
                firebase
                          .database()
                          .ref('assesment/<?= md5($pasien->id."_".$id_jadwal_konsultasi)?>')
                          .update({ 
                           
                            inputed: 0,
            })
        })
        
    // ENDCALL
    $('#btn-stop-call').click(function(){
   
   
    Swal.fire({
          title: 'Akhiri konsultasi ini?',
          // showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Akhiri Panggilan',
          cancelButtonText: 'Batalkan',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            firebase
                      .database()
                      .ref("panggilan/<?= md5($pasien->id); ?>")
                      .update({
                        endCall: 1,
                      });
             // $('#formResepDokter').append($('#formKonsultasi').children())
             //   $.ajax({
             //        method : 'POST',
             //        url    : baseUrl+'dokter/Teleconsultasi/send_data_konsultasi',
             //        data   : $('#formResepDokter').serializeArray(),
             //        success : function(data){
             //            firebase
             //          .database()
             //          .ref("panggilan/<?= md5($pasien->id); ?>")
             //          .update({
             //            endCall: 1,
             //          });
             //           location.href = '<?= base_url('dokter/Teleconsultasi')?>';    
             //        },
             //        error : function(request, status, error){
             //            console.log(request);
             //            console.log(status);
             //            console.log(error);
             //        }
             //    }); 
          } 
        })

        // $.ajax({
        //             method : 'POST',
        //             url    : baseUrl+'dokter/Teleconsultasi/send_data_konsultasi',
        //             data   : $('#formResepDokter').serializeArray(),
        //             success : function(data){
        //                location.href = '<?= base_url('dokter/Teleconsultasi')?>';    
        //             },
        //             error : function(request, status, error){
        //                 console.log(request);
        //                 console.log(status);
        //                 console.log(error);
        //             }
        //         }); 
     

    })
</script>
<script type="text/javascript">
    
     firebase.database().ref("assesment/<?= md5($pasien->id."_".$id_jadwal_konsultasi)?>").on('value', function(snapshot) {
             firebase
              .database()
              .ref("assesment/<?= md5($pasien->id."_".$id_jadwal_konsultasi)?>")
              .once("value", function (snapshot) {
                // console.log(snapshot.val());
                if(snapshot.val().inputed == 1)
                {
                    Swal.fire('Pasien telah mengupdate assestment.') 
                $('input[name=berat_badan]').val(snapshot.val().berat_badan);
              $('input[name=tinggi_badan]').val(snapshot.val().tinggi_badan);
              $('input[name=suhu]').val(snapshot.val().suhu);
              $('input[name=tekanan_darah]').val(snapshot.val().tekanan_darah);
              if (snapshot.val().merokok == 1) {
                $('#merokok-1').prop('checked', true);
              } else {
                $('#merokok-0').prop('checked', true);
              }

              if (snapshot.val().alkohol == 1) {
                $('#alkohol-1').prop('checked', true);
              } else {
                $('#alkohol-0').prop('checked', true);
              }

              if (snapshot.val().kecelakaan == 1) {
                $('#kecelakaan-1').prop('checked', true);
              } else {
                $('#kecelakaan-0').prop('checked', true);
              }

              if (snapshot.val().dirawat == 1) {
                $('#dirawat-1').prop('checked', true);
              } else {
                $('#dirawat-0').prop('checked', true);
              }

              if (snapshot.val().operasi == 1) {
                $('#operasi-1').prop('checked', true);
              } else {
                $('#operasi-0').prop('checked', true);
              }

              $('textarea[name=keluhan]').val(snapshot.val().keluhan);
                   
                 } 
                 
    })
    })

    firebase.database().ref("panggilan/<?=  md5($pasien->id) ?>").on('value', function(snapshot) {
             firebase
              .database()
              .ref("panggilan/<?= md5($pasien->id) ?>")
              .once("value", function (snapshot) {
                console.log(snapshot.val());
                if(snapshot.val().connected == 1)
                {
                   $("#ring_text").html('Berdering...');
                   
                 } 
                 if(snapshot.val().accepted == 1)
                {
                   $('#memanggil').modal('hide');
                   
                 } 
                if(snapshot.val().closeCall == 1)
                {
                   $('#memanggil').modal('hide');
                   
                 } 
               if(snapshot.val().reject == 1)
                {
                   $('#memanggil').modal('hide');
                   Swal.fire('Panggilan anda ditolak pasien') 
                   
                 }
        // firebase
        //           .database()
        //           .ref("panggilan/<?= md5($pasien->id) ?>")
        //           .update({
                  
        //             connected: 0,
        //           }); 
    })
    })
    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    var uniqid = makeid(12);
    reg_id = '<?php echo $pasien->reg_id; ?>';
    name = '<?php echo $user->name; ?>';
    var room_name = '<?=  hash('sha256','telemedicine_idh_'.$id_jadwal_konsultasi.'_' .$user->id.'_'.random_string('alnum',8))?>';

 $('#call-btn').click(function(){
        $('#memanggil').modal('show');
        $("#ring_text").html('Memanggil...')
        firebase
          .database()
          .ref("panggilan/<?= md5($pasien->id); ?>")
          .set({
            title: 'Panggilan dari <?= $user->name ?> ke <?= $pasien->name  ?>',
            call_From: 'Panggilan dari <?= $user->name ?>',
            time: Date.now(),
            consult_room: baseUrl + 'pasien/Telekonsultasi/konsultasi/' + <?= $user->id ?> + '/' + <?php echo $id_jadwal_konsultasi ?>+ '/' +room_name ,
            closeCall: 0,
            endCall: 0,
            accepted: 0,
            reject: 0,
            connected: 0,
            roomName: room_name,
            id_jadwal_konsultasi: <?php echo $id_jadwal_konsultasi ?>,
            id_dokter: <?php echo $user->id ?>
          });
      });

    function closeCall()
      {
         $('#memanggil').modal('hide'); 
        firebase
          .database()
          .ref("panggilan/<?= md5($pasien->id); ?>")
          .update({
            title: 'Panggilan dari <?= $user->name ?> ke <?= $pasien->name  ?>',
            time: Date.now(),
            consult_room: baseUrl + 'pasien/Telekonsultasi/konsultasi/' + <?= $user->id ?> + '/' + <?php echo $id_jadwal_konsultasi ?>+ '/' +room_name ,
            closeCall: 1,
            endCall: 0,
            accepted: 0,
            // reject: 0,
            // roomName: room_name,
            id_jadwal_konsultasi: <?php echo $id_jadwal_konsultasi ?>,
            id_dokter: <?php echo $user->id ?>
          });
      }

      $('#memanggil').on('hidden.bs.modal', function () {
            closeCall()
        });

    
    document.getElementById("user-call").value = '<?php echo $pasien->id ?>';
    var userName = name;
    const domain = 'telekonsultasi2.telemedical.id';
    const options = {
        roomName: room_name,
        width: 535,
        height: 400,

        parentNode: document.querySelector('#meet')

    };
    const api = new JitsiMeetExternalAPI(domain, options);
    api.executeCommand('displayName', userName);
    api.executeCommand('toggleTileView');
    api.executeCommand('startRecording', {
        mode: 'file' //recording mode, either `file` or `stream`.
    });
    api.addEventListener('participantRoleChanged', function(event) {
        if (event.role === 'moderator') {
            api.executeCommand('toggleLobby', true);
        }
    });
    api.on('passwordRequired', function() {
        api.executeCommand('password', '123456');
    });

    function recordJitsi(e) {
        api.executeCommand('stopRecording', 'stream');
        var isRecording = e.getAttribute('data-is-recording');
        if (isRecording == "1") {
            api.executeCommand('stopRecording', 'stream');
            e.innerHTML = '<i class="fas fa-record-vinyl"></i> Mulai Rekam';
            e.setAttribute('data-is-recording', "0");
            e.style = 'background-color: green';
        } else {
            api.executeCommand('startRecording', 'stream');
            e.innerHTML = '<i class="fas fa-stop"></i> Stop Rekam';
            e.setAttribute('data-is-recording', "1");
            e.style = 'background-color:red;';
        }
    }
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script>
<?php $foto_pasien = $pasien->foto ? base_url('assets/images/users/' . $pasien->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<?php $foto_dokter = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<script>
    chat_locate = 'dokter';
    user_kategori = 'dokter';
    id_pasien = <?php echo $pasien->id ?>;
    id_dokter = <?php echo $user->id ?>;
    foto_pasien = '<?php echo $foto_pasien ?>';
    foto_dokter = '<?php echo $foto_dokter ?>';
</script>
<script>
    function resizeInput() {
        $(this).attr('size', $(this).val().length);
    }

    $('input[type="text"]')
        .keyup(resizeInput)
        .each(resizeInput);

    $('input[type="number"]')
        .keyup(resizeInput)
        .each(resizeInput);
</script>

<script>
    function obat_onchange() {
        var obat = document.getElementById('obat');
        var satuan = document.getElementById('obat-' + obat.value);
        var satuan_obat_hidden = document.getElementById('satuan_obat');

        var satuan_show = document.getElementById('unit');

        satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
        satuan_obat_hidden.value = satuan.innerHTML;
    }
</script>
<div class="sidebar-overlay" data-reff=""></div>
<style>
    .images-upload>input {
        display: none;
    }

    .images-upload>img {
        cursor: pointer;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
</style>
