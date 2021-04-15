<?php
$host = "localhost";
$dbuser = "root";
$dbpwd = "";
$db = "red_social";
$db2 = "Asystem";

$conexion = mysqli_connect ($host, $dbuser, $dbpwd, $db);

	if(!$conexion){
		echo ("No se ha conectado a la base de datos");
	}
	else{
	$select = mysqli_select_db($conexion,$db);
	}
$Aconexion = mysqli_connect ($host, $dbuser, $dbpwd, $db2);

	if(!$conexion){
		echo ("No se ha conectado a la base de datos");
	}
	else{
	$select = mysqli_select_db($conexion,$db);
	}
	
?>
