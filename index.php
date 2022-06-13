<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" type="image/ico" href="./static/images/icono.ico">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <!--JavaScripts-->
    <script src="./static/alert/package/dist/sweetalert2.all.min.js"></script>

    <div class="card mt-5" style="max-width:500px;margin:auto;">
        <div class="card-body text-center" >
            <h1 class="h3">Inicio de Sesi&oacute;n</h1>

            <div class="datosf">
                    <div class="mb-3">
                        <form action="inicioS.php" method="post">
                            <button value="Admin" type="submit" class="btnenviar btn btn-primary" id="ids" name="ids"><a class="btn btn-primary">Usuario Admin</a></button>
                        </form>
                        
                    </div>
                    <div class="mb-3">
                    <form action="inicioS.php" method="post">
                            <button value="Usuario" type="submit" class="btnenviar btn btn-primary" id="ids" name="ids"><a class="btn btn-primary">Usuario</a></button>
                        </form>
                        
                    </div>
            </div>
        </div>
    </div>

    <div>
    </div>
</body>

</html>