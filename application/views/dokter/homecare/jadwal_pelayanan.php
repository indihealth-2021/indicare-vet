 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('dokter/homecare/JadwalPelayanan') ?>" class="text-black font-bold-7"><?= $title ?></a></li>
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
                 <table class="table table-border table-hover custom-table mb-0" id="table_jadwal">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Nama Visitor</th>
                             <th>Pelayanan</th>
                             <th>Alamat</th>
                             <th>Waktu Pelayanan</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody class="font-14">
                        <?php foreach($list_jadwal_pelayanan as $idx=>$jadwal_pelayanan){ ?>
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><?= $jadwal_pelayanan->nama_pasien ?></td>
                                <td><?= $jadwal_pelayanan->list_nama_pelayanan ?></td>
                                <td style="max-width: 200px;"><?= $jadwal_pelayanan->alamat_pelayanan ?></td>
                                <td><?= $jadwal_pelayanan->waktu_pelayanan ?></td>
                                <td><a href="<?= base_url('dokter/homecare/pelayanan/room/'.$jadwal_pelayanan->id_registrasi) ?>"><button class="btn btn-block bg-tele text-light"><i class="fa fa-pencil"></i> Pengisian</button></a></td>
                            </tr>
                        <?php } ?>
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

 </div>
 </div>