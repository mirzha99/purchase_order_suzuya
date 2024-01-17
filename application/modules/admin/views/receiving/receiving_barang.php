<div class="col-lg-6">
    <label >No Receiving</label>
    <input type="text"  class="form-control" disabled value="<?=$receiving_suplier->no_receiving;?>">
    <p></p>
    <label >Tanggal Receiving</label>
    <input type="text"  class="form-control" disabled value="<?=dateme($receiving_suplier->date_receiving);?>">
    <p></p>
    <label >No PO</label>
    <input type="text"  class="form-control" disabled value="<?=$receiving_suplier->no_po;?>">
    <p></p>
    <label for="type_po">Type PO</label>
    <input type="text" class="form-control" disabled value="<?=$receiving_suplier->type_po;?>">
    <p></p>
    <label>Tanggal PO</label>
    <input type="text" class="form-control" disabled value="<?=dateme($receiving_suplier->date_po);?>">
    <p></p>
</div>
<div class="col-lg-6">
    <label >Suplier</label>
    <input type="text" class="form-control" disabled value="<?=$receiving_suplier->nama_suplier;?>">
    <p></p>
    <label >No Telpon Suplier</label>
    <input type="text" class="form-control" disabled value="<?=$receiving_suplier->no_telpon;?>">
    <p></p>
    <label >Expired</label>
    <input type="text" class="form-control" disabled value="<?=dateme($receiving_suplier->date_expired);?>">
    <p></p>
    <label >Status Laporan</label>
    <input type="text"  class="form-control" disabled value="<?=$receiving_suplier->status_laporan;?>">
</div>


<div class="col-lg-12">
<p></p>
        <p></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Satuan Barang</th>
                    <th>unit of measurement</th>
                    <th>Stok Pesanan</th>
                    <th>Harga Beli</th>
                    <th>Total</th>
                    <th>Keterangan Barang</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_harga = 0;?>
                <?php $no=0; foreach($rc_barang as $rc):$no+1;$no++;?>
                <?php
                    $total = $rc->stok_pesanan * $rc->harga_beli;
                    $total_harga += $total;
                ?>
                <tr>
                    <td><?=$no;?>.</td>
                    <td><?=$rc->nama_barang;?></td>
                    <td><?=$rc->jenis_barang;?></td>
                    <td><?=$rc->satuan_barang;?></td>
                    <td><?=$rc->uom_order;?></td>
                    <td><?=$rc->stok_pesanan;?></td>
                    <td><?=rp($rc->harga_beli);?></td>
                    <td><?=rp($total);?></td>
                    <td><?=$rc->keterangan_barang;?></td>
                <?php endforeach;?>
                </tr>
            </tbody>
            <tfooter>
                <tr>
                    <th colspan="7">Total Harga</th>
                    <td><?=rp($total_harga);?></td>
                </tr>
            </tfooter>
        </table>
    </div>
    <form action="<?=base_url();?>suplier/receiving/receiving_order" method="post">
    <div class="col-lg-6">
        <label for="harga_normal">Harga Normal</label>
        <input type="text" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="no_po" value="<?=$receiving_suplier->no_po;?>">
        <input type="hidden" name="harga_normal" class="form-control" id="harga_normal" value="<?=$total_harga;?>">
        <p></p>
        <label for="diskon">Diskon</label>
        <input name="diskon" id="diskon" class="form-control" disabled value="<?=$receiving_suplier->diskon?>">
        <p></p>
        <label for="harga_diskon">Harga Diskon</label>
        <input type="text" id="harga_diskon" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="harga_diskon" id="harga_diskon_hide" class="form-control" value="<?=$total_harga;?>">
    </div>
    <div class="col-lg-6">
        <label for="ppn">PPN</label>
        <div class="form-group">                                                
            <div class="input-group">
                <input type="text" id="ppn_harga" class="form-control" disabled value="<?=rp(0);?>">
                <input type="hidden" id="ppn_harga_hide" class="form-control" disabled value="0">
                <span class="input-group-addon">%</span>
                <input name="ppn" id="ppn" class="form-control" disabled value="<?=$receiving_suplier->ppn?>">
            </div>                               
        </div>        
        <p></p>
        <label for="ppn_bm">PPN BM</label>
        <div class="form-group">                                                
            <div class="input-group">
                <input type="text" id="ppn_bm_harga" class="form-control" disabled value="<?=rp(0);?>">
                <input type="hidden" id="ppn_bm_harga_hide" class="form-control"  value="0">
                <span class="input-group-addon">%</span>
                <input name="ppn_bm" id="ppn_bm" class="form-control" disabled value="<?=$receiving_suplier->ppn_bm?>">

            </div>                               
        </div>        
        <p></p>
        <label for="jumlah_pembelian">Jumlah Pembelian</label>
        <input type="text" id="jumlah_pembelian" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="jumlah_pembelian" id="jumlah_pembelians" class="form-control"  value="<?=$total_harga?>">
        <p></p>
            <a href="<?=base_url();?>admin/receiving/cetak/<?=$receiving_suplier->no_receiving;?>" target="_blank" class="btn btn-success">Cetak</a>
    </form>
</div>