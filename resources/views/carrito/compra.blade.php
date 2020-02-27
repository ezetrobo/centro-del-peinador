@extends('layouts.app')
@section('title', ' | Catalogo')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    
    <!-- VISTA DE PRODUCTO CON VARIAS PRESENTACIONES -->
    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p class="subtitulo">PASO 1 DE 3</p>
                    <p>CARRITO</p>
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


    <div class="contenedor-carrito">
        <div class="container p-lg-0" id="titulo-producto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li><a href="{{url()->previous()}}"><img class="pr-3" src="{{ asset('images/iconos/go-back.png') }}" alt=""></a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/catalogo')}}">Productos</a></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row tabla-carrito">

                <div class="col-md-6 col-lg-5">
                    <p class="text-initial">PRODUCTO</p>
                </div>

                <div class="col-md-2 col-lg-3">
                    <p>CANTIDAD</p>
                </div>

                <div class="col-md-2">
                    <p>PRECIO UNITARIO</p>
                </div>

                <div class="col-md-2">
                    <p class="text-initial">SUBTOTAL</p>
                </div>
            </div>


            <div class="row" id="contenedor-modulo">
                @include('carrito.modulos.productos-carrito')
            </div>


            <div class="row">
                <div class="col-12 mt-4 mt-lg-5 mb-lg-4">
                    <a href="" class="seguir-compra borrar-todo">BORRAR TODO</a>
                    <a href="{{URL('/catalogo')}}" class="seguir-compra">SEGUIR COMPRANDO</a>
                </div>
            </div>

            <div class="d-lg-flex">
                <div class="col-lg-6 col-xl-5 p-0">
                    <div class="row titulo-seccion">
                        <div class="col-12 col-sm-7 col-md-8 col-lg-12 p-0">
                            <hr>
                            <hr>
                        </div>
                        <div class="col-12">
                            <h1>CÓDIGO DE DESCUENTO (OPCIONAL):</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-12 descuento">
                            <p>INGRESAR CÓDIGO DE DESCUENTO</p>
                            <div class="d-md-flex justify-content-md-between">
                                <input class="form-control" type="text" id="txt_descuento" value="@if(!empty(session('carrito')->descuento->codigo)) {{session('carrito')->descuento->codigo}}@endif" placeholder="Código de descuento" aria-label="Search">
                                <a href="" class="btn-aplicar" id="btn-descuento">APLICAR</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 offset-xl-2 p-0">
                    <div class="row titulo-seccion">

                        <div class="col-12 col-sm-7 col-lg-12 p-0">
                            <hr>
                            <hr>
                        </div>
                        <div class="col-12 col-sm-7 col-lg-12">
                            <h1>TIPO DE ENTREGA:</h1>
                        </div>
                    </div>

                    @if(!empty($eCommerce))
                        <div class="row tipo-entrega">
                            <div class="col-12 col-sm-7 col-lg-12">
                                <ul>
                                    @if($eCommerce->RetiroLocal)
                                        <li>
                                            <input type="radio" id="1" name="radio-group" class="opciones-envio" data-id="1" onchange="changeEntrega(1,1)">
                                            <label for="1">Retiro por sucursal</label>
                                        </li>
                                        <div class="collapse" id="collapse_1"></div>
                                    @endif

                                    @if(!empty($eCommerce->eCommerceTipoEnvio))
                                        @foreach($eCommerce->eCommerceTipoEnvio as $key => $xEcommerce)
                                            <li>
                                                <input type="radio" id="{{$xEcommerce->idEcommerceTipo}}" data-id="{{$xEcommerce->idEcommerceTipo}}" name="radio-group" class="opciones-envio">
                                                <label name="zona-envio" for="{{$xEcommerce->idEcommerceTipo}}">{{$xEcommerce->nombre}}</label>
                                            </li>
                                            
                                            <div class="collapse" id="collapse_{{$xEcommerce->idEcommerceTipo}}" >
                                                <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                    <p>Elegir zona:</p>
                                                    
                                                    @if(!empty($xEcommerce->listaCostoEnvioZona))
                                                        <div id="select-orden" class="select-envio">
                                                            <select class="selectpicker show-menu-arrow tipoEntrega" data-id="{{$xEcommerce->idEcommerceTipo}}" id="zona-envio_{{$xEcommerce->idEcommerceTipo}}" data-style="form-control" onchange="changeEntrega($(this).val(),{{$xEcommerce->idEcommerceTipo}})" >
                                                                <option value="0">Seleccione una opcion</option>
                                                                @foreach($xEcommerce->listaCostoEnvioZona as $key => $xZona)
                                                                    <option name="{{$xEcommerce->idEcommerceTipo}}" value="{{$xZona->idCostoEnvioZona}}" data-tokens="opcion">{{$xZona->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                     @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_subtotal">
                        <h1>SUBTOTAL: 
                            @if(!empty($oCarrito->subTotal))
                                <span>${{$oCarrito->subTotal}}</span>
                            @else
                                <span>$0</span>
                            @endif
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_costoEnvio">
                        <h1>COSTO DE ENVÍO:<span>
                            @if(!empty($oCarrito->envio->costo))
                                <span>${{$oCarrito->envio->costo}}</span>
                            @else
                                <span>$0</span>
                            @endif
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_descuento">
                        <h1>DESCUENTO:<span>
                            @if(!empty($oCarrito->descuento->monto))
                                <span>${{$oCarrito->descuento->monto}}</span>
                            @else
                                <span>$0</span>
                            @endif
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_total">
                        <h1>TOTAL:
                            @if(!empty($oCarrito->costoTotal))
                                <span>${{$oCarrito->costoTotal}}</span>
                            @else
                                <span>$0</span>
                            @endif
                        </h1><strong>(IVA incluido)</strong>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-12 col-sm-7 col-lg-5 offset-lg-7 p-0">
                    <a href="{{url('datos')}}" class="siguiente-carrito @if(!empty($oCarrito->productos)) btn-disabled @endif">CONTINUAR <img src="{{ asset('images/iconos/siguiente.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>



    @endsection