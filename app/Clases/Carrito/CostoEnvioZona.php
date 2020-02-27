<?php 

namespace App\Clases\Carrito;

class CostoEnvioZona{
	public $idCostoEnvioZona;
	public $nombre;
	public $costo;
	public $hasta;
	public $excedente;
	public $idEcommerceTipo;

	function __construct($xIdCostoEnvioZona=null, $xNombre=null, $xCosto=null, $xHasta=null, $xExcedente=null, $idEcommerceTipo=null){
		$this->idCostoEnvioZona = $xIdCostoEnvioZona;
		$this->nombre = $xNombre;
		$this->costo = $xCosto;
		$this->hasta = $xHasta;
		$this->excedente = $xExcedente;
		$this->idEcommerceTipo = $idEcommerceTipo;

	}

	function convertZonadepApitoCostoEnvioZona($xListaCostoEnvioZonaDepApi=NULL){
		try{
			if ($xListaCostoEnvioZonaDepApi){
				$this->idCostoEnvioZona = $xListaCostoEnvioZonaDepApi['idCostoEnvioZona'];
				$this->nombre = $xListaCostoEnvioZonaDepApi['zona'];
				$this->costo = $xListaCostoEnvioZonaDepApi['valor'];
				$this->hasta = $xListaCostoEnvioZonaDepApi['hastaKG'];
				$this->excedente = $xListaCostoEnvioZonaDepApi['excedente'];
			}
		}
		catch(Excepcion $e){
			Log::error($e);
		}
	}
}
?>