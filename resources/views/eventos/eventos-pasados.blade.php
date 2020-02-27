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

        <div class="buscador-evento">
            <div class="container">
                <div class="row">
                    @if(!empty($oAños))
                        <div class="col-xl-3 col-lg-2 col-sm-4 col-6" id="select-año">
                            <select class="selectpicker show-menu-arrow" id="evento_año" data-style="form-control" data-live-search="true"  >
                                <option>Seleccione Año</option>
                                @foreach($oAños as $key => $xAño)
                                    <option data-tokens="{{$xAño}}">{{$xAño}}</option>
                                @endforeach    
                            </select>
                        </div>
                    @endif
                    @if(!empty($oCatalogo->productos))
                        <div class="col-xl-3 col-lg-2 col-sm-4 col-6" id="select-mes">
                            <select class="selectpicker show-menu-arrow" id="evento_mes" data-style="form-control" data-live-search="true" onchange="eventos($(this).val(),$('#evento_año').val() )"  >
                                <option>Seleccione Mes</option>
                                @foreach($oCatalogo->productos as $key => $xCatalogo)
                                    <option data-tokens="{{$key}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-xl-6 col-lg-8 col-sm-4 col-12">
                        <form class="d-flex align-items-center" action="">
                            <img src="{{ asset('images/iconos/buscar-evento.png') }}" alt="">
                            <input class="form-control" type="text" placeholder="Buscar evento" aria-label="Search" autocomplete="off" id="txt_searchEvento">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="eventos">
            @if(!empty($oCatalogo->productos))
                @include('eventos.modulos.eventos',compact('oCatalogo'))
            @endif
        </div>
    </div>
    

    
@endsection
