<?php $__env->startSection('title', ' | Eventos'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div id="head-section">
        <div class="container pl-0 pr-0" id="carousel-caption">
            <div class="col-12">
                <div class="descripcion-slide">
                    <p>EVENTOS</p>
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

    <div class="menu-eventos">
        <a href="<?php echo e(URL('eventos')); ?>" class="<?php echo e(request()->is('eventos') ? 'active' : ''); ?>">PRÓXIMOS EVENTOS</a>
        <a href="<?php echo e(URL('eventos/eventos-pasados')); ?>" class="<?php echo e(request()->is('eventos/eventos-pasados') ? 'active' : ''); ?>">EVENTOS ANTERIORES</a>
    </div>

    <div class="contenedor-evento">
        <?php if(!empty($oContenidoStreaming)): ?>
            <?php $__currentLoopData = $oContenidoStreaming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="container evento">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="mes-evento"><?php echo e($xContenido->titulo); ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <iframe width="640" height="360" src="<?php echo e($xContenido->link); ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($oCatalogo->productos)): ?>
            <?php echo $__env->make('eventos.modulos.eventos',compact('oCatalogo'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
    

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/eventos/index.blade.php ENDPATH**/ ?>