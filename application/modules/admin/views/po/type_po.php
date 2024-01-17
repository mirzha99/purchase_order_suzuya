<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Type PO</header>
                <div class="panel-body">
                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".type_po" onclick="Po.type_po()">Tambah</button>
                <p></p>
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Type PO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($type_po as $type_po):$no+1;$no++; ?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$type_po->type_po;?></td>
                                <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".type_po" onclick="Po.edit_type_po(<?=$type_po->id;?>)">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".del_type_po" onclick="Po.delete_type_po(<?=$type_po->id;?>)">Hapus</button>
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
<div class="modal type_po fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <label for="type_po">Type PO</label>
            <input type="text" id="type_po" class="form-control" name="type_po" placeholder="Type PO" autocomplate="off">
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
<div class="modal del_type_po fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            Apakah Anda Yakin Mengahapus Type PO <span class="text-danger dels_type_po">Name</span> ? Mengahapus Type PO Dapat Kehilangan Data Po !
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
