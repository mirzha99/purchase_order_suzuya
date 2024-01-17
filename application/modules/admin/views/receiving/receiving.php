<div class="col-lg-12">
<form action="<?=base_url();?>admin/receiving/dateranges/" method="post">
        <div class="input-daterange " id="datepicker">
           <label>Waktu Mulai</label>
            <input type="text" class="form-control" name="start" placeholder="dd/mm/yyyy" value="<?= $date['s']?>" autocomplete="off">
            <p></p>
            <label>Waktu Terakhir</label>
            <input type="text" class="form-control" name="end" placeholder="dd/mm/yyyy" value="<?= $date['e']?>" autocomplete="off">
        </div>
        <p></p>
        <button class="btn btn-warning">Filter</button>
        <?php if($date['s'] == ""|| $date['e'] == ""):?>
            <a href="<?=base_url();?>admin/receiving/cetak_receiving" class="btn btn-primary">Cetak</a>
        <?php endif;?>
        <?php if($date['s'] != "" || $date['e'] !=""):?>
            <a href="<?=base_url();?>admin/receiving" class="btn btn-danger">Reset</a>
            <a href="<?=base_url();?>admin/receiving/cetak_receiving_daterange/<?=$date['st'];?>/<?=$date['et'];?>" class="btn btn-primary">Cetak</a>
        <?php endif;?>
</form>

<p></p>
    <table class="table responsive-data-table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No Receiving</th>
                <th>No PO</th>
                <th>Suplier</th>
                <th>Tanggal Receiving</th>
                <th>Status Laporan</th>
                <th>Jumlah Pembelian</th>
                <th>Tanggal Pengecekan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach($receiving as $rc):$no+1;$no++;?>
            <tr>
                <td><?=$no;?>.</td>
                <td><?=$rc->no_receiving;?></td>
                <td><?=$rc->no_po;?></td>
                <td><?=$rc->nama_suplier;?></td>
                <td><?=dateme($rc->date_receiving);?></td>
                <td><?=$rc->status_laporan;?></td>
                <?php 
                    $rc_barang = $this->receiving->rc_barang($rc->no_receiving);
                    $total = 0;
                    foreach($rc_barang as $d){
                        $harga_normal = $d->stok_pesanan * $d->harga_beli;
                        //po_harga
                        $diskon = $this->receiving->rc_harga($d->no_receiving)->diskon;
                        $ppn = $this->receiving->rc_harga($d->no_receiving)->ppn;
                        $ppn_bm = $this->receiving->rc_harga($d->no_receiving)->ppn_bm;
                        //rumus
                        $harga_diskon = $harga_normal * ($diskon / 100);
                        $harga_diskons = $harga_normal - $harga_diskon;
                        $tarifppn = ($harga_diskons * $ppn) / 100;
                        $tarifppn_bm = ($harga_diskons * $ppn_bm) / 100;
                        //hasil
                        $total += $harga_diskons + $tarifppn + $tarifppn_bm;
                    }
                ;?>
                <td><?=rp($total);?></td>
                <td><?=$rc->date_checker == 0 ? "Tunggu Checker" : dateme($rc->date_checker);?></td>
                <td>
                    <a href="<?=base_url();?>admin/receiving/receiving_barang/<?=$rc->no_receiving;?>" class="btn btn-success">Cek Barang</a>
                </td>
            <?php endforeach;?>
            </tr>
        </tbody>
    </table>
</div>