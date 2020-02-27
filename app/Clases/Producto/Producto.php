<?php
namespace App\Clases\Producto;

use App\Clases\Common\Imagen;
use App\Clases\Common\Video;
use App\Clases\Producto\Categoria;
use App\Sawubona\Caracteres;
use App\Sawubona\Sawubona;
use Carbon\Carbon;

//  --------------------------------------------------------------  //
//  Model: Producto
//  Author: Enri Fonseca
//  Version: 2. 0
//  --------------------------------------------------------------  //
class Producto {
	public $idProducto;
	public $titulo;
	public $categoria; //  objeto Categoria
	public $codigoInterno;
	public $descripcion;
	public $descripcionCorta;
	public $destacado;
	public $descuento;
	public $detalle;
	public $direccion;
	public $distincion;
	public $email;
	public $especificacion;
	public $etiquetas;
	public $habilitado;
	public $localidad;
	public $orden;
	public $peso;
	public $ranking;
	public $sitio; //  objeto Sitio
	public $telefono;
	public $volumen;
	public $productos; //  vector de Producto
	public $precios; //  vector de float
	public $stocks; //  vector de int
	public $dropbox; //  vector de string
	public $archivos; //  vector de Archivo
	public $imagenes; //  vector de Imagen
	public $videos; //  vector de Video
	public $paginador; //   objeto Paginador
	public $puntos;
	public $etiquetasxProducto;
	public $combo;
	public $marca;
	public $comboDescuento;
	public $tipoComboDescuento;
	public $precioFinal;
	public $precioTachado;
	public $valorCocarda;
	public $envioBonificado;
	public $productoNuevo;
	public $critica;

