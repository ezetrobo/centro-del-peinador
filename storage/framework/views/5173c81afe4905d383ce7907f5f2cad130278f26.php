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
            </div>
            <div class="contenedor-info">
                <?php if($xCatalogo->productoNuevo): ?>
                    <p class="producto-nuevo">Nuevo</p>
                <?php endif; ?>
                <h1 class="titulo-producto"><?php echo e($xCatalogo->titulo); ?></h1>

                <?php if(!empty($xCatalogo->productos)): ?>
                    <p class="bajada-producto">+<?php echo e(count($xCatalogo->productos)); ?> Colores disponibles</p>
                <?php endif; ?>

                <p class="descripcion-producto"><?php echo strip_tags($xCatalogo->descripcion); ?></p>
                <div class="contenedor-precio">
                    <div class="precio">
                        <?php if($xCatalogo->descuento): ?>
                            <span class="tachado">$<?php echo e($xCatalogo->precioTachado); ?></span>
                        <?php endif; ?>
                        <span class="descuento">$<?php echo e($xCatalogo->precioFinal); ?></span>
                    </div>
                </div>
            </div>
            <div class="contenedor-boton">
                <button class="btn-lg btn-comprar">COMPRAR</button>
            </div>
        </a>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/modulos/producto3.blade.php ENDPATH**/ ?>