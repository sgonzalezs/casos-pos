<?php 
    session_start();
    if(isset($_SESSION["Usuario"])){
      header("location: ../controller/Casos.php");
    }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../public/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    html, body{
      height: auto;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Casos Pos-Venta</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

 <!--INICIO MENSAJES DE ALERTA-->
   <div class="container-fluid">

  <!--/container-fluid-->
<!-- FIN MENSAJES DE ALERTA-->

<!--login-box-msg-->

    <p class="text-center pad text-bold bg-primary margin-bottom">Iniciar Sesion</p>

    <form action="../view/ValidateLogin.php" method="POST">
      <div class="form-group has-feedback">
        <input type="text" name="txt_user" id="txt_user" class="form-control" placeholder="Usuario" required="required" autofocus="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="txt_pass" id="txt_pass" class="form-control" placeholder="Clave" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

       <div class="form-group">
        <input type="hidden" name="enviar" class="form-control" value="si">
       
      </div>
      <div class="row">
        
        <div class="col-xs-7 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">
          <button type="Submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-power-off" aria-hidden="true"></i>  Iniciar Sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->

</div>
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="../public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../public/plugins/iCheck/icheck.min.js"></script>
<script src="../public/js/login.js"></script>
<script type="text/javascript">
  $(()=>{
            <?php if(isset($_SESSION["msg"]) && $_SESSION["msg"] != null): ?>
                <?= $_SESSION["msg"]; ?>
                <?php $_SESSION["msg"] = null; ?>

            <?php endif ?>

        });
</script>
</body>
</html>

