<div class="col-lg-12">
    <table class="table responsive-data-table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No Receiving</th>
                <th>No PO</th>
                <th>Tanggal Receiving</th>
                <th>Status Laporan</th>
                <th>Tanggal Checker</th>
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
                <td>
                    <a href="<?=base_url();?>suplier/receiving/receiving_barang/<?=$rc->no_receiving;?>" class="btn btn-success">Cek Barang</a>
                </td>
            <?php endforeach;?>
            </tr>
        </tbody>
    </table>
</div>