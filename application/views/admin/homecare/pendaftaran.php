
    <!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-4">
          <div class="col-sm-12 col-12 ">
            <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>" class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7"><?php echo $title; ?></a></li>
                </ol>
            </nav>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title"><?= $title ?></h3>
          </div>
        </div>  
        <div class="row">
            <div class="col-md-12">
            <div class="bg-tab px-3">
                <div class="tab-pane show pt-3">
                <div class="col-md-12">
                    <div class="box">
                        <div class="container-1">
                            <span class="icon"><i class="fa fa-search font-16 text-tele"></i></span>
                            <input type="search" id="search" style="background: #ffffff !important;" placeholder="Cari User Disini" />
                        </div>
                    </div>
                    <div class="table-responsive pt-4">
                    <table class="table table-border table-hover custom-table mb-0" id="table_pendaftaran">
                        <thead class="text-tr">
                        <tr class="text-center">
                            <th class="text-left">No</th>
                            <th>Nama Pasien</th>
                            <th>Pelayanan</th>
                            <th>Alamat</th>
                            <th>Tanggal Diajukan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="font-14">
                            <?php foreach($data_registrasi as $idx=>$dr){ ?>
                                <tr>
                                    <td><?= $idx+1 ?></td>
                                    <td><?= $dr->nama_pasien ?></td>
                                    <td>
                                        <ul>
                                            <?php for($i = 0; $i < count($dr->nama_pelayanan); $i++){ ?>
                                                <li><?= $dr->nama_pelayanan[$i] ?> ( <?= 'Rp ' . number_format($dr->harga_pelayanan[$i], 2, ',', '.') ?> )</li>
                                            <?php } ?>
                                        </ul>
                                        <span>Total Harga: <span class="badge bg-tele text-light"><?= 'Rp ' . number_format($dr->total_harga, 2, ',', '.') ?></span></span><br/><br/>
                                        <span>Kebutuhan:</span>
                                        <?= $dr->kebutuhan ? '<p class="badge bg-tele text-light">'.$dr->kebutuhan.'</p>':'<span class="badge badge-secondary">-</span>' ?>
                                    </td>
                                    <td style="max-width: 250px !important"><?= $dr->alamat_pelayanan ?></td>
                                    <td class="text-center"><span class="badge bg-tele text-light"><?= $dr->tanggal_pelayanan_pasien ?></span></td>
                                    <td>
                                        <button class="btn btn-block bg-tele text-light" type="button" data-toggle="modal" data-target="#modalPendaftaranHomecare" data-id-registrasi="<?= $dr->id ?>" data-nama-pasien="<?= $dr->nama_pasien ?>" data-no-hp="<?= $dr->no_hp ?>" data-alamat-pelayanan="<?= $dr->alamat_pelayanan ?>" data-total-harga="<?= $dr->total_harga ?>" data-kebutuhan="<?= $dr->kebutuhan ? $dr->kebutuhan:'-' ?>" data-tanggal-pelayanan="<?= $dr->tanggal_pelayanan_pasien ?>" data-list-nama-pelayanan="<?= $dr->list_nama_pelayanan ?>" data-list-harga-pelayanan="<?= $dr->list_harga_pelayanan ?>" data-list-gambar-pelayanan="<?= $dr->list_gambar_pelayanan ?>"><i class="fa fa-check"></i></button>
                                        <button class="btn btn-block btn-danger" type="button"><i class="fa fa-trash"></i></button>
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        

<div class="modal fade" id="modalPendaftaranHomecare" tabindex="-1" role="dialog" aria-labelledby="modalPendaftaranHomecareTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: auto !important; width: auto !important">
      <div class="modal-header">
        <h5 class="modal-title font-18" id="modalPendaftaranHomecareTitle">Form Verifikasi Data Homecare</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?= form_open('', 'id="formVerifPendaftaran"') ?>
        <div class="row">
            <div class="col-4">Nama Pasien</div>
            <div class="col-1">:</div>
            <div class="col-7 nama-pasien"></div>
        </div>
        <div class="row">
            <div class="col-4">No HP</div>
            <div class="col-1">:</div>
            <div class="col-7 no-hp"></div>
        </div>
        <div class="row">
            <div class="col-4">Alamat Pelayanan</div>
            <div class="col-1">:</div>
            <div class="col-7 alamat-pelayanan"></div>
        </div>
        <div class="row">
            <div class="col-4">Pelayanan</div>
            <div class="col-1">:</div>
            <div class="col-12">
                <div class="row list-pelayanan">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">Total Harga</div>
            <div class="col-1">:</div>
            <div class="col-7 total-harga"></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">Kebutuhan</div>
            <div class="col-1">:</div>
            <div class="col-7 kebutuhan"></div>
        </div>
        <div class="row">
            <div class="col-4 mt-3">Visitor</div>
            <div class="col-1 mt-3">:</div>
            <div class="col-7 mt-1">
                <select class="form-control" id="dokter" name="id_dokter" style="background-color: #fff !important; color: #000 !important; border: 1px solid #62C1C5; border-radius: 5px">
                    <option value="" selected disabled>Pilih Visitor</option>
                    <?php foreach($list_dokter as $dokter){ ?>
                        <option value="<?= $dokter->id ?>"><?= htmlentities($dokter->name) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mt-1">Tanggal Pelayanan ( Diajukan )</div>
            <div class="col-1 mt-1">:</div>
            <div class="col-7 mt-1"><span class="badge bg-tele text-light tanggal-pelayanan"></span></div>
        </div>
        <div class="row">
            <div class="col-4 mt-2">Waktu Pelayanan</div>
            <div class="col-1 mt-2">:</div>
            <div class="col-7 mt-1"><input type="datetime-local" class="form-control" name="waktu_pelayanan" style="background-color: #fff !important; color: #000 !important; border: 1px solid #62C1C5; border-radius: 5px;"></div>
        </div>
      </div>
      <div class="modal-footer">
          <div class="p-2">
            <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-simpan">Verifikasi</button>
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

<?= $this->session->flashdata("msg") ? '<script>alert("'.$this->session->flashdata("msg").'")</script>':'' ?>