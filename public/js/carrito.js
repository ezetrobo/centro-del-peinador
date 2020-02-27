var csrfToken = $('[name="csrf_token"]').attr('content');

$( document ).ready(function() {
    /* Obtenemos la cantidad de productos en la sesion */
    obtenerCantidadProductos();

    /* Modificar cantidad Minicarro  */
    $(document).on('click','.q-plus', function(){
        producto = $(this);
        xProducto = "#producto_"+producto.attr("data-id");

        if(parseInt($(xProducto).val()) < parseInt($(xProducto).attr("data-max"))){
            $(xProducto).val(parseInt($(xProducto).val()) + 1);
        }else{
            mensajeModal("El stock disponible de este producto es " + $(xProducto).attr("data-max"));
            $(xProducto).val();
        }

        /* Muestra la cantidad maxima */
        if($(xProducto).val() > parseInt($(xProducto).attr('max'))){
            $(xProducto).val(parseInt($(xProducto).attr('max'))  );
        }
        
        /* Modificamos la cantidad */
        changecantidad(producto.attr("data-id"),$(xProducto).val());
    });
    
    $(document).on('click','.q-minus',function(){
        producto = $(this);
        xProducto = "#producto_"+producto.attr("data-id");


        $(xProducto).val(parseInt($(xProducto).val()) - 1 );
        
        if ($(xProducto).val() == 0) {
            $(xProducto).val(1);
        }

        /* Muestra la cantidad maxima */
        if($(xProducto).val() > parseInt($(xProducto).attr('max'))){
            $(xProducto).val(parseInt($(xProducto).attr('max'))  );
        }

        /* Modificamos la cantidad */
        changecantidad(producto.attr("data-id"),$(xProducto).val())
    });

    /* Modificar cantidad producto ampliado */
    $(document).on('click','.plus',function(){
        $('.count').val(parseInt($('.count').val()) + 1 );

        if($('.count').val() > parseInt($(".count").attr('data-max'))){
            $('.count').val(parseInt($('.count').attr('max'))  );
        }
    });
    
    $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }

        if($('.count').val() > parseInt($(".count").attr('max'))){
            $('.count').val(parseInt($('.count').attr('max'))  );
        }
    });

    $(".count").change(function(event) {
        if($('.count').val() > parseInt($(".count").attr('max'))){
            $('.count').val(parseInt($('.count').attr('max'))  );
        }
    });

    $("#btn-rango").click(function(event) {
        var xUrl = (window.location.search)

        if(xUrl.length == 0){
            window.location.replace(window.location.href+"?rango="+$('#rango_1').val() + '-' + $('#rango_2').val());
        }
        else{
            var alteredURL = removeParam("rango", window.location.href);

            var rango = "rango="+$('#rango_1').val() + '-' + $('#rango_2').val()
            
            if(alteredURL.indexOf('filtros') > -1){
                alteredURL = alteredURL.replace("?","?"+rango+"&")
            }else{
                alteredURL = alteredURL + "?" + rango
            }
            
            window.location.replace(alteredURL);
        }
            
    });


    $(document).on('change','.quantity-minicarro', function(){
        producto = $(this);

        if(producto.val() > 0){
            if(parseInt(producto.val()) < parseInt(producto.attr("data-max"))){
                changecantidad(producto.attr("data-id"), parseInt(producto.val()));
            }else{
                mensajeModal("El stock disponible de este producto es " + producto.attr("data-max"));
                changecantidad(producto.attr("data-id"), parseInt(producto.val()));
            }
        }else{
            $('#quantity-minicarro').val(1)
            changecantidad(producto.attr("data-id"),1)
        }
    });


    /* Eliminar producto  */
    $(document).on('click','.delete-minicarro', function(event){
        event.preventDefault();
        deleteProducto($(this).attr("data-id"));
    });

    /* Eliminar producto carro comun */
    $(document).on('click','.borrar-producto', function(event){
        event.preventDefault();
        deleteProducto($(this).attr("data-id"));
    });

    /* Eliminar todos los productos del carro*/
    $(document).on('click','.borrar-todo', function(event){
        event.preventDefault();
        deleteAll();
    });

    /* Opciones de envio */
    $(document).on('change','.opciones-envio', function(){
        $(".tipo-entrega .collapse").removeClass('show')
        var envio = $(this);
        /* Mostramos las opciones*/
        $("#collapse_"+envio.attr("data-id")).addClass('show')
        $('.selectpicker').selectpicker('val', '0');
    });

    /* Metodos de pago */
    $(".ecommerce").change(function(event) {
        /* Ocultamos el boton */
        $("#btn-pago").addClass('btn-disabled');

        /* Agregamos la clase active */
        $("[name='contenedor-gateway']").removeClass('active');
        $("#contenedor_"+$(this).attr('data-modo')).addClass('active');

        /* Seteamos las propiedades al boton */
        $("#btn-pago").attr('data-modo', $(this).attr('data-modo'));

        /* Seteamos las preferencias de la geleria */
        if($(this).attr('data-modo') == 0){
            /*Gateway Directo*/
            $('#form-gateway').animate({height: 'toggle'}, 200);
            $("#btn-pago").removeClass('btn-disabled');

        }else{
            /*Otras galerias de pago*/
            $('#form-gateway').hide();
            setGatewayPago($(this).attr('id'));
        }
    });

    $("#btn-pago").click(function(event) {
        event.preventDefault()
        setPago($(this).attr('data-modo'),$(this).attr('data-url'))
    });

    $("#btn-descuento").click(function(event) {
        event.preventDefault();
        if($("#txt_descuento").val() != ''){
            calcularDescuento($("#txt_descuento").val());
        }
    });

});

