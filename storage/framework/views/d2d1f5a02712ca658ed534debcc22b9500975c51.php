<?php $__env->startSection('title', ' | Productos'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="head-section">
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

    <div class="container-fluid p-0 d-lg-none d-md-block">
        <button class="btn-categorias toggle-wrap"> CATEGORÍAS <img src="<?php echo e(asset('images/iconos/down.png')); ?>" alt=""></button>
    </div>

    <div id="contenedor-producto" class="catalogo">

        <div class="container p-xl-0" id="titulo-producto">
            <nav aria-label="breadcrumb" class="d-none d-sm-block">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/catalogo')); ?>">Productos</a></li>
                </ol>
            </nav>

            <h1 class="titulo-catalogo">Destacados</h1>
            <div class="d-lg-flex categorias">
            </div>
        </div>



            <div class="container pl-xl-0 pr-xl-0">
                <div class="row" id="productos-catalogo">
                    <div class="col-xl-3 col-lg-3">
                        <hr class=" d-lg-block d-none">
                        <hr class=" d-lg-block d-none">
                        <h1 class=" d-lg-block d-none mt-4">Categorías</h1>
                        <div class="col-12 p-0" id="categorias">
                            <div id="accordion" class="menu-categorias mb-4">
                                <div class="head-categorias d-xl-none d-lg-none">
                                    <h1 class="head-titulo mb-0">CATEGORÍAS</h1>
                                    <a class="cerrar-buscador toggle-wrap"> <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt=""></a>
                                </div>
                                <?php if(!empty($oCategorias[0]->categorias)): ?>
                                    <?php $__currentLoopData = $oCategorias[0]->categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xCategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <button class="cambio-icono icono- btn btn-link bt-categorias mt-1 mb-1" data-toggle="collapse" data-target="#categoria<?php echo e($key); ?>" aria-expanded="true" aria-controls="categoria<?php echo e($key); ?>">
                                                    <span><?php echo e($xCategoria->nombre); ?></span>
                                                </button>
                                            </div>
                                            <div id="categoria<?php echo e($key); ?>" class="collapse item-categoria" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php if(!empty($xCategoria->categorias)): ?>
                                                        <ul>
                                                            <?php $__currentLoopData = $xCategoria->categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xSubCategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a href="<?php echo e(URL($xSubCategoria->getLink($xSubCategoria->idCategoria))); ?>"><?php echo e($xSubCategoria->nombre); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                        <li><a href="<?php echo e(URL($xCategoria->getLink($xCategoria->idCategoria))); ?>" class="ver-todos">Ver más..</a></li>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <hr class="d-lg-block d-none">
                            <hr class="d-lg-block d-none">
                        </div>

                    </div>
                    
                    <?php if(!empty($oProductos)): ?>
                        <div class="col-xl-9 offset-xl-0 col-lg-8 offset-lg-1 col-md-12">
                            <?php $__currentLoopData = $oProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <hr>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <h1><?php echo e($xContenido->titulo); ?></h1>
                                        </div>
                                    </div>
                                <div id="carousel-productos" class="carousel carousel-responsive slide slide-home mb-5" data-ride="carousel" data-items="1, 1, 2, 2, 3">
                                    <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>

                                    <ol class="carousel-indicators">
                                        <?php if(!empty($xContenido->productos)): ?>
                                            <?php $__currentLoopData = $xContenido->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li data-target="#carousel-productos" data-slide-to="<?php echo e($key1); ?>" class="<?php if($key1 == 0): ?> active <?php endif; ?>"></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </ol>
                                    
                                    <div class="carousel-inner" role="listbox">
                                        <?php if(!empty($xContenido->productos)): ?>
                                            <?php $__currentLoopData = $xContenido->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="carousel-item <?php if($key1 == 0): ?> active <?php endif; ?>">
                                                    <?php if(trim($xCatalogo->puntos) == 2): ?>
                                                        <?php echo $__env->make('catalogo.modulos.producto2', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php elseif(trim($xCatalogo->puntos) == 3 || trim($xCatalogo->puntos == 4) ): ?>
                                                        <?php echo $__env->make('catalogo.modulos.producto3', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php else: ?>
                                                        <?php echo $__env->make('catalogo.modulos.producto1', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/index.blade.php ENDPATH**/ ?>