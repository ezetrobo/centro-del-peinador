<?php

namespace App\Http\Controllers;

use App\Clases\Contenido\Contenido;
use App\Sawubona\Sawubona;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function index () {
    	 /* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdTipsHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        /* Imagen Header */
        $xIdTipoContenido1 = config('parametros.xIdTips');
        $xOffSet = 0;
        $xLimit = 0;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido1 = new Contenido();
        $oContenido1 = $oContenido1->getAll($xIdTipoContenido1, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

            if(!empty($oContenido1)):
            	foreach ($oContenido1 as $key => $contenido):
    				$oContenido1[$key]->linkURL = Sawubona::convertToUrl($contenido->titulo);
    			endforeach;
            endif;

        return view('tips.index', compact('oContenido','oContenido1'));
    }

    public function tipsDesplegado (Request $request) {
    	 /* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdTipsHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

    	$oContenido1 = new Contenido();
		$xIdTipoContenido = config('parametros.xIdTips');
		$xIdContenido = $request['xIdContenido'];
		$oContenido1 = $oContenido1->getById($xIdTipoContenido, $xIdContenido);

        $oContenido1->galeriaVideos = explode(";", $oContenido1->bajada);

        return view('tips.tips-desplegado', compact('oContenido','oContenido1'));
    }

    public function buscarTips(Request $request){
        $xIdTipoContenido = config('parametros.xIdTips');
        $oContenido = new Contenido();
        $xContenido = $oContenido->getBySearch($xIdTipoContenido,"titulo",$request['xSearch']);

        return view('tips.modulos.tips', compact('xContenido'));
    }
}
