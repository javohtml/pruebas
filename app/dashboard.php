<?php
session_start();
if($_SESSION['italia'] && $_SESSION['norman'] && $_SESSION['empera']){
  $nombre = base64_decode($_SESSION['norman']);
  $id     = base64_decode($_SESSION['italia']);
  $empresa= base64_decode($_SESSION['empera']);
  include('../data/engine.php');
  $operation  = new Preferencia;
  $row        = $operation->loadData($id);
  $cont       = 0;
  $match      = 0;
  $keyWord    = "";
  $opeFav     = new Favorito;
  $nfavorito  = $opeFav->numberFav($id);
  require("../data/dates.php");
}else
  echo "<script type='text/javascript'>window.location = '../..'</script>";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Panel | Axion</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="../icon.png"/>
    <style type="text/css">
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('../images/loading.gif') 50% 50% no-repeat rgb(249,249,249);
    }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="loader"></div>
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-eye"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="../images/logo.png" alt=""></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
                  <span class="hidden-xs"><?php echo $nombre;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $nombre;?>
                      <small>Usuario AXEON</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<a href="#" class="btn btn-primary btn-lg btn-block" style="color:white;" onclick="salir()">Sign out</a>-->
                    <div class="pull-left">
                      <a href="perfil.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat" onclick="salir()">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $nombre;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $empresa;?></a>
            </div>
          </div>
          <!-- search form -->
          <form action="buscar.php" method="get" class="sidebar-form" id="formu">
            <div class="input-group">
              <input type="text" name="fttp" class="form-control" placeholder="Buscar..." required/>
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
              <li class="header">Menu</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-home"></i> <span>INICIO</span>
              </a>
            </li>
            <li><a href="preferencia.php"><i class="fa fa-cogs"></i><span>Preferencias</span></a></li>
            <li class="treeview">
              <a href="favoritos.php">
                <i class="fa fa-star"></i> <span>Favoritos</span>
              </a>
            </li>
            <li><a href="calendar.php"><i class="fa fa-calendar"></i><span>Calendario</span></a></li>
            <li><a href="avanzada.php"><i class="fa fa-search"></i><span>Busqueda Avanzada</span></a></li>
            <li><a href="docs.php"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li><a target="a_blank" href="https://www.mercadopublico.cl/Home"><i class="fa fa-info-circle"></i> <span> Mercadopublico</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel Principal
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Panel Principal</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 id="totalN"></h3>
                  <p>Licitaciones Abiertas</p>
                </div>
                <script src="../js/stadistics.js"></script>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="delDia.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 id="encontradas"></h3>
                  <p>Licitacion encontradas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-eye"></i>
                </div>
                <a href="#" class="small-box-footer">Desplegadas a Continuación <i class="fa fa-arrow-circle-down"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $nfavorito[0];?></h3>
                  <p>Mis Favoritos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-star"></i>
                </div>
                <a href="favoritos.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $dates;?></h3>
                  <p>Días</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clock"></i>
                </div>
                <a href="#" class="small-box-footer">Restantes de su subscripción</a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Licitaciones según mis preferencias del Día</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <?php

                        if($row=='none'){
                          echo '<div class="alert alert-danger">Aún no ha seleccionado sus preferencias. haga <a href="preferencia.php">clic aquí</a> para hacerlo ahora mismo!</div>';
                          echo "<script>document.getElementById('encontradas').innerHTML = '0';</script>";
                        }else{
                          $cont = 2;
                          foreach ($row as $key => $value) {
                            if($cont>count($row)){
                              $cont = 0;
                            }else{
                              switch ($cont) {
                                case 2:
                                  $idPre = $value;
                                  break;
                                case 5:
                                  $title = base64_decode($value);
                                  break;
                                case 6:
                                  $keyWord = base64_decode($value);
                                  break;
                              }
                              $cont++;
                            }
                          }
                        }
                        echo '<table id="example2" class="table table-bordered table-hover"><thead><tr><th style="text-align: center;">Codigo</th><th style="text-align: center; width:50%;">Nombre</th><th style="text-align: center;">Cierra el</th><th style="text-align: center;">Detalle</th><th style="text-align: center;">Favoritos</th></tr></thead><tbody id="results" style="text-align:center;">';
                        $contando = 0;
                        $doOperation = new Operatorias;
                        $doRoll = $doOperation->getDatos($keyWord,0);
                        if($doRoll!="none"){
                          foreach ($doRoll as $key => $value) {
                            $fechaDeCierre = str_replace('T',' a las ',$value["FechaCierre"]);
                            echo '<tr><td>'.$value["CodigoExterno"].'</td>';
                            echo "<td>" . $value['Nombre'] . '</td>';
                            echo '<td>'. $fechaDeCierre .'</td>';
                            echo "<td><a data-toggle=\"modal\" data-target=\"#myModal\"><button onclick=\"detailCode('" . $value["CodigoExterno"] . "')\" class=\"btn btn-info btn-circle\"><i class=\"fa fa-search\"></i></button></a></td>";
                            $doOper = new Operatorias;
                            $getIf  = $doOper->checkCode($value["CodigoExterno"],$id);
                            if($getIf=="none"){
                              echo '<td><form action="../data/switch.php" method="post">';
                              echo '<input type="hidden" name="hdnOperation" value="hdnAddFav">';
                              echo '<input type="hidden" name="code" value="'.$value["CodigoExterno"].'">';
                              echo '<button type="submit" class="btn btn-warning btn-circle"><i class="fa fa-star-o"></i></button>';
                              echo '</form></td></tr>';
                            }else{
                              echo '<td><button type="button" class="btn btn-success btn-circle"><i class="fa fa-star"></i></button></td></tr>';
                            }
                            $contando++;
                          }
                        }
                        echo "<script>document.getElementById('encontradas').innerHTML = '".$contando."';</script>";
                        if($contando==0)
                          echo '<td colspan="5" class="alert alert-danger">Sin Resultados</td>';
                        echo '</tbody><tfoot><tr><th style="text-align:center;"></th><th style="text-align:center;"></th><th style="text-align:center;"></th><th style="text-align:center;"></th></tr></tfoot></table>';
                      ?>
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
          <!-- Something here-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Axeon MercadoPublico &copy; 2015 All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 4em;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Detalle de licitación</h4>
                </div>
                <div class="modal-body" id="modalData">

                </div>
                <div class="modal-footer" id="historico" style="text-align: center;">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <script src="../js/idDetails.js"></script>
    <script type='text/javascript'>
    function salir(){
      window.location = '../data/session/salir.php'
    }
    </script>
    <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    })
    </script>
    <script type="text/javascript">
    $('#formu').submit(function() {
      $(".loader").fadeIn("slow");
    });
    </script>
    <script src="../js/ajaz.js"></script>
  </body>
</html>
