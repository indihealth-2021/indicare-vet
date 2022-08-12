 <!-- Main content -->
 <div class="page-wrapper">
      <div class="content">
          <div class="row mb-3">
              <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien');?>"class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/homecare/ResepDokter') ?>"class="text-black font-bold-7"><?= $title ?></a></li>
                    </ol>
                </nav>
              </div>
              <div class="col-sm-12 col-12">
                  <h3 class="page-title"><?= $title ?></h3>
              </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="bg-tab p-3">
                <div class="row">
                  <div class="col-md-3 mx-3">
                        <div class="box">
                            <div class="container-1 ">
                                <span class="icon"><i class="fa fa-search font-16"></i></span>
                                <input type="search" id="search" placeholder="Cari Dokter Disini" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-border table-hover custom-table mb-0" id="table_resep">
                                    <thead class="text-tr">
                                        <tr>                                            
                                            <th class="text-left">No</th>
                                            <th>Waktu Pelayanan</th>
                                            <th width="250px">Resep</th>
                                            <th>Total Harga</th>
                                            <th>Visitor</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($list_resep as $idx => $resep){?>
                                        <?php if($resep->diverifikasi != 1){ ?>
                                            <tr>        
                                                <td class="text-center"><?php echo $idx+1 ?></td>
                                                <td>
                                                <?= $resep->waktu_pelayanan ?></td>
                                                <td><ul><?php echo $resep->detail_obat ?></ul></td>
                                                <?php 
                                                    $list_harga_obat = explode(',', $resep->harga_obat);
                                                    $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
                                                    $list_jumlah_obat = explode(',', $resep->jumlah_obat);
                                                    $jml_data = count($list_harga_obat);
                                                    $list_total_harga = [];
                                                    $total_harga = 0;
                                                    for($i=0; $i<$jml_data; $i++){
                                                        $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
                                                    }

                                                    foreach($list_total_harga as $tot_harga){
                                                        $total_harga+=$tot_harga;
                                                    }
                                                    $total_harga+=$resep->biaya_pengiriman;
                                                ?>
                                                <td><?php echo 'Rp. '.number_format($total_harga,2,',','.'); ?></td>
                                                <td><?php echo $resep->nama_dokter ?></td>    
                                                <td class='text-center'>
                                                  <?php if($resep->diverifikasi == NULL){ ?>
                                                    <button class="btn btn-block bg-tele text-light" type="button" data-toggle="modal" data-target="#modalPembayaran" data-id-registrasi="<?= $resep->id_registrasi ?>" data-visitor="<?= $resep->nama_dokter ?>" data-waktu-pelayanan="<?= $resep->waktu_pelayanan ?>" data-list-resep="<?= $resep->detail_obat ?>" data-total-harga=<?= $total_harga ?>>Bayar</button>
                                                  <?php }else{ ?>
                                                    <button class="btn btn-block btn-success" type="button">Diproses</button>
                                                  <?php } ?>
                                                </td>                              
                                            </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                    </table>
              </div> 
              </div>
            </div>
          </div>                          
        </div>
      </div>


<?php if($this->session->flashdata('msg_resep_dokter')){ ?>
<script>
alert("<?php echo $this->session->flashdata('msg_resep_dokter') ?>");
</script>
<?php } ?>

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
                    Resep Obat
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-7 list-resep">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalHapus">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-modal-header p-3 title">Pembatalan Resep Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body font-modal-body">
          <p class="p-3">Anda yakin menyetujui <b class="tipe"></b> <span id="nama"></span> ?</p>
      </div>
      <div class="modal-footer">
        <div class="mx-auto">
          <a href="" class="btn btn-ya" id="buttonHapus">Ya</a>
          <button type="button" class="btn btn-tidak ml-5" data-dismiss="modal">Tidak</button>
        </div>
      </div>
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

<?php if($this->session->flashdata('msg_pmbyrn_obat')){ ?>
<script>
alert("<?php echo $this->session->flashdata('msg_pmbyrn_obat'); ?>")
</script>
<?php } ?>