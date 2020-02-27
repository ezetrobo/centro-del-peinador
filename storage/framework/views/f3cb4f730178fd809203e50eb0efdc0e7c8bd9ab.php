<?php $__env->startSection('title', ' | Productos'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- VISTA DE PRODUCTO ESTANDAR -->
    
    <div id="head-section" class="d-none d-md-block">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>PRODUCTOS</p>
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

<?php if(!empty($oProducto)): ?>
    <div id="contenedor-producto" class="producto">

        <div class="container p-lg-0" id="titulo-producto">
              <nav aria-label="breadcrumb" class="d-none d-sm-block">
                  <ol class="breadcrumb">
                    <li><a href="<?php echo e(url()->previous()); ?>"><img class="pr-3" src="<?php echo e(asset('images/iconos/go-back.png')); ?>" alt=""></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/catalogo')); ?>">Productos</a></li>
                  </ol>
              </nav>
        </div>
        <div class="container pb-5 pl-sm-0 pr-sm-0">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4 p-md-4 p-0">
                    <div class="container p-0" id="contenedor-carouselprod">
                        <div id="carousel-producto" class="modulo-producto carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 1, 1, 1, 1">
                            <div class="carousel-inner carrusel-sawubona" role="listbox">
                                <?php if(!empty($oProducto->imagenes)): ?>
                                    <?php $__currentLoopData = $oProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagenes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?> " >
                                            <div class="contenedor-info">
                                                <?php if($oProducto->productoNuevo): ?>
                                                    <p class="producto-nuevo">Nuevo</p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="imagen-producto">
                                                <div class="centrar-img">
                                                    <img src="<?php echo e(asset($xImagenes->path)); ?>" alt="">
                                                </div>
                                            </div>
                                        
                                            <div class="contenedor-descuentos">
                                                <?php if($oProducto->descuento): ?>
                                                    <span class="badge cocarda-descuento"> -<?php echo e($oProducto->valorCocarda); ?>% </span>
                                                <?php endif; ?>

                                                <?php if($oProducto->envioBonificado): ?>
                                                    <span class="badge cocarda-envio"> Envío <br> gratis </span>
                                                <?php endif; ?>

                                                <?php if($oProducto->combo): ?>
                                                    <span class="badge cocarda-regalo"> <img src="<?php echo e(asset('images/iconos/regalo.png')); ?>" alt=""> </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                            <?php if(!empty($oProducto->imagenes)): ?>
                                <?php if(count($oProducto->imagenes) > 1): ?>
                                    <ol class="carousel-indicators d-none d-md-flex" id="carousel-indicators">
                                        <?php $__currentLoopData = $oProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagenes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-target="#carousel-productos" data-slide-to="<?php echo e($key); ?>" class="<?php if($key == 0): ?> active <?php endif; ?>"></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div id="descripcion-producto" class="col-xl-6 offset-xl-1 col-lg-7 offset-lg-1 col-md-8 pt-4"> 
                <h1 class="titulo-ampliado"><?php echo e($oProducto->titulo); ?></h1>

                <div class="collapse-descripcion">
                    <a class="cambio-icono icono- btn-descripcion collapsed d-flex d-sm-none" type="button" data-target="#descripcion-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="descripcion-prod">
                        Descripción
                    </a>
                    <div id="descripcion-prod" class="collapse">
                        <p class="descripcion-producto">
                            <?php echo e(strip_tags($oProducto->descripcion)); ?>

                        </p>
                    </div>
                </div>

                

                <?php if($oProducto->puntos == 2): ?>
                    
                    <?php if(!empty($oProducto->productos)): ?>
                        <div id="modulo2">
                            <div class="contenedor-presentacion">
                                <ul class="presentaciones-prod">
                                    <?php $__currentLoopData = $oProducto->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $catalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <input data-id="<?php echo e($catalogo->idProducto); ?>" data-codigo="<?php echo e($catalogo->codigoInterno); ?>" data-stock="<?php echo e($catalogo->stocks[0]); ?>"  class="label-checkbox" type="radio" id="<?php echo e($catalogo->idProducto); ?>" name="radio-group">
                                            <label for="<?php echo e($catalogo->idProducto); ?>"><?php echo e($catalogo->volumen); ?> ml. </label>
                                            <?php if($catalogo->descuento): ?>
                                                <span>$<?php echo e($catalogo->precioTachado); ?></span> 
                                            <?php endif; ?>
                                            <strong>$<?php echo e($catalogo->precioFinal); ?></strong>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="collapse-detalles">
                                <hr class="line-vertical d-none d-sm-block">
                                <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                    Detalles de producto
                                </a>
                                <div id="atributo-prod" class="collapse">
                                    <ul class="atributos-producto">
                                        <?php if(!empty($oProducto->etiquetasxProducto)): ?>
                                            <?php $__currentLoopData = $oProducto->etiquetasxProducto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($xProducto->id == Config('parametros.idEtiquetaColor') || $xProducto->id == Config('parametros.idEtiquetaMarca')): ?>
                                                    <li>
                                                        <strong><?php echo e($xProducto->nombre); ?>:</strong> 
                                                        <?php if(!empty($xProducto->valores[0]->nombre)): ?>
                                                            <?php echo e($xProducto->valores[0]->nombre); ?>

                                                        <?php endif; ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <li><strong>Codigo de producto:</strong> <?php echo e($oProducto->codigoInterno); ?></li>
                                        <li>
                                            <strong>Stock:</strong>
                                            <span id="disponibilidad-prod">
                                                
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-presentaciones">
                                <div class="cantidad mt-4">
                                    <span class="minus">-</span>
                                    <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                                    <span class="plus">+</span>
                                </div>
                                <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="0">
                                    <img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">AGREGAR AL CARRITO
                                </button>
                                <div class="prod-agregado">
                                    <span>¡Producto agregado!</span>
                                </div>
                            </div>
                        </div>                
                    <?php endif; ?>
                <?php elseif($oProducto->puntos == 3 || $oProducto->puntos == 4 ): ?>
                    
                    <div id="modulo3">
                        <p class="precio-unitario">Precio unitario:</p>
                        <div class="precio">
                            <?php if($oProducto->descuento): ?>
                                <span class="tachado">$<?php echo e($oProducto->precioTachado); ?></span>
                            <?php endif; ?>
                            <span class="descuento">$<?php echo e($oProducto->precioFinal); ?></span>
                        </div>

                        <form class="buscador-esmalte mt-4" action="">
                            <?php if($oProducto->puntos == 3): ?>
                                <p class="precio-unitario">BUSCAR ESMALTE ESPECÍFICO</p>
                                
                                <select id="searchEsmalte" style="width: 100%">
                                    <option value="">Nombre o número de esmalte</option>
                                    <?php if(!empty($oProducto->vEtiquetas)): ?>
                                        <?php $__currentLoopData = $oProducto->vEtiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($xEtiqueta['productos'])): ?>
                                                <?php $__currentLoopData = $xEtiqueta['productos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($xProducto->idProducto); ?>"><?php echo e($xProducto->codigoInterno); ?> - <?php echo e($xProducto->titulo); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>                                    
                                
                            <?php else: ?>
                                <p class="precio-unitario">BUSCAR POR Nº DE TINTURA</p>
                                <div class="d-flex justify-content-between calculador-tinta">
                                    <select id="searchEsmalte" style="width: 100%">
                                        <option value="">Nombre o número de esmalte</option>
                                        <?php if(!empty($oProducto->vEtiquetas)): ?>
                                            <?php $__currentLoopData = $oProducto->vEtiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($xEtiqueta['productos'])): ?>
                                                    <?php $__currentLoopData = $xEtiqueta['productos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($xProducto->idProducto); ?>"><?php echo e($xProducto->codigoInterno); ?> - <?php echo e($xProducto->titulo); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>

                                    <button class="btn-calcular d-none">CALCULÁ TU TONO DE TINTURA</button>
                                </div>
                            <?php endif; ?>
                            
                        </form>
                        
                        <div class="lista-color d-block d-sm-none">
                            <p class="precio-unitario mt-4 d-block d-sm-none">SELECCIONAR COLOR DE UNA LISTA</p>
                            <p class="precio-unitario mt-4 d-none d-sm-block">SELECCIONAR COLOR</p>
                            <button class="btn-color toggle-wrap"> Elegir un color</button>
                        </div>

                        <div class="d-block d-sm-none">
                            <div class="cantidad mt-4">
                                <span class="minus">-</span>
                                <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                                <span class="plus">+</span>
                            </div>
            
                            <button class="btn agregar-carrito mt-3  btn-add-carrito" data-id="0" id="btn-add-carrito-mobile">
                                <img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">AGREGAR AL CARRITO
                            </button>
                            <div class="prod-agregado">
                                <span>¡Producto agregado!</span>
                            </div>
                        </div>

                        <div class="buscador-tipo mt-4 mb-4">
                            <div class="bg-buscador">
                                <div class="head-buscador d-flex d-sm-none">
                                    <p class="precio-unitario mb-0">SELECCIONAR COLOR</p>
                                    <a class="cerrar-buscador toggle-wrap"> <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt=""></a>
                                </div>
                                <?php if(!empty($oProducto->vEtiquetas)): ?>
                                    <?php $__currentLoopData = $oProducto->vEtiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tipo">
                                            <a class="cambio-icono icono- btn-tipo collapsed" type="button" data-target="#tipo<?php echo e($key); ?>" data-toggle="collapse">
                                                <?php echo e($xEtiqueta['nombre']); ?> <span class="d-block d-sm-none d-color_<?php echo e($key); ?>"></span>
                                            </a>

                                            <div class="collapse" id="tipo<?php echo e($key); ?>">
                                                <div class="d-flex">
                                                    <?php if($oProducto->puntos == 3): ?>
                                                        <ul id="color">
                                                        <?php if(!empty($xEtiqueta['productos'])): ?>
                                                            <?php $__currentLoopData = $xEtiqueta['productos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <a href="" class="btn-change-producto" data-color="<?php echo e($xProducto->titulo); ?>" data-stock="<?php echo e($xProducto->stocks[0]); ?>" data-codigo="<?php echo e($xProducto->codigoInterno); ?>" data-id="<?php echo e($key); ?>" data-producto="<?php echo e($xProducto->idProducto); ?>"  data-path="<?php if(!empty($xProducto->imagenes[0])): ?> <?php echo e($xProducto->imagenes[0]->path); ?> <?php endif; ?>"  data-descuento="<?php echo e($xProducto->descuento); ?>" data-bonificado="<?php echo e($xProducto->envioBonificado); ?>"
                                                                        data-nuevo="<?php echo e($xProducto->productoNuevo); ?>" data-combo="<?php echo e($xProducto->combo); ?>" data-estado="0" data-valorDescuento="<?php echo e($xProducto->valorCocarda); ?>">
                                                                        <div class="color"  style="background-color: <?php echo e($xProducto->color); ?>;"></div>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        </ul>
                                                    <?php elseif($oProducto->puntos == 4): ?>
                                                        <div class="contenedor-presentacion">
                                                            <ul class="presentaciones-prod">
                                                                <?php $__currentLoopData = $xEtiqueta['productos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($xProducto->color)): ?>
                                                                        <li>
                                                                            <input type="radio" id="<?php echo e($xProducto->idProducto); ?>" name="radio-group">
                                                                            <label for="<?php echo e($xProducto->idProducto); ?>" class="btn-change-producto" data-color="<?php echo e($xProducto->titulo); ?>" data-stock="<?php echo e($xProducto->stocks[0]); ?>" data-codigo="<?php echo e($xProducto->codigoInterno); ?>" data-id="<?php echo e($key); ?>" data-producto="<?php echo e($xProducto->idProducto); ?>" data-path="<?php if(!empty($xProducto->imagenes[0])): ?> <?php echo e($xProducto->imagenes[0]->path); ?> <?php endif; ?>"  data-descuento="<?php echo e($xProducto->descuento); ?>" data-bonificado="<?php echo e($xProducto->envioBonificado); ?>" data-nuevo="<?php echo e($xProducto->productoNuevo); ?>" data-combo="<?php echo e($xProducto->combo); ?>" data-estado="0" data-valorDescuento="<?php echo e($xProducto->valorCocarda); ?>"><?php echo e($xProducto->color); ?></label>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                    <hr class="divider-tipo d-none d-sm-block">
                                                    <ul class="atributos-producto d-none d-sm-block">
                                                        <li>
                                                            <strong>Color:</strong> 
                                                            <span id="color_<?php echo e($key); ?>" class="span_color"></span>
                                                        </li>
                                                        <?php if(!empty($oProducto->etiquetasxProducto)): ?>
                                                            <?php $__currentLoopData = $oProducto->etiquetasxProducto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($xProducto->id == Config('parametros.idEtiquetaMarca') ): ?>
                                                                    <li>
                                                                        <strong><?php echo e($xProducto->nombre); ?>:</strong> 
                                                                        <?php if(!empty($xProducto->valores[0]->nombre)): ?>
                                                                            <?php echo e($xProducto->valores[0]->nombre); ?>

                                                                        <?php endif; ?>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        <li>
                                                            <strong>Código de producto:</strong>
                                                            <span id="codigo_<?php echo e($key); ?>" class="span_codigo"></span>
                                                        </li>
                                                        <li>
                                                            <strong>Stock:</strong> 
                                                            <span id="stock_<?php echo e($key); ?>" class="span_stock"></span>
                                                        </li>
                                                        <div class="cantidad mt-4">
                                                            <span class="minus">-</span>
                                                            <input class="count" name="quantity" id="quantity_<?php echo e($key); ?>" value="1" step="6" type="number">
                                                            <span class="plus">+</span>
                                                        </div>
                                        
                                                        <button class="btn agregar-carrito mt-3 add_<?php echo e($key); ?> btn-add-carrito" data-aux="<?php echo e($key); ?>" data-id="0">
                                                            <img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">AGREGAR AL CARRITO
                                                        </button>
                                                        <div class="prod-agregado">
                                                            <span>¡Producto agregado!</span>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="collapse-detalles d-block d-sm-none" id="tinturas">
                            <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                Detalles de producto
                            </a>
                            <div id="atributo-prod" class="collapse">
                                <ul class="atributos-producto">
                                    <?php if(!empty($oProducto->etiquetasxProducto)): ?>
                                        <?php $__currentLoopData = $oProducto->etiquetasxProducto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($xProducto->id == Config('parametros.idEtiquetaColor') || $xProducto->id == Config('parametros.idEtiquetaMarca') ): ?>
                                                <li>
                                                    <strong><?php echo e($xProducto->nombre); ?>:</strong> 
                                                    <?php if(!empty($xProducto->valores[0]->nombre)): ?>
                                                        <?php echo e($xProducto->valores[0]->nombre); ?>

                                                    <?php endif; ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <li>
                                        <strong>Codigo de producto:</strong> <?php echo e($oProducto->codigoInterno); ?>

                                    </li>
                                    <li>
                                        <strong>Stock:</strong>
                                        <span id="disponibilidad-prod"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    
                    <div id="modulo1">
                        <p class="precio-unitario">Precio unitario:</p>
                        <div class="precio">
                            <?php if($oProducto->descuento): ?>
                                <span class="tachado">$<?php echo e($oProducto->precioTachado); ?></span>
                            <?php endif; ?>
                            <span class="descuento">$<?php echo e($oProducto->precioFinal); ?></span>
                        </div>
                        
                        <div class="collapse-detalles" id="tinturas">
                            <a class="cambio-icono icono- btn-detalles collapsed d-flex d-sm-none" type="button" data-target="#atributo-prod"  data-toggle="collapse" aria-expanded="false" aria-controls="atributo-prod">
                                Detalles de producto
                            </a>
                            <div id="atributo-prod" class="collapse">
                                <ul class="atributos-producto">
                                    <?php if(!empty($oProducto->etiquetasxProducto)): ?>
                                        <?php $__currentLoopData = $oProducto->etiquetasxProducto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($xProducto->id == Config('parametros.idEtiquetaColor')): ?>
                                                <li>
                                                    <strong><?php echo e($xProducto->nombre); ?>:</strong> 
                                                    <?php if(!empty($xProducto->valores[0]->nombre)): ?>
                                                        <?php echo e($oProducto->color); ?>

                                                    <?php endif; ?>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($xProducto->id == Config('parametros.idEtiquetaMarca') ): ?>
                                                <li>
                                                    <strong><?php echo e($xProducto->nombre); ?>:</strong> 
                                                    <?php if(!empty($xProducto->valores[0]->nombre)): ?>
                                                        <?php echo e($xProducto->valores[0]->nombre); ?>

                                                    <?php endif; ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <li>
                                        <strong>Codigo de producto:</strong> <?php echo e($oProducto->codigoInterno); ?>

                                    </li>
                                    <li>
                                        <strong>Stock:</strong>
                                        <?php if($oProducto->stocks[0] > 0): ?>
                                            Diponible
                                        <?php else: ?>
                                            <span class="alert-stock">No Disponible</span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="cantidad mt-4">
                            <span class="minus">-</span>
                            <input class="count" name="quantity" id="quantity" value="1" step="6" type="number">
                            <span class="plus">+</span>
                        </div>
                        <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="<?php echo e($oProducto->idProducto); ?>">
                            <img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">AGREGAR AL CARRITO
                        </button>
                        <div class="prod-agregado">
                            <span>¡Producto agregado!</span>
                        </div>
                    </div>
                <?php endif; ?>

                
                </div>
            </div>
        </div>

        <?php if(!empty($vRelacionados)): ?>
            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1>Productos Relacionados</h1>
                    </div>
                </div>
            </div>
            <div class="container p-md-0">
                <div id="carousel-productos" class="carousel relacionados carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 1, 2, 3, 4">
                                
                    <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <ol class="carousel-indicators">
                            <?php $__currentLoopData = $vRelacionados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-target="#carousel-productos" data-slide-to="<?php echo e($key1); ?>" class="<?php if($key1 == 0): ?> active <?php endif; ?>"></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                            <?php $__currentLoopData = $vRelacionados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php if($key1 == 0): ?> active <?php endif; ?>">
                                    <?php if(trim($xCatalogo->puntos) == 2): ?>
                                        <?php echo $__env->make('catalogo.modulos.producto2', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php elseif(trim($xCatalogo->puntos) == 3): ?>
                                        <?php echo $__env->make('catalogo.modulos.producto3', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                        <?php echo $__env->make('catalogo.modulos.producto1', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
    
    
    

        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/producto-ampliado.blade.php ENDPATH**/ ?>