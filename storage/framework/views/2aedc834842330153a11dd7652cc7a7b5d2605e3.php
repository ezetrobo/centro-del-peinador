<?php if(!empty($xContenido)): ?>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="modulo-evento">
            <div class="centrar-img">
                <img src="<?php echo e(asset('images/eventos/filtro.png')); ?>" alt="" class="filtro-evento">
                <?php if(!empty($xContenido->imagenes)): ?>
                    <?php $__currentLoopData = $xContenido->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($xImagen->nombre == 'logo'): ?>
                            <img src="<?php echo e($xImagen->path); ?>" alt="">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="info-evento">
                <h1><?php echo e($xContenido->titulo); ?></h1>
                <p><?php echo e($xContenido->subtitulo); ?></p>
                <button class="btn" onclick="window.location= '<?php echo e(url("/tips/{$xContenido->idContenido}/{$xContenido->linkURL}")); ?>' "> VER MÁS</button>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/tips/modulos/tips.blade.php ENDPATH**/ ?>