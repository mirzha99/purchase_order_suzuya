<div class="text-center">
    <h1>SELEMAT DATANG <?=$suplier->nama_suplier;?></h1>
    <h6>DI APLIKASI PURCHASE ORDER PADA GUDANG SUZUYA</h6>
</div>

<div class="row">
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-warning">
            <div class="pull-right state-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$count_suplier['po'];?></h1>
                        <strong class="text-uppercase">Jumlah PO</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-primary">
            <div class="pull-right state-icon">
                <i class="fa fa-inbox"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$count_suplier['receiving'];?></h1>
                        <strong class="text-uppercase">Jumlah Receiving</strong>
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
                    <h1 class="light-txt"><?=$count_suplier['accept'];?></h1>
                        <strong class="text-uppercase">Di Terima</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-danger">
            <div class="pull-right state-icon">
                <i class="fa fa-inbox"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=$count_suplier['reject'];?></h1>
                        <strong class="text-uppercase">Di Tolak</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
</div>