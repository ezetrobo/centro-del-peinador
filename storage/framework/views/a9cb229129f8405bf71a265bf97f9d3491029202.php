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

    <?php if(!empty($oProducto)): ?>
        <div id="eventos-desplegado">

            <div class="container p-lg-0" id="titulo-producto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li><a href="<?php echo e(url()->previous()); ?>"><img class="pr-3" src="<?php echo e(asset('images/iconos/go-back.png')); ?>" alt=""></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(url('/eventos')); ?>">Eventos</a></li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div id="slide-evento" class="carousel carousel-responsive slide" data-ride="carousel" data-items="1, 1, 1, 1, 1" >
                            <div class="carousel-inner">
                                <div class="carousel-item">
                                    <div class="centrar-img">
                                        <?php if(!empty($oProducto->imagenes)): ?>
                                            <?php $__currentLoopData = $oProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($xImagen->nombre != "logo"): ?>
                                                    <img src="<?php echo e($xImagen->path); ?>" alt="">
                                                    <?php break; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="compartir-evento d-none d-sm-flex">
                            <p>COMPARTIR EVENTO: </p>
                                <div class="iconos-compartir" id="shared">
                                    <?php $oProducto->printShared($oProducto->getLink('eventos')); ?> 
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-7 offset-lg-1 col-md-8 col-sm-8">
                        <div class="info-evento">
                            <h1><?php echo e($oProducto->titulo); ?></h1>
                            <?php echo $oProducto->critica; ?>

                            
                            <?php echo $oProducto->descripcion; ?>

                        </div>

                        <?php if(!empty($oProducto)): ?>
                            <?php if($oProducto->habilitado): ?>
                                <div class="precio-evento">
                                    <p class="precio-unitario">Precio unitario:</p>
                                    <div class="precio">
                                        <?php if($oProducto->descuento): ?>
                                            <span class="tachado">$<?php echo e($oProducto->precioTachado); ?></span>
                                        <?php endif; ?>
                                        <span class="descuento">$<?php echo e($oProducto->precioFinal); ?></span>
                                    </div>
                                    <div id="atributo-evento">
                                        <ul class="atributos-producto">
                                            <li><strong>Cupos:</strong>
                                                <span class="alert-stock"><?php echo e($oProducto->stocks[0]); ?></span>
                                            </li>
                                            <div class="cantidad mt-4">
                                                <span class="minus">-</span>
                                                <input class="count" name="quantity" id="quantity" value="1" step="6" max="<?php echo e($oProducto->stocks[0]); ?>" type="number">
                                                <span class="plus">+</span>
                                            </div>
                                            <button class="btn agregar-carrito mt-3 btn-add-carrito" data-id="<?php echo e($oProducto->idProducto); ?>">
                                                <img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">ADQUIRÍ TU ENTRADA
                                            </button>
                                            <div class="prod-agregado">
                                                <span>¡Producto agregado!</span>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        
                            <?php if(!empty($oProducto->imagenes)): ?>
                                <?php $__currentLoopData = $oProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($xImagen->nombre == "logo"): ?>
                                        <div class="organizador">
                                            <p>organizado por:</p>
                                            <img src="<?php echo e($xImagen->path); ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        
                        <div class="compartir-evento d-flex d-sm-none">
                            <p>COMPARTIR EVENTO: </p>
                                <div class="iconos-compartir" id="shared">
                                   <?php $oProducto->printShared($oProducto->getLink('eventos')); ?>
                                </div>
                        </div>
                    </div>
                </div>

                <?php if(!empty($oProducto) && $oProducto->habilitado == false): ?>
                    <div class="titulo-eventos">
                    <div class="col-12 borde-azul">
                        <hr>
                        <hr>
                        <h1 class="titulo-pasados"> VIDEOS</h1>
                    </div>

                    <div id="carousel-productos" class="carousel carousel-responsive slide slide-home" data-ride="carousel" data-items="1, 2, 2, 3, 3">
                        <a class="carousel-control-prev" href="#carousel-productos" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon prev-slide" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-productos" role="button" data-slide="next">
                            <span class="carousel-control-next-icon next-slide" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                        <div class="carousel-inner galeria-videos" role="listbox">
                            <?php if(!empty($oProducto->videos)): ?>
                                <?php $__currentLoopData = $oProducto->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php if($key == 0): ?> active <?php endif; ?>">
                                        <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/<?php echo e($xVideo->idVideo); ?>" frameborder="0"></iframe>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    </div>
                <?php endif; ?>

            </div>

            <?php if(!empty($oProducto) && $oProducto->habilitado == false): ?>
                <div class="container titulo-eventos">
                    <div class="col-12 borde-azul">
                        <hr>
                        <hr>
                        <h1 class="titulo-pasados"> GALERÍA</h1>
                    </div>
                </div>
                <div class="container-fluid" id="galeria-eventos">
                    <div class="row">
                        <?php if(!empty($oProducto->imagenes)): ?>
                            <?php $__currentLoopData = $oProducto->imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xImagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($xImagen->nombre == ""): ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 galeria-wrapper">
                                        <a data-fancybox="gallery" href="<?php echo e($xImagen->path); ?>">
                                            <div class="centrar-img">
                                                <img src="<?php echo e($xImagen->path); ?>">
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/eventos/evento-ampliado.blade.php ENDPATH**/ ?>