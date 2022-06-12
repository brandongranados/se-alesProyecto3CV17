<?php

    //ESTE ARCHIVO SIRVE PARA FILTRAR LAS RECOMPENSAS POR USUARIO SEGUN LA SELECCION DESDE HTML,
    //ENVIA EL RESULTADO COMO JSON AL CLIENTE

    require_once("conexion.php");

    session_start();

    //EL TIPO DE FILTRO ES PARA SABER SI ES POR FECHA PUNTOS ETC
    $tipoFiltro = htmlspecialchars($_POST["tipoFiltro"]);
    //LA FORMA DE FILTRO ES PARA SABER SI ES DE FORMA ASCENDENTE O DESCENDENTE
    $formaFiltro = htmlspecialchars($_POST["formaFiltro"]);
    $correoUsuario = htmlspecialchars($_SESSION['correo']);

    $consulta = "";
    if($tipoFiltro == "fechaHora")
        $consulta .= "select r.nombreRecompensa, r.puntosCuesta, r.fechaHora, r.foto, u.email, u.nombreUsuario, u.foto from (recompensa r inner join recompensaUsuario rU on r.idRecompensa = rU.idRecompensa) inner join usuarios u on u.idUsuario = rU.idUsuario where u.email= '".$correoUsuario."' order by date(r.".$tipoFiltro.") ".$formaFiltro.", time(r.".$tipoFiltro .") ".$formaFiltro;  
    else
        $consulta .= "select r.nombreRecompensa, r.puntosCuesta, r.fechaHora, r.foto, u.email, u.nombreUsuario, u.foto from (recompensa r inner join recompensaUsuario rU on r.idRecompensa = rU.idRecompensa) inner join usuarios u on u.idUsuario = rU.idUsuario where u.email= '".$correoUsuario."' order by r.".$tipoFiltro." ".$formaFiltro;

    $consultaSQL = mysqli_query($conexion, $consulta);
    if($consultaSQL)
    {
        $resultadoSQL = mysqli_fetch_array($consultaSQL);
        echo json_encode($resultadoSQL);
    }
    else
        echo '{"error": "ERROR AL RECIBIR LOS DATOS"}';
    mysqli_close($conexion);
    header('Location: ESCRIBIR URL DONDE ESTARAN LOS FILTROS');

?>