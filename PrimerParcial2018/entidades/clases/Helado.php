<?php

class helado {
    private $_sabor;
    private $_precio;
    private $_tipo;
    private $_cantidad;

    public function GetSabor() {
        return $this->_sabor;
    }
    public function GetPrecio() {
        return $this->_precio;
    }
    public function __construct($sabor , $precio , $tipo, $cantidad) {
        $this->_sabor = $sabor;
        $this->_precio = $precio;
        $this->_tipo = $tipo;
        $this->_cantidad = $cantidad;
    }
    
    
    public function ToString() {
        return $this->_sabor ." - ". $this->_precio ." - ". $this->_tipo." - ". $this->_cantidad."\r\n";
    }
    
    //--------------------------------------------------------------------------------//    
    //--------------------------------------------------------------------------------//
    //--METODOS DE CLASE  
    public static function Guardar($obj)
    {
        $resultado = FALSE;
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/helados.txt", "a");
        //ESCRIBO EN EL ARCHIVO
        $cant = fwrite($ar, $obj->ToString());
        if($cant > 0)
        {
            $resultado = TRUE;
        }
        //CIERRO EL ARCHIVO
        fclose($ar);
        return $resultado;
    }

    public static function TraerTodosLosHelados()
    {
        $ListaDeHeladosLeidos = array();
       //leo todos los comentarios del archivo
       $archivo=fopen("archivos/helados.txt", "r");
       while(!feof($archivo))
       {
           $archAux = fgets($archivo);
           $helados = explode(" - ", $archAux);
           //http://www.w3schools.com/php/func_string_explode.asp
           $helados[0] = trim($helados[0]);
           if($helados[0] != ""){
               $ListaDeHeladosLeidos[] = new helado($helados[0], $helados[1],$helados[2], trim($helados[3]));
           }
       }
       fclose($archivo);
       return $ListaDeHeladosLeidos;
    }

    public static function ConsultarHelado($sabor,$tipo)
    {
        $ListaDeHeladosLeidos = Helado::TraerTodosLosHelados();
        $ExisteHelado['Existe'] = FALSE;
        $ExisteSabor = FALSE;
        $ExisteTipo = FALSE;
        //var_dump($ListaDeHeladosLeidos);

        // verifico si el email existe en el archivo usuarios.txt.
        for ($i=0; $i < count($ListaDeHeladosLeidos); $i++) {
          if ($ListaDeHeladosLeidos[$i]->_sabor == $sabor && $ListaDeHeladosLeidos[$i] == $tipo) {
            $ExisteHelado['Existe'] = TRUE;
            break;
          }
        }

        for ($j=0; $j < count($ListaDeHeladosLeidos); $j++) {
            if ($ListaDeHeladosLeidos[$j]->_sabor == $sabor) {
              $ExisteSabor = TRUE;
              break;
            }
          }

        for ($k=0; $k < count($ListaDeHeladosLeidos); $k++) {
            if ($ListaDeHeladosLeidos[$k]->_tipo == $tipo) {
                $ExisteTipo = TRUE;
                break;
            }
        }

        

        if ($ExisteHelado['Existe']) {
          
          echo "Si Hay <br>";
          
        }else {
          
          if (!$ExisteSabor) {
              echo "No hay Sabor";
          }

          if(!$ExisteTipo)
          {
              echo "No hay Tipo";
          }

          if($ExisteSabor && $ExisteTipo)
          {
              echo "Si hay";
          }
        }
        return $ExisteHelado;
    }

    public function HayStock($cantidad)
    {
        return $cantidad < $this->_cantidad;
    }

    public function RestarCantidad($cantidad)
    {
        return $this->_cantidad - $cantidad;
    }

    public static function TraerHelado($sabor,$tipo)
    {
        $ListaDeHeladosLeidos = helado::TraerTodosLosHelados();
    
        foreach ($ListaDeHeladosLeidos as $helado) {
            if($helado->_sabor == $sabor && $helado->_tipo == $tipo)
            {
                return $helado;
                break;
            }
        }

        return NULL;
    }

    public static function GuardarArchivoVentas($obj,$cantidad,$email)
    {
        $resultado = FALSE;
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/ventas.txt", "a");

        $ret = $obj->_cantidad - $cantidad;
        echo $cantidad;
        echo $ret;
        $obj->_cantidad = $ret;
        //ESCRIBO EN EL ARCHIVO
        $cant = fwrite($ar,$email. " - " . $obj->ToString());
        if($cant > 0)
        {
            $resultado = TRUE;
        }
        //CIERRO EL ARCHIVO
        fclose($ar);
        return $resultado;
    }

}



?>