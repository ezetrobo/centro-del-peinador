@extends('layouts.app')
@section('title', ' | Catalogo')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')

    <div id="head-section">
        <div class="overlay">
            <img src="{{ asset('images/catalogo/filtro-catalogo.png') }}" alt="">
        </div>
        <div class="centrar-img">
            <img src="{{ asset('images/catalogo/head.png') }}" alt="">
        </div>
    </div>

    <div class="contenedor-faq">

        @if(!empty($oPreguntasFrecuentes))
           @foreach ($oPreguntasFrecuentes as $key => $xContenido)
                <div class="container">

                    <div class="row pl-3 pr-3">
                        <div class="col-12 borde-azul">
                            <hr>
                            <hr>
                        <h1 class="titulo-faq"> {{$key}}</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="accordion mb-5" id="accordionfaq">
                                
                                @if (!empty($xContenido))
                                    @foreach ($xContenido as $key1 => $xPregunta)
                                        <div class="card">
                                            <div class="card-header" id="faqOne">
                                                <h2 class="mb-0">
                                                    <button class="cambio-icono icono- btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$xPregunta->idContenido}}" aria-expanded="true" aria-controls="collapseOne">
                                                    <span> {{$xPregunta->titulo}}</span>
                                                    </button>
                                                </h2>
                                            </div>
                                    
                                            <div id="collapse{{$xPregunta->idContenido}}" class="collapse" aria-labelledby="faqOne" data-parent="#accordionfaq">
                                                <div class="card-body">
                                                    {!!$xPregunta->descripcion!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    @endsection