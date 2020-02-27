<?php $__env->startSection('title', ' | Catalogo'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- CAROUSEL HOME -->
    <?php if(!empty($oContenido1)): ?>
        <div class="container-fluid" id="contenedor-slide">
            <div class="carousel slide carousel-fade" id="carousel-home" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <?php $__currentLoopData = $oContenido1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo e($key); ?>" class="<?php if($key == 0): ?> active <?php endif; ?>"></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
                <!-- Imagenes del slide -->
                
                <div class="carousel-inner">
                    <?php $__currentLoopData = $oContenido1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?>">
                            <div class="overlay"><img src="<?php echo e(asset('images/home/filtro.png')); ?>" alt=""></div>
                            <div class="centrar-img">
                                <?php echo e($xContenido->printImagenes()); ?>

                            </div>
                                <div class="container pl-0 pr-0" id="carousel-caption">
                                    <div class="col-xl-8 offset-xl-0 col-lg-7 offset-lg-1 col-md-7 col-sm-8 col-12">
                                        <div class="titulo-slide"><p><?php echo e($xContenido->titulo); ?></p></div>
                                    </div>
                                    <div class="col-xl-7 offset-xl-0 col-lg-6 offset-lg-1 col-md-7 col-sm-8 col-10">
                                        <div class="descripcion-slide"><?php echo $xContenido->descripcion; ?></div>
                                    </div>
                                    <div class="col-xl-8 offset-xl-0 col-lg-10 col-md-12 col-sm-12 cols-12">
                                        <a class="btn-lg btn-slide" href=""><?php echo e($xContenido->bajada); ?></a>
                                    </div>
                                </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!empty($parametros)): ?>
        <?php $__currentLoopData = $parametros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $oContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('home.secciones.'.$key, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <div id="newsletter">
        <div class="container-fluid p-0">
            <div class="overlay">
                <div class="col-lg-12" id="contenedor-formu">
                    <div class="form-newletter">
                        <p>Conocé todas nuestras promociones, 
                            recibí novedades y descuentos especiales.
                        </p>
                        <iframe src="https://app.fidelitytools.net/resource/suscriptor/?f=Njk2OQ&s=NDMy&ididioma=1" frameborder="0"></iframe>
                    </div>
                </div>
                <img src="<?php echo e(asset('images/home/filtro-newsletter.png')); ?>" alt="" class="img-overlay">
            </div>
                <img src="<?php echo e(asset('images/prueba/bg-newsletter.jpg')); ?>" alt="" class="bg-newsletter">
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/home/index.blade.php ENDPATH**/ ?>