$(function () {
    /* Validar Persona formulario carrito */
    $(document).on('click', '#btn-pago-paso2', function(event) {
        event.preventDefault();
        if ($("#form-persona").valid()){
            setPersona();
        }
    })

    $('.collapse').on('show.bs.collapse', function () {
        $('.collapse.show').each(function(){
            $(this).collapse('hide');
        });
    });

    /* Llamadas agregados al carro */
    $("#modulo1, #modulo2").on('click', '.btn-add-carrito', function(event) {
        if($(this).attr("data-id") == 0){
            alert("Seleccione un producto para continuar")
        }else{
            addProducto($(this).attr("data-id"),$("#quantity").val());
        }
    })

    $("#modulo3").on('click', '.btn-add-carrito', function(event) {
        if($(this).attr("data-id") == 0){
            alert("Seleccione un producto para continuar")
        }else{
            addProducto($(this).attr("data-id"),$("#quantity_"+$(this).attr("data-aux")).val());
        }
    })

    $(".precio-evento").on('click', '.btn-add-carrito', function(event) {
        if($(this).attr("data-id") == 0){
            alert("Seleccione un producto para continuar")
        }else{
            addProducto($(this).attr("data-id"),$("#quantity").val());
        }
    })

   

    /* Seleccionar producto - modulo producto 3 y 4 */
    $(".btn-change-producto").click(function(event) {

        var producto = $(this);
        $("#color_"+producto.data('id')).html(producto.data('color'));
        $("#codigo_"+producto.data('id')).html(producto.data('codigo'));
        $("#stock_"+producto.data('id')).html(parseInt(producto.data('stock')) > 0 ? 'Disponible' : '<span class="alert-stock">No Disponible</span>');
        $('.add_'+producto.data('id')).attr("data-id", producto.data('producto'));
        $('#quantity_'+producto.data('id')).attr("data-max", producto.data('stock'));
        

        /* En version mobile */
        $(".btn-tipo span").html('')
        $(".d-color_"+producto.data('id')).html(producto.data('color'));
        $("#btn-add-carrito-mobile").attr('data-id', producto.data('producto'));
        $("#btn-add-carrito-mobile").addClass('add_'+producto.data('id'))


        /* Quitamos los otros productos que estuviesen agregados */
        $("[data-add='1").remove();
        $(".btn-change-producto").attr('data-estado', '0');

        if(producto.attr("data-estado") == 0){
            /* Se agrega la imagen al carrusel */
            $('<div class="carousel-item" data-add="1"><div class="item-responsive" style="width: 100%; overflow: hidden; float: left;"><div class="contenedor-info">'+((producto.data('nuevo')) ? '<p class="producto-nuevo">Nuevo</p>' : '' )+'</div><div class="imagen-producto"><div class="centrar-img"><img src="'+producto.data('path')+'"></div></div> <div class="contenedor-descuentos">'+((producto.data('descuento')) ? '<span class="badge cocarda-descuento">-'+producto.data('valordescuento')+'%</span>':'')+((producto.data('bonificado')) ? '<span class="badge cocarda-envio"> Envío <br> gratis </span>':'')+ ((producto.data('bonificado')) ? '<span class="badge cocarda-regalo"> <img src="'+baseUrl+'/images/iconos/regalo.png"}" alt=""> </span>':'')+'  </div></div></div>').appendTo('.carrusel-sawubona');
            $('<li data-target="#carousel-producto" data-add="1" data-slide-to="'+(parseInt($('#carousel-indicators li').length)) +'"></li>').appendTo('.carousel-indicators')

            producto.attr('data-estado', '1');
        }

        /* Quitamos todos la clave active */
        $(".carrusel-sawubona .carousel-item").removeClass('active');
        $("[data-target='#carousel-producto']").removeClass('active');

        /* Seteamos la clase active */
        $('.carrusel-sawubona').children().last().addClass('active');
        $('.carousel-indicators li:last-child').addClass('active');

        /* Activamos el carrusel */
        $('#carousel-producto').carousel();
        event.preventDefault();
    });

    /* Seleccionar producto - modulo producto 2 */
    $(".label-checkbox").change(function(event) {
        var producto = $(this);
        $('.btn-add-carrito').attr("data-id", producto.data('id'));
        if(parseInt(producto.data('stock')) > 0){
            $('#disponibilidad-prod').removeClass('alert-stock');
            $('#disponibilidad-prod').text('Disponible');
        }
        else{
            $('#disponibilidad-prod').addClass('alert-stock');
            $('#disponibilidad-prod').text('No Disponible');
        }
    });

    /* Minicarrito */
    $(".mini-carro").on("click", function() {
        
        printMiniCarro()
    });

    /* Reglas de validacion - Formulario carrito */
    $("#form-persona").validate({
        rules: {
            nombre: "required",
            apellido: "required",
            email: "required",
            domicilio: "required",
            barrio: "required",
            cp: "required",
            dni: "required",
            localidad: "required",
            provincia: "required",
            pref3: "required",
            movil: "required",
            localidad: "required",
            numero: "required",
            terminos: {
                required: true
            }
        },
        errorPlacement: function(){
            return false;  // suppresses error message text
        }
    });  
})

