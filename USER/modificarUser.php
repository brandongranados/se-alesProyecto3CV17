<?php
    session_start();
    $usuario = $_SESSION['correo'];
    require "../conexion.php";
    $resultadocont2 = mysqli_query($conexion, "SELECT * FROM usuarios where email='$usuario'");
    $row = mysqli_fetch_array($resultadocont2);
?>

<html lang="en">
  <head>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" type="image/ico" href="./static/images/icono.ico">
	<link href="../static/css/navegacion.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<title>Modificar Perfil</title>

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
    <br><br>
    <script src="./static/alert/package/dist/sweetalert2.all.min.js"></script>
    <div class="card mt-5" style="max-width:500px;margin:auto;">
        <div class="card-body text-center" >
                    <form  action="aplicarCambios.php" style="max-width:480px;margin:auto;" method="post" enctype="multipart/form-data">
                        <label for="Nombre" class="inicia">Nombre</label>
                        <br>
                        <input type="text"class="inicia form-control" value="<?php echo $row['nombreUsuario']?>" name="nombre" id="nombre" placeholder="Ingresa tu nombre" required/>
                        <br>

                        <label for="Email" class="inicia">Correo electr&oacute;nico</label>
                        <br>
                        <input type="text"class="inicia form-control" value="<?php echo $row['email']?>" name="email" id="email" placeholder="Ingresa tu correo electr&oacute;nico" disable/>
                        <br>

                        <label class="inicia" for="imagen" >Imagen de perfil</label>
                        <br>
                        <input class="inicia form-control" type="file" id="imagen" name="imagen" size="20" >
                        <br>
                        <br>
                        <div class="seccion-enviar1 d-flex align-items-center justify-content-center">
                            <button type="submit" class="btnenviar">Realizar cambios</button>
                        </div>
                        
                    </form>
        </div>
                
                
    </div>   
    <br><br>
 
    <footer>
        <div class="bajo bg-primary py-3 d-flex align-items-center contenedor-footer w-100">
            <span class="w-100 text-center">iServiGo &copy; 2022</span>
        </div>
    </footer>
    
</body>
</html>
<?php
mysqli_close($conexion);

?>