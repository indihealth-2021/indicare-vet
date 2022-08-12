 <!-- Main content -->
 <div class="page-wrapper">
     <div class="content">
         <div class="row mb-3">
             <div class="col-sm-12 col-12 ">
                 <nav aria-label="">
                     <ol class="breadcrumb" style="background-color: transparent;">
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('pasien/pasien'); ?>" class="text-black">Dashboard</a></li>
                         <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/homecare/PengirimanObat') ?>" class="text-black font-bold-7"><?= $title ?></a></li>
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
                 <table class="table table-border table-hover custom-table mb-0" id="table_pengiriman">
                     <thead class="text-tr">
                         <tr class="font-16">
                             <th class="text-left">No</th>
                             <th>Pasien</th>
                             <th>Visitor</th>
                             <th>Waktu Pelayanan</th>
                             <th>Resep</th>
                             <th>Alamat Pengiriman</th>
                             <th>Harga</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody class="font-14">
                         <?php foreach($list_pembayaran as $idx=>$pembayaran){ ?>
                            <?php
                            $list_harga_obat = explode('|', $pembayaran->harga_obat);
                            $list_harga_obat_per_n_unit = explode('|', $pembayaran->harga_obat_per_n_unit);
                            $list_jumlah_obat = explode('|', $pembayaran->jumlah_obat);
                            $jml_data = count($list_harga_obat);
                            $list_total_harga = [];
                            $total_harga = 0;
                            for ($i = 0; $i < $jml_data; $i++) {
                                $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
                            }

                            foreach ($list_total_harga as $tot_harga) {
                                $total_harga += $tot_harga;
                            }
                            ?>
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><?= $pembayaran->nama_pasien ?></td>
                                <td><?= $pembayaran->nama_dokter ?></td>
                                <td><?= $pembayaran->waktu_pelayanan ?></td>
                                <td><?= $pembayaran->detail_obat ?></td>
                                <td width="200px"><?= $pembayaran->alamat_pengiriman ?></td>
                                <td>
                                    Biaya Resep: <?= "Rp " . number_format($total_harga,2,',','.') ?><br/>
                                    Biaya Pengiriman: <?= "Rp " . number_format($pembayaran->biaya_pengiriman,2,',','.') ?><br/>
                                    Total Harga: <?= "Rp " . number_format($pembayaran->biaya_pengiriman+$total_harga,2,',','.') ?>
                                </td>
                                <td><a href="<?= base_url('admin/homecare/PengirimanObat/kirim/'.$pembayaran->id_registrasi) ?>"><button class="btn btn-block bg-tele text-light"><i class="fa fa-check"></i></button></a></td>
                            </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

 </div>
 </div>