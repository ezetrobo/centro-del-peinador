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

    @if(!empty($oProducto))
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
                                        @if(!empty($oProducto->imagenes))
                                            @foreach($oProducto->imagenes as $key => $xImagen)
                                                @if($xImagen->nombre != "logo")
                                                    <img src="{{$xImagen->path}}" alt="">
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="compartir-evento d-none d-sm-flex">
                            <p>COMPARTIR EVENTO: </p>
                                <div class="iconos-compartir" id="shared">
                                    <?php $oProducto->printShared($oProducto->getLink('eventos')); ?> 
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-7 offset-lg-1 col-md-8 col-sm-8">
                        <div class="info-evento">
                            <h1>{{$oProducto->titulo}}</h1>
                            {!!$oProducto->critica!!}
                            
                            {!!$oProducto->descripcion!!}
                        </div>

                        @if(!empty($oProducto))
                            @if($oProducto->habilitado)
                                <div class="precio-evento">
                                    <p class="precio-unitario">Precio unitario:</p>
                                    <div class="precio">
                                        @if($oProducto->descuento)
                                            <span class="tachado">${{$oProducto->precioTachado}}</span>
                                        @endif
                                        <span class="descuento">${{$oProducto->precioFinal}}</span>
                                    </div>
                                    <div id="atributo-evento">
                                        <ul class="atributos-producto">
                                            <li><strong>Cupos:</strong>
                                                <span class="alert-stock">{{$oProducto->stocks[0]}}</span>
                                            </li>
                                            <div class="cantidad mt-4">
                                                <span class="minus">-</span>
                                                <input class="count" name="quantity" id="quantity" value="1" step="6" max="{{$oProducto->stocks[0]}}" type="number">
                                                <span class="plus">+</span>
                                            </div>
                                            <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="{{$oProducto->idProducto}}">
                                                <img src="{{asset('images/iconos/carro.png')}}" alt="">ADQUIRÍ TU ENTRADA
                                            </button>
                                            <div class="prod-agregado">
                                                <span>¡Producto agregado!</span>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endif

                        
                            @if(!empty($oProducto->imagenes))
                                @foreach($oProducto->imagenes as $key => $xImagen)
                                    @if($xImagen->nombre == "logo")
                                        <div class="organizador">
                                            <p>organizado por:</p>
                                            <img src="{{$xImagen->path}}" alt="">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        
                        <div class="compartir-evento d-flex d-sm-none">
                            <p>COMPARTIR EVENTO: </p>
                                <div class="iconos-compartir" id="shared">
                                   <?php $oProducto->printShared($oProducto->getLink('eventos')); ?>
                                </div>
                        </div>
                    </div>
                </div>

                @if(!empty($oProducto) && $oProducto->habilitado == false)
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
                            @if(!empty($oProducto->videos))
                                @foreach($oProducto->videos as $key => $xVideo)
                                    <div class="carousel-item @if($key == 0) active @endif">
                                        <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/{{$xVideo->idVideo}}" frameborder="0"></iframe>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    </div>
                @endif

            </div>

            @if(!empty($oProducto) && $oProducto->habilitado == false)
                <div class="container titulo-eventos">
                    <div class="col-12 borde-azul">
                        <hr>
                        <hr>
                        <h1 class="titulo-pasados"> GALERÍA</h1>
                    </div>
                </div>
                <div class="container-fluid" id="galeria-eventos">
                    <div class="row">
                        @if(!empty($oProducto->imagenes))
                            @foreach($oProducto->imagenes as $key => $xImagen)
                                @if($xImagen->nombre == "")
                                    <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                                        <a data-fancybox="gallery" href="{{$xImagen->path}}">
                                            <div class="centrar-img">
                                                <img src="{{$xImagen->path}}">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif
    

    
@endsection
