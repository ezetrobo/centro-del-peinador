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
                    <p class="subtitulo">PASO 2 DE 3</p>
                    <p>COMPLETÁ TUS DATOS</p>
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
            <form id="form-persona">
                <div class="row alinear-form">

                    <div class="col-md-6 col-lg-5 p-md-3 p-sm-0 alinear-col">
                        <div class="row titulo-seccion">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                <hr>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h1>COMPLETÁ TUS DATOS</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-datos">

                                    <div class="d-flex mt-4">
                                        <p>Nombre:</p><input class="form-control" name="nombre" id="nombre" type="text">
                                    </div>

                                    <div class="d-flex mt-4">
                                        <p>Apellido:</p><input class="form-control" name="apellido" id="apellido" type="text">
                                    </div>

                                    <div class="d-flex mt-4">
                                        <p>Email:</p><input class="form-control" name="email" id="email" type="email">
                                    </div>

                                    <div class="d-flex mt-4">
                                        <p>DNI:</p><input class="form-control" name="dni" id="dni" type="text">
                                    </div>

                                    <div class="d-flex mt-4">
                                        <p>Móvil:</p>
                                        <div class="contenedor-cel">
                                            <div class="cel-1">(0<input class="form-control" name="pref3" id="pref3" type="tel">)</div>
                                            <div class="cel-2">15<input class="form-control" name="movil" id="movil" type="tel"></div>
                                        </div>
                                    </div>

                                    <div class="d-flex tipo-entrega mt-4">
                                        <ul>
                                            <li>
                                                <input type="checkbox" id="1" name="terminos" id="terminos">
                                                <label for="1" ><span>Acepto los <a href="">términos y condiciones</a></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($oCarrito->envio) && $oCarrito->envio->idCostoEnvioZona != 1)
                        <div class="col-md-6 col-lg-5 p-md-3 p-sm-0 alinear-col">
                            <div class="row titulo-seccion">

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                    <hr>
                                    <hr>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <h1>TIPO DE ENTREGA:</h1>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group form-datos">
                                        <div class="d-flex mt-4">
                                            <p>Domicilio:</p><input class="form-control" name="domicilio" id="domicilio" type="text">
                                        </div>

                                        <div class="d-flex mt-4">
                                            <p>Número:</p><input class="form-control" name="numero" id="numero" type="tel">
                                        </div>

                                        <div class="d-flex mt-4">
                                            <p>Piso:</p><input class="form-control" name="piso" id="piso" type="text">
                                        </div>

                                        <div class="d-flex mt-4">
                                            <p>Depto:</p><input class="form-control" name="dpto" id="dpto" type="text">
                                        </div>
                                        <div class="d-flex mt-4">
                                            <p>Provincia:</p>
                                            <div id="select-orden">
                                                <select class="selectpicker show-menu-arrow" name="provincia" id="provincia" data-style="form-control" data-live-search="true">
                                                    <option data-tokens="opcion" value="">Seleccione la Provincia</option>
                                                    <option data-tokens="opcion">Buenos Aires</option>
                                                    <option data-tokens="opcion">CABA</option>
                                                    <option data-tokens="opcion">Catamarca</option>
                                                    <option data-tokens="opcion">Chaco</option>
                                                    <option data-tokens="opcion">Chubut</option>
                                                    <option data-tokens="opcion">Cordoba</option>
                                                    <option data-tokens="opcion">Corrientes</option>
                                                    <option data-tokens="opcion">Entre Ríos</option>
                                                    <option data-tokens="opcion">Formosa</option>
                                                    <option data-tokens="opcion">Jujuy</option>
                                                    <option data-tokens="opcion">La Pampa</option>
                                                    <option data-tokens="opcion">La Rioja</option>
                                                    <option data-tokens="opcion">Mendoza</option>
                                                    <option data-tokens="opcion">Neuquén</option>
                                                    <option data-tokens="opcion">Río Negro</option>
                                                    <option data-tokens="opcion">Salta</option>
                                                    <option data-tokens="opcion">San Juan</option>
                                                    <option data-tokens="opcion">San Luis</option>
                                                    <option data-tokens="opcion">Santa Cruz</option>
                                                    <option data-tokens="opcion">Santa Fe</option>
                                                    <option data-tokens="opcion">Santiago del Estero</option>
                                                    <option data-tokens="opcion">Tierra del fuego</option>
                                                    <option data-tokens="opcion">Tucumán</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex mt-4">
                                            <p>Localidad:</p><input class="form-control" name="localidad" id="Localidad" type="text">
                                        </div>

                                        <div class="d-flex mt-4">
                                            <p>Código postal:</p><input class="form-control" name="cp" id="cp" type="text">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-5 col-md-6 p-md-3 alinear-col">
                        <div class="col-12 p-sm-0 p-0">
                            <div class="row titulo-seccion">
            
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                    <hr>
                                    <hr>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
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
            
                        <div class="col-12 p-sm-0 p-0">
                            <div class="row titulo-seccion">
            
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                    <hr>
                                    <hr>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
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

                        <div class="col-12 p-sm-0 p-0">
                            <div class="row titulo-seccion">
            
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                    <hr>
                                    <hr>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
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
                        
                        <div class="col-12 p-sm-0 p-0">
                            <div class="row titulo-seccion">
            
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                                    <hr>
                                    <hr>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
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

                        <div class="col-sm-6 pl-sm-4">
                            <a type="submit" href="{{url('setPersona')}}" id="btn-pago-paso2" class="siguiente-carrito">CONTINUAR 
                                <img src="{{ asset('images/iconos/siguiente.png') }}" alt="">
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection