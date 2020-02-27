@if(!empty($oCarrito->productos))
    @foreach($oCarrito->productos as $key => $xProducto )
        <div class="modulo-carro">
            <div class="col-4 col-sm-2 col-lg-1 p-0">
                <div class="centrar-img">
                    <img src="{{ asset($xProducto->imagen) }}" alt="">
                </div>
                <img class="borrar-producto d-block d-sm-none" data-id="{{$key}}" src="{{ asset('images/iconos/trash.png') }}" alt="">
            </div>

            <div class="col-8 col-md-9 col-lg-10 p-0 info-producto">
                <p class="titulo-producto">{{$xProducto->titulo}}</p>
                <div class="cantidad">
                    <span class="q-minus" data-id="{{$xProducto->idProducto}}">-</span>
                    <input class="count quantity-minicarro" id="producto_{{$xProducto->idProducto}}" name="quantity" value="{{$xProducto->cantidad}}" data-max="{{$xProducto->stock}}" data-id="{{$xProducto->idProducto}}" step="6" type="number">
                    <span class="q-plus" data-id="{{$xProducto->idProducto}}">+</span>
                </div>
                <div class="precio-producto"><p>PRECIO UNITARIO:</p> <span>${{$xProducto->precio}}</span></div>
                <div class="precio-producto"><p>SUBTOTAL: </p><span>${{$xProducto->cantidad * $xProducto->precio}}</span></div>
            </div>

            <div class="col-sm-2 col-md-1 text-right d-none d-sm-block">
                <img class="borrar-producto" data-id="{{$key}}" src="{{ asset('images/iconos/trash.png') }}" alt="">
            </div>
        </div>
    @endforeach
@else
    <p>No hay productos agregados al carrito</p>
@endif
