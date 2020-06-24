
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Proyecto</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="../public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../public/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$titulo;?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
             <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <i class="fa fa-user" aria-hidden="true"></i>
              <span class="hidden-xs"><?=$_SESSION["Nombre"]." ".$_SESSION["Apellidos"];?></span>
            </a>
            <ul class="dropdown-menu">
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div id="btnsMenuBody" class="row" style="padding: 5px;">
                  <a href="../controller/Usuarios.php">
                    <div class="col-xs-4 text-center" style="padding: 5px; border: 1px solid; margin-left: 10px;">
                    Usuarios
                    </div>
                  </a>
                  <a href="#">
                    <div class="col-xs-4 text-center" style="padding: 5px; border: 1px solid; margin-right: 10px; float: right;">
                      Sales
                    </div>
                  </a>
                </div>
                <!-- /.row -->
              <!--</li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../controller/logout.php" class="btn btn-default btn-flat">Cerrar</a>
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
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- <li class="">
          <a href="controllerIndex.php">
            <i class="fa fa-home" aria-hidden="true"></i> <span>Inicio</span>
          </a>
          
        </li> -->
        <?php 
          $opcMenu="";
          if($_SESSION["Rol"]==1){
              $opcMenu='<li class="">
                    <a href="Casos.php">
                    <i class="fa fa-list" aria-hidden="true"></i> <span>Registrar Casos</span>
                    <span class="pull-right-container badge bg-blue">
                      <i class="fa fa-bell pull" id="notfCases" name="notfCases">&nbsp </i>
                    </span>
                  </a>
                 
                </li>
              <li class="">
                <a href="Asignados.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Casos Asignados</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfAssigned">&nbsp </i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="MisCasos.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Mis Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfMyCases">0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="#" id="themesMenu" data-toggle="modal" data-target="#ModalNewTheme">
                  <i class="fa fa-tasks" aria-hidden="true"></i> <span>Temas</span>
                </a>
              </li>
              <li class="">
                <a href="#" onclick="swal(`En mantenimiento`, ``,`warning`);">
                  <i class="fa fa-cogs" aria-hidden="true"></i> <span>Servicios</span>
                </a>
              </li>';
          }else{
            $opcMenu='<li class="">
                <a href="MisCasos.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Mis Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfMyCases">&nbsp0</i>
                  </span>
                </a>
              </li>';
          }
        ?>

        <!-- <li class="">
          <a href="Asignados.php">
            <i class="fa fa-address-book" aria-hidden="true"></i> <span>Casos Asignados</span>
            <span class="pull-right-container badge bg-blue">
              <i class="fa fa-bell pull" id="notfAssigned">&nbsp </i>
            </span>
          </a>
        </li> -->
        <?= $opcMenu; ?>


        <li class="">
          <a href="Historial.php">
            <i class="fa fa-history"  aria-hidden="true"></i>  <span>Historial de Casos</span>
          </a>
        </li>
      </ul>

      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!------------------------    MODAL NUEVO TEMA       --------------------------------->
      <div class="modal fade" id="ModalNewTheme" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
              </button>
              <h4 class="modal-title" id="">Agregar Nuevo Tema</h4>
            </div>
            <div class="modal-body">
                <form class="container-fluid">
                  <div class="row" >
                    <div class="col-md-5">
                      <input type="text" id="txt_theme" name="txt_theme" class="form-control" >
                    </div>
                    <div class="col-md-7">
                      <select class="form-control" id="slcTypeTheme">
                        
                      </select>
                    </div>
                    <div class="col-md-7">
                      <a href="#" id="a_listTheme">Listar Temas</a>
                    </div>
                    <div class="col-md-12" style="height:150px; overflow:auto; ">
                      <table class="table table-bordered table-striped table-hover" id="tableThemes" style="display:none;">
                        <thead>
                          <tr>
                            <td><b>Nombre</b></td>
                            <td><b>Tipo</b></td>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>   
                    </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnNewTheme" onclick="SaveTheme();">Agregar</button>
            </div>
          </div>
        </div>
      </div>
  <!--------------------------------------- FIN MODAL TEMA --------------------------------> 
    

