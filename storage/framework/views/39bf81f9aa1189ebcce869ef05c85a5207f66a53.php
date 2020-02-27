<?php if(!empty($oContenido)): ?>
    <div class="tinturas-home">
        <div class="container-fluid p-sm-0 p-0">
            <?php $__currentLoopData = $oContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="contenedor-calculador">
                    <div class="centrar-img mujer-calculador">
                        <?php echo e($xContenido->printImagenes()); ?>

                    </div>
                    <div class="centrar-img bg-calculador">
                        <img class="" src="<?php echo e(asset('images/home/bg-calculador.jpg')); ?>" alt="">
                        <div class="info-calculador">
                            <h1><?php echo e($xContenido->titulo); ?></h1>
                            <p><?php echo e($xContenido->bajada); ?></p>
                            <a href="<?php echo e($xContenido->link); ?>" class="btn-lg btn-calculador"><?php echo e($xContenido->subtitulo); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/secciones/_9515.blade.php ENDPATH**/ ?>