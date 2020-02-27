<?php
namespace App\Http\Controllers;

use App\Clases\Contenido\Contenido;
use App\Clases\Producto\Producto;
use App\Clases\Producto\SCatalogo;
use DateTime;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    //
    public function index() {
        /* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdEventosHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        /* Link en vivo */
        $xIdTipoContenido = config('parametros.xIdEventos');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenidoStreaming = new Contenido();
        $oContenidoStreaming = $oContenidoStreaming->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        /* Obtenemos todos los productos del catalogo eventos*/
        $oCatalogo = new SCatalogo();
        $oCatalogo->getProductosConFiltroRango(config('parametros.xIdCatalogoEventos'), 0, '', 0, 12, '', '', '', 'orden', 'asc');

        if(!empty($oCatalogo->productos)):
            $vCatalogo = array();

            foreach ($oCatalogo->productos as $key => $xProducto):
                /* Verificamos que la fecha sea correcta al formato esperado */
                if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$xProducto->especificacion) && date("Y-m-d",strtotime($xProducto->especificacion)) > date("Y-m-d")):
                    /* Obtenemos el numero del mes */
                    $mesEvento = (int)date("m",strtotime($xProducto->especificacion));

                    /* Obtenemos el nombre del dia */
                    $xProducto->nombreDia = $this->getDia($xProducto->especificacion);

                    /* Obtenemos el numero del dia */
                    $xProducto->numeroDia = (int)date("d",strtotime($xProducto->especificacion));

                    /* Agregamos al array del numero de mes el producto */
                    $vCatalogo[$this->getMes($mesEvento)][] = $xProducto;
                endif;
            endforeach;

        endif;

        /* Asignamos a productos el arbol previamente armado */
        $oCatalogo->productos = $vCatalogo;

        return view('eventos.index', compact('oContenido','oContenidoStreaming','oCatalogo'));
    }

    public function eventosPasados(Request $request) {
        /* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdEventosHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        $oCatalogo = new SCatalogo();
        $oCatalogo->getProductosConFiltroRango(config('parametros.xIdCatalogoEventos'), 0, '', 0, 12, '', '', '', 'orden', 'asc');

        /* Obtenemos todos los productos del catalogo eventos*/
        $vCatalogo = $this->obtenerEventosPasados($oCatalogo);

        /* Asignamos a productos el arbol previamente armado */
        $oCatalogo->productos = $vCatalogo['vCatalogo'];
        $oAños = $vCatalogo['oAños'];

        return view('eventos.eventos-pasados', compact('oContenido','oCatalogo','oAños'));
    }

    public function eventosDesplegados(Request $request) {
        /* Imagen Header */
        $xIdTipoContenido = config('parametros.xIdEventosHeader');
        $xOffSet = 0;
        $xLimit = 1;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido = new Contenido();
        $oContenido = $oContenido->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);

        /* Producto seleccionado */
        $oCatalogo = new SCatalogo();
        $oCatalogo->getProductosByID(config('parametros.xIdCatalogoEventos'), 0, '', 0, 1 ,'idProducto',$request['xIdProducto']);

        $oProducto =  (($oCatalogo->productos[0]) ? $oCatalogo->productos[0] : null);

        /* Validacion del estado de producto */
        if(!empty($oProducto)):
            if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$oProducto->especificacion)):
                if(date("Y-m-d",strtotime($oProducto->especificacion)) >= date("Y-m-d")):
                    $oProducto->habilitado = true;
                else:
                   $oProducto->habilitado = false; 
                endif;            
            else:
                $oProducto->habilitado = false;
            endif;
        endif;

        return view('eventos.evento-ampliado', compact('oContenido','oProducto'));
    }

    public function getMes($xNumerMes){
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        
        $oDate   = DateTime::createFromFormat('!m', $xNumerMes);
        $nombreMes = strftime('%B', $oDate->getTimestamp());
        
        return $nombreMes;
    }

    public function getDia($xDate){
        $xFecha = strtotime($xDate);

        switch (date('w', $xFecha)):
            case 0: return "Domingo"; break;
            case 1: return "Lunes"; break;
            case 2: return "Martes"; break;
            case 3: return "Miercoles"; break;
            case 4: return "Jueves"; break;
            case 5: return "Viernes"; break;
            case 6: return "Sabado"; break;
        endswitch;
    }

    public function buscarEventos(Request $request){
        $oCatalogo = new SCatalogo();
        $oCatalogo->getProductosConFiltroRango(config('parametros.xIdCatalogoEventos'), 0, '', 0, 0, '', '', '', 'orden', 'asc','titulo',$request['xSearch']);

        /* Obtenemos todos los productos del catalogo eventos*/
        $vCatalogo = $this->obtenerEventosPasados($oCatalogo);

        /* Asignamos a productos el arbol previamente armado */
        $oCatalogo->productos = $vCatalogo['vCatalogo'];
        $oAños = $vCatalogo['oAños'];
        $key = null;

        return view('eventos.modulos.eventos', compact('oCatalogo','oAños','key'));
    }

    public function obtenerEventosPasados($oCatalogo){
       
        $vCatalogo = array();
        $oAños = array();
        
        if(!empty($oCatalogo->productos)):           
            foreach ($oCatalogo->productos as $key => $xProducto):
                /* Verificamos que la fecha sea correcta al formato esperado */
                if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$xProducto->especificacion) && date("Y-m-d",strtotime($xProducto->especificacion)) < date("Y-m-d") ):

                    /* Obtenemos los años disponibles */
                    $año = date("Y",strtotime((int)date("Y",strtotime($xProducto->especificacion))));
                    if(!in_array($año, $oAños)):
                        array_push($oAños, $año);
                    endif;

                    /* Obtenemos el numero del mes */
                    $mesEvento = (int)date("m",strtotime($xProducto->especificacion));

                    /* Obtenemos el nombre del dia */
                    $xProducto->nombreDia = $this->getDia($xProducto->especificacion);

                    /* Obtenemos el numero del dia */
                    $xProducto->numeroDia = (int)date("d",strtotime($xProducto->especificacion));

                    /* Agregamos al array del numero de mes el producto */
                    $vCatalogo[$this->getMes($mesEvento)][] = $xProducto;
                endif;
            endforeach;
        endif;

        return array('vCatalogo' => $vCatalogo, 'oAños' => $oAños);
    }

}
