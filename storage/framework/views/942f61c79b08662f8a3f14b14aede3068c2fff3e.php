<?php $__env->startSection('title', ' | Tips'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>TIPS</p>
                </div>
            </div>
        </div>
        <div class="overlay">
            <img src="<?php echo e(asset('images/catalogo/filtro-catalogo.png')); ?>" alt="">
        </div>
        <?php if(!empty($oContenido[0]->imagenes[0]->path)): ?>
            <div class="centrar-img">
                <img src="<?php echo e($oContenido[0]->imagenes[0]->path); ?>" alt="">
            </div>
        <?php endif; ?>
    </div>

    <div class="contenedor-evento pt-4">

        <div class="buscador-evento">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form class="d-flex align-items-center" action="">
                            <img src="<?php echo e(asset('images/iconos/buscar-evento.png')); ?>" alt="">
                            <input class="form-control" type="text" placeholder="Buscar evento" aria-label="Search" autocomplete="off" id="txt_searchTips">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container evento pt-0">
            <div class="row" id="tips">
                <?php if(!empty($oContenido1)): ?>
                    <?php $__currentLoopData = $oContenido1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('tips.modulos.tips',compact('xContenido'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>                
            </div>
        </div>
    </div>
    

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/tips/index.blade.php ENDPATH**/ ?>