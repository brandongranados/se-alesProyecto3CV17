function agregaform(datas){

    d=datas.split('||');
    
    $('#ids').val(d[0]);
    $('#cant1').val(d[2]);
    $('#tpaga1').val(d[3])
    $('#fecha1').val(d[4]);
    }
    
    function preguntarSiNo(datas){
    d=datas.split('||');
    $('#ids1').val(d[0]);
    }
    
    function eliminarDatos(id){
    
    cadena="id=" + id;
    
        $.ajax({
            type:"POST",
            url:"eliminarVenta.php",
            data:cadena,
            success:function(r){
                if(r==1){
                    $('#tabla').load('./tablaVentas.php');
                    alertify.success("Eliminado con exito!");
                }else{
                    alertify.error("Fallo el servidor :(");
                }
            }
        });
    }