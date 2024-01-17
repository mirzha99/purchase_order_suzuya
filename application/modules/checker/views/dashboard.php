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
                    <h1 class="light-txt"><?=count($hari);?></h1>
                        <strong class="text-uppercase">Receiving Hari ini</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-dark">
            <div class="pull-right state-icon">
                <i class="fa fa-cube"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=count($minggu);?></h1>
                        <strong class="text-uppercase">Receiving Minggu ini</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-warning">
            <div class="pull-right state-icon">
                <i class="fa fa-cube"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=count($bulan);?></h1>
                        <strong class="text-uppercase">Receiving Bulan ini</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
    <!-- start panel -->
    <div class="col-md-3 col-sm-6">
        <div class="panel short-states bg-success">
            <div class="pull-right state-icon">
                <i class="fa fa-cube"></i>
            </div>
                <div class="panel-body">
                    <h1 class="light-txt"><?=count($tahun);?></h1>
                        <strong class="text-uppercase">Receiving Tahun ini</strong>
                </div>
        </div>
    </div>
    <!-- end panel -->
</div>