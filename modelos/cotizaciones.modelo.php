<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR TODAS LAS COTIZACIONES
	=============================================*/	

	static public function mdlMostrarTotalCotizaciones($tabla, $orden){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR DETALLE DE COTIZACIONES
	=============================================*/	
	static public function mdlMostrarDetallesCotizaciones($tabla, $id , $value){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $value = :$id");

		$stmt -> bindParam(":".$value, $id, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

	}


}