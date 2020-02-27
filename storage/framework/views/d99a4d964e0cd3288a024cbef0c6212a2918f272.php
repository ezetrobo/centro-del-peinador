<?php $__env->startSection('title', ' | Catalogo'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- VISTA DE PRODUCTO CON VARIAS PRESENTACIONES -->
    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p class="subtitulo">PASO 1 DE 3</p>
                    <p>CARRITO</p>
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
                <li><a href="<?php echo e(url()->previous()); ?>"><img class="pr-3" src="<?php echo e(asset('images/iconos/go-back.png')); ?>" alt=""></a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/catalogo')); ?>">Productos</a></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row tabla-carrito">

                <div class="col-md-6 col-lg-5">
                    <p class="text-initial">PRODUCTO</p>
                </div>

                <div class="col-md-2 col-lg-3">
                    <p>CANTIDAD</p>
                </div>

                <div class="col-md-2">
                    <p>PRECIO UNITARIO</p>
                </div>

                <div class="col-md-2">
                    <p class="text-initial">SUBTOTAL</p>
                </div>
            </div>


            <div class="row" id="contenedor-modulo">
                <?php echo $__env->make('carrito.modulos.productos-carrito', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>


            <div class="row">
                <div class="col-12 mt-4 mt-lg-5 mb-lg-4">
                    <a href="" class="seguir-compra borrar-todo">BORRAR TODO</a>
                    <a href="<?php echo e(URL('/catalogo')); ?>" class="seguir-compra">SEGUIR COMPRANDO</a>
                </div>
            </div>

            <div class="d-lg-flex">
                <div class="col-lg-6 col-xl-5 p-0">
                    <div class="row titulo-seccion">
                        <div class="col-12 col-sm-7 col-md-8 col-lg-12 p-0">
                            <hr>
                            <hr>
                        </div>
                        <div class="col-12">
                            <h1>CÓDIGO DE DESCUENTO (OPCIONAL):</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-12 descuento">
                            <p>INGRESAR CÓDIGO DE DESCUENTO</p>
                            <div class="d-md-flex justify-content-md-between">
                                <input class="form-control" type="text" id="txt_descuento" value="<?php if(!empty(session('carrito')->descuento->codigo)): ?> <?php echo e(session('carrito')->descuento->codigo); ?><?php endif; ?>" placeholder="Código de descuento" aria-label="Search">
                                <a href="" class="btn-aplicar" id="btn-descuento">APLICAR</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 offset-xl-2 p-0">
                    <div class="row titulo-seccion">

                        <div class="col-12 col-sm-7 col-lg-12 p-0">
                            <hr>
                            <hr>
                        </div>
                        <div class="col-12 col-sm-7 col-lg-12">
                            <h1>TIPO DE ENTREGA:</h1>
                        </div>
                    </div>

                    <?php if(!empty($eCommerce)): ?>
                        <div class="row tipo-entrega">
                            <div class="col-12 col-sm-7 col-lg-12">
                                <ul>
                                    <?php if($eCommerce->RetiroLocal): ?>
                                        <li>
                                            <input type="radio" id="1" name="radio-group" class="opciones-envio" data-id="1" onchange="changeEntrega(1,1)">
                                            <label for="1">Retiro por sucursal</label>
                                        </li>
                                        <div class="collapse" id="collapse_1"></div>
                                    <?php endif; ?>

                                    <?php if(!empty($eCommerce->eCommerceTipoEnvio)): ?>
                                        <?php $__currentLoopData = $eCommerce->eCommerceTipoEnvio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEcommerce): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <input type="radio" id="<?php echo e($xEcommerce->idEcommerceTipo); ?>" data-id="<?php echo e($xEcommerce->idEcommerceTipo); ?>" name="radio-group" class="opciones-envio">
                                                <label name="zona-envio" for="<?php echo e($xEcommerce->idEcommerceTipo); ?>"><?php echo e($xEcommerce->nombre); ?></label>
                                            </li>
                                            
                                            <div class="collapse" id="collapse_<?php echo e($xEcommerce->idEcommerceTipo); ?>" >
                                                <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                    <p>Elegir zona:</p>
                                                    
                                                    <?php if(!empty($xEcommerce->listaCostoEnvioZona)): ?>
                                                        <div id="select-orden" class="select-envio">
                                                            <select class="selectpicker show-menu-arrow tipoEntrega" data-id="<?php echo e($xEcommerce->idEcommerceTipo); ?>" id="zona-envio_<?php echo e($xEcommerce->idEcommerceTipo); ?>" data-style="form-control" onchange="changeEntrega($(this).val(),<?php echo e($xEcommerce->idEcommerceTipo); ?>)" >
                                                                <option value="0">Seleccione una opcion</option>
                                                                <?php $__currentLoopData = $xEcommerce->listaCostoEnvioZona; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xZona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option name="<?php echo e($xEcommerce->idEcommerceTipo); ?>" value="<?php echo e($xZona->idCostoEnvioZona); ?>" data-tokens="opcion"><?php echo e($xZona->nombre); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_subtotal">
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

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_costoEnvio">
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
            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_descuento">
                        <h1>DESCUENTO:<span>
                            <?php if(!empty($oCarrito->descuento->monto)): ?>
                                <span>$<?php echo e($oCarrito->descuento->monto); ?></span>
                            <?php else: ?>
                                <span>$0</span>
                            <?php endif; ?>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-7 p-0">
                <div class="row titulo-seccion">

                    <div class="col-12 col-sm-7 col-lg-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12 col-sm-7 col-lg-12 d-flex" id="carrito_total">
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

            
            <div class="row">
                <div class="col-12 col-sm-7 col-lg-5 offset-lg-7 p-0">
                    <a href="<?php echo e(url('datos')); ?>" class="siguiente-carrito <?php if(!empty($oCarrito->productos)): ?> btn-disabled <?php endif; ?>">CONTINUAR <img src="<?php echo e(asset('images/iconos/siguiente.png')); ?>" alt=""></a>
                </div>
            </div>
        </div>
    </div>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/carrito/compra.blade.php ENDPATH**/ ?>