<?php
namespace App\Http\Controllers;

use App\Clases\Common\Paginador;
use App\Clases\Contenido\Contenido;
use App\Clases\Producto\Categoria;
use App\Clases\Producto\Etiqueta;
use App\Clases\Producto\Producto;
use App\Clases\Producto\SCatalogo;
use Illuminate\Http\Request;


class CatalogoController extends Controller
{    
	public function index(Request $request) {

		$xIdTipoContenido = config('parametros.xIdCatalogoCarrusel');
		$xOffSet = 0;
		$xLimit = 0;
		$xOrderBy = 'orden';
		$xOrderType = 'ASC';
		$oProductos = new Contenido();
		$oProductos = $oProductos->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

		if(!empty($oProductos)):
			foreach ($oProductos as $key => $xContenido):
				$oCatalogo = new SCatalogo();
				$oCatalogo->getProductosConFiltroRango(Config('parametros.xIdCatalogo'), 0, '', 0, 12, '', '', '', 'orden', 'asc', 'etiquetas', $xContenido->tags);
				$oProductos[$key]->productos = $oCatalogo->productos;
			endforeach;
		endif;
		
		/**
		 * [$Etiquetas description]
		 * @var [type]
		 */
		$oEtiquetas = new Etiqueta();
		$xOffSet = 0;
		$xLimit = 10;
		$xOrderBy = '';
		$xOrderType = 'DESC';
		$xGetChild = false;
		$oEtiquetas = $oEtiquetas->getAll(Config('parametros.xIdCatalogo'), $xOffSet, $xLimit, $xOrderBy, $xOrderType, $xGetChild);
		
		/**
		 * Traer el arbol de categorias
		 */
		$oCategorias = new Categoria();
		$xOrderByNombre = false;
		$oCategorias = $oCategorias->getAllOrdenadas(Config('parametros.xIdCatalogo'), $xOrderByNombre);

		return view('catalogo.index')->with(compact('oProductos', 'oEtiquetas', 'oCategorias'));
	}

	public function categoriaSeleccionada(Request $request) {
		$xCategoria = $xPrecioMin = $xPrecioMax = null;

		$xOffset = (!empty($request->offset) ? $request->offset : 0);
        $xLimit = (!empty($request->limit) ? $request->limit : 12);
        $xCampos = (!empty($request->campos) ? $request->campos : null);
        $xOrdenType = (!empty($request->orden) ? $request->orden : "desc");
        $xEtiquetas = (!empty($request->filtros) ? $request->filtros : 0);
        $xOrden = (!empty($request->orden) ? $request->orden : 'orden');

        if ($request->rango):
            $xRango = explode('-', $request->rango);
            $xPrecioMin = $xRango[0];
            $xPrecioMax = $xRango[1];
            $xCampos = 'Precio';
        endif;

		/**
		 * Traer el arbol de categorias
		 */
		$oCateg = new Categoria();
		$oCategorias = $oCateg->getAllOrdenadas(config('parametros.xIdCatalogo'), false);

		/**
		* Categoria Actual
		**/
		$oCategoriaActual = $oCateg->getById($request['idCategoria']);
		if(!empty($oCategoriaActual)):
			$xCategoria = strtoupper($oCategoriaActual->nombre);
		endif;

		/**
		* Productos de la categoria
		**/
		$oCatalogo = new sCatalogo();
		$oCatalogo->getProductosConFiltroRango(config('parametros.xIdCatalogo'), $request['idCategoria'], $xEtiquetas, $xOffset, $xLimit, $xCampos, $xPrecioMin, $xPrecioMax, 'orden', $xOrdenType, '', '' ,true);


		/* Etiquetas */
		if(!empty($oCatalogo->etiquetas)):
			foreach ($oCatalogo->etiquetas as $key => $xEtiquetas):
				if($xEtiquetas->idEtiqueta == config('parametros.idEtiquetaColor')):
					if(!empty($xEtiquetas->etiquetas)):
						foreach($xEtiquetas->etiquetas as $key1 => $xEtiqueta):
							$aux = explode("#", $xEtiqueta->nombre);
							if(isset($aux[1])):
								$oCatalogo->etiquetas[$key]->etiquetas[$key1]->color = $aux[1];
							endif;
						endforeach;
					endif;
				endif;
			endforeach;
		endif;

		return view('catalogo.categoria-seleccionada', compact('oCategorias','oCatalogo','xCategoria'));
	}

