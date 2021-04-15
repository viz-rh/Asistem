<?php
session_start();
include 'lib/config.php';
ini_set('error_reporting',0);

if(isset($_SESSION['usuario']))
{
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php //nombre red social ?> Registro</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>RED</b>SOCIAL</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Regístrate en REDSOCIAL</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <input type="text" name="Apaterno" class="form-control" placeholder="apellido paterno" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <input type="text" name="Amaterno" class="form-control" placeholder="apellido materno" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="usuario" class="form-control" placeholder="Usuario"  required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <select  name="grupo" class="form-control" placeholder="grupo"  required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
     <?php
	 $sql1=mysqli_query($Aconexion,"select * from grupo");
	 while($dato=mysqli_fetch_array($sql1,MYSQL_ASSOC)){

					echo	"<option>".$dato['Nombre']."</option>";
	 }
	 ?>
	 	</select>

      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repcontrasena" class="form-control" placeholder="Repita la contraseña" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-10">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="add-new-event" required> Acepto los <a href="#">términos y condiciones</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="registrar" class="btn btn-primary btn-block btn-flat">Registrarme</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <?php

    if(isset($_POST['registrar'])) {

		$aa=$_POST['grupo'];
		$a=mysqli_query($Aconexion,"select * from grupo where Nombre='$aa'");
 		$aaa = mysqli_fetch_array($a,MYSQL_ASSOC);
		$grupo=$aaa['IDG'];
      $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
	   $Apaterno = mysqli_real_escape_string($conexion,$_POST['Apaterno']);
	   $Amaterno = mysqli_real_escape_string($conexion,$_POST['Amaterno']);
	   $Nomcompleto = $nombre . " " . $Apaterno . " " . $Amaterno;
      $email = mysqli_real_escape_string($conexion,$_POST['email']);
      $usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
      $contrasena = mysqli_real_escape_string($conexion,md5($_POST['contrasena']));
      $repcontrasena = mysqli_real_escape_string($conexion,md5($_POST['repcontrasena']));

      $comprobarusuario = mysqli_num_rows(mysqli_query($conexion,"SELECT usuario FROM usuarios WHERE usuario = '$usuario'"));

      $comprobaremail = mysqli_num_rows(mysqli_query($conexion,"SELECT email FROM usuarios WHERE email = '$email'"));

      if($comprobarusuario >= 1) { ?>

      <br>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        El nombre de usuario está en uso, por favor escoja otro
     </div>

     <?php } else {



          if($contrasena != $repcontrasena) { ?>

          <br>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Las contraseñas no coinciden
          </div>

          <?php } else {

$insertar2 = mysqli_query($Aconexion,"INSERT INTO alumnos (Nombre,Apaterno,Amaterno,Grupo) values('$nombre','$Apaterno','$Amaterno','$grupo')");
		    $sql2=mysqli_query($Aconexion,"select * from alumnos where Nombre='$nombre' and Apaterno='$Apaterno' and Grupo='$grupo'");
		   $alumno=mysqli_fetch_array($sql2,MYSQL_ASSOC);
		   $id_a=$alumno['IDA'];
       $insertar3=mysqli_query($Aconexion,"INSERT INTO evi_". $grupo . " (id_A) values('$id_a')");
           $insertar = mysqli_query($conexion,"INSERT INTO usuarios (nombre,id_A,email,usuario,contrasena,avatar,fecha_reg) values ('$Nomcompleto','$id_a','$email','$usuario','$contrasena','defect.jpg',now())");


            if($insertar2) { ?>

            <br>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Felicidades se ha registrado correctamente
            </div>

            <?php

           header("Refresh: 2; url = login.php");

            }

          }

        }

      }



    ?>

    <br>
    <a href="login.php" class="text-center">Tengo actualmente una cuenta</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
