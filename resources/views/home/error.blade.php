@extends('layouts.app')
@section('title', ' | Empresa')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    <div class="section-error">
        <div id="head-section">
            <div class="container">
                <div class="info-head">
                    <h1>¡Ups! Se produjo un error</h1>
                    <p>La página que estaba buscando no pudo ser encontrada. </p>
                    <button class="btn-error">Volver al inicio</button>
                </div>
            </div>
            <div class="overlay">
                <img src="{{ asset('images/error/overlay.png') }}" alt="">
            </div>
            <div class="centrar-img">
                <img src="{{ asset('images/error/bg-error.png') }}" alt="">
            </div>
        </div>
    </div>


    @endsection