	public function productoAmpliado(Request $request) {
		$vRelacionados = array();
		$oCatalogo = new SCatalogo();
		$oCatalogo->getProductosByID(config('parametros.xIdCatalogo'), 0, '', 0, 9999 ,'idProducto',$request['xIdProducto']);

		$oProducto =  (($oCatalogo->productos[0]) ? $oCatalogo->productos[0] : null);

		/* Se arma el arbol de forma distinta */
		if(!empty($oProducto)):
			/* Esmaltes */
			if($oProducto->puntos == 3):
				if(!empty($oProducto->productos) && is_array($oProducto->productos)):
					/* Agregamos el producto padre como si fuera un hijo para la compra */
						//array_push($oProducto->productos, $oProducto);
					$vEtiquetas = null;
					foreach ($oProducto->productos as $key => $xProducto):
						if(!empty($xProducto->etiquetasxProducto)):
							foreach ($xProducto->etiquetasxProducto as $key => $xEtiqueta):

								/* Color del producto  */
								if($xEtiqueta->id == config('parametros.idEtiquetaColor')):
									$aux = explode("#", $xEtiqueta->valores[0]->nombre);
									if(isset($aux[1])):
										$xProducto->color = "#".$aux[1];
									else:
										continue;
									endif;
								endif;

								/* Tipo de producto */
								if($xEtiqueta->id == config('parametros.idEtiquetaTipoEsmalte')):									
									$vEtiquetas[$xEtiqueta->valores[0]->id]['nombre'] = $xEtiqueta->valores[0]->nombre;
									$vEtiquetas[$xEtiqueta->valores[0]->id]['productos'][] = $xProducto;
								endif;

							endforeach;
						endif;
					endforeach;

					/* Agregamos las etiquetas con sus productos al objeto producto padre */
					$oProducto->vEtiquetas = $vEtiquetas;

					/* Quitamos lo que no necesitamos del producto */
					unset($oProducto->productos);
				endif;
			endif;

			/* Tinturas */
			if($oProducto->puntos == 4):
				if(!empty($oProducto->productos) && is_array($oProducto->productos)):
					/* Agregamos el producto padre como si fuera un hijo para la compra */
						//array_push($oProducto->productos, $oProducto);
					$vEtiquetas = null;
					foreach ($oProducto->productos as $key => $xProducto):
						if(!empty($xProducto->etiquetasxProducto)):
							foreach ($xProducto->etiquetasxProducto as $key => $xEtiqueta):

								/* Color del producto  */
								if($xEtiqueta->id == config('parametros.idEtiquetaColor')):
									$aux = explode("#", $xEtiqueta->valores[0]->nombre);

									if(isset($aux[0])):
										$xProducto->color = str_replace("-", "", $aux[0]);
									else:
										continue;
									endif;
								endif;

								/* Tipo de producto */
								if($xEtiqueta->id == config('parametros.idEtiquetaTipoTintura')):									
									$vEtiquetas[$xEtiqueta->valores[0]->id]['nombre'] = $xEtiqueta->valores[0]->nombre;
									$vEtiquetas[$xEtiqueta->valores[0]->id]['productos'][] = $xProducto;
								endif;

							endforeach;
						endif;
					endforeach;

					/* Agregamos las etiquetas con sus productos al objeto  padre */
					$oProducto->vEtiquetas = $vEtiquetas;

					/* Quitamos lo que no necesitamos del producto */
					unset($oProducto->productos);
				endif;
			endif;

			/* Producto comun */
			if($oProducto->puntos == 1 || $oProducto->puntos == 2):
				if(!empty($oProducto)):
					if(!empty($oProducto->etiquetasxProducto)):
						foreach ($oProducto->etiquetasxProducto as $key => $xEtiqueta):
							/* Color del producto  */
							if($xEtiqueta->id == config('parametros.idEtiquetaColor')):
								$aux = explode("#", $xEtiqueta->valores[0]->nombre);

								if(isset($aux[0])):
									$oProducto->color = str_replace('$nuevo',"",str_replace("-", "", $aux[0]));
								else:
									continue;
								endif;
							endif;
						endforeach;
					endif;

				endif;
			endif;
		endif;

		/* Se buscan los productos del combo para completar los productos relacionados */
		if(!empty($oProducto)):
			$vProducto = new Producto();
        	$vRelacionados = $vProducto->getRelacionados(config('parametros.xIdCatalogo'), $oProducto, 0, 12);
        endif;

		return view('catalogo.producto-ampliado')->with(compact('oProducto','vRelacionados'));
	}	
}
