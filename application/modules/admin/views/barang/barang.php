<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Barang</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".barang" onclick="Barang.barang()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>UOM (unit of measurement)</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; foreach($barang as $barang):$no+1;$no++;?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$barang->nama_barang;?></td>
                                <td><?=$barang->jenis_barang;?></td>
                                <td><?=$barang->satuan_barang;?></td>
                                <td><?=$barang->uom_order;?></td>
                                <td><?=rp($barang->harga_beli);?></td>
                                <td><?=rp($barang->harga_jual);?></td>
                                <td><?=$barang->stok_barang;?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".barang" onclick="Barang.edit_barang(<?=$barang->id;?>)">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_barang" onclick="Barang.delete_barang(<?=$barang->id;?>)">Hapus</button>
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
<div class="modal fade barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" autocomplate="off">
            <p></p>
            <label for="jenis_barang">Jenis Barang</label>
            <select name="id_jenis" id="jenis_barang" class="form-control">
                <option value="">=== Pilih Jenis Barang ===</option>
                <?php foreach($jenis_barang as $jb):?>
                    <option value="<?=$jb->id;?>"><?=$jb->jenis_barang;?></option>
                <?php endforeach;?>
            </select>
            <p></p>
            <label for="satuan_barang">Satuan Barang</label>
            <select name="id_satuan" id="satuan_barang" class="form-control">
                <option value="">=== Pilih Satuan Barang ===</option>
                <?php foreach($satuan_barang as $sb):?>
                    <option value="<?=$sb->id;?>"><?=$sb->satuan_barang;?></option>
                <?php endforeach;?>
            </select>
            <p></p>
            <label for="uom">UOM (unit of measurement)</label>
            <input type="number" name="uom" id="uom" class="form-control" placeholder="UOM (unit of measurement)">
            <p></p>
            <label for="harga_beli">Harga Beli</label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Harga Beli">
            <p></p>
            <label for="harga_jual">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga Jual">
            <p></p>
            <label for="stok_barang">Stok Barang</label>
            <input type="number" name="stok_barang" id="stok_barang" class="form-control" placeholder="Stok Barang">
            <!--end-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal Del -->
<div class="modal fade del_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            Apakah Anda Yakin Ingin Menghapus Barang <span class="nama_del text-danger"></span> ?
            <!--end-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


