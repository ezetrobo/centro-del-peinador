<?php $__env->startSection('title', ' | Empresa'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid" id="slider-seccion">
        <div class="carousel slide carousel-fade" id="carousel-empresa" data-ride="carousel" data-interval="false">
            <div class="container p-0">
                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                    <a class="carousel-control-prev" href="#carousel-empresa" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                
                    <a class="carousel-control-next" href="#carousel-empresa" role="button" data-slide="next">
                        <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <?php if(!empty($vContenido)): ?>
                        <ol class="carousel-indicators">
                            <?php $__currentLoopData = $vContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li data-target="#carousel-empresa" data-slide-to="<?php echo e($key); ?>" class="<?php if($key == 0): ?> active <?php endif; ?>"></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Indicadores -->

            <!-- Imagenes del slide -->
            
            <?php if(!empty($vContenido)): ?>
                <div class="carousel-inner">
                    <?php $__currentLoopData = $vContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($xContenido['portada']): ?>
                            <?php if(!empty($xContenido['contenido'])): ?>
                                <?php $__currentLoopData = $xContenido['contenido']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xDestacado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <div class="carousel-item <?php if($key1 == 0): ?> active <?php endif; ?>">
                                        <div class="overlay"><img src="<?php echo e(asset('images/empresa/filtro-empresa.png')); ?>" alt=""></div>
                                        <div class="centrar-img">
                                            <?php echo e($xDestacado->printImagenes(1)); ?>

                                        </div>
                                        <div class="caption" id="caption-1">
                                            <div class="container pl-0 pr-0">
                                                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                                                    <div class="titulo-slide"><p><?php echo e($xDestacado->titulo); ?></p></div>
                                                </div>
                                                <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12">
                                                    <div class="descripcion-slide">
                                                        <?php echo $xDestacado->descripcion; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="carousel-item">
                                <div class="overlay"><img src="<?php echo e(asset('images/empresa/filtro-empresa.png')); ?>" alt=""></div>
                                <div class="centrar-img">
                                    <?php if(!empty($xContenido['contenido'][0]->imagenes[0]->path)): ?>
                                        <img src="<?php echo e($xContenido['contenido'][0]->imagenes[0]->path); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="caption" id="caption-2">
                                    <div class="container pl-0 pr-0 d-md-flex d-sm-block">
                                        <?php if(!empty($xContenido['contenido'])): ?>
                                            <?php $__currentLoopData = $xContenido['contenido']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $xAdicional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="caption-cuadro">
                                                        <div class="titulo-slide"><p><?php echo e($xAdicional->titulo); ?></p></div>
                                                        <div class="descripcion-slide">
                                                            <?php echo $xAdicional->descripcion; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($oContenido)): ?>
        <div id="contenedor-empresa">
            <div class="container">
                <div class="row">
                    <?php $__currentLoopData = $oContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-12">
                            <div class="info-empresa" id="info-1">
                                <?php echo e($xContenido->printImagenes(1)); ?>

                                <h1><?php echo e($xContenido->titulo); ?></h1>
                                <?php echo $xContenido->descripcion; ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/empresa/index.blade.php ENDPATH**/ ?>