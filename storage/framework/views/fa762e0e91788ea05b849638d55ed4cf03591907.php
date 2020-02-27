<?php $__env->startSection('title', ' | Catalogo'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- VISTA DE PRODUCTO CON VARIAS PRESENTACIONES -->
    
    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p class="subtitulo">PASO 3 DE 3</p>
                    <p>MEDIOS DE PAGO</p>
                </div>
            </div>
        </div>
        <div class="overlay">
            <img src="<?php echo e(asset('images/catalogo/filtro-catalogo.png')); ?>" alt="">
        </div>
            <div class="centrar-img">
                <img src="<?php echo e(asset('images/catalogo/head.png')); ?>" alt="">
            </div>
    </div>


    <div class="contenedor-carrito">
        <div class="container p-lg-0" id="titulo-producto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li><a href="#"><img class="pr-3" src="<?php echo e(asset('images/iconos/go-back.png')); ?>" alt=""></a></li>
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Productos</a></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row titulo-seccion">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                    <hr>
                    <hr>
                </div>
                <div class="col-12">
                    <h1>SELECCIONÁ TU MEDIO DE PAGO</h1>
                </div>
            </div>

            <div class="row">
                <?php if(!empty($oGatewayPagos)): ?>
                    <?php $__currentLoopData = $oGatewayPagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <div class="contenedor-mp d-sm-flex" name="contenedor-gateway" id="contenedor_<?php echo e($xGateway->idGatewayPago); ?>">
                                <div class="col-xl-6 tipo-entrega">
                                    <ul>
                                        <li>
                                            <input type="radio" class="ecommerce" id="<?php echo e($xGateway->idGatewayPago); ?>" name="radio-group" data-modo="<?php echo e($xGateway->idGatewayPago); ?>">
                                            <label for="<?php echo e($xGateway->idGatewayPago); ?>">
                                                <img class="logo-mp" src="<?php echo e(asset( $xGateway->icono )); ?>" alt="">
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-xl-6">
                                    <div class="d-inline logo-tarjetas">
                                        <?php if(!empty($xGateway->mediosPago)): ?>
                                            <?php $__currentLoopData = $xGateway->mediosPago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xMedioPago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img src="<?php echo e($xMedioPago->icono); ?>" title="<?php echo e($xMedioPago->nombre); ?>" alt="">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                
                <div class="col-12">
                    <div class="gateway d-lg-flex" name="contenedor-gateway" id="contenedor_0">

                        <div class="col-lg-6 col-sm-12 tipo-entrega">
                            <ul>
                                <li>
                                    <input type="radio" class="ecommerce" name="radio-group" id="gateway-directo" data-modo="0">
                                    <label for="gateway-directo"><img class="logo-gateway" src="<?php echo e(asset('images/iconos/naranja.png')); ?>" alt=""></label>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <form action="" class='form-gateway'  method="post" id="form-gateway" name="form-gateway" >
                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Email:</p><input class="form-control" type="email" name="email" placeholder="Escriba su email">
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Nº de tarjeta:</p><input class="form-control" type="text" placeholder="Escriba los numeros de su tarjeta" id="cardNumber" data-checkout="cardNumber"  onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" >
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <span id="nombTarj" class="nombre-tarjeta"> </span>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Código de seguridad:</p><input class="form-control" type="text" placeholder="Escriba el código de seguridad de su tarjeta" id="securityCode" data-checkout="securityCode" nselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off">
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Tarjeta:</p>
                                        <div id="select-orden">
                                            <select id="issuer" name="issuer" class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Tarjetas..."></select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Mes de Vencimiento:</p><input class="form-control" type="text" placeholder="Escriba mes de vencimiento de su tarjeta" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off">
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Año de Vencimiento:</p><input class="form-control" type="text" placeholder="Escriba año de vencimiento de su tarjeta" id="cardExpirationYear" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Nombre de titular:</p><input class="form-control" type="text" placeholder="Escriba el nombre del titular de la tarjeta" id="cardholderName" data-checkout="cardholderName" >
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Tipo de documento:</p>
                                        <div id="select-orden">
                                            <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" id="docType" data-checkout="docType" title="Documentos..."></select>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Nº de documento:</p><input class="form-control" type="text" placeholder="Escriba su documento" id="docNumber" data-checkout="docNumber">
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <p>Cuotas:</p>
                                        <div id="select-orden">
                                            <select id="installments"  onchange="CFT(this)" name="installments" class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Cuotas..."></select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <label for="" class="total" id="totsinC" >
                                            <span id="CostoFTU"> </span>
                                            <span id="CostoFT"> CFT:</span>
                                        </label>
                                    </div>

                                    <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
                                    <label for="" class="total" id="totCint" >
                                        </label>
                                    </div>
                                    <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
                                        <input type="hidden" name="paymentMethodId" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-lg-5 offset-lg-6 col-md-8 offset-md-4 col-sm-8 offset-sm-2 p-md-3 p-sm-0 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
                        <h1>SUBTOTAL: 
                            <?php if(!empty($oCarrito->subTotal)): ?>
                                <span>$<?php echo e($oCarrito->subTotal); ?></span>
                            <?php else: ?>
                                <span>$0</span>
                            <?php endif; ?>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-6 col-md-8 offset-md-4 col-sm-8 offset-sm-2 p-md-3 p-sm-0 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
                            <h1>COSTO DE ENVÍO:<span>
                                <?php if(!empty($oCarrito->envio->costo)): ?>
                                    <span>$<?php echo e($oCarrito->envio->costo); ?></span>
                                <?php else: ?>
                                    <span>$0</span>
                                <?php endif; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-6 col-md-8 offset-md-4 col-sm-8 offset-sm-2 p-md-3 p-sm-0 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex">
                        <h1>TOTAL:
                            <?php if(!empty($oCarrito->costoTotal)): ?>
                                <span>$<?php echo e($oCarrito->costoTotal); ?></span>
                            <?php else: ?>
                                <span>$0</span>
                            <?php endif; ?>
                        </h1><strong>(IVA incluido)</strong>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-6 col-md-4 offset-md-4 col-sm-8 offset-sm-2">
                <a href="" id="btn-pago" class="siguiente-carrito justify-content-center btn-disabled">PAGAR</a>
            </div>

            


        </div>
    </div>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/carrito/pago.blade.php ENDPATH**/ ?>