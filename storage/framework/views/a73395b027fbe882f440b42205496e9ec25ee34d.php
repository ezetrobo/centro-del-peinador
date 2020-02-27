<?php if(!empty($oCarrito->productos)): ?>
    <?php $__currentLoopData = $oCarrito->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modulo-carro">
            <div class="col-4 col-sm-2 col-lg-1 p-0">
                <div class="centrar-img">
                    <img src="<?php echo e(asset($xProducto->imagen)); ?>" alt="">
                </div>
                <img class="borrar-producto d-block d-sm-none" data-id="<?php echo e($key); ?>" src="<?php echo e(asset('images/iconos/trash.png')); ?>" alt="">
            </div>

            <div class="col-8 col-md-9 col-lg-10 p-0 info-producto">
                <p class="titulo-producto"><?php echo e($xProducto->titulo); ?></p>
                <div class="cantidad">
                    <span class="q-minus" data-id="<?php echo e($xProducto->idProducto); ?>">-</span>
                    <input class="count quantity-minicarro" id="producto_<?php echo e($xProducto->idProducto); ?>" name="quantity" value="<?php echo e($xProducto->cantidad); ?>" data-max="<?php echo e($xProducto->stock); ?>" data-id="<?php echo e($xProducto->idProducto); ?>" step="6" type="number">
                    <span class="q-plus" data-id="<?php echo e($xProducto->idProducto); ?>">+</span>
                </div>
                <div class="precio-producto"><p>PRECIO UNITARIO:</p> <span>$<?php echo e($xProducto->precio); ?></span></div>
                <div class="precio-producto"><p>SUBTOTAL: </p><span>$<?php echo e($xProducto->cantidad * $xProducto->precio); ?></span></div>
            </div>

            <div class="col-sm-2 col-md-1 text-right d-none d-sm-block">
                <img class="borrar-producto" data-id="<?php echo e($key); ?>" src="<?php echo e(asset('images/iconos/trash.png')); ?>" alt="">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <p>No hay productos agregados al carrito</p>
<?php endif; ?>
<?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/carrito/modulos/productos-carrito.blade.php ENDPATH**/ ?>