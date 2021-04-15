<?php
session_start();
include 'lib/config.php';

ini_set('error_reporting',0);

if(!isset($_SESSION['usuario']))
{
  header("Location: login.php");
}
?>

<?php
if(isset($_GET['id'])) {

$id = mysqli_real_escape_string($conexion,$_GET['id']);
$action = mysqli_real_escape_string($conexion,$_GET['action']);

if($action == 'aceptar') {

	$update = mysqli_query($conexion,"UPDATE amigos SET estado = '1' WHERE id_ami = '$id'");
	header('Location:' . getenv('HTTP_REFERER'));

}

if($action == 'rechazar') {

	$delete = mysqli_query($conexion,"DELETE FROM amigos WHERE id_ami = '$id'");
	header('Location:' . getenv('HTTP_REFERER'));

}



}
