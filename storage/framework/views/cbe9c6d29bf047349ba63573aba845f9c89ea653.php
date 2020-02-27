<?php if(!empty($oContenido)): ?>
    <div class="container-fluid" id="servicios">
        <div class="container">
            <div class="servicios">
                <div class="row">
                    <?php $__currentLoopData = $oContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="img-servicios">
                                <?php echo e($xContenido->printImagenes()); ?>

                            </div>
                            <h1><?php echo e($xContenido->bajada); ?><br><?php echo e($xContenido->tags); ?></h1>
                            <?php echo $xContenido->descripcion; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/secciones/_9298.blade.php ENDPATH**/ ?>