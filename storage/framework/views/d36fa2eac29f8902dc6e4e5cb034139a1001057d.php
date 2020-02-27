
        <div class="shopping-cart-header">
            <div class="d-flex justify-content-between">
                <p>CARRITO</p>
                <a class="mini-carro" onclick="cerrarMiniCarrito()">
                    <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt="">
                </a>
            </div>
        </div>  

        <?php if(!empty($oCarrito->productos)): ?>
            <ul class="shopping-cart-items">
                <?php $__currentLoopData = $oCarrito->productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xProducto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="clearfix">
                        <div class="d-flex">
                            <div class="centrar-img">
                                <img src="<?php echo e(asset($xProducto->imagen)); ?>">
                            </div>
                            <div class="modulo-carrito">
                                <span class="item-name"><?php echo e($xProducto->titulo); ?>

                                    <br><span class="item-price">$<?php echo e($xProducto->precio); ?></span>
                                </span>
                                <div class="contador-carro">
                                    <div class="cantidad">
                                        <span class="q-minus" data-id="<?php echo e($xProducto->idProducto); ?>">-</span>
                                        <input class="quantity quantity-minicarro" id="producto_<?php echo e($xProducto->idProducto); ?>" value="<?php echo e($xProducto->cantidad); ?>" step="6" data-max="<?php echo e($xProducto->stock); ?>" data-id="<?php echo e($xProducto->idProducto); ?>" type="number">
                                        <span class="q-plus" data-id="<?php echo e($xProducto->idProducto); ?>">+</span>
                                    </div>
                                    <a href="" data-id="<?php echo e($key); ?>" class="delete-minicarro" >
                                        <img src="<?php echo e(asset('images/iconos/trash.png')); ?>" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

        <div class="shopping-cart-footer">
            <p>SUBTOTAL <br> 
                <span>$<?php if(!empty($oCarrito->productos)): ?> <?php echo e($oCarrito->costoTotal); ?> <?php else: ?> 0 <?php endif; ?></span>
            </p>
            <a href="<?php echo e(url('compra')); ?>" class="btn-carrito"><img src="<?php echo e(asset('images/iconos/carro.png')); ?>" alt="">Continuar</a>
        </div>
        <?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/carrito/mini-carro.blade.php ENDPATH**/ ?>