<?php
    include "../conexion.php";
    session_start();
    $tipoUser = $_SESSION['tipoUser'];
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
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' ");
        }elseif($servicio == "MR"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' order by date(fechaHora) desc, time(fechaHora) desc");
        }elseif($servicio == "MA"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' order by date(fechaHora) asc, time(fechaHora) asc");
        }elseif($servicio == "MV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' order by puntosCuesta desc");
        }elseif($servicio == "MEV"){
            $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' order by puntosCuesta asc");
        }

    }else{
        $resultado = mysqli_query($conexion, "SELECT * FROM recompensa re JOIN recompensausuario ru ON re.idRecompensa = ru.idRecompensa WHERE ru.idUsuario = '$idAdmin' ");
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

