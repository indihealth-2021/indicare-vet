
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
                    <table class="table table-border table-hover custom-table mb-0" id="table_pembayaran">
                        <thead class="text-tr">
                        <tr class="text-center">
                            <th class="text-left">No</th>
                            <th class="text-left">Nama Pasien</th>
                            <th class="text-left">Pelayanan</th>
                            <th class="text-left">Foto</th>
                            <th class="text-left">Tanggal Upload</th>
                            <th class="text-left">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="font-14">
                            <?php foreach($list_pembayaran as $idx=>$pembayaran){ ?>
                                <tr>
                                    <td><?= $idx+1 ?></td>
                                    <td><?= $pembayaran->nama_pasien ?></td>
                                    <td>
                                        <ul>
                                            <?php for($i = 0; $i < count($pembayaran->nama_pelayanan); $i++){ ?>
                                                <li><?= $pembayaran->nama_pelayanan[$i] ?> ( <?= 'Rp ' . number_format($pembayaran->harga_pelayanan[$i], 2, ',', '.') ?> )</li>
                                            <?php } ?>
                                        </ul>
                                        <span>Total Harga: <span class="badge bg-tele text-light"><?= 'Rp ' . number_format($pembayaran->total_harga, 2, ',', '.') ?></span></span><br/><br/>
                                        <span>Kebutuhan:</span>
                                        <?= $pembayaran->kebutuhan ? '<p class="badge bg-tele text-light">'.$pembayaran->kebutuhan.'</p>':'<span class="badge badge-secondary">-</span>' ?>
                                    </td>
                                    <td><img src="<?= $pembayaran->foto ?>" class="img-fluid" width="170px"></td>
                                    <td><?= $pembayaran->tanggal_upload ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/homecare/pembayaran/verif_layanan/'.$pembayaran->id_registrasi) ?>"><button class="btn btn-block bg-tele text-light"><i class="fa fa-check"></i></button></a>
                                        <button class="btn btn-block btn-danger"><i class="fa fa-trash"></i></button>
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