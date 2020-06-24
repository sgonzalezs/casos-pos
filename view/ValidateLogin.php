<?php

  require "../controller/Inicio.php";
  	// echo "Validate";
  	$inicio=new Inicio();
    $iduser=$_POST["txt_user"];
    $pass=$_POST["txt_pass"];
    $inicio->Signin($iduser, $pass);

?>