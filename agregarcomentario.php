<?php
require('lib/config.php');

$usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
$comentario = mysqli_real_escape_string($conexion,$_POST['comentario']);
$publicacion = mysqli_real_escape_string($conexion,$_POST['publicacion']);

$comprobar = mysqli_query($conexion,"SELECT * FROM `comentarios` order by fecha DESC");

$comprobar1 = mysqli_fetch_array($comprobar,MYSQL_ASSOC);
$Comprobar2 = $comprobar1['comentario'];
echo $Comprobar2;
if ($Comprobar2==$comentario){
	?><script>
	alert("existe otro comentario igual");
	</script><?php }
	else {
		
       
       
	
    



$insert = mysqli_query($conexion,"INSERT INTO comentarios (usuario, comentario, fecha, publicacion) VALUES ('$usuario', '$comentario', now(), '$publicacion')");



$llamado = mysqli_query($conexion,"SELECT * FROM publicaciones WHERE id_pub = '".$publicacion."'");
$ll = mysqli_fetch_array($llamado,MYSQL_ASSOC);

$usuario2 = mysqli_real_escape_string($conexion,$ll['usuario']);

$insert2 = mysqli_query($conexion,"INSERT INTO notificaciones (user1, user2, tipo, leido, fecha, id_pub) VALUES ('$usuario', '$usuario2', 'ha comentado', '0', now(), '$publicacion')");

?>
 <script>
		alert("aprobado");
		</script>
        <?php }	


?>