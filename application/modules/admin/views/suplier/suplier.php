<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Suplier</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".suplier" onclick="Suplier.suplier()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Username</th>
                                <th>Waktu Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($suplier as $sp):$no+1;$no++; ?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$sp->nama_suplier;?></td>
                                <td><?=$sp->alamat;?></td>
                                <td><?=$sp->no_telpon;?></td>
                                <td><?=$sp->username;?></td>
                                <td><?=$sp->date_login == 0 ? "Suplier Belum Login" : dateme($sp->date_login);?></td>
                                <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".suplier" onclick="Suplier.edit_suplier(<?=$sp->id;?>)">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_suplier" onclick="Suplier.delete_suplier(<?=$sp->id;?>)">Hapus</button>
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
<div class="modal suplier fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="nama_suplier">Nama Suplier</label>
            <input type="text" id="nama_suplier" class="form-control" name="nama_suplier" placeholder="Nama Suplier" autocomplate="off">
            <p></p>
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat">
            <p></p>
            <label for="no_telpon">No Telpon</label>
            <input type="text" id="no_telpon" name="no_telpon" class="form-control" placeholder="No Telpon">
            <p></p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
            <p></p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
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
<div class="modal del_suplier fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            Apakah Anda Yakin Mengahapus Suplier <span class="text-danger dels_suplier">Name</span> ? Mengahapus Suplier Dapat Kehilangan data PO Dan Receiving !
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
