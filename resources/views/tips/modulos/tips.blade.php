@if(!empty($xContenido))
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="modulo-evento">
            <div class="centrar-img">
                <img src="{{ asset('images/eventos/filtro.png') }}" alt="" class="filtro-evento">
                @if(!empty($xContenido->imagenes))
                    @foreach($xContenido->imagenes as $key => $xImagen)
                        @if($xImagen->nombre == 'logo')
                            <img src="{{$xImagen->path}}" alt="">
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="info-evento">
                <h1>{{$xContenido->titulo}}</h1>
                <p>{{$xContenido->subtitulo}}</p>
                <button class="btn" onclick="window.location= '{{ url("/tips/{$xContenido->idContenido}/{$xContenido->linkURL}") }}' "> VER MÁS</button>
            </div>
        </div>
    </div>
@endif