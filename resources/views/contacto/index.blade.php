@extends('layouts.app')
@section('title', ' | Contacto')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    
    <!-- VISTA DE PRODUCTO CON VARIAS PRESENTACIONES -->
    
    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>CONTACTO</p>
                </div>
            </div>
        </div>
        <div class="overlay">
            <img src="{{ asset('images/catalogo/filtro-catalogo.png') }}" alt="">
        </div>
        @if(!empty($oContenido[0]->imagenes[0]->path))
            <div class="centrar-img">
                <img src="{{$oContenido[0]->imagenes[0]->path}}" alt="">
            </div>
        @endif
    </div>
    <div class="maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9631.358215406393!2d-64.19087344728837!3d-31.40863313442661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9432a282a7c97fc3%3A0x76c24e7c2813d80b!2sEl%20Centro%20del%20Peinador!5e0!3m2!1ses!2sar!4v1579285511231!5m2!1ses!2sar" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>


    @if(!empty($oContenido1[0]))
        <div class="contenedor-contacto">

            <div class="container">
                <div class="row">
                    <div class="col-xl-4 offset-xl-1 col-lg-5 offset-lg-0 col-md-6 offset-md-0 col-sm-10 offset-sm-1">
                        <div class="container titulo-eventos">
                            <div class="col-12 borde-azul">
                                <hr>
                                <hr>
                                <h1 class="titulo"> DEJANOS TU MENSAJE:</h1>
                            </div>
                            <div class="col-12 p-0">
                                <iframe height="700" src="https://app.fidelitytools.net/resource/suscriptor/?f=NjkwOA&s=NDMy&ididioma=1" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 offset-xl-2 col-lg-4 offset-lg-1 col-md-6 offset-md-0 col-sm-10 offset-sm-1">
                        <div class="container titulo-eventos">
                            <div class="col-12 borde-azul">
                                <hr>
                                <hr>
                                <h1 class="titulo"> VISITANOS:</h1>
                            </div>
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
        </div>
    @endif


    @endsection