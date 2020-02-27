<?php if(!empty($oContenido)): ?>
    <?php $__currentLoopData = $oContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div id="contenedor-producto">
            <div class="container" id="titulo-producto">
                <div class="row">
                    <div class="col-12 p-0">
                        <hr>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h1><?php echo e($xContenido->titulo); ?></h1>
                    </div>
                </div>
            </div>

            <div class="container p-0">
                <div id="carousel-productos2" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="2,2,2,3,4">
                    
                        <a class="carousel-control-prev" href="#carousel-productos2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-productos2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    <div class="carousel-inner" role="listbox">
                        <?php if(!empty($xContenido->catalogo)): ?>
                            <?php $__currentLoopData = $xContenido->catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/secciones/_9297.blade.php ENDPATH**/ ?>