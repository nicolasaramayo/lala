<?php

require_once "entidades/clases/helado.php";

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$sabor = isset($_POST['sabor']) ? $_POST['sabor'] : NULL;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$cantidad  = isset($_POST['cantidad']) ? $_POST['cantidad'] : NULL;


// si el helado existe en helados.txt y hay stock
// guardar en el archivo ventas.txt todos los datos
// descontar la cantidad vendida.

$respuesta['Existe'] = Helado::ConsultarHelado($sabor,$tipo);
$helado = Helado::TraerHelado($sabor,$tipo);
//var_dump($helado);
// verificar si el helado existe
if($respuesta['Existe'])
{
    if ($helado->HayStock($cantidad)) 
    {
        // guardar en ventas.txt todos los datos.
        // descontar la cantidad vendida. 
        Helado::GuardarArchivoVentas($helado, $cantidad,$email);

    }else
    {
        echo "no hay stock";
    }
    
}else{
    echo "no se encontro";
}



?>