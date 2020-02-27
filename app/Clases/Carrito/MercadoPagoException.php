<?php
namespace App\Clases\Carrito;

use App\Clases\Carrito\MercadoPagoException;

/**
 * MercadoPago Integration Library
 * Access MercadoPago for payments integration
 * 
 * @author hcasatti
 *
 */

class MercadoPagoException extends Exception {
    public function __construct($message, $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

?>