<?php

require_once "entidades/clases/helado.php";

$sabor = isset($_GET['sabor']) ? $_GET['sabor'] : NULL;
$precio = isset($_GET['precio']) ? $_GET['precio'] : NULL;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$cantidad  = isset($_GET['cantidad']) ? $_GET['cantidad'] : NULL;

$helado = new helado($sabor,$precio,$tipo,$cantidad);

if($tipo == "crema" || $tipo == "agua")
{
    if(helado::Guardar($helado))
    {
        echo "helado guardado";
    }
    
}else
{
    echo "el helado tiene que ser de tipo crema o agua";
}

?>