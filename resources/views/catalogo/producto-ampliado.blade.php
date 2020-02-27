@extends('layouts.app')
@section('title', ' | Productos')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    
    <!-- VISTA DE PRODUCTO ESTANDAR -->
    
    <div id="head-section" class="d-none d-md-block">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>PRODUCTOS</p>
                </div>
            </div>
        </div>
        <div class="overlay">
            <img src="{{ asset('images/catalogo/filtro-catalogo.png') }}" alt="">
        </div>
        <div class="centrar-img">
            <img src="{{ asset('images/catalogo/head.png') }}" alt="">
        </div>
    </div>

@if(!empty($oProducto))
    <div id="contenedor-producto" class="producto">

        <div class="container p-lg-0" id="titulo-producto">
              <nav aria-label="breadcrumb" class="d-none d-sm-block">
                  <ol class="breadcrumb">
                    <li><a href="{{url()->previous()}}"><img class="pr-3" src="{{ asset('images/iconos/go-back.png') }}" alt=""></a></li>
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/catalogo')}}">Productos</a></li>
                  </ol>
              </nav>
        </div>
        <div class="container pb-5 pl-sm-0 pr-sm-0">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4 p-md-4 p-0">
                    <div class="container p-0" id="contenedor-carouselprod">
                        <div id="carousel-producto" class="modulo-producto carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 1, 1, 1, 1">
                            <div class="carousel-inner carrusel-sawubona" role="listbox">
                                @if(!empty($oProducto->imagenes))
                                    @foreach($oProducto->imagenes as $key => $xImagenes)
                                        <div class="carousel-item @if($key == 0) active @endif " >
                                            <div class="contenedor-info">
                                                @if($oProducto->productoNuevo)
                                                    <p class="producto-nuevo">Nuevo</p>
                                                @endif
                                            </div>
                                            <div class="imagen-producto">
                                                <div class="centrar-img">
                                                    <img src="{{ asset($xImagenes->path) }}" alt="">
                                                </div>
                                            </div>
                                        
                                            <div class="contenedor-descuentos">
                                                @if($oProducto->descuento)
                                                    <span class="badge cocarda-descuento"> -{{$oProducto->valorCocarda}}% </span>
                                                @endif

                                                @if($oProducto->envioBonificado)
                                                    <span class="badge cocarda-envio"> Envío <br> gratis </span>
                                                @endif

                                                @if($oProducto->combo)
                                                    <span class="badge cocarda-regalo"> <img src="{{ asset('images/iconos/regalo.png') }}" alt=""> </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            @if(!empty($oProducto->imagenes))
                                @if(count($oProducto->imagenes) > 1)
                                    <ol class="carousel-indicators d-none d-md-flex" id="carousel-indicators">
                                        @foreach($oProducto->imagenes as $key => $xImagenes)
                                            <li data-target="#carousel-productos" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                                        @endforeach
                                    </ol>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div id="descripcion-producto" class="col-xl-6 offset-xl-1 col-lg-7 offset-lg-1 col-md-8 pt-4"> 
                <h1 class="titulo-ampliado">{{$oProducto->titulo}}</h1>

                <div class="collapse-descripcion">
                    <a class="cambio-icono icono- btn-descripcion collapsed d-flex d-sm-none" type="button" data-target="#descripcion-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="descripcion-prod">
                        Descripción
                    </a>
                    <div id="descripcion-prod" class="collapse">
                        <p class="descripcion-producto">
                            {{strip_tags($oProducto->descripcion)}}
                        </p>
                    </div>
                </div>

                {{-- Inicio de modulos de productos --}}

                @if($oProducto->puntos == 2)
                    {{-- Modulo 2 --}}
                    @if(!empty($oProducto->productos))
                        <div id="modulo2">
                            <div class="contenedor-presentacion">
                                <ul class="presentaciones-prod">
                                    @foreach($oProducto->productos as $key => $catalogo)
                                        <li>
                                            <input data-id="{{$catalogo->idProducto}}" data-codigo="{{$catalogo->codigoInterno}}" data-stock="{{$catalogo->stocks[0]}}"  class="label-checkbox" type="radio" id="{{$catalogo->idProducto}}" name="radio-group">
                                            <label for="{{$catalogo->idProducto}}">{{$catalogo->volumen}} ml. </label>
                                            @if($catalogo->descuento)
                                                <span>${{$catalogo->precioTachado}}</span> 
                                            @endif
                                            <strong>${{$catalogo->precioFinal}}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="collapse-detalles">
                                <hr class="line-vertical d-none d-sm-block">
                                <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                    Detalles de producto
                                </a>
                                <div id="atributo-prod" class="collapse">
                                    <ul class="atributos-producto">
                                        @if(!empty($oProducto->etiquetasxProducto))
                                            @foreach($oProducto->etiquetasxProducto as $key => $xProducto)
                                                @if($xProducto->id == Config('parametros.idEtiquetaColor') || $xProducto->id == Config('parametros.idEtiquetaMarca'))
                                                    <li>
                                                        <strong>{{$xProducto->nombre}}:</strong> 
                                                        @if(!empty($xProducto->valores[0]->nombre))
                                                            {{$xProducto->valores[0]->nombre}}
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                        <li><strong>Codigo de producto:</strong> {{$oProducto->codigoInterno}}</li>
                                        <li>
                                            <strong>Stock:</strong>
                                            <span id="disponibilidad-prod">
                                                
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-presentaciones">
                                <div class="cantidad mt-4">
                                    <span class="minus">-</span>
                                    <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                                    <span class="plus">+</span>
                                </div>
                                <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="0">
                                    <img src="{{ asset('images/iconos/carro.png') }}" alt="">AGREGAR AL CARRITO
                                </button>
                                <div class="prod-agregado">
                                    <span>¡Producto agregado!</span>
                                </div>
                            </div>
                        </div>                
                    @endif
                @elseif($oProducto->puntos == 3 || $oProducto->puntos == 4 )
                    {{-- Modulo 3 --}}
                    <div id="modulo3">
                        <p class="precio-unitario">Precio unitario:</p>
                        <div class="precio">
                            @if($oProducto->descuento)
                                <span class="tachado">${{$oProducto->precioTachado}}</span>
                            @endif
                            <span class="descuento">${{$oProducto->precioFinal}}</span>
                        </div>

                        <form class="buscador-esmalte mt-4" action="">
                            @if($oProducto->puntos == 3)
                                <p class="precio-unitario">BUSCAR ESMALTE ESPECÍFICO</p>
                                
                                <select id="searchEsmalte" style="width: 100%">
                                    <option value="">Nombre o número de esmalte</option>
                                    @if(!empty($oProducto->vEtiquetas))
                                        @foreach($oProducto->vEtiquetas as $key => $xEtiqueta)
                                            @if(!empty($xEtiqueta['productos']))
                                                @foreach($xEtiqueta['productos'] as $key1 => $xProducto)
                                                <option value="{{$xProducto->idProducto}}">{{$xProducto->codigoInterno}} - {{$xProducto->titulo}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </select>                                    
                                
                            @else
                                <p class="precio-unitario">BUSCAR POR Nº DE TINTURA</p>
                                <div class="d-flex justify-content-between calculador-tinta">
                                    <select id="searchEsmalte" style="width: 100%">
                                        <option value="">Nombre o número de esmalte</option>
                                        @if(!empty($oProducto->vEtiquetas))
                                            @foreach($oProducto->vEtiquetas as $key => $xEtiqueta)
                                                @if(!empty($xEtiqueta['productos']))
                                                    @foreach($xEtiqueta['productos'] as $key1 => $xProducto)
                                                    <option value="{{$xProducto->idProducto}}">{{$xProducto->codigoInterno}} - {{$xProducto->titulo}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    <button class="btn-calcular d-none">CALCULÁ TU TONO DE TINTURA</button>
                                </div>
                            @endif
                            
                        </form>
                        
                        <div class="lista-color d-block d-sm-none">
                            <p class="precio-unitario mt-4 d-block d-sm-none">SELECCIONAR COLOR DE UNA LISTA</p>
                            <p class="precio-unitario mt-4 d-none d-sm-block">SELECCIONAR COLOR</p>
                            <button class="btn-color toggle-wrap"> Elegir un color</button>
                        </div>

                        <div class="d-block d-sm-none">
                            <div class="cantidad mt-4">
                                <span class="minus">-</span>
                                <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                                <span class="plus">+</span>
                            </div>
            
                            <button class="btn agregar-carrito mt-3  btn-add-carrito" data-id="0" id="btn-add-carrito-mobile">
                                <img src="{{ asset('images/iconos/carro.png') }}" alt="">AGREGAR AL CARRITO
                            </button>
                            <div class="prod-agregado">
                                <span>¡Producto agregado!</span>
                            </div>
                        </div>

                        <div class="buscador-tipo mt-4 mb-4">
                            <div class="bg-buscador">
                                <div class="head-buscador d-flex d-sm-none">
                                    <p class="precio-unitario mb-0">SELECCIONAR COLOR</p>
                                    <a class="cerrar-buscador toggle-wrap"> <img src="{{ asset('images/iconos/cerrar.png') }}" alt=""></a>
                                </div>
                                @if(!empty($oProducto->vEtiquetas))
                                    @foreach($oProducto->vEtiquetas as $key => $xEtiqueta)
                                        <div class="tipo">
                                            <a class="cambio-icono icono- btn-tipo collapsed" type="button" data-target="#tipo{{$key}}" data-toggle="collapse">
                                                {{$xEtiqueta['nombre']}} <span class="d-block d-sm-none d-color_{{$key}}"></span>
                                            </a>

                                            <div class="collapse" id="tipo{{$key}}">
                                                <div class="d-flex">
                                                    @if($oProducto->puntos == 3)
                                                        <ul id="color">
                                                        @if(!empty($xEtiqueta['productos']))
                                                            @foreach($xEtiqueta['productos'] as $key1 => $xProducto)
                                                                <li>
                                                                    <a href="" class="btn-change-producto" data-color="{{$xProducto->titulo}}" data-stock="{{$xProducto->stocks[0]}}" data-codigo="{{$xProducto->codigoInterno}}" data-id="{{$key}}" data-producto="{{$xProducto->idProducto}}"  data-path="@if(!empty($xProducto->imagenes[0])) {{$xProducto->imagenes[0]->path}} @endif"  data-descuento="{{$xProducto->descuento}}" data-bonificado="{{$xProducto->envioBonificado}}"
                                                                        data-nuevo="{{$xProducto->productoNuevo}}" data-combo="{{$xProducto->combo}}" data-estado="0" data-valorDescuento="{{$xProducto->valorCocarda}}">
                                                                        <div class="color"  style="background-color: {{$xProducto->color}};"></div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                        </ul>
                                                    @elseif($oProducto->puntos == 4)
                                                        <div class="contenedor-presentacion">
                                                            <ul class="presentaciones-prod">
                                                                @foreach($xEtiqueta['productos'] as $key1 => $xProducto)
                                                                    @if(!empty($xProducto->color))
                                                                        <li>
                                                                            <input type="radio" id="{{$xProducto->idProducto}}" name="radio-group">
                                                                            <label for="{{$xProducto->idProducto}}" class="btn-change-producto" data-color="{{$xProducto->titulo}}" data-stock="{{$xProducto->stocks[0]}}" data-codigo="{{$xProducto->codigoInterno}}" data-id="{{$key}}" data-producto="{{$xProducto->idProducto}}" data-path="@if(!empty($xProducto->imagenes[0])) {{$xProducto->imagenes[0]->path}} @endif"  data-descuento="{{$xProducto->descuento}}" data-bonificado="{{$xProducto->envioBonificado}}" data-nuevo="{{$xProducto->productoNuevo}}" data-combo="{{$xProducto->combo}}" data-estado="0" data-valorDescuento="{{$xProducto->valorCocarda}}">{{$xProducto->color}}</label>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <hr class="divider-tipo d-none d-sm-block">
                                                    <ul class="atributos-producto d-none d-sm-block">
                                                        <li>
                                                            <strong>Color:</strong> 
                                                            <span id="color_{{$key}}" class="span_color"></span>
                                                        </li>
                                                        @if(!empty($oProducto->etiquetasxProducto))
                                                            @foreach($oProducto->etiquetasxProducto as $key2 => $xProducto)
                                                                @if($xProducto->id == Config('parametros.idEtiquetaMarca') )
                                                                    <li>
                                                                        <strong>{{$xProducto->nombre}}:</strong> 
                                                                        @if(!empty($xProducto->valores[0]->nombre))
                                                                            {{$xProducto->valores[0]->nombre}}
                                                                        @endif
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <li>
                                                            <strong>Código de producto:</strong>
                                                            <span id="codigo_{{$key}}" class="span_codigo"></span>
                                                        </li>
                                                        <li>
                                                            <strong>Stock:</strong> 
                                                            <span id="stock_{{$key}}" class="span_stock"></span>
                                                        </li>
                                                        <div class="cantidad mt-4">
                                                            <span class="minus">-</span>
                                                            <input class="count" name="quantity" id="quantity_{{$key}}" value="1" step="6" type="number">
                                                            <span class="plus">+</span>
                                                        </div>
                                        
                                                        <button class="btn agregar-carrito mt-3 add_{{$key}} btn-add-carrito" data-aux="{{$key}}" data-id="0">
                                                            <img src="{{ asset('images/iconos/carro.png') }}" alt="">AGREGAR AL CARRITO
                                                        </button>
                                                        <div class="prod-agregado">
                                                            <span>¡Producto agregado!</span>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="collapse-detalles d-block d-sm-none" id="tinturas">
                            <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                Detalles de producto
                            </a>
                            <div id="atributo-prod" class="collapse">
                                <ul class="atributos-producto">
                                    @if(!empty($oProducto->etiquetasxProducto))
                                        @foreach($oProducto->etiquetasxProducto as $key => $xProducto)
                                            @if($xProducto->id == Config('parametros.idEtiquetaColor') || $xProducto->id == Config('parametros.idEtiquetaMarca') )
                                                <li>
                                                    <strong>{{$xProducto->nombre}}:</strong> 
                                                    @if(!empty($xProducto->valores[0]->nombre))
                                                        {{$xProducto->valores[0]->nombre}}
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                    <li>
                                        <strong>Codigo de producto:</strong> {{$oProducto->codigoInterno}}
                                    </li>
                                    <li>
                                        <strong>Stock:</strong>
                                        <span id="disponibilidad-prod"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Modulo 1 --}}
                    <div id="modulo1">
                        <p class="precio-unitario">Precio unitario:</p>
                        <div class="precio">
                            @if($oProducto->descuento)
                                <span class="tachado">${{$oProducto->precioTachado}}</span>
                            @endif
                            <span class="descuento">${{$oProducto->precioFinal}}</span>
                        </div>
                        
                        <div class="collapse-detalles" id="tinturas">
                            <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                Detalles de producto
                            </a>
                            <div id="atributo-prod" class="collapse">
                                <ul class="atributos-producto">
                                    @if(!empty($oProducto->etiquetasxProducto))
                                        @foreach($oProducto->etiquetasxProducto as $key => $xProducto)
                                            @if($xProducto->id == Config('parametros.idEtiquetaColor'))
                                                <li>
                                                    <strong>{{$xProducto->nombre}}:</strong> 
                                                    @if(!empty($xProducto->valores[0]->nombre))
                                                        {{$oProducto->color}}
                                                    @endif
                                                </li>
                                            @endif
                                            @if($xProducto->id == Config('parametros.idEtiquetaMarca') )
                                                <li>
                                                    <strong>{{$xProducto->nombre}}:</strong> 
                                                    @if(!empty($xProducto->valores[0]->nombre))
                                                        {{$xProducto->valores[0]->nombre}}
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                    <li>
                                        <strong>Codigo de producto:</strong> {{$oProducto->codigoInterno}}
                                    </li>
                                    <li>
                                        <strong>Stock:</strong>
                                        @if($oProducto->stocks[0] > 0)
                                            Diponible
                                        @else
                                            <span class="alert-stock">No Disponible</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="cantidad mt-4">
                            <span class="minus">-</span>
                            <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                            <span class="plus">+</span>
                        </div>
                        <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="{{$oProducto->idProducto}}">
                            <img src="{{ asset('images/iconos/carro.png') }}" alt="">AGREGAR AL CARRITO
                        </button>
                        <div class="prod-agregado">
                            <span>¡Producto agregado!</span>
                        </div>
                    </div>
                @endif

                {{-- Fin modulos de productos --}}
                </div>
            </div>
        </div>

        @if(!empty($vRelacionados))
            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1>Productos Relacionados</h1>
                    </div>
                </div>
            </div>
            <div class="container p-md-0">
                <div id="carousel-productos" class="carousel relacionados carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 1, 2, 3, 4">
                                
                    <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <ol class="carousel-indicators">
                            @foreach($vRelacionados as $key1 => $xCatalogo)
                                <li data-target="#carousel-productos" data-slide-to="{{$key1}}" class="@if($key1 == 0) active @endif"></li>
                            @endforeach
                    </ol>

                    <div class="carousel-inner" role="listbox">
                            @foreach($vRelacionados as $key1 => $xCatalogo)
                                <div class="carousel-item @if($key1 == 0) active @endif">
                                    @if(trim($xCatalogo->puntos) == 2)
                                        @include('catalogo.modulos.producto2', compact('xCatalogo'))
                                    @elseif(trim($xCatalogo->puntos) == 3)
                                        @include('catalogo.modulos.producto3', compact('xCatalogo'))
                                    @else
                                        @include('catalogo.modulos.producto1', compact('xCatalogo'))
                                    @endif
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
    
    
    

        
@endsection