<div id="carousel-marcas">
    @if(!empty($oContenido))
        <div id="contenedor-producto" class="pt-5">

            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1>{{$oContenido[0]->titulo}}</h1>
                    </div>
                </div>
            </div>

            <div class="container p-0">
                <div id="carousel-marca" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="2, 2, 3, 4, 5">
                    
                        <a class="carousel-control-prev" href="#carousel-marca" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-marca" role="button" data-slide="next">
                            <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    <div class="carousel-inner" role="listbox">
                        @if(!empty($oContenido[0]->imagenes))
                            @foreach($oContenido[0]->imagenes as $key => $xContenidoMarcas )
                                <div class="carousel-item @if ($key == 0) active @endif ">
                                    <img src="{{$xContenidoMarcas->path}}" alt="">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>