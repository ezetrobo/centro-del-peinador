@if(!empty($oContenido))
    <div class="container-fluid" id="servicios">
        <div class="container">
            <div class="servicios">
                <div class="row">
                    @foreach($oContenido as $key => $xContenido)
                        <div class="col-lg-3 col-sm-6">
                            <div class="img-servicios">
                                {{$xContenido->printImagenes()}}
                            </div>
                            <h1>{{$xContenido->bajada}}<br>{{$xContenido->tags}}</h1>
                            {!!$xContenido->descripcion!!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif