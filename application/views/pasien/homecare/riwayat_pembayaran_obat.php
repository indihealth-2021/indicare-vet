 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/homecare/pembayaran/riwayat_pembayaran_layanan') ?>" class="text-black font-bold-7"><?= $title ?></a></li>
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
                 <table class="table table-border table-hover custom-table mb-0" id="table_riwayat">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Nama Visitor</th>
                             <th>Pelayanan</th>
                             <th>Waktu Pelayanan</th>
                             <th>Resep</th>
                             <th>Alamat Pengiriman Obat</th>
                             <th>Bukti Pembayaran</th>
                             <th>Order Status</th>
                             <th>Tanggal Upload</th>
                         </tr>
                     </thead>
                     <tbody class="font-14">
                         <?php foreach($list_pembayaran as $idx=>$pembayaran){ ?>
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><?= $pembayaran->nama_dokter ?></td>
                                <td><?= $pembayaran->list_pelayanan ?></td>
                                <td><?= $pembayaran->waktu_pelayanan ?></td>
                                <td><?= $pembayaran->detail_obat ?></td>
                                <td><?= $pembayaran->alamat_pengiriman ?></td>
                                <td><img src="<?= base_url('assets/images/bukti_pembayaran_layanan_homecare/'.$pembayaran->foto_bukti) ?>" width="200px"></td>
                                <td><?= $pembayaran->order_status ?></td>
                                <td><?= $pembayaran->tanggal_upload ?></td>
                            </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

 </div>
 </div>