<?php use App\Sawubona\Sawubona; ?>
@if(!empty($xCatalogo))
    <div class="modulo-producto">
        <a href="{{ url('/'.Sawubona::convertToUrl($xCatalogo->titulo).'/'.$xCatalogo->idProducto) }}">
            <div class="imagen-producto">
                <div class="centrar-img">
                    {{$xCatalogo->printImagenes(1)}}
                </div>
            </div>
            <div class="contenedor-descuentos">
                @if($xCatalogo->descuento)
                    <span class="badge cocarda-descuento"> -{{$xCatalogo->valorCocarda}}% </span>
                @endif

                @if($xCatalogo->envioBonificado)
                    <span class="badge cocarda-envio"> Envío <br> gratis </span>
                @endif
                
                @if($xCatalogo->combo)
                    <span class="badge cocarda-regalo"> <img src="{{ asset('images/iconos/regalo.png') }}" alt=""> </span>
                @endif
            </div>
            <div class="contenedor-info">
                @if($xCatalogo->productoNuevo)
                    <p class="producto-nuevo">Nuevo</p>
                @endif
                <h1 class="titulo-producto">{{$xCatalogo->titulo}}</h1>
                <p class="descripcion-producto">{!!strip_tags($xCatalogo->descripcion)!!}</p>
                <div class="contenedor-precio">
                    <div class="precio">
                        @if($xCatalogo->descuento)
                            <span class="tachado">${{$xCatalogo->precioTachado}}</span>
                        @endif
                        <span class="descuento">${{$xCatalogo->precioFinal}}</span>
                    </div>
                </div>
            </div>
            <div class="contenedor-boton">
                <button class="btn-lg btn-comprar">COMPRAR</button>
            </div>
        </a>
    </div>
@endif
