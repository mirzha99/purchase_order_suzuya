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
                    <th>Unit of Measurement</th>
                    <th>Stok Pesanan</th>
                    <th>Harga Beli</th>
                    <th>Total</th>
                    <th>Keterangan Barang</th>
                    <?php if(!$receiving_suplier):?>
                        <th>Aksi</th>
                    <?php endif;?>
               
                </tr>
            </thead>
            <tbody>
                <?php $total_harga = 0;?>
                <?php $no=0; foreach($receiving_sup_barang as $rcb):$no+1;$no++;?>
                <?php
                    $total = $rcb->stok_pesanan * $rcb->harga_beli;
                    $total_harga += $total;
                ?>
                <tr>
                    <td><?=$no;?>.</td>
                    <td><?=$rcb->nama_barang;?></td>
                    <td><?=$rcb->jenis_barang;?></td>
                    <td><?=$rcb->satuan_barang;?></td>
                    <td><?=$rcb->uom_order;?></td>
                    <td><?=$rcb->stok_pesanan;?></td>
                    <td><?=rp($rcb->harga_beli);?></td>
                    <td><?=rp($total);?></td>
                    <td><?=$rcb->keterangan_barang;?></td>
                    <td>
                    <?php if(!$receiving_suplier):?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edit_po_barang" onclick="Po.edit_po_barang_s(<?=$rcb->id;?>)">Edit Stok Barang</button>
                    <?php endif;?>
                    </td>
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
        <input name="diskon" id="diskon" class="form-control" disabled value="<?=$po_harga->diskon?>">
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
                <input name="ppn" id="ppn" class="form-control" disabled value="<?=$po_harga->ppn?>">
            </div>                               
        </div>        
        <p></p>
        <label for="ppn_bm">PPN BM</label>
        <div class="form-group">                                                
            <div class="input-group">
                <input type="text" id="ppn_bm_harga" class="form-control" disabled value="<?=rp(0);?>">
                <input type="hidden" id="ppn_bm_harga_hide" class="form-control"  value="0">
                <span class="input-group-addon">%</span>
                <input name="ppn_bm" id="ppn_bm" class="form-control" disabled value="<?=$po_harga->ppn_bm?>">

            </div>                               
        </div>        
        <p></p>
        <label for="jumlah_pembelian">Jumlah Pembelian</label>
        <input type="text" id="jumlah_pembelian" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="jumlah_pembelian" id="jumlah_pembelians" class="form-control"  value="<?=$total_harga?>">
        <p></p>
            <a href="<?=base_url();?>suplier/receiving/cetak/<?=$receiving_suplier->no_receiving;?>" target="_blank"class="btn btn-success">Cetak</a>
    </form>
</div>
<!-- modal Edit-->
<div class="modal fade edit_po_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <b class="modal-title" id="exampleModalLabel">Modal title</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <!--start-->
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="no_po" value="<?=$receiving_suplier->no_po;?>">
            <label for="id_barang">Barang</label>
            <input type="text" name="nama_barang" class="form-control nama_barang">
            <p></p>
            <label for="stok_pesanan">Stok Pesanan</label>
            <input type="number" name="stok_pesanan" class="form-control stok_pesanan" placeholder="Stok Pesanan">
            <p></p>
            <label for="stok_barang_suplier">Stok Tersedia</label>
            <input type="number" name="stok_barang_suplier" class="form-control stok_barang_suplier" placeholder="Stok Pesanan">
            <!--end-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>