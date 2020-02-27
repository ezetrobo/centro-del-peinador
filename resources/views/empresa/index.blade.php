@extends('layouts.app')
@section('title', ' | Empresa')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')

    <div class="container-fluid" id="slider-seccion">
        <div class="carousel slide carousel-fade" id="carousel-empresa" data-ride="carousel" data-interval="false">
            <div class="container p-0">
                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                    <a class="carousel-control-prev" href="#carousel-empresa" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                
                    <a class="carousel-control-next" href="#carousel-empresa" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    @if(!empty($vContenido))
                        <ol class="carousel-indicators">
                            @foreach($vContenido as $key => $xContenido)
                                <li data-target="#carousel-empresa" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
            <!-- Indicadores -->

            <!-- Imagenes del slide -->
            
            @if(!empty($vContenido))
                <div class="carousel-inner">
                    @foreach($vContenido as $key => $xContenido)
                        @if($xContenido['portada'])
                            @if(!empty($xContenido['contenido']))
                                @foreach($xContenido['contenido'] as $key1 => $xDestacado)
                                    
                                    <div class="carousel-item @if($key1 == 0) active @endif">
                                        <div class="overlay"><img src="{{ asset('images/empresa/filtro-empresa.png') }}" alt=""></div>
                                        <div class="centrar-img">
                                            {{$xDestacado->printImagenes(1)}}
                                        </div>
                                        <div class="caption" id="caption-1">
                                            <div class="container pl-0 pr-0">
                                                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                                                    <div class="titulo-slide"><p>{{$xDestacado->titulo}}</p></div>
                                                </div>
                                                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                                                    <div class="descripcion-slide">
                                                        {!!$xDestacado->descripcion!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        @else
                            <div class="carousel-item">
                                <div class="overlay"><img src="{{ asset('images/empresa/filtro-empresa.png') }}" alt=""></div>
                                <div class="centrar-img">
                                    @if(!empty($xContenido['contenido'][0]->imagenes[0]->path))
                                        <img src="{{ $xContenido['contenido'][0]->imagenes[0]->path }}" alt="">
                                    @endif
                                </div>
                                <div class="caption" id="caption-2">
                                    <div class="container pl-0 pr-0 d-md-flex d-sm-block">
                                        @if(!empty($xContenido['contenido']))
                                            @foreach($xContenido['contenido'] as $key2 => $xAdicional)
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="caption-cuadro">
                                                        <div class="titulo-slide"><p>{{$xAdicional->titulo}}</p></div>
                                                        <div class="descripcion-slide">
                                                            {!!$xAdicional->descripcion!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if(!empty($oContenido))
        <div id="contenedor-empresa">
            <div class="container">
                <div class="row">
                    @foreach($oContenido as $key => $xContenido)
                        <div class="col-md-4 col-sm-12">
                            <div class="info-empresa" id="info-1">
                                {{$xContenido->printImagenes(1)}}
                                <h1>{{$xContenido->titulo}}</h1>
                                {!!$xContenido->descripcion!!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection