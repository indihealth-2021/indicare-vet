 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/homecare/RekamMedis') ?>" class="text-black font-bold-7"><?= $title ?></a></li>
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

             </div>
             <div class="table-responsive">
                 <table class="table table-border table-hover custom-table mb-0" id="table_rm">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Nama Pasien</th>
                             <th>Visitor</th>
                             <th>Pelayanan</th>
                             <th>Waktu Pelayanan</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody class="font-14">
                        <?php foreach($list_rm as $idx=>$rm){ ?>
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><?= $rm->nama_pasien ?></td>
                                <td><?= $rm->nama_dokter ?></td>
                                <td><?= str_replace('|', ',', $rm->list_nama_pelayanan) ?></td>
                                <td><?= $rm->waktu_pelayanan ?></td>
                                <td><button class="btn btn-block bg-tele text-light" type="button" data-toggle="modal" data-target="#modalRekamMedis" data-no-rm="<?= $rm->no_medrec ?>" data-pasien="<?= $rm->nama_pasien ?>" data-visitor="<?= $user->name ?>" data-list-nama-pelayanan="<?= $rm->list_nama_pelayanan ?>" data-waktu-pelayanan="<?= $rm->waktu_pelayanan ?>" data-tinggi-badan="<?= $rm->tinggi_badan ?>" data-berat-badan="<?= $rm->berat_badan ?>" data-suhu="<?= $rm->suhu ?>" data-tekanan-darah="<?= $rm->tekanan_darah ?>" data-merokok="<?= $rm->merokok ? 'Ya':'Tidak' ?>" data-alkohol="<?= $rm->alkohol ? 'Ya':'Tidak' ?>" data-kecelakaan="<?= $rm->kecelakaan ? 'Ya':'Tidak' ?>" data-operasi="<?= $rm->operasi ? 'Ya':'Tidak' ?>" data-list-nama-kegiatan="<?= $rm->list_nama_kegiatan ?>" data-list-foto-kegiatan="<?= $rm->list_foto_kegiatan ?>" data-list-nama-obat="<?= $rm->list_nama_obat ?>" data-list-keterangan-obat="<?= $rm->list_keterangan_obat ?>" data-list-jumlah-obat="<?= $rm->list_jumlah_obat ?>" data-list-satuan-obat="<?= $rm->list_satuan_obat ?>"><i class="fa fa-search"></i></button></td>
                            </tr>
                        <?php } ?>
                     </tbody>
                 </table>
             </div>

         </div>
    </div>
</div>

<div class="modal fade" id="modalRekamMedis" tabindex="-1" role="dialog" aria-labelledby="modalRekamMedisTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height: auto !important; width: auto !important">
      <div class="modal-header">
        <h5 class="modal-title font-18" id="modalRekamMedisTitle">Rekam Medis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-3">No RM</div>
            <div class="col-1">:</div>
            <div class="col-8 no-rm"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Pasien</div>
            <div class="col-1">:</div>
            <div class="col-8 pasien"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Visitor</div>
            <div class="col-1">:</div>
            <div class="col-8 visitor"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Pelayanan</div>
            <div class="col-1">:</div>
            <div class="col-8 list-pelayanan">

            </div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Waktu Pelayanan</div>
            <div class="col-1">:</div>
            <div class="col-8 waktu-pelayanan"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Tinggi Badan</div>
            <div class="col-1">:</div>
            <div class="col-8 tinggi-badan"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Berat Badan</div>
            <div class="col-1">:</div>
            <div class="col-8 berat-badan"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Suhu</div>
            <div class="col-1">:</div>
            <div class="col-8 suhu"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Tekanan Darah</div>
            <div class="col-1">:</div>
            <div class="col-8 tekanan-darah"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Merokok</div>
            <div class="col-1">:</div>
            <div class="col-8 merokok"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Alkohol</div>
            <div class="col-1">:</div>
            <div class="col-8 alkohol"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Kecelakaan</div>
            <div class="col-1">:</div>
            <div class="col-8 kecelakaan"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Operasi</div>
            <div class="col-1">:</div>
            <div class="col-8 operasi"></div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Kegiatan</div>
            <div class="col-1">:</div>
            <div class="col-8 list-kegiatan">

            </div>
        </div>
        <div class="row mt-2">
            <div class="col-3">Resep Obat</div>
            <div class="col-1">:</div>
            <div class="col-8 list-resep-obat">

            </div>
        </div>
      </div>
      <div class="modal-footer">
          <div class="p-2">
            <button type="button" class="btn btn-batal" data-dismiss="modal">Tutup</button>
          </div>
      </div>
    </div>
  </div>
</div>