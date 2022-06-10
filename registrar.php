<?php
    include 'validarR.php';
?>
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registrar</title>
    
</head>
<body>
    <div class="container my-5">
        <div class="informacion">
            <div class="seccion-info-contacto d-flex my-5 align-items-center flex-column">
                
            </div>
            <div class="alto seccion-formulario bg-primary container w-50 my-5  text-formulario justify-content-center border">
                <div class="data">
                    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="m-5" method="post">
                        <label for="Nombre" class="inicia">Nombre</label>
                        <br/>
                        <input type="text"class="inicia" name="nombre" id="nombre" placeholder="Ingresa tu nombre completo">
                        <span style="color: red; font-weight: bold;"><?php echo $username_error; ?></span>
                        <br>
                        <label for="email" class="inicia">Email</label>
                        <br/>
                        <input type="email" class="inicia" name="email" id="email" placeholder="Ingresa tu correo electr&oacute;nico" >
                        <span style="color: red; font-weight: bold;"><?php echo $email_error; ?></span>
                        <br>
                        <label for="pass" class="inicia">Contrase&ntilde;a</label>
                        <br/>
                        <input  type="password" class="inicia" name="pass" id="pass" placeholder="Ingresa tu contrase&ntilde;a" >
                        <span style="color: red; font-weight: bold;"><?php echo $contra_error; ?></span>
                        <br>
                        <label for="pass" class="inicia">Confirma contrase&ntilde;a</label>
                        <br/>
                        <input  type="password" class="inicia" name="pass1" id="pass1" placeholder="Vuelve a escribir tu contrase&ntilde;a" >
                        <span style="color: red; font-weight: bold;"><?php echo $contra1_error; ?></span>
                        <br>
                        <div class="seccion-enviar1 d-flex align-items-center justify-content-center">
                            <button class="btnenviar">Registrar</button>
                        </div>
                        
                    </form>
                </div>
                
             </div>   
        </div>
    </div>
    <footer>
        <div class="bajo bg-primary py-3 d-flex align-items-center contenedor-footer w-100">
            <span class="text-secondary w-100 text-center">Nombre de la aplicacion &copy; 2022</span>
        </div>
    </footer>
    
</body>
</html>

