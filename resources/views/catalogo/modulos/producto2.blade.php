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

                @if(!empty($xCatalogo->productos))
                    @foreach($xCatalogo->productos as $key => $catalogo)
                        <div class="precio-tamaño">
                            <span class="medida">{{$catalogo->volumen}}</span>
                            @if($catalogo->descuento)
                                <span class="tachado">${{$catalogo->precioTachado}} </span>
                            @endif
                            <strong class="descuento">${{$catalogo->precioFinal}}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="contenedor-boton">
                <button class="btn-lg btn-comprar">COMPRAR</button>
            </div>
        </a>
    </div>
@endif