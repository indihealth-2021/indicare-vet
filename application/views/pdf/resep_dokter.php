 <div class="row">
        <div class="col-2">
             <img src="<?php echo base_url('assets/dashboard/img/logo.png');?>" width="120" height="auto" alt="logo">
        </div>
        <div class="col-10" align="center">

              <h4><strong><?= $head_resep->nama_faskes ?></strong></h4>
              <small><?= $head_resep->alamat ?></small><br>
                <small><?= !empty($head_resep->no_telp) ? "<b>Telp:</b> ".$head_resep->no_telp:""?> <?= $head_resep->no_telp ?> <?= !empty($head_resep->email) ? "<b>e-mail:</b> ".$head_resep->email:""?>  <?= !empty($head_resep->fax) ? "<b>Fax:</b> ".$head_resep->fax:""?>  <?= !empty($head_resep->no_wa) ? "<b>no hp:</b> ".$head_resep->no_wa:""?></small>

                <!-- <small>Kota Bandung</small> -->
        </div>

    </div>
    <hr>
     <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <b>Dokter :</b> <?= $rekam_medis->nama_dokter  ?><br>
            <b>Poli   :</b> <?= $rekam_medis->poli ?><br>
            <b>Tgl Rilis :</b> <?= $rekam_medis->tanggal_konsultasi ?>
        </div>
    </div>
</div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <hr>
            
            <ul class="list-group list-group-flush">
                <?php foreach($resep_obat as $rd): ?>
                <li class="list-group-item ">R/ <?= $rd->name ?>
                    <br><?= $rd->keterangan ?>
                    
                </li>
            <?php endforeach; ?>
                
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <hr>
            
           <b>Pro :</b> <?= $rekam_medis->nama_pasien ?> (<?= $umur ?> thn)
        </div>
    </div>
</div>