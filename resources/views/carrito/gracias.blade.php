@extends('layouts.app')
@section('title', ' | Empresa')
@section('body-clase','landing-page sidebar-collapse')


@section('contenido')
    @include('layouts.menu')
    <div class="section-error">
        <div id="head-section">
            <div class="container">
                <div class="info-head">
                    <h1>¡Gracias!</h1>
                    <p>Por elegir El Centro del Peinador.<br>
                        La compra se ha realizado con éxito.</p>
                    <button class="btn-error">SEGUIR COMPRANDO</button>
                </div>
            </div>
            <div class="overlay">
                <img src="{{ asset('images/error/overlay.png') }}" alt="">
            </div>
            <div class="centrar-img">
                <img src="{{ asset('images/gracias/bg-gracias.png') }}" alt="">
            </div>
        </div>
    </div>


    @endsection