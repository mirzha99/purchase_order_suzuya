<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Purchase Order</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".po" onclick="Po.po()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table ">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Purchase Order</th>
                                <th>Type PO</th>
                                <th>Nama Suplier</th>
                                <th>Tanggal PO</th>
                                <th>Tanggal Expired</th>
                                <th>Status Order</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; foreach($po as $po):$no+1;$no++;?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$po->no_po;?></td>
                                <td><?=$po->type_po;?></td>
                                <td><?=$po->nama_suplier;?></td>
                                <td><?=dateme($po->date_po);?></td>
                                <td><?=dateme($po->date_expired);?></td>
                                <td>
                                    <?= $this->db->get_where('po_harga',['no_po'=>$po->no_po])->num_rows() > 0 ? "Sudah Order" : "Belum Order" ;?>
                                </td>
                                <td>
                                  <a href="<?=base_url();?>admin/po/po_barang/<?=$po->no_po;?>" class="btn btn-success">Barang</a>
                                  <?php $check_receiving = $this->db->get_where('receiving_suplier',['no_po'=>$po->no_po])->row_object();?>
                                    <?php if($check_receiving){?>
                                  <?php if($check_receiving->status_laporan !="Di Terima"):?>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".po" onclick="Po.edit_po('<?=$po->no_po;?>')">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_po" onclick="Po.del_po('<?=$po->no_po;?>')">Hapus</button>
                                  <?php endif;?>
                                  <?php }else{;?>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".po" onclick="Po.edit_po('<?=$po->no_po;?>')">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_po" onclick="Po.del_po('<?=$po->no_po;?>')">Hapus</button>
                                  <?php };?>
                                </td>
                            <?php endforeach;?>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </section>
    </div>
</div>

<!-- modal -->
<div class="modal fade po" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <input type="hidden" name="no_po" id="no_po">
            <label for="type_po">Type PO</label>
            <select name="type_po" id="type_po" class="form-control">
                    <option value="">=== Pilih Type Po ===</option>
                <?php foreach($type_po as $type_po):?>
                    <option value="<?=$type_po->id;?>"><?=$type_po->type_po;?></option>
                <?php endforeach;?>
            </select>
            <p></p>
            <label for="id_suplier">Suplier</label>
            <select name="id_suplier" id="id_suplier" class="form-control">
                    <option value="">=== Pilih Suplier ===</option>
                <?php foreach($suplier as $id_suplier):?>
                    <option value="<?=$id_suplier->id;?>"><?=$id_suplier->nama_suplier;?></option>
                <?php endforeach;?>
            </select>
            <p></p>
            <label for="date_expired">Tanggal Expired</label>
            <div class="form-group">                                                
                <div class="input-group date">
                    <input type="text" class="form-control" id="date_expired"  name="date_expired" placeholder="dd/mm/yyyy">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th fa fa-calendar"></i></span>
                </div>                               
            </div>
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
<!-- modal del-->
<div class="modal fade del_po" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <input type="hidden" name="no_po" id="del_no_po">
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