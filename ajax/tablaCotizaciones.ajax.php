<?php

require_once "../controladores/cotizaciones.controlador.php";
require_once "../modelos/cotizaciones.modelo.php";


class TablaProductos{

  /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  =============================================*/ 

  public function mostrarTablaProductos(){	

  	$item = null;
  	$valor = null;
    $numero_cotizacion = 1;

  	$productos = ControladorCotizaciones::ctrMostrarCotizaciones($numero_cotizacion);

    $datosJson = '

      { 
        "data":[';

    for($i = 0; $i < count($productos); $i++){


      /*=============================================
      TRAER DETALLE DE COTIZACION
      =============================================*/

      /*$id[] = $productos[$i]["numero_cotizacion"];
      $id = $id;
      

      $traerDetalle = ControladorCotizaciones::ctrMostrarDetalles($id);*/


			$datosJson .='[
					
					"'.($i+1).'",
					"'.(($productos[$i]["numero_cotizacion"])+100).'",
          "'.$productos[$i]["fecha_cotizacion"].'",
          "'.$productos[$i]["empresa"].'",
          "'.$productos[$i]["email"].'",
          "'.$productos[$i]["tel1"].'",
          "'.$productos[$i]["tel2"].'",
          "'.$productos[$i]["condiciones"].'",
          "'.$productos[$i]["validez"].'",
          "'.$productos[$i]["entrega"].'",
          "'.$productos[$i]["observaciones"].'"
			],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']

		}';
    //print_r($traerDetalle);
		echo $datosJson;
    //echo $productos;
  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();