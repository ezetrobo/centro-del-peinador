<?php

namespace App\Clases\Carrito;

class ProductoCarrito 
{
    public $cantidad;
    public $idProducto;
    public $codigo;
    public $titulo;
    public $precio;
    public $imagen;
    public $stock;
    public $volumen;

    function __construct($xIdProducto=null, $xCodigo=null, $xTitulo=null, $xPrecio=null,  $xCantidad = 1, $xImagen=null, $xStock=null, $volumen = 1)
    {
        $this->idProducto = $xIdProducto;
        $this->codigo = $xCodigo;
        $this->titulo = $xTitulo;
        $this->precio = $xPrecio;
        $this->imagen = $xImagen;
        $this->cantidad = $xCantidad;
        $this->stock  = $xStock;
        $this->imagen = $xImagen;
        $this->volumen = $volumen;
    }
}
?>