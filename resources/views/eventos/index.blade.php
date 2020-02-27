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

    <div class="menu-eventos">
        <a href="{{URL('eventos')}}" class="{{ request()->is('eventos') ? 'active' : ''}}">PRÓXIMOS EVENTOS</a>
        <a href="{{URL('eventos/eventos-pasados')}}" class="{{ request()->is('eventos/eventos-pasados') ? 'active' : ''}}">EVENTOS ANTERIORES</a>
    </div>

    <div class="contenedor-evento">
        @if(!empty($oContenidoStreaming))
            @foreach($oContenidoStreaming as $key => $xContenido)
                <div class="container evento">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="mes-evento">{{$xContenido->titulo}}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <iframe width="640" height="360" src="{{$xContenido->link}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if(!empty($oCatalogo->productos))
            @include('eventos.modulos.eventos',compact('oCatalogo'))
        @endif

    </div>
    

    
@endsection
