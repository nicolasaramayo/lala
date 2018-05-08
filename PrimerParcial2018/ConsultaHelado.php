<?php

require_once "entidades/clases/helado.php";

$sabor = isset($_POST['sabor']) ? $_POST['sabor'] : NULL;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;


helado::ConsultarHelado($sabor,$tipo);



?>