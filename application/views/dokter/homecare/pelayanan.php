 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/homecare/pelayanan/room/' . $pelayanan->id_registrasi) ?>" class="text-black font-bold-7"><?= $title ?></a></li>
                     </ol>
                 </nav>
             </div>
             <div class="col-sm-12 col-12">
                 <h3 class="page-title"><?= $title ?></h3>
             </div>
         </div>
         <div class="row">
             <div class="col-12 p-4" style="background-color: #fff;border-top-left-radius: 20px;border-top-right-radius: 20px;border: 2px solid rgb(28,195,198)">
                 <div class="container">
                     <div class="row">
                         <div class="col-md-3">
                             <img src="<?= $pelayanan->foto_pasien ?>" alt="" class="img-fluid" style="border-radius: 20px">
                         </div>
                         <div class="col-md-8 mt-4">
                             <p class="font-20"><?= $pelayanan->nama_pasien ?></p>
                             <p class="font-18"><?= $pelayanan->umur_pasien ?> Tahun</p>
                             <p class="font-18">Pelayanan: <?= $pelayanan->list_nama_pelayanan ?></p>
                             <p class="font-18">Kebutuhan: <?= $pelayanan->kebutuhan ?></p>
                             <span class="badge badge-success d-<?= $pelayanan->sudah_dimulai ? 'block' : 'none'; ?>" id="start-desc">Pelayanan sedang berlangsung ( dimulai pada: <span class="dimulai-pada"><?= $pelayanan->dimulai_pada ?></span> )</span>
                             <button class="btn btn-lg bg-tele text-light d-<?= $pelayanan->sudah_dimulai ? 'none' : 'block'; ?>" id="start-button">Mulai Pelayanan</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row input-dokter d-<?= $pelayanan->sudah_dimulai ? 'block' : 'none' ?>">
             <div class="col-12 p-4" style="background-color: #fff; border-left: 1px solid rgb(28,195,198); border-right: 1px solid rgb(28,195,198); border-bottom: 2px solid rgb(28,195,198)">
                 <div class="container">
                     <div class="row">
                         <div class="col-12">
                             <nav>
                                 <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                     <a class="nav-item nav-link active font-18" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Assessment & Resep Obat</a>
                                     <a class="nav-item nav-link font-18" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Kegiatan</a>
                                 </div>
                             </nav>
                             <div class="tab-content" id="nav-tabContent">
                                 <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                     <div class="container">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <form id="formAssesment">
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label for="tinggi-badan">Tinggi Badan</label>
                                                                 <input type="number" class="form-control" id="tinggi-badan" name="tinggi_badan" value="<?= $assesment_exists ? $assesment->tinggi_badan : '' ?>" placeholder="ex: 160" required>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label for="berat-badan">Berat Badan</label>
                                                                 <input type="number" class="form-control" id="berat-badan" name="berat_badan" value="<?= $assesment_exists ? $assesment->berat_badan : '' ?>" placeholder="ex: 60" required>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label for="suhu">Suhu Tubuh</label>
                                                                 <input type="text" class="form-control" id="suhu" name="suhu" value="<?= $assesment_exists ? $assesment->suhu : '' ?>" placeholder="ex: 36.3" required>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label for="tekanan-darah">Tekanan Darah</label>
                                                                 <input type="text" class="form-control" id="tekanan-darah" name="tekanan_darah" value="<?= $assesment_exists ? $assesment->tekanan_darah : '' ?>" placeholder="ex: 100/70" required>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                             Merokok:<br />
                                                             <div class="mt-2 custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="merokok-1" name="merokok" value="1" class="custom-control-input" required <?= $assesment_exists ? ($assesment->merokok ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="merokok-1">Ya</label>
                                                             </div>
                                                             <div class="custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="merokok-2" name="merokok" value="0" class="custom-control-input" <?= $assesment_exists ? (!$assesment->merokok ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="merokok-2">Tidak</label>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                             Alkohol:<br />
                                                             <div class="mt-2 custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="alkohol-1" name="alkohol" value="1" class="custom-control-input" required <?= $assesment_exists ? ($assesment->alkohol ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="alkohol-1">Ya</label>
                                                             </div>
                                                             <div class="custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="alkohol-2" name="alkohol" value="0" class="custom-control-input" <?= $assesment_exists ? (!$assesment->alkohol ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="alkohol-2">Tidak</label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row mt-3">
                                                         <div class="col-md-6">
                                                             Kecelakaan:<br />
                                                             <div class="mt-2 custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="kecelakaan-1" name="kecelakaan" value="1" class="custom-control-input" required <?= $assesment_exists ? ($assesment->kecelakaan ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="kecelakaan-1">Ya</label>
                                                             </div>
                                                             <div class="custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="kecelakaan-2" name="kecelakaan" value="0" class="custom-control-input" <?= $assesment_exists ? (!$assesment->kecelakaan ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="kecelakaan-2">Tidak</label>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                             Operasi:<br />
                                                             <div class="mt-2 custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="operasi-1" name="operasi" value="1" class="custom-control-input" required <?= $assesment_exists ? ($assesment->operasi ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="operasi-1">Ya</label>
                                                             </div>
                                                             <div class="custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" id="operasi-2" name="operasi" value="0" class="custom-control-input" <?= $assesment_exists ? (!$assesment->operasi ? 'checked' : '') : '' ?>>
                                                                 <label class="custom-control-label" for="operasi-2">Tidak</label>
                                                             </div>
                                                         </div>
                                                         <button class="btn btn-block bg-tele text-light mt-2" type="submit"><i class="fa fa-save"> Simpan Assesment</i></button>
                                                     </div>
                                                 </form>
                                             </div>
                                             <div class="col-md-7 mt-4">
                                                 <button class="btn btn-block bg-tele text-light" type="button" data-toggle="modal" data-target="#ModalResep"><i class="fa fa-plus"></i> Tambah Resep</button>
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
                                                             <?php foreach ($resep_dokter as $obat) { ?>
                                                                 <tr>
                                                                     <td><?= $obat->name ?></td>
                                                                     <td><?= $obat->jumlah_obat ?></td>
                                                                     <td><?= $obat->keterangan ?></td>
                                                                     <td><button class="btn btn-secondary delete-resep" data-id-resep="<?= $obat->id ?>" onclick="return delete_resep(this)" type="button"><i class="fas fa-trash-alt"></i></button></td>
                                                                 </tr>
                                                             <?php } ?>
                                                         </tbody>
                                                     </table>
                                                 </div>
                                                 <div id="resepDokter"></div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                     <div class="table-responsive p-3">
                                         <button class="btn btn-lg bg-tele text-light mb-3" type="button" data-toggle="modal" data-target="#ModalKegiatan"><i class="fa fa-plus"></i> Tambah Kegiatan</button>
                                         <table class="table table-border table-hover custom-table mb-0">
                                             <thead class="font-12">
                                                 <tr class="text-abu">
                                                     <td>Nama Kegiatan</td>
                                                     <td>Foto</td>
                                                     <td>Aksi</td>
                                                 </tr>
                                             </thead>
                                             <tbody id="listKegiatan">
                                                 <?php foreach ($list_kegiatan as $kegiatan) { ?>
                                                     <tr>
                                                         <td><?= $kegiatan->nama ?></td>
                                                         <td><img class="kegiatan-<?= $kegiatan->id ?>" src="<?= base_url("assets/images/kegiatan_homecare/" . $kegiatan->foto) ?>" height="200px"></td>
                                                         <td><button class="btn btn-secondary" onclick="return delete_kegiatan(this)" type="button" data-id-kegiatan="<?= $kegiatan->id ?>"><i class="fas fa-trash-alt"></i></button></td>
                                                     </tr>
                                                 <?php } ?>
                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-12 mt-4">
                         <button class="btn btn-block btn-danger" id="end-button">Akhiri Pelayanan</button>
                     </div>
                 </div>
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

 <div class="modal fade" id="ModalKegiatan" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content" style="height: auto;">
             <div class="modal-header">
                 <p class="modal-title font-14 font-bold-7" id="exampleModalLabel">Tambah Kegiatan</p>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?= form_open_multipart('', 'id="formKegiatan"'); ?>
                 <div class="row">
                     <div class="col-md-12">
                         <div class="form-group">
                             <textarea class="form-control" id="nama-kegiatan" name="nama" placeholder="Nama Kegiatan" style="border-radius: 10px;" required></textarea>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="input-group mb-3">
                             <div class="custom-file">
                                 <input type="file" name="foto" class="custom-file-input" id="file_upload" required>
                                 <label class="custom-file-label" for="file_upload" id="filename">Upload Foto</label>
                             </div>
                         </div>
                     </div>
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

 <script>
     function obat_onchange() {
         var obat = document.getElementById('obat');
         var satuan = document.getElementById('obat-' + obat.value);
         var satuan_obat_hidden = document.getElementById('satuan_obat');

         var satuan_show = document.getElementById('unit');

         satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
         satuan_obat_hidden.value = satuan.innerHTML;
     }

     $('#formResepDokter').submit(function(e) {
         e.preventDefault();

         var formdata = new FormData();
         var listResep = $("#listResep");
         formdata.append('id_obat', $('#obat').val());
         formdata.append('jumlah_obat', $('input[name=jumlah_obat]').val());
         formdata.append('id_pasien', $('input[name=id_pasien]').val());
         formdata.append('id_dokter', '<?php echo $user->id ?>');
         formdata.append('id_jadwal_konsultasi', $('input[name=id_jadwal_konsultasi]').val());
         formdata.append('keterangan', $('input[name=keterangan]').val());
         formdata.append('satuan_obat', $('input[name=satuan_obat]').val());
         axios.post(baseUrl + 'dokter/Teleconsultasi/cartResep', formdata)
             .then(function(response) {

                 //  var templateListResep = '<tr id=obat-'+response.data.resep_id+'><td>'+response.data.name+'</td><td>'+response.data.jumlah_obat+' <small>'+response.data.satuan_obat+'</small></td><td>'+response.data.keterangan+'</td><td><button class=\'btn btn-secondary\' type=\'button\' delete-resep-obat data-resep='+response.data.resep_id+' ><i class=\'fas fa-trash-alt\'></i></button></td></tr>';
                 // listResep.append(templateListResep);
                 $("#listResephead").load(location.href + " #listResephead");
                 $('#formResepDokter')[0].reset();
                 $('#ModalResep').modal('hide')

             })
             .catch(function(error) {
                 console.log(error);
             });
     });

     function deleteObatAct(id, element) {
         var id = $(this).data('resep');
         Swal.fire({
             title: 'Hapus Resep Obat Ini?',

             showCancelButton: true,
             confirmButtonText: 'Hapus',
         }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
                 if (deleteResep(id, element)) {

                 }

             }
         })

     }

     function deleteResep(id, rm) {
         var formdata = new FormData();
         formdata.append('resep_id', id);
         axios.post(baseUrl + '/Dokter/Teleconsultasi/deleteResep', formdata)
             .then(function(response) {
                 (rm.parentNode).parentNode.remove();
                 Toast.fire({
                     icon: 'success',
                     title: response.data.message
                 })
                 return true;

             })
             .catch(function(error) {
                 console.log(error);
                 return false;
             });
     }
 </script>