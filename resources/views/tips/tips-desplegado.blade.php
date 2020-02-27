@extends('layouts.app')
@section('title', ' | Tips')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')

    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>TIPS</p>
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
                <li class="breadcrumb-item"><a href="{{url('/tips')}}">Tips</a></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div id="slide-evento" class="carousel carousel-responsive slide" data-ride="carousel" data-items="1, 1, 1, 1, 1" >
                        <div class="carousel-inner">
                            @if(!empty($oContenido1->imagenes))
                                @foreach($oContenido1->imagenes as $key => $xImagen)
                                    @if($xImagen->nombre == "logo")
                                        <div class="carousel-item @if($key == 0) active @endif" >
                                            <div class="centrar-img">
                                                <img src="{{$xImagen->path}}" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div class="compartir-evento d-none d-sm-flex">
                        <p>COMPARTIR EVENTO: </p>
                            <div class="iconos-compartir" id="shared">
                                <?php $oContenido1->printShared($oContenido1->getLink('tips')); ?> 
                            </div>
                    </div>
                </div>

                <div class="col-lg-7 offset-lg-1 col-md-8 col-sm-8">
                    <div class="info-evento">
                        <h1>{{$oContenido1->titulo}}</h1>
                        {!!$oContenido1->descripcion!!}
                    </div>

                    <div class="compartir-evento d-flex d-sm-none">
                        <p>COMPARTIR EVENTO: </p>
                            <div class="iconos-compartir" id="shared">
                               <?php $oContenido1->printShared($oContenido1->getLink('tips')); ?>
                            </div>
                    </div>

                </div>
            </div>
            @if(!empty($oContenido1->galeriaVideos))
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
                                @foreach($oContenido1->galeriaVideos as $key => $xVideo)
                                    <div class="carousel-item active">
                                        <iframe id="player" type="text/html" width="640" height="360" src="{{$xVideo}}" frameborder="0"></iframe>
                                    </div>
                                @endforeach                                                    
                        </div>
                    </div>
                </div>
            @endif
        </div>

            @if(!empty($oContenido1->imagenes))
                <div class="container titulo-eventos">
                    <div class="col-12 borde-azul">
                        <hr>
                        <hr>
                        <h1 class="titulo-pasados"> GALERÍA</h1>
                    </div>
                </div>
                <div class="container-fluid" id="galeria-eventos">
                    <div class="row">
                        @foreach($oContenido1->imagenes as $key => $xImagen)
                            @if($xImagen->nombre != 'logo') 
                                <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                                    <a data-fancybox="gallery" href="{{$xImagen->path}}">
                                        <div class="centrar-img">
                                            <img src="{{$xImagen->path}}">
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    

    
@endsection
