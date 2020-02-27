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

        <!-- BOTONES DEL FILTRO EN VERSION MOBILE -->
        <div class="container-fluid p-0 d-lg-none d-md-block">
            <div class="row m-0">
                <button class="btn-categorias toggle-wrap"> CATEGORÍAS <img src="<?php echo e(asset('images/iconos/down.png')); ?>" alt=""></button>
            </div>
            <div class="row m-0">
                <div class="col-6 p-0">
                    <button class="btn-filtros button-orden">ORDENAR POR <img src="<?php echo e(asset('images/iconos/down.png')); ?>" alt=""></button>
                </div>
                <div class="col-6 p-0">
                    <button class="btn-marcas button-filtro"> FILTRAR<img src="<?php echo e(asset('images/iconos/filtro.png')); ?>" alt=""></button>
                </div>
            </div>
        </div>

        <div id="contenedor-producto" class="catalogo">

            <div class="container p-lg-0" id="titulo-producto">
                <nav aria-label="breadcrumb" class="d-none d-sm-block">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Inicio</a></li>
                      <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/catalogo')); ?>">Productos</a></li>
                    </ol>
                </nav>
                <div class="d-flex">

                    <div class="col-xl-6 p-lg-0">
                        <h1 class="titulo-catalogo"><?php echo e($xCategoria); ?></h1>
                    </div>

                    <!-- FILTRO DE "ORDENAR POR" VERSIÓN PC -->
                    <div class="col-xl-6 d-flex justify-content-end" id="select-orden">
                        <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true"  title="ORDENAR POR">
                            <option value="orden" data-tokens="order1">Predeterminado</option>
                            <option value="desc" data-tokens="order2">Alfabetico A - Z</option>
                            <option value="asc" data-tokens="order3">Alfabetico Z - A</option>
                            <option value="mayor" data-tokens="order4">Mayor Precio</option>
                            <option value="menor" data-tokens="order5">Menor Precio</option>
                        </select>
                    </div>
                </div>
                

            </div>

            
                <div class="container pl-sm-0 pr-sm-0">
                    <div class="row">
                        <div class="col-lg-3 mt-3" id="menu-catalogo">
                            <hr class="d-lg-block d-none">
                            <hr class="d-lg-block d-none">
                            <div class="col-12 p-0" id="categorias">
                                <div id="accordion" class="menu-categorias">
                                    <div class="head-categorias">
                                        <h1 class="head-titulo">CATEGORÍAS</h1>
                                        <a class="cerrar-buscador toggle-wrap d-xl-none d-lg-none"> <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt=""></a>
                                    </div>

                                    <?php if(!empty($oCategorias[0]->categorias)): ?>
                                        <?php $__currentLoopData = $oCategorias[0]->categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xCategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card">
                                                <div class="card-header">
                                                    <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#categoria<?php echo e($key); ?>" aria-expanded="true" aria-controls="categoria<?php echo e($key); ?>">
                                                        <span><?php echo e($xCategoria->nombre); ?></span>
                                                    </button>
                                                </div>
                                                
                                                <div id="categoria<?php echo e($key); ?>" class="collapse item-categoria" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php if(!empty($xCategoria->categorias)): ?>
                                                            <ul>
                                                                <?php $__currentLoopData = $xCategoria->categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xSubCategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><a class="<?php echo e((request()->idCategoria ==$xSubCategoria->idCategoria ) ? 'active' : ''); ?>" href="<?php echo e(URL($xSubCategoria->getLink($xSubCategoria->idCategoria))); ?>"><?php echo e($xSubCategoria->nombre); ?></a></li>
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

                            <?php if(!empty($oCatalogo->etiquetas)): ?>
                                <?php echo $__env->make('catalogo.modulos.etiquetas', compact('oCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>


                        
                        <div class="col-lg-9">
                            <div class="row listado-catalogo m-0">
                                <?php if(!empty($oCatalogo->productos)): ?>
                                    <?php $__currentLoopData = $oCatalogo->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(trim($xCatalogo->puntos) == 2): ?>
                                            <?php echo $__env->make('catalogo.modulos.producto2', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php elseif(trim($xCatalogo->puntos) == 3 || trim($xCatalogo->puntos == 4) ): ?>
                                            <?php echo $__env->make('catalogo.modulos.producto3', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php else: ?>
                                            <?php echo $__env->make('catalogo.modulos.producto1', compact('xCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/categoria-seleccionada.blade.php ENDPATH**/ ?>