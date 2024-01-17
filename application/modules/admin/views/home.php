<div class="text-center">
    <h1>SELEMAT DATANG</h1>
    <h6>DI APLIKASI PURCHASE ORDER PADA GUDANG SUZUYA</h6>
</div>

<div class="row">
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-danger">
            <div class="pull-right state-icon">
                <i class="fa fa-cube"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$jumlah_barang;?></h1>
                        <strong class="text-uppercase">Jumlah Barang</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-dark">
            <div class="pull-right state-icon">
                <i class="fa fa-users"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$jumlah_suplier;?></h1>
                        <strong class="text-uppercase">Jumlah Suplier</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-warning">
            <div class="pull-right state-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$jumlah_po;?></h1>
                        <strong class="text-uppercase">Jumlah PO</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-success">
            <div class="pull-right state-icon">
                <i class="fa fa-inbox"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$jumlah_receiving;?></h1>
                        <strong class="text-uppercase">Jumlah Receiving</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
</div>