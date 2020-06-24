
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title id="titlePage">Casos Pos-Venta</title>
  <link rel="icon" type="icon" href="../public/img/icon.ico"/>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../public/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini" style="width: 100%; min-width: 800px; overflow-x: auto;">
<div class="wrapper" style="width: 100%;">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
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
                <!-- <div id="btnsMenuBody" class="row" style="padding: 5px;">
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
                </div> -->
                <!-- /.row -->
              <!--</li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <?php 
                $menu='';
                if($_SESSION["Usuario"]==="admin"){
                  $menu='<div class="pull-left">
                    <a href="../controller/Usuarios.php" class="btn btn-default btn-flat">Usuarios</a>
                  </div>';
                }
                  ?>
                  <?= $menu; ?>
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
                      <i class="fa fa-bell pull" id="notfCases" name="notfCases">&nbsp0</i>
                    </span>
                  </a>
                </li>
              <li class="">
                <a href="Asignados.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Casos Asignados</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfAssigned">&nbsp0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="Reasignacion.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Reasignacion de Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfReassigned">&nbsp0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="MisCasos.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Mis Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfMyCases">&nbsp0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="#" id="themesMenu" data-toggle="modal" data-target="#ModalNewTheme">
                  <i class="fa fa-tasks" aria-hidden="true"></i> <span>Temas</span>
                </a>
              </li>
              <li class="">
                <a href="#" data-toggle="modal" data-target="#ModalNewService" onclick="ListServices();">
                  <i class="fa fa-cogs" aria-hidden="true"></i> <span>Servicios</span>
                </a>
              </li>';
          }else if($_SESSION["Rol"]==3){
            $opcMenu='<li class="">
                <a href="MisCasos.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Mis Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfMyCases">&nbsp0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="#" data-toggle="modal" data-target="#NewcaseModalH">
                  <i class="fa fa-plus-square" aria-hidden="true"></i> <span>Agregar Caso</span>
                </a>
              </li>
              <li class="">
                <a href="#" id="themesMenu" data-toggle="modal" data-target="#ModalNewTheme">
                  <i class="fa fa-tasks" aria-hidden="true"></i> <span>Temas</span>
                </a>
              </li>
              <li class="">
                <a href="MisAsignados.php" >
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Registrados</span>
                </a>
              </li>';
          }else if($_SESSION["Rol"]==2){
            $opcMenu='<li class="">
                <a href="MisCasos.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Mis Casos</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfMyCases">&nbsp0</i>
                  </span>
                </a>
              </li>
              <li class="">
                <a href="#" data-toggle="modal" data-target="#NewcaseModalH">
                  <i class="fa fa-plus-square" aria-hidden="true"></i> <span>Agregar Caso</span>
                </a>
              </li>
              <li class="">
                <a href="#" id="themesMenu" data-toggle="modal" data-target="#ModalNewTheme">
                  <i class="fa fa-tasks" aria-hidden="true"></i> <span>Temas</span>
                </a>
              </li>';
          }else{
            $opcMenu='<li class="">
                    <a href="Casos.php">
                    <i class="fa fa-list" aria-hidden="true"></i> <span>Registrar Casos</span>
                    <span class="pull-right-container badge bg-blue">
                      <i class="fa fa-bell pull" id="notfCases" name="notfCases">&nbsp0</i>
                    </span>
                  </a>
                </li>
              <li class="">
                <a href="Asignados.php">
                  <i class="fa fa-address-book" aria-hidden="true"></i> <span>Casos Asignados</span>
                  <span class="pull-right-container badge bg-blue">
                    <i class="fa fa-bell pull" id="notfAssigned">&nbsp0</i>
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
          <a href="Historial.php" >
            <i class="fa fa-history"  aria-hidden="true"></i>  <span>Historial de Casos</span>
          </a>
        </li>
        <li class="">
          <a href="Reportes.php" >
            <i class="fa fa-signal" aria-hidden="true"></i>  <span>Gráficos</span>
          </a>
        </li>
        <!-- <li class="">
          <a href="#" id="aModalreports" data-toggle="modal" data-target="#ModalReport">
            <i class="fa fa-book"  aria-hidden="true"></i>  <span>Reportes</span>
          </a>
        </li> -->
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
                    <div class="col-md-12" style="height:150px; overflow:auto;">
                      <table class="table table-bordered table-striped table-hover" id="tableThemes">
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

   <!--------------------------------- MODAL AGREGAR CASO -------------------------------->
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="NewcaseModalH" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
              </button>
              <h3 class="modal-title">Registrar nuevo Caso</h3>
            </div>
            <div class="modal-body modalNewCaseHeader">
              <form class="container-fluid" method="post" id="formData" enctype="multipart/form-data">
                <div class="row" id="divNewCaseHeader">
                    <div class="col-md-3">
                      <label for="recipient-name" class="col-form-label"><span style="color: red">*</span> Nit:</label>
                      <input type="text" class="form-control" id="txt_nitCaseHead" name="txt_nitCaseHead" list="listClientsH" onchange="ListClientH();" />
                      <datalist id="listClientsH">
                         <?= $clients; ?>
                       </datalist>
                    </div>
                    <div class="col-md-4">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Cliente:</label>
                      <input type="text" class="form-control" id="txt_clientCaseHead" name="txt_clientCaseHead">
                    </div>
                    <div class="col-md-5">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Asunto:</label>
                      <input type="text" class="form-control" id="txt_AsntCaseHead" name="txt_AsntCaseHead" onkeyup="ValCharacter();">
                    </div>
                      <div class="col-md-12">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Descripción:</label>
                      <textarea class="form-control" id="txa_DescCaseHead" name="txa_DescCaseHead" maxlength="5000"></textarea>
                    </div>
                    <div class="col-md-12">
                      <label class="col-form-label">Adjuntar archivo</label>
                      <input type="file" class="btn btn-default" id="fileCaseH" name="fileCaseH">
                    </div>
                    <div class="col-md-4">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Entorno:</label>
                      <select class="form-control" id="slc_EnvCaseHead" onchange="SlcEnvHead();">
                        <option value="">Seleccione --</option>
                        <?= $optionEnvH;?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Programa:</label>
                      <select class="form-control" id="slc_SoftCaseHead" name="slc_SoftCaseHead">
                                      
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="message-text" class="col-form-label"><span style="color: red">*</span> Asesor:</label>
                      <select class="form-control" id="slc_AcCaseHead" name="slc_AcCaseHead">
                        <option value="">Seleccione --</option>
                        <?= $listAc;?> 
                      </select>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="CleanDataCaseHeader();" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" onclick="SaveCaseHeader();" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
  <!----------------------------  CIERRE MODAL ------------------------------->


    <!------------------------    MODAL REPORTES     --------------------------------->
      <div class="modal fade" id="ModalReport" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" action="../view/Reports/ReportValidate.php" target="_blank">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
              </button>
              <h4 class="modal-title" id="">Generar reportes</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid divslcreports">
                  <div class="row" >
                    <div class="col-md-5">
                      <label>Tipo de reporte</label>
                      <select class="form-control" id="slc_typeReport" name="slc_typeReport" onchange="typeReport()">
                        <option value="">Seleccione --</option>
                        <option value="actual">Casos del mes actual</option>
                        <option value="rango">Casos por rango de meses</option>
                        <option value="agrupado">Casos por cliente</option>
                        <option value="asesor">Casos por Asesor</option>
                      </select>
                    </div>
                    <div class="col-md-3 monthRange">
                       <label>Mes inicial</label>
                       <select class="form-control" id="slc_mesInicial" name="slc_mesInicial" onchange="validateMonth()">
                         <option value="">Seleccione --</option>
                         <option value=1>Enero</option>
                         <option value=2>Febrero</option>
                         <option value=3>Marzo</option>
                         <option value=4>Abril</option>
                         <option value=5>Mayo</option>
                         <option value=6>Junio</option>
                         <option value=7>Julio</option>
                         <option value=8>Agosto</option>
                         <option value=9>Septiembre</option>
                         <option value=10>Octubre</option>
                         <option value=11>Noviembre</option>
                         <option value=12>Diciembre</option>
                       </select> 
                    </div>
                    <div class="col-md-3 monthRange">
                       <label>Mes final</label>
                       <select class="form-control" id="slc_mesFinal" name="slc_mesFinal">
                         <option value="">Seleccione --</option>
                         <option value=1>Enero</option>
                         <option value=2>Febrero</option>
                         <option value=3>Marzo</option>
                         <option value=4>Abril</option>
                         <option value=5>Mayo</option>
                         <option value=6>Junio</option>
                         <option value=7>Julio</option>
                         <option value=8>Agosto</option>
                         <option value=9>Septiembre</option>
                         <option value=10>Octubre</option>
                         <option value=11>Noviembre</option>
                         <option value=12>Diciembre</option>
                       </select> 
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cleanSelects();">Cerrar</button>
                <button type="Submit" class="btn btn-primary" id="btnReport">Generar Reporte</button>
            </div>
          </form>
          </div>
        </div>
      </div>
  <!--------------------------------------- FIN MODAL TEMA --------------------------------> 

    <!------------------------    MODAL NUEVO SERVICIO       --------------------------------->
      <div class="modal fade" id="ModalNewService" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
              </button>
              <h4 class="modal-title" id="">Agregar Nuevo Servicio</h4>
            </div>
            <div class="modal-body">
                <form class="container-fluid">
                  <div class="row" >
                    <div class="col-md-5">
                      <input type="text" id="txt_service" name="txt_service" class="form-control" placeholder="Servicio">
                    </div>
                    <div class="col-md-7">
                      <select class="form-control" id="slcTypeService">
                        <option value="">Seleccione --</option>
                        <option value="Area Comercial">Area Comercial</option>
                        <option value="Area Tecnica">Area Tecnica</option>
                      </select>
                    </div>
                    <div class="col-md-7">
                      <!-- <a href="#" id="a_listServices">Listar Servicios</a> -->
                    </div>
                    <div class="col-md-12" style="height:150px; margin-top: 2%; overflow:auto; ">
                      <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                          <tr>
                            <td><b>Nombre</b></td>
                            <td><b>Tipo</b></td>
                          </tr>
                        </thead>
                        <tbody id="tableServices">

                        </tbody>
                      </table>   
                    </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnNewTheme" onclick="SaveService();">Registrar</button>
            </div>
          </div>
        </div>
      </div>
  <!--------------------------------------- FIN MODAL SERVICIOC --------------------------------> 
    


