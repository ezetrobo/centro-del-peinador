@extends('layouts.app')
@section('title', ' | Productos')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>PRODUCTOS</p>
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

    <div class="container-fluid p-0 d-lg-none d-md-block">
        <button class="btn-categorias toggle-wrap"> CATEGORÍAS <img src="{{ asset('images/iconos/down.png') }}" alt=""></button>
    </div>

    <div id="contenedor-producto" class="catalogo">

        <div class="container p-xl-0" id="titulo-producto">
            <nav aria-label="breadcrumb" class="d-none d-sm-block">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="{{URL::to('/catalogo')}}">Productos</a></li>
                </ol>
            </nav>

            <h1 class="titulo-catalogo">Destacados</h1>
            <div class="d-lg-flex categorias">
            </div>
        </div>



            <div class="container pl-xl-0 pr-xl-0">
                <div class="row" id="productos-catalogo">
                    <div class="col-xl-3 col-lg-3">
                        <hr class=" d-lg-block d-none">
                        <hr class=" d-lg-block d-none">
                        <h1 class=" d-lg-block d-none mt-4">Categorías</h1>
                        <div class="col-12 p-0" id="categorias">
                            <div id="accordion" class="menu-categorias mb-4">
                                <div class="head-categorias d-xl-none d-lg-none">
                                    <h1 class="head-titulo mb-0">CATEGORÍAS</h1>
                                    <a class="cerrar-buscador toggle-wrap"> <img src="{{ asset('images/iconos/cerrar.png') }}" alt=""></a>
                                </div>
                                @if(!empty($oCategorias[0]->categorias))
                                    @foreach($oCategorias[0]->categorias as $key => $xCategoria)
                                        <div class="card">
                                            <div class="card-header">
                                                <button class="cambio-icono icono- btn btn-link bt-categorias mt-1 mb-1" data-toggle="collapse" data-target="#categoria{{$key}}" aria-expanded="true" aria-controls="categoria{{$key}}">
                                                    <span>{{$xCategoria->nombre}}</span>
                                                </button>
                                            </div>
                                            <div id="categoria{{$key}}" class="collapse item-categoria" data-parent="#accordion">
                                                <div class="card-body">
                                                    @if(!empty($xCategoria->categorias))
                                                        <ul>
                                                            @foreach($xCategoria->categorias as $key1 => $xSubCategoria)
                                                                <li><a href="{{URL($xSubCategoria->getLink($xSubCategoria->idCategoria))}}">{{$xSubCategoria->nombre}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                        <li><a href="{{URL($xCategoria->getLink($xCategoria->idCategoria))}}" class="ver-todos">Ver más..</a></li>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <hr class="d-lg-block d-none">
                            <hr class="d-lg-block d-none">
                        </div>

                    </div>
                    
                    @if(!empty($oProductos))
                        <div class="col-xl-9 offset-xl-0 col-lg-8 offset-lg-1 col-md-12">
                            @foreach($oProductos as $key => $xContenido)
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <hr>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <h1>{{$xContenido->titulo}}</h1>
                                        </div>
                                    </div>
                                <div id="carousel-productos" class="carousel carousel-responsive slide slide-home mb-5" data-ride="carousel" data-items="1, 1, 2, 2, 3">
                                    <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>

                                    <ol class="carousel-indicators">
                                        @if(!empty($xContenido->productos))
                                            @foreach($xContenido->productos as $key1 => $xProducto)
                                                <li data-target="#carousel-productos" data-slide-to="{{$key1}}" class="@if($key1 == 0) active @endif"></li>
                                            @endforeach
                                        @endif
                                    </ol>
                                    
                                    <div class="carousel-inner" role="listbox">
                                        @if(!empty($xContenido->productos))
                                            @foreach($xContenido->productos as $key1 => $xCatalogo)
                                                <div class="carousel-item @if($key1 == 0) active @endif">
                                                    @if(trim($xCatalogo->puntos) == 2)
                                                        @include('catalogo.modulos.producto2', compact('xCatalogo'))
                                                    @elseif(trim($xCatalogo->puntos) == 3 || trim($xCatalogo->puntos == 4) )
                                                        @include('catalogo.modulos.producto3', compact('xCatalogo'))
                                                    @else
                                                        @include('catalogo.modulos.producto1', compact('xCatalogo'))
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
        
    </div>
@endsection