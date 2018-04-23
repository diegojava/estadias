<?php
ob_start();
  include("bin/conexion.php");
  session_start();
  if($_SESSION["id_usuario"] == TRUE && $_SESSION["cargo"] == "admin")
  {
?>
<!DOCTYPE html>
<html>
<head>

  <!-- LLAMAMOS A TRAER EL HEADER -->
  <?php include_once(__DIR__."/bin/header.php"); ?>
  <title>Inicio | Administración</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- LLAMAMOS A TRAER EL ENCABEZADO -->
  <?php include_once(__DIR__."/bin/cabeza.php"); ?>

  <!-- TRAEMOS EL SIDEBAR DE LA IZQUIERDA -->
  <?php include_once(__DIR__."/bin/sidebar.php"); ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel de administración
        <small>sección: escuelas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/Estadias/admin/"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Escuelas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 <?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM escuela WHERE id='$nik'");
			if(mysqli_num_rows($sql) == 0){
				//header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id		     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["id"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$direccion	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["direccion"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
				$director	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["director"],ENT_QUOTES)));//Escanpando caracteres 
				

				$update = mysqli_query($mysqli, "UPDATE escuela SET nombre='$nombre', direccion='$direccion', telefono='$telefono', director='$director' WHERE id='$nik'") or die(mysqli_error());
				if($update){
					header("Location: escuelas-edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">ID</label>
					<div class="col-sm-2">
						<input type="text" name="matricula" value="<?php echo $row ['id']; ?>" class="form-control" placeholder="NIK" required readonly>
					</div>
				</div>
				<hr />
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="Nombre de la escuela" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Direccion</label>
					<div class="col-sm-4">
						<input type="text" name="direccion" value="<?php echo $row ['direccion']; ?>" class="form-control" placeholder="Direccion de la escuela" required>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Telefono</label>
					<div class="col-sm-4">
						<input type="text" name="telefono" value="<?php echo $row ['telefono']; ?>" class="form-control" placeholder="Telefono de la escuela" required>
					</div>
				</div>
                   
                
				<div class="form-group">
					<label class="col-sm-3 control-label">Director</label>
					<div class="col-sm-3">
						<input type="text" name="director" value="<?php echo $row ['director']; ?>" class="form-control" placeholder="Director de la escuela" required>
				</div>
				</div>
			
				
			
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="escuelas.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
      </div>

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
      
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include_once(__DIR__."/bin/footer.php") ?>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once(__DIR__."/bin/scripts.php") ?>
</body>
</html>
<?php
ob_end_flush();
  } else {
    header("Location: /Estadias/admin/login.php");
  }
 ?>
