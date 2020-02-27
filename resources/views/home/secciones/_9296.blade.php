@if(!empty($oContenido))
    <div class="banner-home">
        <div class="container">
            <div class="row">
                @foreach($oContenido as $key => $xContenido)
                    @if($xContenido->portada)
                        <div class="col-12">
                    @else
                        <div class="col-sm-6">
                    @endif
                            <a href="{{$xContenido->link}}">
                                <div class="centrar-img">
                                    {{$xContenido->printImagenes()}}
                                </div>
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
@endif