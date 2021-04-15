<?php
session_start();
include 'lib/config.php';

$post = mysqli_real_escape_string($conexion,$_POST['id']);
$usuario = $_SESSION['id'];


$comprobar = mysqli_query($conexion,"SELECT * FROM likes WHERE post = '".$post."' AND usuario = ".$usuario."");
$count = mysqli_num_rows($comprobar);

if ($count == 0) {

	$insert = mysqli_query($conexion,"INSERT INTO likes (usuario,post,fecha) values ('$usuario','$post',now())");
	$update = mysqli_query($conexion,"UPDATE publicaciones SET likes = likes+1 WHERE id_pub = '".$post."'");
	
	?>
    <script type="text/javascript">
	$(document).ready(function() {
	alert(like);
	})
	</script>
    <?php
	

}

else 

{

	$delete = mysqli_query($conexion,"DELETE FROM likes WHERE post = ".$post." AND usuario = ".$usuario."");
	$update = mysqli_query($conexion,"UPDATE publicaciones SET likes = likes-1 WHERE id_pub = '".$post."'");
	
	echo "<a href=" . header('Location: index.php') . "> regresar </a>";
	
?>
    <script>
	$(document).ready(function() {
	alert(dislike);
	})
	</script>
    <?php
}

$contar = mysqli_query($conexion,"SELECT likes FROM publicaciones WHERE id_pub = ".$post."");
$cont = mysqli_fetch_array($contar,MYSQL_);
$likes = $cont['likes'];

if ($count >= 1) { $megusta = "<i class='glyphicon glyphicon-thumbs-up'></i> Me gusta"; $likes = " (".$likes++.")"; } else { $megusta = "<i class='glyphicon glyphicon-thumbs-down'></i> No me gusta"; $likes = " (".$likes--.")"; }

$datos = array('likes' =>$likes,'text' =>$megusta);

echo json_encode($datos);

?>