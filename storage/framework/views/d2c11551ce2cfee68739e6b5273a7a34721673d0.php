<?php if(!empty($oCatalogo->etiquetas)): ?>
    <div class="col-12 p-0" id="filtros">
        <div id="accordion" class="menu-categorias">
            <div class="head-categorias">
                <h1 class="head-titulo">FILTROS</h1>
                <a class="cerrar-buscador button-filtro d-xl-none d-lg-none"> <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt=""></a>
            </div>

            <?php $__currentLoopData = $oCatalogo->etiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($xEtiqueta->idEtiqueta == 269): ?>
                    <div class="card" id="color">
                        <div class="card-header">
                            <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#filtros<?php echo e($key3); ?>" aria-expanded="true" aria-controls="filtros<?php echo e($key3); ?>">
                                <span><?php echo e($xEtiqueta->nombre); ?></span>
                            </button> 
                        </div>
                        <?php if(!empty($xEtiqueta->etiquetas)): ?>
                            <div id="filtros<?php echo e($key3); ?>" class="collapse item-categoria" data-parent="#accordion">
                                <ul>
                                    <?php $__currentLoopData = $xEtiqueta->etiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(strpos($xEtiqueta->nombre, '$nuevo') === false): ?>
                                            <li data-toggle="tooltip" data-placement="top" title="Nuevo">
                                                <span class="producto-nuevo"></span>
                                                <a href="<?php echo e($xEtiqueta->getLink()); ?>"><div class="color" style="background-color:#<?php echo e($xEtiqueta->color); ?>;"></div></a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="<?php echo e($xEtiqueta->getLink()); ?>"><div class="color" style="background-color:#<?php echo e($xEtiqueta->color); ?>;"></div></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class="card-header">
                            <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#filtros<?php echo e($key3); ?>" aria-expanded="true" aria-controls="filtros<?php echo e($key3); ?>">
                                <span><?php echo e($xEtiqueta->nombre); ?></span>
                            </button> 
                        </div>
                        <?php if(!empty($xEtiqueta->etiquetas)): ?>
                            <div id="filtros<?php echo e($key3); ?>" class="collapse item-categoria" data-parent="#accordion">
                                <ul>
                                    <?php $__currentLoopData = $xEtiqueta->etiquetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $xEtiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($xEtiqueta->getLink()); ?>"><?php echo e($xEtiqueta->nombre); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="card" id="precio">
                    <div class="card-header">
                        <button class="cambio-icono icono- btn btn-link btn-categorias mt-1 mb-1" data-toggle="collapse" data-target="#categoria4" aria-expanded="true" aria-controls="categoria4">
                            <span>Rango de precios</span>
                        </button> 
                    </div>
                    <div id="categoria4" class="collapse item-categoria" data-parent="#accordion">
                        <div class="price-slider">
                            <span>
                                <input type="number" value="5000" min="0" max="120000" />
                                <input type="number" value="50000" min="0" max="120000" />
                            </span>
                            <input value="5000" min="0" max="120000" step="500" type="range" id="rango_1"/>
                            <input value="50000" min="0" max="120000" step="500" type="range" id="rango_2"/>
                            <button class="btn" id="btn-rango">Consultar</button>
                        </div> 
                    </div>
                </div>
        </div>
    </div>
    <!-- FILTRO DE "ORDENAR POR" VERSIÓN MOBILE -->
    <div class="col-12 p-0 d-xl-none d-lg-none" id="orden">
        <div id="accordion" class="menu-categorias">
            <div class="head-categorias">
                <h1 class="head-titulo">ORDENAR POR</h1>
                <a class="cerrar-buscador button-orden d-xl-none d-lg-none"> <img src="<?php echo e(asset('images/iconos/cerrar.png')); ?>" alt=""></a>
            </div>
            <div class="filtro-orden">
                <a href="">Predeterminado</a>
            </div>
            <div class="filtro-orden">
                <a href="">Alfabético: A-Z</a>
            </div>
            <div class="filtro-orden">
                <a href="">Alfabético: Z-A</a>
            </div>
            <div class="filtro-orden">
                <a href="">Mayor precio</a>
            </div>
            <div class="filtro-orden">
                <a href="">Menor precio</a>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xamppOK\htdocs\centro-del-peinador\resources\views/catalogo/modulos/etiquetas.blade.php ENDPATH**/ ?>