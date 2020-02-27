<?php

namespace App\Http\Controllers;

use App\Clases\Contenido\Contenido;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
	public function index() {
		/* Atencion */
        $xIdTipoContenido = config('parametros.xIdEmpresa');
        $xOffSet = 0;
        $xLimit = 3;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        $xIdTipoContenido = config('parametros.xIdEmpresaHeader');
        $xOffSet = 0;
        $xLimit = 0;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido1 = new Contenido();
        $oContenido1 = $oContenido1->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        $vContenido = array();

        if(!empty($oContenido1)):
        	foreach($oContenido1 as $key => $xContenido):
        		if($xContenido->portada):
        			/*  */
        			$vContenido['contenido']['contenido'][] = $xContenido;
        			$vContenido['contenido']['portada'] = true;
        		else:
        			/* Se agrupan los contenidos no destacados por el campo tags  new \stdClass(); */
        			$vContenido[$xContenido->tags]['contenido'][] = $xContenido;
        			$vContenido[$xContenido->tags]['portada'] = false;
        		endif;
        	endforeach;
        endif;

        //print_r($vContenido);die;
		return view('empresa.index', compact('oContenido','vContenido'));
	}
}