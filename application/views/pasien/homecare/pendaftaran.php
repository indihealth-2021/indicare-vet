 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/homecare/pendaftaran') ?>" class="text-black font-bold-7"><?= $title ?></a></li>
                     </ol>
                 </nav>
             </div>
             <div class="col-sm-12 col-12">
                 <h3 class="page-title"><?= $title ?></h3>
             </div>
         </div>
         <div class="bg-tab p-3">
             <div class="row">
                 <div class="col-md-3 pb-2">
                     <div class="box">
                         <div class="container-1 ">
                             <span class="icon"><i class="fa fa-search font-16"></i></span>
                             <input type="search" id="search" placeholder="Cari Disini" />
                         </div>
                     </div>
                 </div>
                 <div class="col-md-8 pb-2">
                     <a href="<?php echo base_url('pasien/Telekonsultasi/jadwal') ?>" class="btn btn-sm bg-tele text-light" data-toggle="modal" data-target="#modalPendaftaranHomecare" data-nama="<?= $user->name ?>" data-no-hp="<?= $user->telp ?>" data-alamat="<?= 'Jalan '.ucwords(strtolower($user->alamat_jalan)).', Kel '.ucwords(strtolower($user->nama_kelurahan)).', Kec '.ucwords(strtolower($user->nama_kecamatan)).', Kab/Kota '.ucwords(strtolower($user->nama_kota)).', Kode Pos '.$user->kode_pos.', Provinsi '.ucwords(strtolower($user->nama_provinsi)) ?>"><i class="fa fa-plus"></i> Daftar</a>
                 </div>

             </div>
             <div class="table-responsive">
                 <table class="table table-border table-hover custom-table mb-0" id="table_pendaftaran">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Nama Visitor</th>
                             <th>Pelayanan</th>
                             <th>Alamat</th>
                             <th>Waktu Pelayanan</th>
                             <th>Status Registrasi</th>
                         </tr>
                     </thead>
                     <tbody class="font-14">
                         <?php foreach($data_registrasi as $idx=>$dr){ ?>
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><p><?= $dr->nama_dokter ? $dr->nama_dokter:'<span class="badge badge-secondary">BELUM DIVERIFIKASI</span>' ?></p></td>
                                <td>
                                    <p>
                                        Pelayanan yang dipilih:
                                        <ul>
                                            <?php for($i = 0; $i < count($dr->nama_pelayanan); $i++){ ?>
                                                <li><?= $dr->nama_pelayanan[$i] ?> ( <?= 'Rp ' . number_format($dr->harga_pelayanan[$i], 2, ',', '.') ?> )</li>
                                            <?php } ?>
                                        </ul>
                                        <span>Total Harga: <span class="badge bg-tele text-light"><?= 'Rp ' . number_format($dr->total_harga, 2, ',', '.') ?></span></span><br/><br/>
                                        <span>Kebutuhan:</span>
                                        <?= $dr->kebutuhan ? '<p class="badge bg-tele text-light">'.$dr->kebutuhan.'</p>':'<span class="badge badge-secondary">-</span>' ?>
                                    </p>
                                </td>
                                <td style="max-width: 250px !important;"><p><?= $dr->alamat_pelayanan ?></p></td>
                                <td>
                                    <p>Diajukan Pasien: <br/><?= '<span class="badge bg-tele text-light">'.$dr->tanggal_pelayanan_pasien.'</span>' ?><br/>
                                    Disetujui Admin: <br/><?= $dr->tanggal_pelayanan_admin ? '<span class="badge bg-tele text-light">'.$dr->tanggal_pelayanan_admin.' '.$dr->waktu_mulai.'</span>' : '<span class="badge badge-secondary">BELUM DIVERIFIKASI</span>' ?></p>
                                </td>
                                <td>
                                    <p>
                                        <?= $dr->status_registrasi ? ($dr->pembayaran_verif != null ? '<button class="btn btn-block btn-success" type="button">Sedang Diproses</button>':'<button class="btn bg-tele text-light btn-block" type="button" style="border: 1px solid #000" data-toggle="modal" data-target="#modalPembayaran" data-id-registrasi="'.$dr->id.'" data-visitor="'.$dr->nama_dokter.'" data-waktu-pelayanan="'.$dr->tanggal_pelayanan_admin.' '.$dr->waktu_mulai.'" data-list-pelayanan="'.$dr->list_nama_pelayanan.'" data-total-harga="'.$dr->total_harga.'"><i class="fa fa-money"></i> Bayar</button>'):'<span class="badge badge-secondary">BELUM DIVERIFIKASI</span>' ?>
                                    </p>
                                </td>
                            </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

 </div>
 </div>

<div class="modal fade" id="modalPendaftaranHomecare" tabindex="-1" role="dialog" aria-labelledby="modalPendaftaranHomecareTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: auto !important; width: auto !important">
      <div class="modal-header">
        <h5 class="modal-title font-18" id="modalPendaftaranHomecareTitle">Form Pendaftaran Homecare</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active font-16" id="data-pasien-tab" data-toggle="tab" href="#data-pasien" role="tab" aria-controls="data-pasien" aria-selected="true">Data Pasien</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-16" id="pendaftaran-tab" data-toggle="tab" href="#pendaftaran" role="tab" aria-controls="pendaftaran" aria-selected="false">Pelayanan</a>
            </li>
        </ul>
        <?= form_open(base_url('pasien/homecare/pendaftaran/daftar'), 'id=formPendaftaranHomecare') ?>
            <div class="tab-content container-fluid" id="myTabContent">
                <div class="tab-pane fade show active" id="data-pasien" role="tabpanel" aria-labelledby="data-pasien-tab">
                    <div class="form-group">
                        <label for="nama-pasien">Nama Pasien <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_pasien" id="nama-pasien" placeholder="Masukkan Nama Pasien" required style="color: #000 !important; background-color: #EEEEEE !important; border: 0.5px solid #62C1C5; border-radius: 5px;" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no-hp">No HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" id="no-hp" placeholder="Masukkan No HP" required style="color: #000 !important; background-color: #fff !important; border: 0.5px solid #62C1C5; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label for="alamat-pelayanan">Alamat Pelayanan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alamat_pelayanan" id="alamat-pelayanan" rows="3" required style="color: #000 !important; background-color: #fff !important; border: 0.5px solid #62C1C5; border-radius: 5px;"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="pendaftaran" role="tabpanel" aria-labelledby="pendaftaran-tab">
                    Pelayanan yang akan dipilih <span class="text-danger">*</span>
                    <div class="container mt-2" style="border: 1px solid #62C1C5; border-radius: 10px">
                        <div class="row">
                            <?php foreach($list_pelayanan as $pelayanan){ ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input pelayanan" type="checkbox" name="pelayanan[]" value="<?= $pelayanan->id ?>" id="pelayanan-<?= $pelayanan->id ?>" data-harga="<?= $pelayanan->harga ?>">
                                    <label class="form-check-label" for="pelayanan-<?= $pelayanan->id ?>">
                                            <div class="d-inline-flex">
                                                <!-- <div class="dash-icon mx-auto my-auto">
                                                <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                                                </div> -->
                                                <div class="my-auto">
                                                    <img src="<?php echo base_url('assets/images/pelayanan/'.$pelayanan->gambar);?>">
                                                </div>
                                                <div class="mx-3 mt-2">
                                                <p class="font-16 my-2 text-black"><?= $pelayanan->nama ?></p>
                                                <p class="font-14 text-dash"><?= 'Rp ' . number_format($pelayanan->harga, 2, ',', '.') ?></p>
                                                </div>
                                            </div>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <b class="mt-2 font-16">Total Harga: <span class="font-14 text-dash total-harga-pelayanan">Rp. 0,00</span></b>
                    </div>
                    <div class="form-group mt-4">
                        <label for="kebutuhan">Kebutuhan</label>
                        <textarea class="form-control" name="kebutuhan" id="kebutuhan" rows="3" style="color: #000 !important; background-color: #fff !important; border: 0.5px solid #62C1C5; border-radius: 5px;"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="tanggal-pelayanan">Ajukan Jadwal Pelayanan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pelayanan" class="form-control" id="tanggal-pelayanan" placeholder="Tanggal Pelayanan" required style="color: #000 !important; background-color: #fff !important; border: 0.5px solid #62C1C5; border-radius: 5px;">
                    </div>
                    <div class="form-group mt-4">
                        <label for="alamat-pengiriman-obat">Alamat Pengiriman Obat <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alamat_pengiriman_obat" id="alamat-pengiriman-obat" rows="3" style="color: #000 !important; background-color: #fff !important; border: 0.5px solid #62C1C5; border-radius: 5px;" required></textarea>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="p-2">
            <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-simpan">Daftar</button>
          </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="modalPembayaranTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: auto !important; width: auto !important">
      <div class="modal-header">
        <h5 class="modal-title font-18" id="modalPembayaranTitle">Form Pembayaran Homecare</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?= form_open_multipart('', 'id="formPembayaran"') ?>
        <div class="container">
            <!-- <div class="row">
                <div class="col-12 bg-tele text-light text-center p-2" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">
                    Invoice
                </div>
                <div class="col-12" style="border: 1px solid #62C1C5">
                    <div class="container p-2">
                        test
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-4">
                    Visitor
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-7 visitor">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    Waktu Pelayanan
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-7 waktu-pelayanan">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    Pelayanan
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-7 list-pelayanan">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    Total Harga
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-7 total-harga">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 mt-1">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="file_upload" required>
                            <label class="custom-file-label" for="file_upload" id="filename">Upload Bukti Pembayaran</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <div class="p-2">
            <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-simpan">Bayar</button>
          </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<script>
/* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>