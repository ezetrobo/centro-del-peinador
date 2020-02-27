<?php
use App\Clases\Contenido\Contenido;
        /* Contacto | Visitanos */
        $xIdTipoContenido = config('parametros.xIdContacto');
        $xOffSet = 0;
        $xLimit = 0;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido1 = new Contenido();
        $oContenido1 = $oContenido1->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);
?>

<a id="go-top"></a>

<a id="mini-carro" class="mini-carro">
    <span>0</span>
</a>


<div class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-12 d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="" class="logo-footer">
            </div>

            <div class="col-md-4 col-12 d-flex align-items-center menu-footer">
                <ul>
                    <li class="{{ request()->is('/') ? 'active' : ''}}" > <a href="{{ url('/') }}">Inicio</a></li>
                    <li class="{{ request()->is('empresa') ? 'active' : ''}}" > <a href="{{ url('empresa') }}">Empresa</a></li>
                    <li class="{{ request()->is('catalogo') ? 'active' : ''}}" > <a href="{{ url('catalogo') }}">Productos</a></li>
                    <li class="{{ request()->is('eventos') ? 'active' : ''}}" > <a href="{{ url('eventos') }}">Eventos</a></li>
                    <li class="{{ request()->is('tips') ? 'active' : ''}}" > <a href="{{ url('tips') }}">Tips</a></li>
                    <li class="{{ request()->is('contacto') ? 'active' : ''}}" > <a href="{{ url('contacto') }}">Contacto</a></li>
                    <!--<li class="{{ request()->is('') ? 'active' : ''}}" > <a href="{{ url('') }}">Servicio Técnico</a></li>-->
                    <li class="{{ request()->is('preguntas-frecuentes') ? 'active' : ''}}" > <a href="{{ url('preguntas-frecuentes') }}">Preguntas Frecuentes</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 col-12 d-inline-grid align-items-center info-footer">
                @if(!empty($oContenido1))
                    <ul>
                        @foreach($oContenido1 as $key => $xContenido)
                            @if(!$xContenido->portada)
                                @if($key == 0)
                                    <li><img src="{{$xContenido->imagenes[0]->path}}" alt=""><strong>{{$xContenido->bajada}}</strong> {{$xContenido->link}}</li>
                                @else
                                    <li><img src="{{$xContenido->imagenes[0]->path}}" alt=""><a href="{{$xContenido->link}}" target="blank_">{{$xContenido->bajada}}</a></li>
                                @endif
                            @else
                                <li>
                                    <strong>{{$xContenido->titulo}}</strong>
                                    {!!$xContenido->descripcion!!}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="shopping-cart">
        <div id="mini-carrito">
            @include('carrito.mini-carro')
        </div>
    </div>
</div>