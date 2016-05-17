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
    <link rel="stylesheet" href="css/calendar.css">
  	<style type="text/css">
  		.btn-twitter {
  			padding-left: 30px;
  			background: rgba(0, 0, 0, 0) url(https://platform.twitter.com/widgets/images/btn.27237bab4db188ca749164efd38861b0.png) -20px 6px no-repeat;
  			background-position: -20px 11px !important;
  		}
  		.btn-twitter:hover {
  			background-position:  -20px -18px !important;
  		}
  	</style>
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
            <li>
              <a href="dashboard.php">
                <i class="fa fa-home"></i> <span>INICIO</span>
              </a>
            </li>
            <li><a href="preferencia.php"><i class="fa fa-cogs"></i><span>Preferencias</span></a></li>
            <li class="treeview">
              <a href="favoritos.php">
                <i class="fa fa-star"></i> <span>Favoritos</span>
              </a>
            </li>
            <li class="active treeview"><a href="#"><i class="fa fa-calendar"></i><span>Calendario</span></a></li>
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
          <!-- Main row -->
          <div class="row">
            <div class="col-xs-2">
            </div><!-- /.col -->
            <div class="col-xs-8">
              <div class="form-inline">
          			<div class="btn-group">
          				<button class="btn btn-primary" data-calendar-nav="prev">< Antes</button>
          				<button class="btn" data-calendar-nav="today">Ahora</button>
          				<button class="btn btn-primary" data-calendar-nav="next">Despues ></button>
          			</div>
          			<div class="btn-group">
          				<button class="btn btn-warning" data-calendar-view="year">Durante el Año</button>
          				<button class="btn btn-warning active" data-calendar-view="month">Durante el Mes</button>
          				<button class="btn btn-warning" data-calendar-view="week">Durante la Semana</button>
          				<button class="btn btn-warning" data-calendar-view="day">Durante el Día</button>
          			</div>
          		</div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-1">
            </div><!-- /.col -->
            <div class="col-xs-10">
              <div id="calendar" style="min-height:100vh;"></div>
            </div><!-- /.col -->
          </div><!-- /.row -->
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
    <script type="text/javascript" src="components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="components/underscore/underscore-min.js"></script>
    <script type="text/javascript" src="components/bootstrap2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="components/jstimezonedetect/jstz.min.js"></script>
  	<script type="text/javascript" src="js/language/es-MX.js"></script>
  	<script type="text/javascript" src="js/language/es-ES.js"></script>
  	<script type="text/javascript" src="js/calendar.js"></script>
  	<script type="text/javascript" src="js/app.js"></script>

  	<script type="text/javascript">
  		var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
  		(function() {
  			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
  			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
  			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  		})();
  	</script>
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
  </body>
</html>
