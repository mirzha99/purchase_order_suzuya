<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Jenis Barang</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".jenis_barang" onclick="Barang.jenis_barang()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($jenis_barang as $jb):$no+1;$no++; ?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$jb->jenis_barang;?></td>
                                <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".jenis_barang" onclick="Barang.edit_jenis_barang(<?=$jb->id;?>)">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_jenis_barang" onclick="Barang.delete_jenis_barang(<?=$jb->id;?>)">Hapus</button>
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
<div class="modal jenis_barang fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="jenis_barang">Jenis Barang</label>
            <input type="text" id="jenis_barang" class="form-control" name="jenis_barang" placeholder="Jenis Barang" autocomplate="off">
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
<div class="modal del_jenis_barang fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            Apakah Anda Yakin Mengahapus Jenis Barang <span class="text-danger dels_jenis_barang">Name</span> ? Mengahapus Jenis Barang Dapat Kehilangan Data Barang !
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
