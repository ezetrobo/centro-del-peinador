<?php
use App\Clases\Contenido\Contenido;
        /* Contacto | Visitanos */
        $xIdTipoContenido = config('parametros.xIdContacto');
        $xOffSet = 0;
        $xLimit = 0;
        $xOrderBy = 'orden';
        $xOrderType = 'ASC';
        $oContenido1 = new Contenido();
        $oContenido1 = $oContenido1->getAll($xIdTipoContenido, $xOffSet, $xLimit, $xOrderBy, $xOrderType);
?>

<a id="go-top"></a>

<a id="mini-carro" class="mini-carro">
    <span>0</span>
</a>


<div class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-12 d-flex align-items-center">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" class="logo-footer">
            </div>

            <div class="col-md-4 col-12 d-flex align-items-center menu-footer">
                <ul>
                    <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>" > <a href="<?php echo e(url('/')); ?>">Inicio</a></li>
                    <li class="<?php echo e(request()->is('empresa') ? 'active' : ''); ?>" > <a href="<?php echo e(url('empresa')); ?>">Empresa</a></li>
                    <li class="<?php echo e(request()->is('catalogo') ? 'active' : ''); ?>" > <a href="<?php echo e(url('catalogo')); ?>">Productos</a></li>
                    <li class="<?php echo e(request()->is('eventos') ? 'active' : ''); ?>" > <a href="<?php echo e(url('eventos')); ?>">Eventos</a></li>
                    <li class="<?php echo e(request()->is('tips') ? 'active' : ''); ?>" > <a href="<?php echo e(url('tips')); ?>">Tips</a></li>
                    <li class="<?php echo e(request()->is('contacto') ? 'active' : ''); ?>" > <a href="<?php echo e(url('contacto')); ?>">Contacto</a></li>
                    <!--<li class="<?php echo e(request()->is('') ? 'active' : ''); ?>" > <a href="<?php echo e(url('')); ?>">Servicio Técnico</a></li>-->
                    <li class="<?php echo e(request()->is('preguntas-frecuentes') ? 'active' : ''); ?>" > <a href="<?php echo e(url('preguntas-frecuentes')); ?>">Preguntas Frecuentes</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 col-12 d-inline-grid align-items-center info-footer">
                <?php if(!empty($oContenido1)): ?>
                    <ul>
                        <?php $__currentLoopData = $oContenido1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xContenido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$xContenido->portada): ?>
                                <?php if($key == 0): ?>
                                    <li><img src="<?php echo e($xContenido->imagenes[0]->path); ?>" alt=""><strong><?php echo e($xContenido->bajada); ?></strong> <?php echo e($xContenido->link); ?></li>
                                <?php else: ?>
                                    <li><img src="<?php echo e($xContenido->imagenes[0]->path); ?>" alt=""><a href="<?php echo e($xContenido->link); ?>" target="blank_"><?php echo e($xContenido->bajada); ?></a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li>
                                    <strong><?php echo e($xContenido->titulo); ?></strong>
                                    <?php echo $xContenido->descripcion; ?>

                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="shopping-cart">
        <div id="mini-carrito">
            <?php echo $__env->make('carrito.mini-carro', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/layouts/footer.blade.php ENDPATH**/ ?>