<?php
session_start();

unset($_SESSION['usuario']);
unset($_SESSION['id']);

session_destroy();
setcookie("usuario_usu",$usuario,time()-1);
setcookie("usuario_id",$row['id_use'],time()-1);
setcookie("usuario_nombre",$row['nombre'],time()-1);
setcookie("usuario_avatar",$row['avatar'],time()-1);

header("Location: login.php");
?>
