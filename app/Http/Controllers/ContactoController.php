<?php

namespace App\Http\Controllers;

use App\Clases\Contenido\Contenido;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index() {
    	/* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdContactoHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        /* Contacto | Visitanos */
        $xIdTipoContenido = config('parametros.xIdContacto');
        $xOffSet = 0;
        $xLimit = 0;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido1 = new Contenido();
        $oContenido1 = $oContenido1->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

		return view('contacto.index', compact('oContenido','oContenido1'));
	}
}
