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

    <div class="contenedor-evento pt-4">

        <div class="buscador-evento">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form class="d-flex align-items-center" action="">
                            <img src="{{ asset('images/iconos/buscar-evento.png') }}" alt="">
                            <input class="form-control" type="text" placeholder="Buscar evento" aria-label="Search" autocomplete="off" id="txt_searchTips">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container evento pt-0">
            <div class="row" id="tips">
                @if(!empty($oContenido1))
                    @foreach($oContenido1 as $key => $xContenido)
                        @include('tips.modulos.tips',compact('xContenido'))
                    @endforeach
                @endif                
            </div>
        </div>
    </div>
    

    
@endsection
