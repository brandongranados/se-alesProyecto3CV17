<?php
    include "../conexion.php";
    session_start();
    $tipoUser = $_SESSION['tipoUser'];
    $usuario = $_SESSION['correo'];
    $contrasenia = $_SESSION['pass'];
    $Puntos = 0;
    //Obtenemos datos de la BD
	$consultaempl ="SELECT*FROM usuarios where email = '$usuario' and passwordUser = '$contrasenia' ";
	$resultadoemp = mysqli_query($conexion, $consultaempl);
	$filasempl = mysqli_num_rows($resultadoemp);
    if($filasempl){   
		$fila=mysqli_fetch_array($resultadoemp);
		$idAdmin = $fila['idUsuario'];
    }
    
    $resultado = mysqli_query($conexion, "SELECT * FROM usuarios usu JOIN usuariodependiente uD ON uD.idUsuarioDep = usu.idUsuario WHERE uD.idUsuario ='$idAdmin'");
    
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
</head>
<body>
<header class="encabe">
        <div class="Logo">
            <a class="navText" href="./homeUser.php"><img src="./static/images/Logo.png" class="logito" alt="Logo"></a>    
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
        
        <br><br>
                <a href="../CRUD-Usuarios/gestionUsuario.php" class="category_item" category="ordenadores">Agregar Usuario</a>
              
            </div>
            <div class="products-list">
                <?php while ($row = mysqli_fetch_array($resultado)) {?>
                    <div class='product-item'>
                    <img class="pro" src="<?php echo $row['foto']; ?>">    
                        <div class='item-text'>
                        <label class="proLab">Nombre:</label>
                            <label class="proLab"><?php echo $row['nombreUsuario']; ?></label>
                            <label class="proLab">Puntos del Usuario:</label>
                            <label class="proLab"><?php 
                                    $dependiente = $row['idUsuarioDep'];
                                    $consultaemp3 ="SELECT*FROM tarearealizada where idUsuario = '$dependiente' and estatus ='finalizado'";
                                    $resultadoemp3 = mysqli_query($conexion, $consultaemp3);
                                    $filasemp3 = mysqli_num_rows($resultadoemp3);    
                                    $consulta ="SELECT*FROM recompensausuario where idUsuario = '$dependiente' and disponible ='no'";
                                    $resultado1 = mysqli_query($conexion, $consulta);
                                    $filas = mysqli_num_rows($resultado1);    
                                if($filas > 0){ 
                                    while($fila = mysqli_fetch_array($resultado1)) {
                                            $Puntos -= $fila['puntosCuesta'] ;
                                    }
                                }
                                if($filasemp3 > 0){ 
                                    while($fila3 = mysqli_fetch_array($resultadoemp3)) {
                                            $Puntos += $fila3['avancePuntos'] ;
                                    }
                                }else{
                                    $Puntos = "0";
                                }
                                echo $Puntos; ?></label>
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
<?php
mysqli_close($conexion);
?>
