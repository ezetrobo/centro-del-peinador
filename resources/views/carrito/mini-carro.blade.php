
        <div class="shopping-cart-header">
            <div class="d-flex justify-content-between">
                <p>CARRITO</p>
                <a class="mini-carro" onclick="cerrarMiniCarrito()">
                    <img src="{{ asset('images/iconos/cerrar.png') }}" alt="">
                </a>
            </div>
        </div>  

        @if(!empty($oCarrito->productos))
            <ul class="shopping-cart-items">
                @foreach($oCarrito->productos as $key => $xProducto )
                    <li class="clearfix">
                        <div class="d-flex">
                            <div class="centrar-img">
                                <img src="{{ asset($xProducto->imagen) }}">
                            </div>
                            <div class="modulo-carrito">
                                <span class="item-name">{{$xProducto->titulo}}
                                    <br><span class="item-price">${{$xProducto->precio}}</span>
                                </span>
                                <div class="contador-carro">
                                    <div class="cantidad">
                                        <span class="q-minus" data-id="{{$xProducto->idProducto}}">-</span>
                                        <input class="quantity quantity-minicarro" id="producto_{{$xProducto->idProducto}}" value="{{$xProducto->cantidad}}" step="6" data-max="{{$xProducto->stock}}" data-id="{{$xProducto->idProducto}}" type="number">
                                        <span class="q-plus" data-id="{{$xProducto->idProducto}}">+</span>
                                    </div>
                                    <a href="" data-id="{{$key}}" class="delete-minicarro" >
                                        <img src="{{ asset('images/iconos/trash.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="shopping-cart-footer">
            <p>SUBTOTAL <br> 
                <span>$@if(!empty($oCarrito->productos)) {{$oCarrito->costoTotal}} @else 0 @endif</span>
            </p>
            <a href="{{ url('compra') }}" class="btn-carrito"><img src="{{ asset('images/iconos/carro.png') }}" alt="">Continuar</a>
        </div>
        