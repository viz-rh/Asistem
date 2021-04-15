<?php
session_start();
include 'lib/config.php';

if(isset($_SESSION['usuario']))
{
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>LogIn</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/font.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="cover" style="background-image: url(./assets/img/loginFont.jpg);">




	<form action="" method="POST" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
		  <label  class="control-label" for="UserEmail">Usuario</label>
		  <input name="usu" class="form-control" id="UserEmail" type="text">
		  <p class="help-block">Escribe tú E-mail</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input name="contrasena" class="form-control" id="UserPass" type="text">
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
        <button type="submit" name="login" class="btn btn-raised btn-danger">Iniciar Sesión</button>
       			
            
		</div>
        <div>
               <?php
    if(isset($_POST['login']))

    {
echo $_POST['usu'];
      $usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
      $usuario = strip_tags($_POST['usuario']);
      $usuario = trim($_POST['usuario']);

      $contrasena = mysql_real_escape_string(md5($_POST['contrasena']));
      $contrasena = strip_tags(md5($_POST['contrasena']));
      $contrasena = trim(md5($_POST['contrasena']));

      $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'");
      $contar = mysqli_num_rows($query);

      if($contar == 1) 

      {

        while($row=mysqli_fetch_array($query)) 

        {

          if($usuario = $row['usuario'] && $contrasena = $row['contrasena'])

          {

            $_SESSION['usuario'] = $usuario;
            $_SESSION['id'] = $row['id_use'];

            header('Location: ../index.php');

          }

        }
        
      } else { echo 'Los datos ingresados no son correctos'; }


    }

    ?>

    <br>

    <a href="#">Olvidé mi contraseña</a><br>
    <a href="../registro.php" class="text-center">Registrarme en REDSOCIAL</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

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
    
    
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script> 
        </div>
	</form>

</body>
</html>