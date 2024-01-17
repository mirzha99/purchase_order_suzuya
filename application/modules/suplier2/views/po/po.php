<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading panel-border">Data Purchase Order</header>
                <div class="panel-body">
                    <table class="table responsive-data-table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No PO</th>
                                <th>Tanggal PO</th>
                                <th>Tanggal Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no= 0; foreach($po as $po):$no+1; $no++;?>
                            <tr>
                                <td><?=$no;?>.</td>
                                <td><?=$po->no_po;?></td>
                                <td><?=dateme($po->date_po);?></td>
                                <td><?=dateme($po->date_expired);?></td>
                                <td>
                                    <?php if($po->date_expired < time()){;?>
                                        <span class="btn btn-dark" disabled>Purchase Order Kadaluarsa</span>
                                    <?php }else{;?>
                                        <a href="<?=base_url();?>suplier/po/po_barang/<?=$po->no_po;?>" class="btn btn-success">Lanjut Purchase Order</a>
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