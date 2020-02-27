<?php if(!empty($oContenido)): ?>
    <div class="container-fluid" id="banner-calculador">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $oContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($xContenido->portada): ?>
                        <div class="col-12">
                    <?php else: ?>
                        <div class="col-sm-6">
                    <?php endif; ?>
                            <a href="<?php echo e($xContenido->link); ?>">
                                <div class="centrar-img">
                                    <?php echo e($xContenido->printImagenes()); ?>

                                </div>
                            </a>
                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/secciones/_9299.blade.php ENDPATH**/ ?>