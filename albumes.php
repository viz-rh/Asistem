<?php
$id = mysqli_real_escape_string($conexion,$_GET['id']);
$album = mysqli_real_escape_string($conexion,$_GET['album']);
?>

                <center>
                <?php
                $fotosa = mysqli_query($conexion,"SELECT * FROM fotos WHERE usuario = '$id' AND album = '$album' ORDER BY id_fot desc");
                while($fot=mysqli_fetch_array($fotosa,MYSQL_ASSOC))
                {
                ?>
                  <a href="#"><img src="publicaciones/<?php echo $fot['ruta'];?>" width="70%"> </a>
                <?php
                }
                ?>
                </center>