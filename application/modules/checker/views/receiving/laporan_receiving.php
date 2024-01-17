<div class="col-lg-12">
<form action="<?=base_url();?>checker/dateranges/" method="post">
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
            <a href="<?=base_url();?>checker/cetak_receiving" target="_blank" class="btn btn-primary">Cetak</a>
        <?php endif;?>
        <?php if($date['s'] != "" || $date['e'] !=""):?>
            <a href="<?=base_url();?>checker/laporan_receiving" class="btn btn-danger">Reset</a>
            <a href="<?=base_url();?>checker/cetak_receiving_daterange/<?=$date['st'];?>/<?=$date['et'];?>" class="btn btn-primary">Cetak</a>
        <?php endif;?>
</form>
    <table class="table responsive-data-table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No Receiving</th>
                <th>No PO</th>
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
                <td><?=dateme($rc->date_receiving);?></td>
                <td><?=$rc->status_laporan;?></td>
                <?php 
                    $rc_barang = $this->receiving->po_barang($rc->no_po);
                    $total = 0;
                    foreach($rc_barang as $rb){
                        $harga_normal = $rb->stok_pesanan * $rb->harga_beli  ;
                        $diskon = $this->receiving->po_harga($rc->no_po)->diskon;
                        $ppn = $this->receiving->po_harga($rc->no_po)->ppn;
                        $ppn_bm = $this->receiving->po_harga($rc->no_po)->ppn_bm;
                         //rumus
                        $harga_diskon = $harga_normal * ($diskon / 100);
                        $harga_diskons = $harga_normal - $harga_diskon;
                        $tarifppn = ($harga_diskons * $ppn) / 100;
                        $tarifppn_bm = ($harga_diskons * $ppn_bm) / 100;
                        $total += $harga_diskons + $tarifppn + $tarifppn_bm;
                    }
                ;?>
                <td><?=rp($total);?></td>
                <td><?=$rc->date_checker == 0 ? "Belum Melakukan Pengecekan Barang" : dateme($rc->date_checker);?></td>
                <td>
                    <a href="<?=base_url();?>checker/cek_receiving/<?=$rc->no_receiving;?>" class="btn btn-success">Cek Barang</a>
                </td>
            <?php endforeach;?>
            </tr>
        </tbody>
    </table>
</div>