/* Refrescamos el token cada 1 hs */
setInterval(refreshToken, 3600000);

function refreshToken(){
    $.get('refresh-csrf').done(function(data){
        csrfToken = data;
    });
}



/* ------ CARRO DE COMPRAS ECOMMERCE ------*/

/* Funcion para agregar un producto al carro */
function addProducto(xIdProducto, xCantidad){
    $.ajax({
        url: baseUrl + '/carrito/addProducto',
        type: 'POST',
        dataType:'json',
        data: {
            idProducto: xIdProducto, 
            cantidad: xCantidad,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend:function(){
            cerrarMiniCarrito();
        }
    })
    .done(function(response) {
        if(response.estado){
            $('.prod-agregado').fadeIn();
            $('.mini-carro').addClass('bounceIn');
            setTimeout(() => {
                $('.prod-agregado').fadeOut();
                $('.mini-carro').removeClass('bounceIn');
            }, 3000);
            setcarro(response);
        }else{
            mensajeModal(response.mensaje);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    })
}

/* Funcion para modificar la cantidad de productos*/
function changecantidad(xIdProducto,xCantidad){
    $.ajax({
        url: baseUrl + '/carrito/changecantidad',
        type: 'POST',
        dataType: 'JSON',
        data: {
            xIdProducto: xIdProducto, 
            xCantidad: xCantidad,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        if(response.estado){
            setcarro(response);
        }else{
            mensajeModal(response.mensaje);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    }); 
}

/* Funcion para Eliminar producto del carro */
function deleteProducto(xIndex){
    $.ajax({
        url: baseUrl + '/carrito/deleteproducto',
        type: 'POST',
        dataType: 'JSON',
        data: {
            xIndex: xIndex,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        if(response.estado){
            setcarro(response)
        }else{
            mensajeModal(response.mensaje);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    })
}

/* Funcion para Eliminar todo el carro */
function deleteAll(){
    $.ajax({
        url: baseUrl + '/carrito/deleteAll',
        type: 'POST',
        dataType: 'JSON',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        if(response.estado){
            limpiarCarrito(response);
        }else{
            mensajeModal(response.mensaje);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    })
}

/* Funcion para calgular el desucento */
function calcularDescuento(xCodigo){
    try {
        $.ajax({
            url: baseUrl + 'carrito/calculardescuento',
            type: 'POST',
            dataType: 'JSON',
            data: {
                codigo: xCodigo,
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
        })
        .done(function(response) {
            if(response.estado){
                setcarro(response)
            }else{
                mensajeModal(response.mensaje);
            }
        })
        .fail(function(response) {
            consultasErroneas(response);
        });
    }
    catch(e){console.log(e)}
}

/* Funcion para setear el tipo de envio*/
function changeEntrega(xIdZona, xIdTipoEnvio){
    $.ajax({
        url: baseUrl + 'carrito/setTipoEnvio',
        type: 'POST',
        dataType: 'JSON',
        data: {
            xIdZona: xIdZona,
            xIdTipoEnvio: xIdTipoEnvio,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        if(response['estado'] == true){
            $(".siguiente-carrito").removeClass('btn-disabled');
            setcarro(response)
        }
    })
    .fail(function() {
        consultasErroneas(response);
    });
}

/* funcion para limpiar el carrito delete all */
function limpiarCarrito(response){
    $("#mini-carro span, #navbar-count span").html(response.parametros.cantidadProductos)
    $("#contenedor-modulo").html("No hay productos agregados al carrito");
    $("#carrito_subtotal span").html("$0");
    $("#carrito_costoEnvio span").html("$0");
    $("#carrito_total span").html("$0");
}

/* Function para abrir el carrito */
function abrirMiniCarrito(){

    $(".shopping-cart").fadeIn("fast");
}

/* Function para cerrar el carrito */
function cerrarMiniCarrito(){

    $(".shopping-cart").fadeOut("fast");
}

/* Funcion para realizar posterior al guardado en el carro */
function setcarro(xCarro){
    try{
        /* Contador del carrito */
        $("#mini-carro span, #navbar-count span").html(xCarro.parametros.cantidadProductos);

        /* Impresion del mini-carro */        
        if($('.shopping-cart:visible').css('display') == 'block'){
            printMiniCarro()
        }

        /* Impresion del carro */
        if (window.location.href.indexOf("compra") !== -1){
            $("#carrito_subtotal span").html("$"+  (xCarro.parametros.subTotal != null ? xCarro.parametros.subTotal : 0 ));
            $("#carrito_costoEnvio span").html("$"+ (xCarro.parametros.costoEnvio != null ? xCarro.parametros.costoEnvio : 0 ));
            $("#carrito_descuento span").html("$"+ (xCarro.parametros.descuento != null ? xCarro.parametros.descuento : 0 ));
            $("#carrito_total span").html("$"+ (xCarro.parametros.total != null ? xCarro.parametros.total : 0 ));

            printCarrito();
        }
    }
    catch(e){
        console.log(e);
    }
}

/* Funcion para Imprimir el minicarro */
function printMiniCarro(){
    $.ajax({
        url: baseUrl + "/carrito/printMiniCarrito",
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend:function(){
            abrirMiniCarrito()
        }
    })
    .done(function(response) {

        $("#mini-carrito").html(response);

    })
    .fail(function(response) {
        consultasErroneas(response);
    });
}

/* Funcion para Imprimir el Carrito */
function printCarrito(){
    $.ajax({
        url: baseUrl + "/carrito/printCarrito",
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend:function(){
            cerrarMiniCarrito()
        }
    })
    .done(function(response) {
        $("#contenedor-modulo").html(response);

    })
    .fail(function(response) {
        consultasErroneas(response);
    });
}

/*Seteamos la persona - Formulario carrito*/
function setPersona(){
    var form_data = new FormData($('#form-persona')[0]);
    form_data.append("_token", $('meta[name="csrf-token"]').attr('content'));
    form_data.append("provincia-nombre", $( "#provincia option:selected" ).text());
    
    $.ajax({
        url: baseUrl + 'carrito/setPersona',
        type: 'POST',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        data:form_data,
    })
    .done(function(response) {
        if(response['estado']){
            window.location.href = baseUrl + "pago";
        }else{
            location.reload(true);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    });
}

/* Funcion para obtener la cantidad de productos del carro */
function obtenerCantidadProductos(){
    $.ajax({
        url: baseUrl + '/carrito/contCarrito',
        type: 'POST',
        dataType: 'json',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        $("#mini-carro span, #navbar-count span").html(response.parametros.cantidadProductos);
    })
    .fail(function(response) {
        consultasErroneas(response);
    })
}

/* Muestra los errores */
function consultasErroneas(xError){
    try{
        //location.reload(true);
        console.log(xError);
    }
    catch(e){
        console.log(e)
    }
}

/* Muestra los mensajes */
function mensajeModal(xMensaje){
    try{
        alert(xMensaje);
    }
    catch(e)
    {
        console.log(e);
    }
}

function setGatewayPago(xGatewayPago){
    $.ajax({
        url: baseUrl +'/carrito/setGatewayPago',
        type: 'POST',
        dataType: 'JSON',
        data: {
            xGatewayPago: xGatewayPago,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        if(response['estado'] == true){
            $("#btn-pago").attr('data-url', response['url']);
            $("#btn-pago").removeClass('btn-disabled');
            $("#btn-pago").attr('data-modo', '1');
        }else{
            $("[name='radio-group']").prop('checked', false);
        }
    })
    .fail(function(response) {
        consultasErroneas(response);
    });
}

function setPago(xModo,xUrl){
    /* Envio de Email */
    enviarMail();
    
    if(xModo == 0){
        doPay();
        /*Gateway Directo*/
        var form_data = new FormData($('#formulario-gateway')[0]);

        $.ajax({
            url: baseUrl +'/carrito/gatewayDirecto',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            data:form_data,
            beforeSend:function(){
                $(".loading").show();
            },
        })
        .done(function(response) {
            console.log(response);
        })
        .fail(function(response) {
            consultasErroneas(response)
        });
    }else{
        /* MercadoPago comun */
        window.location.replace(xUrl);
    }
}

function enviarMail(){
    $.ajax({
        url: baseUrl +'/carrito/enviarMail',
        type: 'POST',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
    })
    .done(function(response) {
        
    })
    .fail(function(response) {
        console.log("error");
    });
    
}

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

/* FIN DEL CARRO DE COMPRAS */