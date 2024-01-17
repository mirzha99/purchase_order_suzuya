<div class="col-lg-6">
    <label for="no_po">No PO</label>
    <input type="text" class="form-control" disabled value="<?=$no_po->no_po;?>">
    <p></p>
    <label for="type_po">Type PO</label>
    <input type="text" class="form-control" disabled value="<?=$no_po->type_po;?>">
    <p></p>
    <label for="tanggal_po">Tanggal PO</label>
    <input type="text" class="form-control" disabled value="<?=dateme($no_po->date_po);?>">
</div>
<div class="col-lg-6">
    <label for="suplier">Suplier</label>
    <input type="text" class="form-control" disabled value="<?=$no_po->nama_suplier;?>">
    <p></p>
    <label for="suplier">No Telpon Suplier</label>
    <input type="text" class="form-control" disabled value="<?=$no_po->no_telpon;?>">
    <p></p>
    <label for="expired">Expired</label>
    <input type="text" class="form-control" disabled value="<?=dateme($no_po->date_expired);?>">
</div>


<div class="col-lg-12">
<p></p>
    <?php if(!$po_harga):?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".po_barang" onclick="Po.po_barang()">Tambah Barang</button>
    <?php endif;?>
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
                    <?php if(!$po_harga):?>
                        <th>Aksi</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php $total_harga = 0;?>
                <?php $no=0; foreach($po_barang as $pb):$no+1;$no++;?>
                <?php
                    $total = $pb->stok_pesanan * $pb->harga_beli;
                    $total_harga += $total;
                ?>
                <tr>
                    <td><?=$no;?>.</td>
                    <td><?=$pb->nama_barang;?></td>
                    <td><?=$pb->jenis_barang;?></td>
                    <td><?=$pb->satuan_barang;?></td>
                    <td><?=$pb->uom_order;?></td>
                    <td><?=$pb->stok_pesanan;?></td>
                    <td><?=rp($pb->harga_beli);?></td>
                    <td><?=rp($total);?></td>
                    <?php if(!$po_harga):?>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".edit_po_barang" onclick="Po.edit_po_barang(<?=$pb->id;?>)">Edit Stok Barang</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_po_barang" onclick="Po.delete_po_barang(<?=$pb->id;?>)">Hapus</button>
                    </td>
                    <?php endif;?>
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
    <form action="<?=base_url();?>admin/po/add_po_harga" method="post">
    <div class="col-lg-6">
        <label for="harga_normal">Harga Normal</label>
        <input type="text" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="no_po" value="<?=$no_po->no_po;?>">
        <input type="hidden" name="harga_normal" class="form-control" id="harga_normal" value="<?=$total_harga;?>">
        <p></p>
        <label for="diskon">Diskon</label>
        <select name="diskon" id="diskon" class="form-control" <?= $po_harga ? "disabled" : "";?>>
            <?php for($i = 0; $i <= 100; $i++):?>
                <?php 
                    $sl='';
                    $nilai = $po_harga->diskon;
                    if($nilai == $i){
                        $sl ='selected="selected"';
                    }
                ;?>
                <option value="<?=$i;?>" <?=$sl;?>> <?=$i;?> %</option>
            <?php endfor;?>
        </select>
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
                <select name="ppn" id="ppn" class="form-control" <?= $po_harga ? "disabled" : "";?>>
                    <?php for($i = 0; $i <= 100; $i++):?>
                        <?php 
                            $sl='';
                            $nilai = $po_harga->ppn;
                            if($nilai == $i){
                                $sl ='selected="selected"';
                            }
                        ;?>
                        <option value="<?=$i;?>" <?=$sl;?>> <?=$i;?> %</option>
                    <?php endfor;?>
                </select>
            </div>                               
        </div>        
        <p></p>
        <label for="ppn_bm">PPN BM</label>
        <div class="form-group">                                                
            <div class="input-group">
                <input type="text" id="ppn_bm_harga" class="form-control" disabled value="<?=rp(0);?>">
                <input type="hidden" id="ppn_bm_harga_hide" class="form-control"  value="0">
                <span class="input-group-addon">%</span>
                <select name="ppn_bm" id="ppn_bm" class="form-control" <?= $po_harga ? "disabled" : "";?> >
                    <?php for($i = 0; $i <= 100; $i++):?>
                        <?php 
                            $sl='';
                            $nilai = $po_harga->ppn_bm;
                            if($nilai == $i){
                                $sl ='selected="selected"';
                            }
                        ;?>
                        <option value="<?=$i;?>" <?=$sl;?>> <?=$i;?> %</option>
                    <?php endfor;?>
                </select>
            </div>                               
        </div>        
        <p></p>
        <label for="jumlah_pembelian">Jumlah Pembelian</label>
        <input type="text" id="jumlah_pembelian" class="form-control" disabled value="<?=rp($total_harga);?>">
        <input type="hidden" name="jumlah_pembelian" id="jumlah_pembelians" class="form-control"  value="<?=$total_harga?>">
        <p></p>
        <?php if($po_harga){;?>
            <?php $check_receiving = $this->db->get_where('receiving_suplier',['no_po'=>$no_po->no_po])->row_object();?>
            <?php if($check_receiving){?>
                <?php if($check_receiving->status_laporan !="Di Terima"):?>
                    <a href="<?=base_url();?>admin/po/batal_po_harga/<?=$no_po->no_po;?>" class="btn btn-danger">Batal Order</a>
                <?php endif;?>
            <?php }else{;?>
                <a href="<?=base_url();?>admin/po/batal_po_harga/<?=$no_po->no_po;?>" class="btn btn-danger">Batal Order</a>
            <?php };?>
        <?php }else{;?>
            <button type="sumbit" class="btn btn-success">Order</button>
        <?php };?>
    </form>
</div>
<!-- modal -->
<div class="modal fade po_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <input type="hidden" name="no_po" value="<?=$no_po->no_po;?>">
            <label for="id_barang">Barang</label>
            <select name="id_barang" id="id_barang" class="form-control">
                <option value="">===Pilih Barang===</option>
                <?php foreach($input_barang as $ib):?>
                    <option value="<?=$ib->id;?>"><?=$ib->nama_barang;?></option>
                <?php endforeach;?>
            </select>
            <p></p>
            <label for="stok_pesanan">Stok Pesanan</label>
            <input type="number" name="stok_pesanan" id="stok_pesanan" class="form-control" placeholder="Stok Pesanan">
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
            <input type="hidden" name="no_po" value="<?=$no_po->no_po;?>">
            <label for="id_barang">Barang</label>
            <input type="text" name="nama_barang" class="form-control nama_barang">
            <p></p>
            <label for="stok_pesanan">Stok Pesanan</label>
            <input type="number" name="stok_pesanan" class="form-control stok_pesanan" placeholder="Stok Pesanan">
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
<!-- modal Del-->
<div class="modal fade del_po_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <input type="hidden" name="id" id="id_del">
            <input type="hidden" name="no_po" value="<?=$no_po->no_po;?>">
            <span class="msg_del"></span>
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