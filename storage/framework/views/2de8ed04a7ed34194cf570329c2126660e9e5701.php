<?php use App\Sawubona\Sawubona; ?>
<?php if(!empty($xCatalogo)): ?>
    <div class="modulo-producto">
        <a href="<?php echo e(url('/'.Sawubona::convertToUrl($xCatalogo->titulo).'/'.$xCatalogo->idProducto)); ?>">
                <div class="imagen-producto">
                    <div class="centrar-img">
                        <?php echo e($xCatalogo->printImagenes(1)); ?>

                    </div>
                </div>
            <div class="contenedor-descuentos">
                <?php if($xCatalogo->descuento): ?>
                    <span class="badge cocarda-descuento"> -<?php echo e($xCatalogo->valorCocarda); ?>% </span>
                <?php endif; ?>
                <?php if($xCatalogo->envioBonificado): ?>
                    <span class="badge cocarda-envio"> Envío <br> gratis </span>
                <?php endif; ?>
                <?php if($xCatalogo->combo): ?>
                    <span class="badge cocarda-regalo"> <img src="<?php echo e(asset('images/iconos/regalo.png')); ?>" alt=""> </span>
                <?php endif; ?>
            </div>
            <div class="contenedor-info">
                <?php if($xCatalogo->productoNuevo): ?>
                    <p class="producto-nuevo">Nuevo</p> 
                <?php endif; ?>
                <h1 class="titulo-producto"><?php echo e($xCatalogo->titulo); ?></h1>

                <?php if(!empty($xCatalogo->productos)): ?>
                    <?php $__currentLoopData = $xCatalogo->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $catalogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="precio-tamaño">
                            <span class="medida"><?php echo e($catalogo->volumen); ?></span>
                            <?php if($catalogo->descuento): ?>
                                <span class="tachado">$<?php echo e($catalogo->precioTachado); ?> </span>
                            <?php endif; ?>
                            <strong class="descuento">$<?php echo e($catalogo->precioFinal); ?></strong>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="contenedor-boton">
                <button class="btn-lg btn-comprar">COMPRAR</button>
            </div>
        </a>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/modulos/producto2.blade.php ENDPATH**/ ?>