<?php
    include 'validarR.php';
?>
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
</head>
<body>
<div class="card mt-5 mb-5" style="max-width:500px;margin:auto;">
        <div class="card-body text-center" >
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="max-width:480px;margin:auto;">
                <h1 class="h3 mb-3">Registrarse</h1>
                <div class="mb-3">
                    <label for="Nombre" class="inicia">Nombre(s)</label>
                    <input type="text"class="inicia form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre ">
                    <span style="color: red; font-weight: bold;"><?php echo $username_error; ?></span>
                </div>
                <div class="mb-3">
                    <label for="Email" class="inicia">Correo electr&oacute;nico</label>
                    <input type="text"class="inicia form-control" name="email" id="email" placeholder="Ingresa tu correo electr&oacute;nico">
                    <span style="color: red; font-weight: bold;"><?php echo $email_error; ?></span>
                </div>
               
                <div class="mb-3">
                    <label for="pass" class="inicia">Contrase&ntilde;a</label>
                    <input  type="password" class="inicia form-control" name="pass" id="pass" placeholder="Ingresa tu contrase&ntilde;a">
                    <span style="color: red; font-weight: bold;"><?php echo $contra_error; ?></span>
                </div>
                <div class="mb-3">
                    <label for="pass" class="inicia">Confirma contrase&ntilde;a</label>
                    <input  type="password" class="inicia form-control" name="pass1" id="pass1" placeholder="Vuelve a escribir tu contrase&ntilde;a">
                    <span style="color: red; font-weight: bold;"><?php echo $contra1_error; ?></span>
                </div>
                <div class="seccion-enviar1 d-flex align-items-center justify-content-center mt-3 mb-3">
                    <button type="submit" class="btnenviar btn btn-primary" id="mensajeRegistro">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        
    </footer>
</body>
</html>

