@if(!empty($oCatalogo->etiquetas))
    <div class="col-12 p-0" id="filtros">
        <div id="accordion" class="menu-categorias">
            <div class="head-categorias">
                <h1 class="head-titulo">FILTROS</h1>
                <a class="cerrar-buscador button-filtro d-xl-none d-lg-none"> <img src="{{ asset('images/iconos/cerrar.png') }}" alt=""></a>
            </div>

            @foreach($oCatalogo->etiquetas as $key3 => $xEtiqueta)
                @if($xEtiqueta->idEtiqueta == 269)
                    <div class="card" id="color">
                        <div class="card-header">
                            <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#filtros{{$key3}}" aria-expanded="true" aria-controls="filtros{{$key3}}">
                                <span>{{$xEtiqueta->nombre}}</span>
                            </button> 
                        </div>
                        @if(!empty($xEtiqueta->etiquetas))
                            <div id="filtros{{$key3}}" class="collapse item-categoria" data-parent="#accordion">
                                <ul>
                                    @foreach($xEtiqueta->etiquetas as $key => $xEtiqueta)
                                        @if(strpos($xEtiqueta->nombre, '$nuevo') === false)
                                            <li data-toggle="tooltip" data-placement="top" title="Nuevo">
                                                <span class="producto-nuevo"></span>
                                                <a href="{{$xEtiqueta->getLink()}}"><div class="color" style="background-color:#{{$xEtiqueta->color}};"></div></a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{$xEtiqueta->getLink()}}"><div class="color" style="background-color:#{{$xEtiqueta->color}};"></div></a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#filtros{{$key3}}" aria-expanded="true" aria-controls="filtros{{$key3}}">
                                <span>{{$xEtiqueta->nombre}}</span>
                            </button> 
                        </div>
                        @if(!empty($xEtiqueta->etiquetas))
                            <div id="filtros{{$key3}}" class="collapse item-categoria" data-parent="#accordion">
                                <ul>
                                    @foreach($xEtiqueta->etiquetas as $key => $xEtiqueta)
                                        <li><a href="{{$xEtiqueta->getLink()}}">{{$xEtiqueta->nombre}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach

                <div class="card" id="precio">
                    <div class="card-header">
                        <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#categoria4" aria-expanded="true" aria-controls="categoria4">
                            <span>Rango de precios</span>
                        </button> 
                    </div>
                    <div id="categoria4" class="collapse item-categoria" data-parent="#accordion">
                        <div class="price-slider">
                            <span>
                                <input type="number" value="5000" min="0" max="120000" />
                                <input type="number" value="50000" min="0" max="120000" />
                            </span>
                            <input value="5000" min="0" max="120000" step="500" type="range" id="rango_1"/>
                            <input value="50000" min="0" max="120000" step="500" type="range" id="rango_2"/>
                            <button class="btn" id="btn-rango">Consultar</button>
                        </div> 
                    </div>
                </div>
        </div>
    </div>
    <!-- FILTRO DE "ORDENAR POR" VERSIÓN MOBILE -->
    <div class="col-12 p-0 d-xl-none d-lg-none" id="orden">
        <div id="accordion" class="menu-categorias">
            <div class="head-categorias">
                <h1 class="head-titulo">ORDENAR POR</h1>
                <a class="cerrar-buscador button-orden d-xl-none d-lg-none"> <img src="{{ asset('images/iconos/cerrar.png') }}" alt=""></a>
            </div>
            <div class="filtro-orden">
                <a href="">Predeterminado</a>
            </div>
            <div class="filtro-orden">
                <a href="">Alfabético: A-Z</a>
            </div>
            <div class="filtro-orden">
                <a href="">Alfabético: Z-A</a>
            </div>
            <div class="filtro-orden">
                <a href="">Mayor precio</a>
            </div>
            <div class="filtro-orden">
                <a href="">Menor precio</a>
            </div>
        </div>
    </div>
@endif