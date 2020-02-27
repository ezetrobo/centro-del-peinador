<?php use App\Sawubona\Sawubona; ?>

@foreach($oCatalogo->productos as $key => $xCatalogo)
    <div class="container evento">
        <div class="row">
            <div class="col-12">
                <h1 class="mes-evento">{{ucwords($key)}}</h1>
            </div>
        </div>
        <div class="row">
            @if(!empty($xCatalogo))
                @foreach($xCatalogo as $key1 => $xProducto)
                    @if(!empty($xProducto))
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="modulo-evento">
                                <div class="cocarda-fecha"><p>{{strtoupper(substr($xProducto->nombreDia,0,3))}} <br><strong>{{$xProducto->numeroDia}}</strong></p></div>
                                <div class="centrar-img">
                                    <img src="{{ asset('images/eventos/filtro.png') }}" alt="" class="filtro-evento">
                                    @if(!empty($xProducto->imagenes))
                                        @foreach($xProducto->imagenes as $key => $xImagen)
                                            @if($xImagen->nombre != 'logo')
                                                <img src="{{$xImagen->path}}" alt="" class="">
                                                @break;
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="info-evento">
                                    <h1>{{strtoupper($xProducto->titulo)}}</h1>
                                    {!!$xProducto->critica!!}
                                    <button class="btn" onclick="window.location = '{{ url('/eventos/'.Sawubona::convertToUrl($xProducto->titulo).'/'.$xProducto->idProducto) }}';"> VER MÁS</button>
                                </div>        
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endforeach