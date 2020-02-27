<?php $__env->startSection('title', ' | Catalogo'); ?>
<?php $__env->startSection('body-clase','landing-page sidebar-collapse'); ?>


<?php $__env->startSection('contenido'); ?>
    <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="head-section">
        <div class="overlay">
            <img src="<?php echo e(asset('images/catalogo/filtro-catalogo.png')); ?>" alt="">
        </div>
        <div class="centrar-img">
            <img src="<?php echo e(asset('images/catalogo/head.png')); ?>" alt="">
        </div>
    </div>

    <div class="contenedor-faq">

        <?php if(!empty($oPreguntasFrecuentes)): ?>
           <?php $__currentLoopData = $oPreguntasFrecuentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="container">

                    <div class="row pl-3 pr-3">
                        <div class="col-12 borde-azul">
                            <hr>
                            <hr>
                        <h1 class="titulo-faq"> <?php echo e($key); ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="accordion mb-5" id="accordionfaq">
                                
                                <?php if(!empty($xContenido)): ?>
                                    <?php $__currentLoopData = $xContenido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $xPregunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card">
                                            <div class="card-header" id="faqOne">
                                                <h2 class="mb-0">
                                                    <button class="cambio-icono icono- btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo e($xPregunta->idContenido); ?>" aria-expanded="true" aria-controls="collapseOne">
                                                    <span> <?php echo e($xPregunta->titulo); ?></span>
                                                    </button>
                                                </h2>
                                            </div>
                                    
                                            <div id="collapse<?php echo e($xPregunta->idContenido); ?>" class="collapse" aria-labelledby="faqOne" data-parent="#accordionfaq">
                                                <div class="card-body">
                                                    <?php echo $xPregunta->descripcion; ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/preguntas-frecuentes/index.blade.php ENDPATH**/ ?>