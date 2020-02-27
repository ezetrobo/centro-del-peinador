<?php

/**
 * Ruta del home
 */

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/error', 'HomeController@error');


/**
 * Rutas de Catalogo
 */
Route::get('/catalogo', 'CatalogoController@index');
//Route::get('/catalogo/categoria-seleccionada', 'CatalogoController@categoriaSeleccionada');




/**
* Rutas del carrito
*/


Route::get('/compra', 'CarritoController@compra');
Route::get('/datos', 'CarritoController@datos');
Route::get('/pago', 'CarritoController@pago');
Route::get('/gracias', 'CarritoController@gracias');

Route::post('/carrito/addProducto', 'CarritoController@addProducto');
Route::post('/carrito/contCarrito', 'CarritoController@contCarrito');
Route::post('/carrito/deleteproducto', 'CarritoController@deleteProducto');
Route::post('/carrito/calculardescuento', 'CarritoController@calculardescuento');
Route::post('/carrito/changecantidad', 'CarritoController@changeCantidad');
Route::post('/carrito/setPersona', 'CarritoController@setPersona');
Route::post('/carrito/deleteAll', 'CarritoController@deleteAll');
Route::post('/carrito/printMiniCarrito', 'CarritoController@printMiniCarrito');
Route::post('/carrito/printCarrito', 'CarritoController@printCarrito');
Route::post('/carrito/setTipoEnvio', 'CarritoController@setTipoEnvio');
Route::post('/carrito/setGatewayPago', 'CarritoController@setGatewayPago');
Route::post('/carrito/gatewayDirecto', 'CarritoController@gatewayDirecto');
Route::post('/carrito/enviarMail', 'CarritoController@enviarMail');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache borrado";
});


/**
 * Rutas del contacto
 */
Route::get('/contacto', 'ContactoController@index');

/**
* csrf Token
*/
Route::get('refresh-csrf', function(){
   return csrf_token();
});

/**
* Rutas de Empresa
*/
Route::get('/empresa', 'EmpresaController@index');


/**
 * Rutas de los Tips
 */

Route::get('/tips', 'TipsController@index');
Route::get('/tips/{xIdContenido}/{nombreContenido}', 'TipsController@tipsDesplegado');
Route::post('/tips/buscarTips', 'TipsController@buscarTips');


/**
 * Rutas de preguntas Frecuentes
 */

Route::get('/preguntas-frecuentes', 'PreguntasFrecuentesController@index');



Route::get('/eventos', 'EventosController@index');
Route::get('/eventos/eventos-pasados', 'EventosController@eventosPasados');
Route::get('/eventos/{xNombre?}/{xIdProducto}', 'EventosController@eventosDesplegados')->where('xIdProducto', '[0-9]+');
Route::get('/eventos/pasados-desplegado', 'EventosController@pasadosDesplegado');
Route::post('/eventos/buscarEventos', 'EventosController@buscarEventos');


/**
* csrf Token
*/
Route::get('refresh-csrf', function(){
    return csrf_token();
});
Route::get('/empresa', 'EmpresaController@index');

Route::get('/{xNombre?}/{xIdProducto}', 'CatalogoController@productoAmpliado')->where('xIdProducto', '[0-9]+');
Route::get('{idCategoria}/{nombreCategoria}/{etiquetas?}', 'CatalogoController@categoriaSeleccionada')->where('xIdProducto', '[0-9]+');