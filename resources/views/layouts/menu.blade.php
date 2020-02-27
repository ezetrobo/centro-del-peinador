<?php 
    use App\Clases\Contenido\Contenido;
    
    $xIdTipoContenido = config('parametros.xIdEventos');
    $xOffSet = 0;
    $xLimit = 1;
    $xOrderBy = 'orden';
    $xOrderType = 'ASC';
    $oContenidoStreaming = new Contenido();
    $oContenidoStreaming = $oContenidoStreaming->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);
?>
<nav class="navbar navbar-expand-lg" id="nav">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{URL::to('/')}}"><img class="icon-r" src="{{ asset('images/logo.png') }}" alt=""></a>

        <!-- Button mobile -->
        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        
        <div class="collapse navbar-collapse justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item d-flex align-items-center">
                <a class="nav-link {{ request()->is('/') ? 'active' : ''}}" href="{{URL::to('/')}}">inicio</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link {{ request()->is('empresa') ? 'active' : ''}}" href="{{ url('empresa') }}">empresa</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link {{ request()->is('catalogo') ? 'active' : ''}}" href="{{ url('catalogo') }}">productos</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link {{ request()->is('eventos') ? 'active' : ''}}" href="{{ url('eventos') }}">eventos </a>
                    @if(!empty($oContenidoStreaming))
                        <img class="img-vivo" data-toggle="tooltip" data-placement="top" title="En vivo" src="{{ asset('images/iconos/vivo.png') }}" alt="">
                    @endif
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link {{ request()->is('tips') ? 'active' : ''}}" href="{{ url('tips') }}">tips</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link {{ request()->is('contacto') ? 'active' : ''}}" href="{{ url('contacto') }}">contacto</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand btn-carro" id="navbar-count" href="{{ url('compra') }}">
            <span> 0</span><img src="{{ asset('images/iconos/carro.png') }}" alt="">
        </a>
    </div>
    <div id="menu-md">
        <div class="container">
            <div class="head-md">
                <h1 class="head-titulo">MENU</h1>
                <a class="cerrar-menu navbar-toggler d-xl-none d-lg-none"> <img src="{{ asset('images/iconos/cerrar-blanco.png') }}" alt=""></a>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/')}}">Inicio<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('empresa')}}">Empresa<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('catalogo')}}">Productos<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('eventos')}}">Eventos<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('tips')}}">Tips<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('contacto')}}">Contacto<img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('preguntas-frecuentes')}}">Preguntas frecuentes <img src="{{ asset('images/iconos/flecha-menu.png') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div id="buscador">
    <div class="container">
        <form action="">
            <img src="{{ asset('images/iconos/buscador.png') }}" alt="">
            <input class="form-control" type="text" placeholder="Buscar productos..." aria-label="Search">
        </form>
    </div>
</div>




