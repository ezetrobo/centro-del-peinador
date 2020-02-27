@if(!empty($oContenido))
    @foreach($oContenido as $key => $xContenido)
        <div id="contenedor-producto">
            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1>{{$xContenido->titulo}}</h1>
                    </div>
                </div>
            </div>

            <div class="container p-0">
                <div id="carousel-productos" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="2,2,2,3,4">
                        <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                            <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    <div class="carousel-inner" role="listbox">
                        @if(!empty($xContenido->catalogo))
                            @foreach($xContenido->catalogo as $key1 => $xCatalogo)
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
            </div>
        </div>
        
    @endforeach
@endif


