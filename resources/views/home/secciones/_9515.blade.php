@if(!empty($oContenido))
    <div class="tinturas-home">
        <div class="container-fluid p-sm-0 p-0">
            @foreach($oContenido as $key => $xContenido)
                <div class="contenedor-calculador">
                    <div class="centrar-img mujer-calculador">
                        {{$xContenido->printImagenes()}}
                    </div>
                    <div class="centrar-img bg-calculador">
                        <img class="" src="{{ asset('images/home/bg-calculador.jpg') }}" alt="">
                        <div class="info-calculador">
                            <h1>{{$xContenido->titulo}}</h1>
                            <p>{{$xContenido->bajada}}</p>
                            <a href="{{$xContenido->link}}" class="btn-lg btn-calculador">{{$xContenido->subtitulo}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif