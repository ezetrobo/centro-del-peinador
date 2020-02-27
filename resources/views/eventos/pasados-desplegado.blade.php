@extends('layouts.app')
@section('title', ' | Eventos')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')

    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>EVENTOS</p>
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


    <div id="eventos-desplegado">

        <div class="container p-lg-0" id="titulo-producto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li><a href="{{url()->previous()}}"><img class="pr-3" src="{{ asset('images/iconos/go-back.png') }}" alt=""></a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/eventos')}}">Eventos</a></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div id="slide-evento" class="carousel carousel-responsive slide" data-ride="carousel" data-items="1, 1, 1, 1, 1" >
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <div class="centrar-img">
                                    <img src="{{ asset('images/eventos/evento-1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="compartir-evento d-none d-sm-block">
                        <p>COMPARTIR EVENTO: </p>
                            <div class="iconos-compartir" id="shared">
                               <!-- ACA HAY QUE IMPRIMIR LOS ICONOS DE FACEBOOK Y TWITTER PARA COMPARTIR -->
                            </div>
                    </div>
                </div>

                <div class="col-lg-7 offset-lg-1 col-md-8 col-sm-8">
                    <div class="info-evento">
                        <h1>LO NUEVO EN COLORIMETRÍA Y COLORACIONES BITONALES</h1>
                        <ul>
                            <li>Lunes 06/05/19 - 15:00 a 18:00 hs.</li>
                            <li>Centro del Peinador (Santa Rosa 133)</li>
                            <li>Disertante: Natalia Cravero</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
                            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                        </p>
                    </div>

                

                    <div class="organizador">
                        <p>organizado por:</p>
                        <img src="{{ asset('images/eventos/organiza.png') }}" alt="">
                    </div>
                    <div class="compartir-evento d-block d-sm-none">
                        <p>COMPARTIR EVENTO: </p>
                            <div class="iconos-compartir" id="shared">
                               <!-- ACA HAY QUE IMPRIMIR LOS ICONOS DE FACEBOOK Y TWITTER PARA COMPARTIR -->
                            </div>
                    </div>

                </div>
            </div>
            <div class="titulo-eventos">
                <div class="col-12 borde-azul">
                    <hr>
                    <hr>
                    <h1 class="titulo-pasados"> VIDEOS</h1>
                </div>

                <div id="carousel-productos" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 2, 2, 3, 3">
                    <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="carousel-inner galeria-videos" role="listbox">
                        <div class="carousel-item active">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                        <div class="carousel-item">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                        <div class="carousel-item">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                        <div class="carousel-item">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                        <div class="carousel-item">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                        <div class="carousel-item">
                            <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1&origin=http://example.com" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container titulo-eventos">
            <div class="col-12 borde-azul">
                <hr>
                <hr>
                <h1 class="titulo-pasados"> GALERÍA</h1>
            </div>
        </div>
        <div class="container-fluid" id="galeria-eventos">
            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                    <a data-fancybox="gallery" href="{{ asset('images/eventos/galeria.png') }}">
                        <div class="centrar-img">
                            <img src="{{ asset('images/eventos/galeria.png') }}">
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                    <a data-fancybox="gallery" href="big_1.jpg">
                        <div class="centrar-img">
                            <img src="{{ asset('images/eventos/evento-1.jpg') }}">
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                    <a data-fancybox="gallery" href="big_1.jpg">
                        <div class="centrar-img">
                            <img src="{{ asset('images/eventos/galeria.png') }}">
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                    <a data-fancybox="gallery" href="big_1.jpg">
                        <div class="centrar-img">
                            <img src="{{ asset('images/eventos/evento-1.jpg') }}">
                        </div>
                    </a>
                </div>

            </div>

                

            </div>
        </div>

    </div>
    

    
@endsection
