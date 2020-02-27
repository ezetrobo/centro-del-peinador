<?php

namespace App\Clases\Carrito;

class eCommerceTipoEnvio{
	public $idEcommerceTipo;
	public $idCostoEnvio;	
	public $nombre;
	public $listaCostoEnvioZona;

	public function __construct(){
		$this->idECommerceTipo=0;
		$this->idCostoEnvio=0;
		$this->nombre='';
		$this->listaCostoEnvioZona=array();
	}	
}
?>