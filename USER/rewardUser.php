<?php
    include "../conexion.php";
    session_start();
    $tipoUser = $_SESSION['tipoUser'];
    $usuario = $_SESSION['correo'];
    $contrasenia = $_SESSION['pass']    ;
    $puntosVale;
    $Puntos = 0;
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
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' ");
        }elseif($servicio == "MR"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' order by date(fechaHora) desc, time(fechaHora) desc");
        }elseif($servicio == "MA"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' order by date(fechaHora) asc, time(fechaHora) asc");
        }elseif($servicio == "MV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' order by ru.puntosCuesta desc");
        }elseif($servicio == "MEV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' order by ru.puntosCuesta asc");
        }

    }else{
        $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' and ru.disponible = 'si' ");
    }
    if($tipoUser == "Usuario"){
        $consultaemp3 ="SELECT*FROM tarearealizada where idUsuario = '$idAdmin' and estatus ='finalizado'";
        $resultadoemp3 = mysqli_query($conexion, $consultaemp3);
        $filasemp3 = mysqli_num_rows($resultadoemp3);    
		$consulta ="SELECT*FROM recompensausuario where idUsuario = '$idAdmin' and disponible ='no'";
        $resultado1 = mysqli_query($conexion, $consulta);
        $filas = mysqli_num_rows($resultado1);    
	if($filas > 0){ 
		while($fila = mysqli_fetch_array($resultado1)) {
			if($tipoUser == "Usuario"){
				$Puntos -= $fila['puntosCuesta'] ;
			}
		}
	}
	if($filasemp3 > 0){ 
		while($fila3 = mysqli_fetch_array($resultadoemp3)) {
			if($tipoUser == "Usuario"){
				$Puntos += $fila3['avancePuntos'] ;
			}
		}
	}else{
		$Puntos = "0";
	}
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
            <li><a class="navText" href="<?php if($tipoUser == "Usuario"){echo "./rewardUser.php";}else{echo "../CRUD-Reward/gestionRewards.php";}?>"><span > Recompensas </span></a></li>    
            <li><a class="navText" href="../cerrarSesion.php"><span > Cerrar sesi&oacute;n </span></a></li>
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
                <option value="MV">Mayor precio</option>
                <option value="MEV">Menor precio</option>
            </select>
            <button name="buscar" type="submit">Buscar</button>
        </form>
        <br><br>
            <?php
                if($tipoUser == "Admin"){?>
                   <a href="../CRUD-Reward/gestionRewards.php" class="category_item" category="ordenadores">Agregar Recompensa</a>
            <?php
                }
            ?>
            </div>
            <div class="products-list">
                <?php while ($row = mysqli_fetch_array($resultado)) {?>
                    <div class='product-item'>
                    <h4 class='text-center ' style="color: #686767; bold;"><?php echo $row['nombreRecompensa']; ?></h3>
                    <img class="pro" src="<?php echo $row['foto']; ?>">    
                    <div class='item-text'>
                            <label class="proLab">Precio:</label>
                            <label class="proLab"><?php echo $row['puntosCuesta']; ?> Puntos</label>
                            <label class="proLab">Fecha y Hora:</label>
                            <label class="proLab"><?php echo $row['fechaHora']; ?></label>
                            <input value='Contratar servicio' onClick='contratar(<?php echo $idAdmin;?>,<?php echo $row['idRecompensa'];?>,<?php $puntosVale = $row['puntosCuesta']; echo $row['puntosCuesta'];?>);' type='button' class='btnenviar btn btn-primary' id='ids' name='ids'>
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
	function contratar(idUsuario,idRecompensa,puntosCuesta) {
        <?php
            if($Puntos >= $puntosVale){
                ?>
                const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		},
		buttonsStyling: true
		})

		swalWithBootstrapButtons.fire({
		title: '¿Canjear Recompensa?',
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
					'Se ha Canjeado la recompensa',
					'Por favor contacte con el supervisor para obtener su recompensa',
					'success'
					)
			
			$.ajax({
            type: "POST",
            url: 'generarRecompensa.php',
            data: {
				"idUsuario":idUsuario,
				"idRecompensa":idRecompensa,
                "puntosCuesta":puntosCuesta
			},
            success: function(response)
            {
                
           }
       });
	   
		} 
		})
<?php
    }else{ ?>
        Swal.fire(
            'No tienes suficientes puntos'
            )
    <?php } 
        ?>
		
	
	}
</script>