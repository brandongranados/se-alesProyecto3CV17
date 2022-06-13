<?php
 //Realizamos conexion y solicitamos datos del inicio de sesion
	session_start();
	require_once "../conexion.php";
	$tipoUser = $_SESSION['tipoUser'];
	$usuario = $_SESSION['correo'];
	$contraseña = $_SESSION['pass'];
	$_SESSION['correo'] = $usuario;
	$_SESSION['pass'] = $contraseña;
	//Obtenemos datos de la BD
	$consultaempl ="SELECT*FROM usuarios where email = '$usuario' and passwordUser = '$contraseña' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasempl = mysqli_num_rows($resultadoemp);
	//Se obtienen los datos del contratante
	if($filasempl){   
		$fila=mysqli_fetch_array($resultadoemp);
		$rIdContratante = $fila['idUsuario'];
		$rNombre = $fila['nombreUsuario'];
		$rEmail = $fila['email'];
		$rFoto=$fila['foto'];
    }
    $consulta ="SELECT*FROM usuariodependiente where idUsuarioDep = '$rIdContratante'";
    $resultado = mysqli_query($conexion, $consulta);
	$filas = mysqli_num_rows($resultado);
    if($filas){   
        $filas = mysqli_fetch_array($resultado);
		$Puntos = $filas['puntosUsuario'];
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" type="image/ico" href="../static/images/icono.ico">
    <link href="../static/css/navegacion.css" rel="stylesheet" type="text/css">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" 
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>
  <body>
  <header class="encabe">
  		<div class="Logo">
            <a class="navText" href="<?php if($tipoUser == "Admin"){
                    echo "./homeUser.php";}else{echo "./taskUser.php";}?>"><img src="./static/images/Logo.png" class="logito" alt="Logo"></a>    
        </div>
        <nav>
            <li><a class="navText" href="./perfilUser.php"><span > Perfil </span></a></li>    
            <li><a class="navText" href="./taskUser.php"><span > Tareas </span></a></li>    
            <li><a class="navText" href="./rewardUser.php"><span > Recompensas </span></a></li>    
            <li><a class="navText" href="../cerrarSesion.php"><span > Cerrar sesi&oacute;n </span></a></li>
        </nav>
    </header>
<br>
	<br>
	<a class="navText" href="./cerrarSesion.php"><h1>Cerrar Sesion</h1></a>
	<div>
	
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col col-lg-6 mb-4 mb-lg-0">
				<div class="card mb-3" style="border-radius: .5rem;">
					<div class="row g-0">
						<div class="row pt-1 text-center">
								<h1 class="h3">Usuario</h1>
						</div>	
						<div class="col-md-8">
							<div class="card-body p-4">
								<div class="row pt-1">
									<div class="col-12 mb-3">
										<h6>Nombre</h6>
										<p class="text-muted"><?php echo $rNombre ?> </p>
									</div>
								</div>
								<div class="row pt-1">
									<div class="col-12 mb-3">
										<h6>Email</h6>
										<p class="text-muted"> <?php echo $rEmail ?></p>
									</div>
								</div>
								<?php
									if($tipoUser == "Usuario"){
								?>
                                <div class="row pt-1">
									<div class="col-12 mb-3">
										<h6>Puntos</h6>
										<p class="text-muted"> <?php echo $Puntos ?></p>
									</div>
								</div>
								<?php
									}
									?>
							</div>
						</div>
						<div class="col-md-4 gradient-custom text-center text-white"
							style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
							<img src="<?php echo $rFoto?>" alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
							<i class="far fa-edit mb-5"></i>
							<div class="row pt-1">
								<div class="col-12 mb-3">
		  							<a class="btn btn-primary" href="./modificarUser.php">Modificar datos</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <div class="card mt-5 mb-5" style="max-width:500px;margin:auto;">
        <div class="card-body text-center" >
			<h1 class="h3 mb-3">Actividades de usuarios en curso</h1>
			<hr>
			<?php 
			include('encursoUser.php');
			?>
        </div>
    </div>
	
	<div class="card mt-5 mb-5" style="max-width:500px;margin:auto;">
        <div class="card-body text-center" >
			<h1 class="h3 mb-3">Historial Servicios Contratados</h1>
			<hr>
			<?php 
			include('historialContrataciones.php')
			?>
        </div>
    </div>

	<footer>
        <div class="bajo bg-primary py-3 d-flex align-items-center contenedor-footer w-100">
            <span class="text-secondary w-100 text-center">iServiGo &copy; 2022</span>
        </div>
    </footer>
  </body>
</html>

<script type="text/javascript">
	function alertar(idBuscar,tipo) {
		var contenido = obtenerInfo(idBuscar);
	if(tipo == "activo" || tipo == "finalizada"){

		Swal.fire({
		icon: 'info',
		html: contenido
		})
	}
	else{


		const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: true
		})

		swalWithBootstrapButtons.fire({
		title: '¿Terminar servicio?',
		html: contenido,
		icon: 'question',
		showDenyButton: true,
		confirmButtonText: 'Terminar',
		denyButtonText: 'Cancelar',
		confirmButtonColor: '#7DEB4E',
		denyButtonColor: '#9b9b9b',
		cancelButtonColor: '#d33',
		reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {

				swalWithBootstrapButtons.fire(
					'Se concluyo el servicio',
					'',
					'success'
					)
			
			$.ajax({
            type: "POST",
            url: 'terminarContratacion.php',
            data: {
				"IdContratacion":idBuscar,
				"status": "finalizado",
			},
            success: function(response)
            {
                if (response == "1")
                {
                }
                else
                {
					Swal.fire(
					'Fallo en aceptar la solicitud'
					)
                }
           }
       });
	   header("location:Perfil_c.php");
		}
		})
	}
	}
</script>

<script type="text/javascript">

function obtenerInfo(idBuscar){
	var text;
	$.ajax({
			async: false,
            type: "POST",
            url: 'infoHistorial.php',
            data: {
				"IdContratacion":idBuscar
			},
            success: function(response)
            {
				text=response;
           }
       });
	   return text;
}
</script>


<?php
mysqli_free_result($resultadoemp);
mysqli_close($conexion);
?>
