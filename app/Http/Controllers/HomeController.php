<?php
namespace App\Http\Controllers;

use App\Clases\Contenido\Contenido;
use App\Clases\Producto\Producto;
use App\Clases\Producto\SCatalogo;

/**
 *  [index description]  -> Muestra la aplicacion.
 *  [prueba description]  -> Funcion para realizar pruebas unicamente.
 */

class HomeController extends Controller {
	/**
	 * Muestra la aplicacion dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$parametros = array();
		$oCatalogo = null;

		$xIdTipoContenido = config('parametros.xIdTipoHomeGeneral');
		$xOffSet = 0;
		$xLimit = 0;
		$xOrderBy = 'orden';
		$xOrderType = 'ASC';
		$oContenidoHome = new Contenido();
		$oContenidoHome = $oContenidoHome->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

		if(!empty($oContenidoHome)):
			foreach ($oContenidoHome as $key => $xContenido):
				if(!empty($xContenido->subtitulo)):
					$xIdTipoContenido = (int)$xContenido->subtitulo;
					$xOffSet = 0;
					$xLimit = 0;
					$xOrderBy = 'orden';
					$xOrderType = 'ASC';
					$oContenido = new Contenido();
					$oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

					/* Si es un carrusel, buscamos todos los productos que tengan ese tag asociado */
					if( !empty($oContenido) && ($xContenido->subtitulo == config('parametros.xIdTipoCarrusel1') || $xContenido->subtitulo == config('parametros.xIdTipoCarrusel2'))):

						foreach ($oContenido as $key => $value):
							if(!empty($value->tags)):
								$oContenido[$key]->catalogo = $this->getProductoxTag($value->tags);
							endif;
							$parametros["_".$xContenido->subtitulo] = $oContenido;	
						endforeach;
					else:
						$parametros["_".$xContenido->subtitulo] = $oContenido;
					endif;
				endif;
			endforeach;
		endif;

		$xIdTipoContenido = config('parametros.xIdTipoHomeSlide');
		$xOffSet = 0;
		$xLimit = 0;
		$xOrderBy = 'orden';
		$xOrderType = 'ASC';
		$oContenido1 = new Contenido();
		$oContenido1 = $oContenido1->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

		return view('home.index', compact('parametros','oContenido1'));
	}

	public function getProductoxTag($xTags){
		$oCatalogo = new SCatalogo();
		$oCatalogo->getProductosConFiltroRango(Config('parametros.xIdCatalogo'), 0, '', 0, 12, '', '', '', 'orden', 'asc', 'etiquetas', $xTags);

		return $oCatalogo->productos;
	}
	public function error () {
		return view('home.error');
	}
}