<?php

class ControladorCotizaciones{

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS
	=============================================*/

	static public function ctrMostrarCotizaciones($orden){

		$tabla = "cotizaciones_demo";

		$respuesta = ModeloProductos::mdlMostrarTotalCotizaciones($tabla, $orden);

		return $respuesta;

	}

	static public function ctrMostrarDetalles($id){

		$tabla = "detalle_cotizacion_demo";
		$value = "numero_cotizacion";
		$respuesta = ModeloProductos::mdlMostrarDetallesCotizaciones($tabla, $id, $value);

		return $respuesta;

	}

}