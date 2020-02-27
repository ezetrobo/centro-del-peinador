<?php

namespace App\Http\Controllers;
use App\Clases\Contenido\Contenido;
use Illuminate\Http\Request;

class PreguntasFrecuentesController extends Controller
{
    public function index (){
        $oPreguntasFrecuentes = array();
        $xIdTipoPreguntasFrecuentes = config('parametros.xIdTipoPreguntasFrecuentes');
		$xOffSet = 0;
		$xLimit = 0;
		$xOrderBy = 'orden';
		$xOrderType = 'ASC';
		$oContenido = new Contenido();
		$oContenido = $oContenido->getAll($xIdTipoPreguntasFrecuentes, $xOffSet, $xLimit, $xOrderBy, $xOrderType);
       
        if(!empty($oContenido)):
            foreach($oContenido as $key => $xContenido): 
                $oPreguntasFrecuentes[$xContenido->tags][] = $xContenido; 
            endforeach;
        endif;

		return view('preguntas-frecuentes.index', compact('oPreguntasFrecuentes'));
    }
}