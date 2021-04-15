<?php
$id = mysqli_real_escape_string($conexion,$_GET['id']);
?>

                <center>
                <?php
                $fotosa = mysqli_query($conexion,"SELECT * FROM albumes WHERE usuario = '$id' ORDER BY id_alb asc");
                while($fot=mysqli_fetch_array($fotosa))
                {
                $fotalb = mysqli_query($conexion,"SELECT ruta FROM fotos WHERE album = '$fot[id_alb]' ORDER BY id_fot DESC");
                $fotal = mysqli_fetch_array($fotalb);
                ?>
                  <a href="?id=<?php echo $id;?>&album=<?php echo $fot[id_alb]; ?>&perfil=albumes"><img src="publicaciones/<?php echo $fotal['ruta'];?>" width="50%"> </a>
                  <br>
                  <?php echo $fot['nombre']; ?>
                <?php
                }
                ?>
                </center>