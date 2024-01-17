<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="<?=base_url();?>assets/imgs/favicon.png" />
        <title><?=$title;?></title>

        <!-- inject:css -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Select2 Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/select2/dist/css/select2.min.css">

        <!-- Touch Spin Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">

        <!-- Input mask Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css">

        <!-- Switchery Dependencies -->
        <!-- iOS 7 style switches for your checkboxes  -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/switchery/dist/switchery.min.css">

        <!-- Bootstrap Date Range Picker Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">

        <!-- Bootstrap DatePicker Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">

        <!-- Bootstrap TimePicker Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

        <!-- Bootstrap ColorPicker Dependencies -->
        <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

        <!-- Main Style  -->
        <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/main.css">
        <!--Data Table-->
        <link href="<?=base_url();?>assets/bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/bower_components/datatables-tabletools/css/dataTables.tableTools.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/bower_components/datatables-colvis/css/dataTables.colVis.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
        <link href="<?=base_url();?>assets/bower_components/datatables-scroller/css/scroller.dataTables.scss" rel="stylesheet">
        <script src="<?=base_url();?>assets/js/modernizr-custom.js"></script>
        <?php
            if($this->session->userdata('admin')){
                $profil = $this->db->get_where('user',['id'=>$this->session->userdata('admin')->id])->row_object();
            }elseif($this->session->userdata('suplier')){
                $profil = $this->db->get_where('suplier',['id'=>$this->session->userdata('suplier')->id])->row_object();
            }elseif($this->session->userdata('checker')){
                $profil = $this->db->get_where('user',['id'=>$this->session->userdata('checker')->id])->row_object();
            }
        ;?>
</head>
    <body>

        <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header ui-header--me text-white">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="<?=base_url();?>" class="navbar-brand">
                        <span class="logo"><img src="<?=base_url();?>assets/imgs/logo-light.png" alt=""/></span>
                        <span class="logo-compact"><img src="<?=base_url();?>assets/imgs/logo-icon-light.png" alt=""/></span>
                    </a>
                    <!--logo end-->
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->

                    <!--search start-->
                        
                    <!--search end-->

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <!-- <div class="user-avatar"><img src="<?=base_url();?>assets/imgs/a0.jpg" alt="..."></div> -->
                                <span class="hidden-sm hidden-xs"><?=$profil->username;?></span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="<?=base_url();?>profil"><i class="fa fa-user"></i>  Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=base_url();?>logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->

            <!--sidebar start-->
            <?php if($this->session->userdata('admin')){;?>
                <?php include_once "sidebar.php";?>
            <?php }elseif($this->session->userdata('suplier')){;?>
                <?php include_once "sidebar_suplier.php";?>
            <?php }elseif($this->session->userdata('checker')){;?>
                <?php include_once "sidebar_checker.php";?>
            <?php };?>
            <!--sidebar end-->

            <!--main content start-->
            <div id="content" class="ui-content">
                <div class="ui-content-body">
                    <div class="ui-container">
                        <div class="panel">
                            <header class="panel-heading">
                                <?=$title;?>
                            </header>
                            <div class="panel-body">
                                <?=$this->session->flashdata('flash');?>
                                <?=$contents;?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--main content end-->

            <!--footer start-->
            <div id="footer" class="ui-footer">
                <?=date('Y');?> &copy; Suzuya
            </div>
            <!--footer end-->

        </div>

        <!-- inject:js -->
        <script src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="<?=base_url();?>assets/dist/js/main.js"></script>

        <!-- Select2 Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/select2/dist/js/select2.min.js"></script>
        <script src="<?=base_url();?>assets/js/init-select2.js"></script>

        <!-- Touch Spin Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?=base_url();?>assets/js/init-touchspin.js"></script>

        <!-- jquery TagsInput Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <script src="<?=base_url();?>assets/js/init-tagsinput.js"></script>
        <!-- Input mask Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?=base_url();?>assets/js/init-daterangepicker.js"></script>

        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=base_url();?>assets/js/init-datepicker.js"></script>

        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="<?=base_url();?>assets/js/init-timepicker.js"></script>

        <!-- Bootstrap Color Picker Dependencies -->
        <script src="<?=base_url();?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?=base_url();?>assets/js/init-colorpicker.js"></script>

        <!--Data Table-->
        <script src="<?=base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
        <script src="<?=base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
        <script src="<?=base_url();?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
        <script src="<?=base_url();?>assets/bower_components/datatables-scroller/js/dataTables.scroller.js"></script>

        <!--init data tables-->
        <script src="<?=base_url();?>assets/js/init-datatables.js"></script>
        <!-- script me-->
        <script src="<?=base_url();?>assets/script/core.js"></script>
        <script src="<?=base_url();?>assets/script/barang.js"></script>
        <script src="<?=base_url();?>assets/script/suplier.js"></script>
        <script src="<?=base_url();?>assets/script/po.js"></script>
        <script src="<?=base_url();?>assets/script/user.js"></script>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>
