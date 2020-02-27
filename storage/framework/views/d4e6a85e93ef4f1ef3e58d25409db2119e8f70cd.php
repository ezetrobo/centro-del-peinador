<div id="carousel-marcas">
    <?php if(!empty($oContenido)): ?>
        <div id="contenedor-producto" class="pt-5">

            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1><?php echo e($oContenido[0]->titulo); ?></h1>
                    </div>
                </div>
            </div>

            <div class="container p-0">
                <div id="carousel-marca" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="2, 2, 3, 4, 5">
                    
                        <a class="carousel-control-prev" href="#carousel-marca" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-marca" role="button" data-slide="next">
                            <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    <div class="carousel-inner" role="listbox">
                        <?php if(!empty($oContenido[0]->imagenes)): ?>
                            <?php $__currentLoopData = $oContenido[0]->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenidoMarcas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?> ">
                                    <img src="<?php echo e($xContenidoMarcas->path); ?>" alt="">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/secciones/_9300.blade.php ENDPATH**/ ?>