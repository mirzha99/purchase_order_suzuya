<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data user</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".user" onclick="User.user()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>No Telpon</th>
                                <th>level</th>
                                <th>Waktu Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($users as $user):$no+1;$no++; ?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$user->username;?></td>
                                <td><?=$user->no_telpon;?></td>
                                <td><?=$user->level == 1 ? "Admin" : "Checker";?></td>
                                <td><?=dateme($user->date_login);?></td>
                                <td>
                                <?php if($user->id !=1):?>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".user" onclick="User.edit_user(<?=$user->id;?>)">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_user" onclick="User.delete_user(<?=$user->id;?>)">Hapus</button>
                                <?php endif;?>
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
<div class="modal user fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="username">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" autocomplate="off">
            <p></p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <p></p>
            <label for="no_telpon">No Telpon</label>
            <input type="number" id="no_telpon" name="no_telpon" class="form-control" placeholder="No Telpon">
            <p></p>
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control">
                <option value="">=== Pilih Level ===</option>
                <option value="1">Admin</option>
                <option value="2">Checker</option>
            </select>
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
<div class="modal del_user fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            Apakah Anda Yakin Mengahapus user <span class="text-danger dels_user">Name</span> ?
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
