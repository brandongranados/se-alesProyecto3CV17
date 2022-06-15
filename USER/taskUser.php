<?php
    include "../conexion.php";
    session_start();
    $tipoUser = $_SESSION['tipoUser'];
    $usuarioDep = $_SESSION['correo'];
    $usuario = $_SESSION['correo'];
    $contrasenia = $_SESSION['pass']    ;
    //Obtenemos datos de la BD
	$consultaempl ="SELECT*FROM usuarios where email = '$usuario' and passwordUser = '$contrasenia' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasempl = mysqli_num_rows($resultadoemp);
    if($filasempl){   
		$fila=mysqli_fetch_array($resultadoemp);
		$idAdmin = $fila['idUsuario'];
    }
    if(isset($_POST['buscar'])){
        $servicio = $_POST['servicio'];
        if(empty($_POST['servicio'])){
            $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin'");
        }elseif($servicio == "MR"){
            $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin' order by date(fechaHora) desc, time(fechaHora) desc");
        }elseif($servicio == "MA"){
            $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin' order by date(fechaHora) asc, time(fechaHora) asc");
        }elseif($servicio == "MV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin' order by valorPuntos desc");
        }elseif($servicio == "MEV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin' order by valorPuntos asc");
        }

    }else{
        $resultado = mysqli_query($conexion, "SELECT * FROM tarea t JOIN usuariodependiente uD ON uD.idUsuario = t.idUsuario WHERE uD.idUsuarioDep = '$idAdmin'");
    }
     
    mysqli_close($conexion);
?>
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <link href="../static/css/style.css" rel="stylesheet" type="text/css">
    <link href="../static/css/agregar.css" rel="stylesheet" type="text/css">
    <link href="../static/css/navegacion.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" 
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<header class="encabe">
        <div class="Logo">
            <a class="navText" href="<?php if($tipoUser == "Admin"){
                    echo "./homeUser.php";}else{echo "./taskUser.php";}?>"><img src="./static/images/Logo.png" class="logito" alt="Logo"></a>    
        </div>
        <nav>
        <li><a class="navText" href="./perfilUser.php"><span > Perfil </span></a></li>    
            <li><a class="navText" href="<?php if($tipoUser == "Usuario"){echo "./taskUser.php";}else{echo "../CRUD-Task/gestionTasks.php";}?>"><span > Tareas </span></a></li>    
            <li><a class="navText" href="<?php if($tipoUser == "Usuario"){echo "./rewardUser.php";}else{echo "../CRUD-Reward/gestionRewards.php";}?>"><span > Recompensas </span></a></li>    <li><a class="navText" href="../cerrarSesion.php"><span > Cerrar sesi&oacute;n </span></a></li>
        </nav>
    </header>
    <br><br><br><br>
    
    <div class="wrap">
        <br><br>
        <div class="store-wrapper">
        <div class="category_list">
        <form method="post">
            <select name="servicio">
                <option value=""></option>
                <option value="MR">M&aacute;s recientes</option>
                <option value="MA">M&aacute;s antiguas</option>
                <option value="MV">Mayor valor</option>
                <option value="MEV">Menor valor</option>
            </select>
            <button name="buscar" type="submit">Buscar</button>
        </form>
        <br><br>
        <?php
                if($tipoUser == "Admin"){?>
                    <a href="../CRUD-Task/gestionTasks.php" class="category_item" category="ordenadores">Agregar Tarea</a>
        <?php
                }
        ?>
            </div>
            <div class="products-list">
                <?php while ($row = mysqli_fetch_array($resultado)) {?>
                    <div class='product-item'>
                    <h4 class='text-center ' style="color: #686767; bold;"><?php echo $row['nombreTarea']; ?></h3>
                        <div class='item-text'>
                        <label class="proLab">Nombre:</label>
                            <label class="proLab"><?php echo $row['nombreTarea']; ?></label>
                            <label class="proLab">Valor:</label>
                            <label class="proLab"><?php echo $row['valorPuntos']; ?> Puntos</label>
                            <label class="proLab">Fecha y Hora:</label>
                            <label class="proLab"><?php echo $row['fechaHora']; ?></label>
                            <input value='Empezar tarea' onClick='contratar(<?php echo $idAdmin;?>,<?php echo $row['idTarea'];?>,<?php echo $row['valorPuntos'];?>);' type='button' class='btnenviar btn btn-primary' id='ids' name='ids'>
                        </div>
                    </div>
                <?php }
                    
                ?>
            </div>
        </div>
    </div>
<br><br>
    <footer>
        <div class="bajo bg-primary py-3 d-flex align-items-center contenedor-footer w-100">
        </div>
    </footer>
    
</body>
</html>

<script type="text/javascript">
	function contratar(idUsuario,idTarea,valorPuntos) {
		const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: true
		})

		swalWithBootstrapButtons.fire({
		title: '¿Aceptar tarea?',
		icon: 'question',
		showDenyButton: true,
		confirmButtonText: 'Aceptar',
		denyButtonText: 'Cancelar',
		confirmButtonColor: '#7DEB4E',
		denyButtonColor: '#9b9b9b',
		reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {

				swalWithBootstrapButtons.fire(
					'Se ha generado una petición',
					'Por favor contacte al Supervisor de la tarea',
					'success'
					)
			
			$.ajax({
            type: "POST",
            url: 'generarTarea.php',
            data: {
				"idUsuario":idUsuario,
				"idTarea":idTarea,
                "valorPuntos":valorPuntos
			},
            success: function(response)
            {
                if (response == "1")
                {
                }
                else
                {
					
                }
           }
       });
	   header("location:taskUser.php");
		} 
		})
	
	}
</script>