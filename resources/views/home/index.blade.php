@extends('layouts.app')
@section('title', ' | Catalogo')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    <!-- CAROUSEL HOME -->
    @if(!empty($oContenido1))
        <div class="container-fluid" id="contenedor-slide">
            <div class="carousel slide carousel-fade" id="carousel-home" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    @foreach($oContenido1 as $key => $xContenido)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                    @endforeach
                </ol>
                <!-- Imagenes del slide -->
                
                <div class="carousel-inner">
                    @foreach($oContenido1 as $key => $xContenido)
                        <div class="carousel-item @if($key == 0) active @endif">
                            <div class="overlay"><img src="{{ asset('images/home/filtro.png') }}" alt=""></div>
                            <div class="centrar-img">
                                {{$xContenido->printImagenes()}}
                            </div>
                                <div class="container pl-0 pr-0" id="carousel-caption">
                                    <div class="col-xl-8 offset-xl-0 col-lg-7 offset-lg-1 col-md-7 col-sm-8 col-12">
                                        <div class="titulo-slide"><p>{{$xContenido->titulo}}</p></div>
                                    </div>
                                    <div class="col-xl-7 offset-xl-0 col-lg-6 offset-lg-1 col-md-7 col-sm-8 col-10">
                                        <div class="descripcion-slide">{!!$xContenido->descripcion!!}</div>
                                    </div>
                                    <div class="col-xl-8 offset-xl-0 col-lg-10 col-md-12 col-sm-12 cols-12">
                                        <a class="btn-lg btn-slide" href="">{{$xContenido->bajada}}</a>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(!empty($parametros))
        @foreach ($parametros as $key => $oContenido)
            @include('home.secciones.'.$key)
        @endforeach
    @endif

    <div id="newsletter">
        <div class="container-fluid p-0">
            <div class="overlay">
                <div class="col-lg-12" id="contenedor-formu">
                    <div class="form-newletter">
                        <p>Conocé todas nuestras promociones, 
                            recibí novedades y descuentos especiales.
                        </p>
                        <iframe src="https://app.fidelitytools.net/resource/suscriptor/?f=Njk2OQ&s=NDMy&ididioma=1" frameborder="0"></iframe>
                    </div>
                </div>
                <img src="{{ asset('images/home/filtro-newsletter.png') }}" alt="" class="img-overlay">
            </div>
                <img src="{{ asset('images/prueba/bg-newsletter.jpg') }}" alt="" class="bg-newsletter">
        </div>
    </div>
@endsection