<?php use App\Sawubona\Sawubona; ?>

<?php $__currentLoopData = $oCatalogo->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xCatalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container evento">
        <div class="row">
            <div class="col-12">
                <h1 class="mes-evento"><?php echo e(ucwords($key)); ?></h1>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($xCatalogo)): ?>
                <?php $__currentLoopData = $xCatalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($xProducto)): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="modulo-evento">
                                <div class="cocarda-fecha"><p><?php echo e(strtoupper(substr($xProducto->nombreDia,0,3))); ?> <br><strong><?php echo e($xProducto->numeroDia); ?></strong></p></div>
                                <div class="centrar-img">
                                    <img src="<?php echo e(asset('images/eventos/filtro.png')); ?>" alt="" class="filtro-evento">
                                    <?php if(!empty($xProducto->imagenes)): ?>
                                        <?php $__currentLoopData = $xProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($xImagen->nombre != 'logo'): ?>
                                                <img src="<?php echo e($xImagen->path); ?>" alt="" class="">
                                                <?php break; ?>;
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="info-evento">
                                    <h1><?php echo e(strtoupper($xProducto->titulo)); ?></h1>
                                    <?php echo $xProducto->critica; ?>

                                    <button class="btn" onclick="window.location = '<?php echo e(url('/eventos/'.Sawubona::convertToUrl($xProducto->titulo).'/'.$xProducto->idProducto)); ?>';"> VER MÁS</button>
                                </div>        
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/eventos/modulos/eventos.blade.php ENDPATH**/ ?>