	public function __construct() {
		try
		{
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			$this->archivos = NULL;
			$this->categoria = NULL;
			$this->codigoInterno = NULL;
			$this->descripcion = NULL;
			$this->destacado = NULL;
			$this->destacado = NULL;
			$this->detalle = NULL;
			$this->direccion = NULL;
			$this->distincion = NULL;
			$this->dropbox = NULL;
			$this->email = NULL;
			$this->especificacion = NULL;
			$this->etiquetas = NULL;
			$this->habilitado = 1;
			$this->idProducto = NULL;
			$this->imagenes = NULL;
			$this->localidad = NULL;
			$this->orden = NULL;
			$this->precios = NULL;
			$this->paginador = NULL;
			$this->peso = NULL;
			$this->productos = NULL;
			$this->ranking = NULL;
			$this->sitio = NULL;
			$this->stocks = NULL;
			$this->telefono = NULL;
			$this->titulo = NULL;
			$this->volumen = 0;
			$this->puntos = NULL;
			$this->etiquetasxProducto = NULL;
			$this->combo = NULL;
			$this->marca = NULL;
			$this->comboDescuento = null;
			$this->tipoComboDescuento = null;
			$this->precioFinal = null;
			$this->precioTachado = null;
			$this->valorCocarda = null;
			$this->envioBonificado = null;
			$this->productoNuevo = null;
			$this->critica = null;
			$this->videos = array();
			
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [printImagenes description] Imprime las imagenes del producto
	 * @param  integer $xLimit     [description]
	 * @param  string  $xClass     [description]
	 * @param  boolean $xContainer [description]
	 * @param  [type]  $xCondition [description]
	 * @param  boolean $xBool      [description]
	 * @param  string  $xDefault   [description]
	 * @return img                 [description]
	 */
	public function printImagenes($xLimit = 1, $xClass = '', $xContainer = false, $xCondition = null, $xBool = true, $xDefault = 'producto.png') {
		try
		{
			$xCount = ($this->imagenes) ? count($this->imagenes) : 0;
			$xLimit = (is_numeric($xLimit)) ? $xLimit : null;
			$xCondition = (is_string($xCondition)) ? $xCondition : '';
			$xBool = (is_bool($xBool)) ? $xBool : true;
			$xOffSet = 0;

			if (is_array($this->imagenes)
				AND $xCount > 0) {
				for ($i = 0; $i < $xCount; $i++) {
					if ($this->imagenes[$i]) {
						if ($xCondition != '') {
							if ($xBool AND $this->imagenes[$i]->nombre == $xCondition) {
								$this->imagenes[$i]->printImagen($xClass, $xContainer, $this->titulo);
								$xOffSet++;
							} elseif (!$xBool AND $this->imagenes[$i]->nombre != $xCondition) {
								$this->imagenes[$i]->printImagen($xClass, $xContainer, $this->titulo);
								$xOffSet++;
							}
						} else {
							$this->imagenes[$i]->printImagen(
								$xClass,
								$xContainer,
								$this->titulo
							);
							$xOffSet++;
						}
						if (is_numeric($xLimit) AND $xOffSet > $xLimit) {
							break;
						}
					}
				}
			} else {
				$oImagen = new Imagen(0, $this->titulo, '/images/default/' . $xDefault);
				$oImagen->printImagen($xClass, $xContainer, $this->titulo);
				unset($oImagen);
			}
			unset($xCount, $xLimit, $xCondition, $xBool, $xOffSet);
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}

	// //  Imprime los botones sociales
	// public function printShared($xUrl = '') {
	// 	try
	// 	{
	// 		if (is_string($xUrl)) {
	// 			//Shared::printShared($this->getLink($xUrl));
	// 		}

	// 	} catch (Exception $e) {
	// 		// Sawubona::writeLog($e);
	// 	}
	// }

	//  Devuelve el link de producto
	public function getLink($xUrl = null, $oCategoriaMadre = null, $oCategoriaAbuela = null) {
		try
		{
			if (!is_string($xUrl)) {
				return NULL;
			}
			$xLink = NULL;
			if (config('main.MULTIDIOMAS')) {
				$xLink = Sawubona::getTranslation($xUrl);
				if (isset($xLink->href)) {
					$xLink = '/' . Sawubona::getIdioma() . '/' . $xLink->href;
				}
			} else {
				$xLink = '/' . $xUrl;
			}

			$xLink .= url($xUrl. '/' . Caracteres::convertToUrl($this->titulo) . '/' . $this->idProducto);

			return $xLink;
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [getNext description] Devuelve el proximo producto de la base relacionado por categoria
	 * @param  integer $xIdCatalogo [description]
	 * @return [type]              	[description]
	 */
	public function getNext($xIdCatalogo = null) {
		try
		{
			if (is_numeric($xIdCatalogo) AND $this->categoria) {
				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xIdProducto=" . $this->idProducto
				. "&xIdCategoria=" . $this->categoria->idCategoria;

				$vProductos = $this->getProductos($xUrl);

				if (is_array($vProductos) AND !empty($vProductos)) {
					$oProducto = $vProductos[0];

					unset($xIdCatalogo, $xUrl, $vProductos);

					return $oProducto;
				}
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}

	//  Devuelve todos los productos de un catalogo
	/**
	 * [getAll description] Devuelve todos los productos de un catalogo
	 * @param  integer  $xIdCatalogo 	[description]
	 * @param  integer 	$xOffSet     	[description]
	 * @param  integer 	$xLimit      	[description]
	 * @param  string  	$xOrderBy    	[description]
	 * @param  string  	$xOrderType  	[description]
	 * @param  boolean 	$xGetChild   	[description]
	 * @return Producto             	[description]
	 */
	public function getAll($xIdCatalogo = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try
		{
			if (is_numeric($xIdCatalogo) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {
				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . "0"
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . ""
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;

				unset($xIdCatalogo, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);
				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [getDestacados description] Devuelve todos los productos Destacados de un catalogo
	 * @param  [type]  $xIdCatalogo [description]
	 * @param  integer $xOffSet     [description]
	 * @param  integer $xLimit      [description]
	 * @param  string  $xOrderBy    [description]
	 * @param  string  $xOrderType  [description]
	 * @param  boolean $xGetChild   [description]
	 * @return [type]               [description]
	 */
	public function getDestacados($xIdCatalogo = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try
		{
			if (is_numeric($xIdCatalogo) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . "0"
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . "TRUE"
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;

				unset($xIdCatalogo, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [getNoDestacados description] Devuelve todos los productos NO Destacados de un catalogo
	 * @param  integer  $xIdCatalogo 	[description]
	 * @param  integer 	$xOffSet     	[description]
	 * @param  integer 	$xLimit      	[description]
	 * @param  string  	$xOrderBy    	[description]
	 * @param  string  	$xOrderType  	[description]
	 * @param  boolean 	$xGetChild   	[description]
	 * @return [type]               	[description]
	 */
	public function getNoDestacados($xIdCatalogo = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try
		{
			if (is_numeric($xIdCatalogo) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {
				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . "0"
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . "FALSE"
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;
				unset($xIdCatalogo, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [getByCategoria description] Devuelve todos los productos de una categoria (incluye categorias hijas y nietas)
	 * @param  integer  $xIdCatalogo  	[description]
	 * @param  integer  $xIdCategoria 	[description]
	 * @param  integer 	$xOffSet      	[description]
	 * @param  integer 	$xLimit       	[description]
	 * @param  string  	$xOrderBy     	[description]
	 * @param  string  	$xOrderType   	[description]
	 * @param  boolean 	$xGetChild    	[description]
	 * @return array                	[description]
	 */
	public function getByCategoria($xIdCatalogo = null, $xIdCategoria = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {

		try {
			if (is_numeric($xIdCatalogo) AND is_numeric($xIdCategoria) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . $xIdCategoria
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . ""
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;

				//Sawubona::diePretty($xUrl);

				unset($xIdCatalogo, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [getDestacadosByCategoria description] Devuelve los productos destacados de una categoria (incluye categorias hijas y nietas)
	 * @param  integer  $xIdCatalogo  	[description]
	 * @param  Integer  $xIdCategoria 	[description]
	 * @param  integer 	$xOffSet      	[description]
	 * @param  integer 	$xLimit       	[description]
	 * @param  string  	$xOrderBy     	[description]
	 * @param  string  	$xOrderType   	[description]
	 * @param  boolean 	$xGetChild    	[description]
	 * @return array                	[description]
	 */
	public function getDestacadosByCategoria($xIdCatalogo = null, $xIdCategoria = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try {
			if (is_numeric($xIdCatalogo) AND is_numeric($xIdCategoria) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . $xIdCategoria
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . "TRUE"
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;

				unset($xIdCatalogo, $xIdCategoria, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [getNoDestacadosByCategoria description] Devuelve los productos NO destacados de una categoria (incluye categorias hijas y nietas)
	 * @param  integer  $xIdCatalogo  	[description]
	 * @param  integer  $xIdCategoria 	[description]
	 * @param  integer 	$xOffSet      	[description]
	 * @param  integer 	$xLimit       	[description]
	 * @param  string  	$xOrderBy     	[description]
	 * @param  string  	$xOrderType   	[description]
	 * @param  boolean 	$xGetChild    	[description]
	 * @return array                	[description]
	 */
	public function getNoDestacadosByCategoria($xIdCatalogo = null, $xIdCategoria = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try {
			if (is_numeric($xIdCatalogo) AND is_numeric($xIdCategoria) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo
					. "&xIdCategoria=" . $xIdCategoria
					. "&xOffSet=" . $xOffSet
					. "&xLimit=" . $xLimit
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrden=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValor=" . ""
					. "&xDestacado=" . "FALSE"
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;

				unset($xIdCatalogo, $xIdCategoria, $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [getRelacionados description] Devuelve productos relacionados a un producto
	 * @param  integer  $xIdCatalogo [description]
	 * @param  Producto $oProducto   [description]
	 * @param  integer 	$xOffSet     [description]
	 * @param  integer 	$xLimit      [description]
	 * @param  string  	$xOrderBy    [description]
	 * @param  string  	$xOrderType  [description]
	 * @param  boolean 	$xGetChild   [description]
	 * @return array               	 [description]
	 */
	public function getRelacionados($xIdCatalogo = null, $oProducto = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = '', $xOrderType = 'DESC', $xGetChild = false) {
		try {
			if (is_numeric($xIdCatalogo) AND $oProducto AND $oProducto->categoria AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xOrderBy) AND is_string($xOrderType) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xIdProducto=" . $oProducto->idProducto
				. "&xOffSet=" . $xOffSet
				. "&xLimit=" . $xLimit
				. "&xIdCategoria=" . $oProducto->categoria->idCategoria
					. "&xCampoOrden=" . $xOrderBy
					. "&xOrdenCampo=" . $xOrderType
					. "&xCampoValor=" . ""
					. "&xValorCampo=" . ""
					. "&xDestacado=" . ""
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;
				unset($xIdCatalogo, $oProducto, $xOffSet, $xLimit, $xOrderBy, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [getRelacionadosByTag description] Devuelve productos relacionados a un producto por el campo etiquetas
	 * @param  integer  	$xIdCatalogo [description]
	 * @param  Producto 	$oProducto   [description]
	 * @param  integer 		$xOffSet     [description]
	 * @param  integer 		$xLimit      [description]
	 * @return array        		     [description]
	 */
	public function getRelacionadosByTag($xIdCatalogo = null, $oProducto = null, $xOffSet = 0, $xLimit = 5) {
		try {
			if (is_numeric($xIdCatalogo) AND $oProducto AND is_numeric($xOffSet) AND is_numeric($xLimit)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xOffSet=" . $xOffSet
				. "&xLimit=" . $xLimit
				. "&xIdProducto=" . $oProducto->idProducto//excluye este producto de la lista devuelta
				 . "&xEtiquetas=" . urlencode($oProducto->etiquetas);

				unset($xIdCatalogo, $oProducto, $xOffSet, $xLimit);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [getProductosAutocomplete description] Devuelve todo el listado de productos de un catalogo para el autocomplete
	 * @param  integer $xIdCatalogo [description]
	 * @return array              	[description]
	 */
	public function getProductosAutocomplete($xIdCatalogo = null) {
		try {
			if (is_numeric($xIdCatalogo)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
					. "&xIdTipoContenido=" . $xIdCatalogo;
				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Log::writeLog($e);
		}
	}
	/**
	 * [getById description] Devuelve un producto por idProducto
	 * @param  integer  $xIdProducto [description]
	 * @param  boolean 	$xOrderChild [description]
	 * @return array               	 [description]
	 */
	public function getById($xIdProducto = null, $xOrderChild = false) {
		try {
			if (is_numeric($xIdProducto)) {
				$xUrl = config('main.URL_API')
				. "Productos?xKey=" . config('main.FIDELITY_KEY')
				. "&xOffSet=" . "0"
				. "&xLimit=" . "1"
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdProducto=" . $xIdProducto;
				
				$vProductos = $this->getProductos($xUrl);
				if (is_array($vProductos) AND !empty($vProductos)) {
					$oProducto = $vProductos[0];
					//Yii::app()->session['meta-producto'] = $oProducto;
					if ($xOrderChild === true) {
						$vProductos = array();
						$xCount = count($oProducto->productos);
						for ($i = 0; $i < $xCount; $i++) {
							if ($oProducto->productos[$i]) {
								$vProductos[$oProducto->productos[$i]->orden] = $oProducto->productos[$i];
							}
						}
						ksort($vProductos);
						$oProducto->productos = $vProductos;
					}

					unset($xIdProducto, $vProductos, $xOrderChild, $xCount);

					return $oProducto;
				}
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [search description] Retorna un listado de productos de acuerdo a un patron de busqueda
	 * @param  integer $xIdCatalogo [description]
	 * @param  string  $xSearch     [description]
	 * @param  integer $xOffSet     [description]
	 * @param  integer $xLimit      [description]
	 * @param  string  $xOrderBy    [description]
	 * @param  string  $xOrderType  [description]
	 * @param  boolean $xGetChild   [description]
	 * @param  string  $xDestacado  [description]
	 * @return array                [description]
	 */
	public function search($xIdCatalogo = null, $xSearch = null, $xOffSet = 0, $xLimit = 5, $xOrderBy = 'orden', $xOrderType = 'asc', $xGetChild = false, $xDestacado = '') {
		try {
			if (is_numeric($xIdCatalogo) AND is_string($xSearch) AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_bool($xGetChild)) {
				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xIdCategoria=" . "0"
				. "&xOffSet=" . $xOffSet
				. "&xLimit=" . $xLimit
				. "&xCampoOrden=" . $xOrderBy
				. "&xOrden=" . $xOrderType
				. "&xCampoValor=" . ""
				. "&xValor=" . ""
				. "&xDestacado=" . $xDestacado
				. "&xBusqueda=" . urlencode($xSearch)
					. "&xHijos=" . $xGetChild;

				unset($xIdCatalogo, $xSearch, $xOffSet, $xLimit, $xGetChild
				);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [searchByCampo description] Retorna un listado de productos de acuerdo a un patron de busqueda por un campo especifico
	 * @param  imteger $xIdCatalogo [description]
	 * @param  string  $xSearch     [description]
	 * @param  string  $xSearchBy   [description]
	 * @param  integer $xOffSet     [description]
	 * @param  integer $xLimit      [description]
	 * @param  boolean $xGetChild   [description]
	 * @param  string  $xCampoOrden [description]
	 * @param  string  $xOrden      [description]
	 * @param  string  $xDestacado  [description]
	 * @return array                [description]
	 */
	public function searchByCampo($xIdCatalogo = null, $xSearch = null, $xSearchBy = null, $xOffSet = 0, $xLimit = 5, $xGetChild = false, $xCampoOrden = null, $xOrden = null, $xDestacado = '') {
		try {
			if (is_numeric($xIdCatalogo) AND is_string($xSearch) AND str_replace(" ", "", $xSearch) != "" AND is_numeric($xOffSet) AND is_numeric($xLimit) AND is_string($xSearchBy) AND is_bool($xGetChild)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xIdCategoria=" . "0"
				. "&xOffSet=" . $xOffSet
				. "&xLimit=" . $xLimit
				. "&xCampoOrden=" . $xCampoOrden
				. "&xOrden=" . $xOrden
				. "&xCampoValor=" . urlencode($xSearchBy)
				. "&xValor=" . urlencode($xSearch)
					. "&xDestacado=" . $xDestacado
					. "&xBusqueda=" . ""
					. "&xHijos=" . $xGetChild;
				unset($xIdCatalogo, $xSearch, $xOffSet, $xLimit, $xSearchBy, $xGetChild);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}
	}
	/**
	 * [cast description] Conviente un Vector de ProductoAPI en Vector de Producto
	 * @param  array $vProductosAPI [description]
	 * @return array                [description]
	 */
	public static function cast($vProductosAPI = null) {
		$oProducto = new Producto();
		return $oProducto->setProductos($vProductosAPI);
	}
	/**
	 * [getAllByTag description] Retorna un listado de objetos Producto segun etiquetas tag
	 * @param  integer $xIdCatalogo [description]
	 * @param  integer $xOffSet     [description]
	 * @param  integer $xLimit      [description]
	 * @param  string  $xEtiquetas  [description]
	 * @return array                [description]
	 */
	public function getAllByTag($xIdCatalogo = null, $xOffSet = 0, $xLimit = 5, $xEtiquetas = '') {
		try {
			if (is_numeric($xIdCatalogo) AND is_numeric($xOffSet) AND is_numeric($xLimit)) {

				$xUrl = config('main.URL_API')
				. "Productos?"
				. "xKey=" . config('main.FIDELITY_KEY')
				. "&xIdSitio=" . config('main.ID_SITIO')
				. "&xIdTipoContenido=" . $xIdCatalogo
				. "&xOffSet=" . $xOffSet
				. "&xLimit=" . $xLimit
				. "&xIdProducto=" . '0'
				. "&xEtiquetas=" . urldecode($xEtiquetas);

				unset($xIdCatalogo, $xOffSet, $xLimit
				);

				return $this->getProductos($xUrl);
			}
		} catch (Exception $e) {
			// Sawubona::writeLog($e);
		}

	}

	//  ---------------------------------------------------------------    //
	//  Funciones privadas
	//  ---------------------------------------------------------------    //
	/**
	 * [getProductos description]
	 * @param  string $xUrl [description]
	 * @return array       [description]
	 */
	protected function getProductos($xUrl = null) {
		try {
			if (is_string($xUrl)) {
				$vDataAPI = Sawubona::getCache($xUrl, config('main.CACHE_PRODUCTO'));
				$vDataAPI = $vDataAPI;
				if ($vDataAPI->data != null) {
					$vDataAPI = $vDataAPI->data->productos;
				}
				return $this->setProductos($vDataAPI);
			}
		} catch (Exception $e) {
			//Sawubona::writeLog($e);
		}
	}
	/**
	 * [setProductos description] Conviente un Vector de ProductoAPI en Vector de Producto
	 * @param array $vProductosAPI [description]
	 */
	protected function setProductos($vProductosAPI = null) {
		try
		{
			if (is_array($vProductosAPI) AND !empty($vProductosAPI)):
				$vProductos = array();
				foreach ($vProductosAPI as $oProductoAPI):
					$oProducto = $this->setProducto($oProductoAPI);
					
					if (!($oProducto)):
						continue;
					endif;

					$vProductos[] = $oProducto;
				endforeach;

				unset($vProductosAPI);
				
				return $vProductos;
			endif;
		} catch (Exception $e) {
			Log::error($e);
		}
	}
	/**
	 * [CalcularPorcentajeAplicado description] Calcular qué porcentaje del total es una cantidad
	 * @param Producto $oProducto [description]
	 */
	public function CalcularPorcentajeAplicado($oProducto) {
		//Ejemplo: Descuento = 100 - ((precioActivo * 100) / preciodeLista )
		return $oProducto->descuento = 100 - (($oProducto->precioActivo * 100) / $oProducto->precioDeLista);

	}
	/**
	 * [setProducto description] Convierte un Objeto ProductoAPI en Producto
	 * @param array $oProductoAPI [description]
	 */
	public function setProducto($oProductoAPI = null) {
		try
		{		
			$oProducto = new Producto();			

			/* datos producto */
			$oProducto->idProducto = isset($oProductoAPI->idProducto) ? $oProductoAPI->idProducto : null;
			$oProducto->titulo = isset($oProductoAPI->titulo)  ? $oProductoAPI->titulo : null;
			$oProducto->descripcion = isset($oProductoAPI->descripcion)? $oProductoAPI->descripcion : null;
			$oProducto->habilitado = isset($oProductoAPI->habilitado) ? $oProductoAPI->habilitado : null;
			$oProducto->ranking = isset($oProductoAPI->ranking) ? $oProductoAPI->ranking : null;
			$oProducto->destacado = isset($oProductoAPI->destacado) ? $oProductoAPI->destacado : null;
			$oProducto->descuento = isset($oProductoAPI->descuento) ? $oProductoAPI->descuento : null;
			$oProducto->orden = isset($oProductoAPI->orden)  ? $oProductoAPI->orden : null;
			$oProducto->etiquetas = isset($oProductoAPI->etiquetas)  ? $oProductoAPI->etiquetas : null;
			$oProducto->especificacion = isset($oProductoAPI->especificacion)  ? $oProductoAPI->especificacion : null;
			$oProducto->detalle = isset($oProductoAPI->detalle) ? $oProductoAPI->detalle : null;
			$oProducto->direccion = isset($oProductoAPI->direccion) ?  $oProductoAPI->direccion : null;
			$oProducto->localidad = isset($oProductoAPI->localidad) ?  $oProductoAPI->localidad : null;
			$oProducto->telefono = isset($oProductoAPI->telefono) ?  $oProductoAPI->telefono : null;
			$oProducto->email = isset($oProductoAPI->email) ?  $oProductoAPI->email : null;
			$oProducto->peso = isset($oProductoAPI->peso) ?  $oProductoAPI->peso : null;
			$oProducto->codigoInterno = isset($oProductoAPI->codigoInterno) ?  $oProductoAPI->codigoInterno : null;
			$oProducto->distincion = isset($oProductoAPI->distincion) ? $oProductoAPI->distincion : null;
			$oProducto->puntos = isset($oProductoAPI->puntos) ? $oProductoAPI->puntos : null;
			$oProducto->combo = isset($oProductoAPI->combo) ? $oProductoAPI->combo : null;
			$oProducto->volumen = isset($oProductoAPI->volumen) ? $oProductoAPI->volumen : null;
			$oProducto->marca = isset($oProductoAPI->marca) ? $oProductoAPI->marca : null;
			$oProducto->critica = isset($oProductoAPI->critica) ? $oProductoAPI->critica : null;
			$oProducto->categoria = isset($oProductoAPI->categoria) ? new Categoria($oProductoAPI->categoria) : null;


			/* Stock */
			isset($oProductoAPI->stock1) ? $oProducto->stocks[] = $oProductoAPI->stock1 : null;
			isset($oProductoAPI->stock2) ? $oProducto->stocks[] = $oProductoAPI->stock2 : null;
			

			/* Combos */
			isset($oProductoAPI->comboDescuento) ?  $oProducto->comboDescuento : null;
			isset($oProductoAPI->tipoComboDescuento) ? $oProducto->tipoComboDescuento : null;

			
			/* Imagenes */
			if (isset($oProductoAPI->imagenesProducto)):
				foreach ($oProductoAPI->imagenesProducto as $oImagenAPI):
					$oProducto->imagenes[] = new Imagen($oImagenAPI->imagen->idImagen, $oImagenAPI->imagen->pieImagen, $oImagenAPI->path);
				endforeach;
			endif;
			

			/* Envio Bonificado */
			$oProducto->envioBonificado = ((strpos($oProducto->etiquetas, Config('parametros.envioBonificado')) === false ) ? false : true);

			/* Producto nuevo */
			$oProducto->productoNuevo = ((strpos($oProducto->etiquetas, Config('parametros.productoNuevo')) === false) ? false : true);


			/* Archivos */
			if (isset($oProductoAPI->archivosProducto)):
				foreach ($oProductoAPI->archivosProducto as $oArchivoAPI):
					$oProducto->archivos[] = new Archivo($oArchivoAPI);
				endforeach;
			endif;


			/*  Etiquetas por producto */
			if(isset($oProductoAPI->etiquetasxProducto)):
				foreach($oProductoAPI->etiquetasxProducto as $index => $oEtiquetaxProductoAPI):
					$oProducto->etiquetasxProducto[] = $oEtiquetaxProductoAPI;
				endforeach;
			endif;

			/* Precios */
			isset($oProductoAPI->precio) ? $oProducto->precios[] = $oProductoAPI->precio : null;
			isset($oProductoAPI->precio1) ? $oProducto->precios[] = $oProductoAPI->precio1 : null;
			isset($oProductoAPI->precio2) ? $oProducto->precios[] = $oProductoAPI->precio2 : null;
			isset($oProductoAPI->precio3) ? $oProducto->precios[] = $oProductoAPI->precio3 : null;
			$this->setPrecioProductos($oProductoAPI,$oProducto);

			/* Productos dependientes */
			if(isset($oProductoAPI->listaProductosDep) && is_array($oProductoAPI->listaProductosDep)):
				foreach($oProductoAPI->listaProductosDep as $oProductoDepAPI):
					$oProducto->productos[] = $this->setProducto($oProductoDepAPI);
				endforeach;
			endif;

			/* Videos */
			if (!empty($oProductoAPI->video)):
				foreach (explode(';', $oProductoAPI->video) as $oVideoAPI):
					$oProducto->videos[] = new Video(trim($oVideoAPI));
				endforeach;
			endif;


			$oProducto->puntos = isset($oProductoAPI->puntos) ? $oProductoAPI->puntos : null;


			unset($oProductoAPI);

			return $oProducto;
		} catch (Exception $e) {
			Log::error($e);
		}
	}

	/**
	 * [descripcionCorta description] Crea una descripcon corta del producto
	 * @param  Producto $oProductos [description]
	 * @return array                [description]
	 */
	public static function descripcionCorta($oProductos) {
		if ($oProductos) {
			foreach ($oProductos as $producto) {
				if (!empty($producto->descripcion)) {
					$producto->descripcionCorta = Caracteres::cutWord($producto->descripcion);
				}
			}
			return $oProductos;
		}
	}

	/**
	 * [setPrecioProductos description] Setea el precio al producto con opciones
	 * @param  Producto $xProductoAPI [description]
	 * @param  Producto $oProducto [description]
	 * @return $oProducto [description]
	 */
	public function setPrecioProductos($xProductoAPI = null,$oProducto = null){
		try {
			if(!empty($xProductoAPI)):
				$precioTachado = $precioTotal = $valorCocarda = $stock = 0;
				$xDescuento =  false;

				if($xProductoAPI->combo == true):
					/* Es un producto Combo - Calculamos el precio */
					if(!empty($xProductoAPI->comboProductos)):
						foreach ($xProductoAPI->comboProductos as  $xCombo):
							/* Utilizo la lista de precio para WEB */
							if($xCombo->comboPrecio == "precio"):
								if(!empty($xCombo->producto)):
									$xListaPrecio = $xCombo->productoPrecio;
                        			$precioTachado += ($xCombo->producto->$xListaPrecio * $xCombo->cantidad);
                        			$precioTotal += ($xCombo->producto->$xListaPrecio * $xCombo->cantidad);
	                        	endif;
	                        endif;
	                    endforeach;
	                endif;

	                /* Calculamos el descuento */
	            	if($xProductoAPI->descuento == true):
	                    if($xProductoAPI->tipoComboDescuento == "$"):
	                        $precioFinal = round(($precioTotal - $xProductoAPI->comboDescuento),2);
	                        $valorCocarda = "$ ".($xProductoAPI->comboDescuento);
	                    else:
	                        $descuento = (($precioTotal * $xProductoAPI->comboDescuento) / 100) ;
	                        $precioFinal = round($precioTotal - $descuento,2);
	                        $valorCocarda = $xProductoAPI->comboDescuento.$xProductoAPI->tipoComboDescuento."";
	                    endif;
	                else:
	                	$precioFinal = round(($precioTotal),2);
	                endif;

                    /* Vemos el stock del producto */
                    if(!empty($xProductoAPI->comboProductos)):
	                    foreach ($xProductoAPI->comboProductos as $key1 => $value):
	                    	/* Busco el menor stock del Combo */
	                    	if($key1 == 0 ):
	                    		$stock = $value->producto->stock1;
	                    	endif;
	                    	if($stock >= $value->producto->stock1):
	                    		$stock = $value->producto->stock1;
	                    	endif;
	                    endforeach;
	                endif;

	                $xProductoAPI->stocks[0] = $stock;
                else:
                	/* Es un producto Comun*/
                	if($xProductoAPI->descuento == true):
                		$precioTachado = $xProductoAPI->precio2;
                		$precioFinal = $xProductoAPI->precio;
                		$precioAux = ($precioTachado - $precioFinal);

                        if ($precioAux != 0 && $precioTachado != 0 ):
                            $valorCocarda = round(($precioAux * 100) / $precioTachado,2)."%";
                        endif;
                	else:
                		$precioFinal = $xProductoAPI->precio;
                	endif;

                	if($xProductoAPI->precio == $xProductoAPI->precio2 && $xProductoAPI->descuento == true):
                		$xProductoAPI->descuento = false;
             		endif;
				endif;

				$oProducto->precioTachado = number_format($precioTachado, 2, '.', '');
				$oProducto->precioFinal = number_format($precioFinal, 2, '.', '');
				$oProducto->valorCocarda = ceil($valorCocarda);

				unset($xProductoAPI);
				/* Retornamos al mismo el producto con los precios actualizados*/
				return $oProducto;
			endif;				

		} catch (Exception $e) {
			Log::error($e);
		}
	}

	public function printShared($xLink = null) {
		echo '<ul class="shared">'
		. '<li class="btn-facebook">'
		. '<a href="' . $xLink . '">'
		. '<img src="'.asset('images/iconos/evento-facebook.png').'">'
			. '</a>'
			. '</li>';

		echo '<li class="btn-twitter">'
		. '<a href="' . $xLink . '">'
		. '<img src="'.asset('images/iconos/evento-twitter.png').'">'
			. '</a>'
			. '</li>'
			. '</ul>';
	}
	
}
?>