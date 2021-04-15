
<?php



session_start();



//ini_set('error_reporting',0);

if(!$_SESSION['usuario'])
{



  header("Location: login.php");
}
include 'lib/config.php';
include 'lib/socialnetwork-lib.php';

$_SESSION['usuario']=$_COOKIE["usuario_usu"];
$_SESSION['id']=$_COOKIE["usuario_id"];
$_SESSION['nombre']=$_COOKIE["usuario_nombre"];
$_SESSION['avatar']=$_COOKIE["usuario_avatar"];

?>

<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ASYSTEM</title>


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
    <link rel="stylesheet" href="css/comun.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Archivos modificar el input file -->
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <!-- remove this if you use Modernizr -->
  <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- codigo scroll -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/jquery.jscroll.js"></script>
        	<script type="text/javascript" src="js/views.js"></script>
  <!-- codigo scroll -->


</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed">
<div class="wrapper">



   <?php echo Headerb (); ?>

<?php echo Side (); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

    <!-- Script validar caracteres -->
    <script type="text/javascript">
    function validarn(e) {
    tecla = (document.all) ? e.keyCode : e.which;
   if (tecla==8) return true;
   if (tecla==9) return true;
   if (tecla==11) return true;
    patron = /[A-Za-zñ!#$%&()=?¿¡*+0-9-_á-úÁ-Ú :;,.]/;

    te = String.fromCharCode(tecla);
    return patron.test(te);
}
    </script>
    <!-- Script validar caracteres -->


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- /.box -->
          <div class="row">
    <div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> administrar <small>evidencias</small></h1>
			</div>
			<p class="lead"></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">

                <?php
										$select=mysqli_query($conexion,"select * from usuarios where id_use='".$_SESSION['id']."'");
										$select2=mysqli_fetch_array($select,MYSQL_ASSOC);
										$IDdoc=$select2['IDdoc'];
										if(!$IDdoc==0){
											?>

					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#list" data-toggle="tab">list</a></li>
					  	<li><a href="#new" data-toggle="tab">new</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">


									    <form action="" method="POST">
	                      <div class="form-group label-floating">
                      <label class="control-label">materia</label>
                      <select  name="materia" class="form-control" placeholder="materia"  required>
                  <option></option>
                   <?php
                   $consulta=mysqli_query($Aconexion,"select * from materia where Docente='$IDdoc' ");
                   while($Materia=mysqli_fetch_array($consulta,MYSQLI_ASSOC)){

                        echo	"<option>".$Materia['Nombre']."</option>";
                 }
                 ?>
                  </select>
                    </div>
									    	<div class="form-group label-floating">
											  <label class="control-label">nombre de la evidencia</label>
											  <input name="nombre" class="form-control" type="text">
											</div>

                      <div class="form-group label-floating">
                      <label class="control-label">descripcion</label>
                      <textarea name="descripcion" class="form-control" rows="3"> </textarea>
                    </div>


                      <div class="form-group label-floating">
                      <label class="control-label">fecha de entrega</label>
                      <input name="fecha" class="form-control" type="date">
                    </div>



                        <p class="text-center">
										    	<button name="guardar" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> guardar</button>
										    </p>
									    </form>
                        <?php if (isset($_POST['guardar'])){
                          $aa=$_POST['materia'];
                      		$a=mysqli_query($Aconexion,"select * from materia where Nombre='$aa'");
                       		$aaa = mysqli_fetch_array($a,MYSQL_ASSOC);
                      		$materia=$aaa['IDM'];
                          $nombre = mysqli_real_escape_string($Aconexion,$_POST['nombre']);
                          $descripcion = mysqli_real_escape_string($Aconexion,$_POST['descripcion']);
                            $fecha = mysqli_real_escape_string($Aconexion,$_POST['fecha']);

                          $insertar = mysqli_query($Aconexion,"INSERT INTO evidencias(IDM, Nombre,Descripcion, Parcial, fecha, fecha_en) values('$materia','$nombre','$descripcion','3',now(),'$fecha')");

                            $asystem=mysqli_fetch_array(mysqli_query($Aconexion,"SELECT * from evidencias where Nombre ='$nombre' "),MYSQL_ASSOC);
							$consulta=mysqli_query($Aconexion,"SELECT * from materia_u_grupo where IDM='".$asystem['IDM']."'");
while($asystem2=mysqli_fetch_array($consulta,MYSQL_ASSOC)){
                                 if(mysqli_query($Aconexion,"alter table evi_". $asystem2['IDG'] ." Add E". $asystem['IDE'] ." int not null")){
 	echo"logrado";
 }else{
 	echo "no logrado";
}
	?>

	<center>
	<?php


}
}

?>
	</center>






									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade active in" id="list">
							<div class="table-responsive">


                                <table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">materia</th>
											<th class="text-center">nombre</th>
                                          <!--  <th class="text-center">descripcion</th>-->
											<th class="text-center">estado</th>
										</tr>
									</thead>
									<tbody>
										<tr>



                                            <?php


									$consulta=mysqli_query($Aconexion,"select * from materia where Docente='$IDdoc' ");
									while($Materia=mysqli_fetch_array($consulta,MYSQLI_ASSOC)){

											$listaevidencia=mysqli_query($Aconexion,"SELECT * FROM `evidencias` WHERE IDM='" . $Materia['IDM']. "'");
											while($evidencia=mysqli_fetch_array($listaevidencia,MYSQL_ASSOC)){
$consultar=mysqli_query($Aconexion,"SELECT * from materia_u_grupo where IDM='".$Materia['IDM']."'");
$count=0;
$b=0;
$c=0;
while($dato=mysqli_fetch_array($consultar, MYSQL_ASSOC)){
	$count=$count+1;
	$sql=mysqli_query($Aconexion,"SELECT * from evi_". $dato['IDG']."");
	$a=mysqli_num_rows($sql);
	$sql1=mysqli_query($Aconexion,"SELECT * from evi_". $dato['IDG']." where E" .$evidencia['IDE'] ."=1");
	$d=mysqli_num_rows($sql1);
	$b=$b+$a;
	$c=$c+$d;
	}
	$total=$b;
	$parte=$c;
	$porcentaje=($parte/$total)*100;

											echo "<td>".$evidencia['IDE']."</td>
											<td>".$Materia['Nombre'] ."</td>
											<td>".$evidencia['Nombre']."</td>
											<td>".$porcentaje."%</td>";


											echo "
										</tr>";


										}
										}

										?>

									</tbody>
								</table>

							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php

}else{
	$IDAlum=$select2['id_A'];

	?>


					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">




									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade active in" id="list">
							<div class="table-responsive">


                                <table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">materia</th>
											<th class="text-center">nombre</th>
                                          <!--  <th class="text-center">descripcion</th>-->
											<th class="text-center">estado</th>
										</tr>
									</thead>
									<tbody>
										<tr>



                                            <?php


$consulta=mysqli_query($Aconexion,"select * from alumnos where IDA='$IDAlum' ");
while($grupo=mysqli_fetch_array($consulta,MYSQLI_ASSOC)){

		$listamaterias=mysqli_query($Aconexion,"SELECT * FROM materia_u_grupo where IDG='" . $grupo['Grupo']. "'");
		while($materias=mysqli_fetch_array($listamaterias,MYSQL_ASSOC)){

      $consultar=mysqli_query($Aconexion,"SELECT * from materia_u_grupo where IDM='".$m2aterias['IDM']."'");
      $count=0;
      $b=0;
      $c=0;
while($dato=mysqli_fetch_array($consultar, MYSQL_ASSOC)){
	$count=$count+1;
	$sql=mysqli_query($Aconexion,"SELECT * from evi_". $dato['IDG']."");
	$a=mysqli_num_rows($sql);
	$sql1=mysqli_query($Aconexion,"SELECT * from evi_". $dato['IDG']." where E" .$evidencia['IDE'] ."=1");
	$d=mysqli_num_rows($sql1);
	$b=$b+$a;
	$c=$c+$d;
	}
	$total=$b;
	$parte=$c;
	$porcentaje=($parte/$total)*100;

											echo "<td>".$evidencia['IDE']."</td>
											<td>".$Materia['Nombre'] ."</td>
											<td>".$evidencia['Nombre']."</td>
											<td>".$porcentaje."%</td>";


											echo "
										</tr>";


										}
										}

										?>

									</tbody>
								</table>

							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>




    <?php

}
	?>
            <!-- CAJA QUÉ ESTÁS PENSANDO? --><!-- /.col -->
          </div>
          <!-- /.row -->




          <script>
            //Simple codigo para hacer la paginacion scroll
            $(document).ready(function() {
              $('.scroll').jscroll({
                loadingHtml: '<img src="images/invisible.png" alt="Loading" />'
            });
            });
            </script>
          <!-- codigo scroll -->


        </div>

        <div class="col-md-4">

          <!-- PRODUCT LIST --><!-- /.box -->
        </div>
        <!-- /.col -->


        <div class="col-md-4">
              <!-- USERS LIST --><!--/.box -->
            </div>
            <!-- /.col -->


      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="glyphicon glyphicon-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="glyphicon glyphicon-equalizer"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- codigo viz -->



</body>
</html>
