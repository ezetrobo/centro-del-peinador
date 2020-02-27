<?php
namespace App\Http\Controllers;

use App\Clases\Carrito\CostoEnvioZona;
use App\Clases\Carrito\Descuento;
use App\Clases\Carrito\Ecommerce;
use App\Clases\Carrito\Envio;
use App\Clases\Carrito\ProductoCarrito;
use App\Clases\Carrito\cCarrito;
use App\Clases\Carrito\setMp;
use App\Clases\Persona\Direccion;
use App\Clases\Persona\Persona;
use App\Clases\Persona\Telefono;
use App\Clases\Producto\Categoria;
use App\Clases\Producto\Producto;
use App\Sawubona\Sawubona;
use Illuminate\Http\Request;
use Session;
use View;
use Datetime;

class CarritoController extends Controller {

	public function index() {
		return view('carrito.index');
	}

	public function compra() {
		/* Eliminamos la sesion del carrito - entrega */
		$xCarrito = new cCarrito();
		$xCarrito->deleteEnvio();
		$xCarrito->setPaso(1);

		$oCarrito = session('carrito');

		$eCommerce = new Ecommerce();
		$eCommerce->getConfiguracion();
		
		return view('carrito.compra', compact('oCarrito','eCommerce'));
	}

	public function datos() {
		if (session::has('carrito') && session('carrito')->paso == 2):
			$oCarrito = session('carrito');

			return view('carrito.datos', compact('oCarrito'));
		else:
			return redirect('compra');
		endif;
	}

	public function pago() {
		if (session::has('carrito') && session('carrito')->paso == 3):
			/* Carrito */
			$oCarrito = session('carrito');

			/* Ecommerce */
			$eCommerce = new Ecommerce();
			$eCommerce->getConfiguracion();
			$oGatewayPagos = $eCommerce->gatewayPagos;

			return view('carrito.pago', compact('oCarrito','oGatewayPagos'));
		else:
			return redirect('compra');
		endif;
	}

	/**
	*	Funcion agregar producto al carro
	**/
	public function addProducto($xIdProducto = null, $xCantidad = 0) {
		try {
			$xParams = array();
			if ($_POST):
				$xIdProducto = $_POST['idProducto'];
				$xCantidad = $_POST['cantidad'];
			endif;

			$xIdioma = config('main.IDIOMA_DEFAULT');
			
			$xCarrito = new cCarrito();
			$xCarrito-> iniciarCarrito();

			if ($xCarrito->idioma == null):
				$xCarrito->setIdioma($xIdioma);
			endif;

			$oProducto = new Producto();
			$oProducto = $oProducto->getById($xIdProducto);

			if (!empty($oProducto->imagenes[0]->path) && $oProducto->imagenes[0]->path != ""):
				$imagen = $oProducto->imagenes[0]->path;
			else:
				$imagen = "/img/default/producto.jpg";
			endif;
			
			if($xCantidad > 0):
				if (!empty($oProducto->stocks)):
					if ($oProducto->stocks[0] != null and $oProducto->stocks[0] != 0):
						if ($xCarrito->validarStock($xIdProducto, $oProducto->stocks[0], $xCantidad)):
							if (!empty($oProducto->precios) && $oProducto->precios[0] > 0):
								$xProducto = new ProductoCarrito($oProducto->idProducto, trim($oProducto->codigoInterno), $oProducto->titulo, $oProducto->precios[0], $xCantidad, $imagen, $oProducto->stocks[0], $oProducto->volumen);
									$xCarrito->setAddProducto($xProducto);
									$xCarrito->calcularCostoTotal();
									$xCarrito->deleteEnvio();
									
									$xParams = array(
										'cantidadProductos' => $xCarrito->contCarrito(),
										'total' => session('carrito')->costoTotal,
										'subTotal' => session('carrito')->subTotal,
										'costoEnvio' => session('carrito')->envio->costo,
										'descuento' => session('carrito')->descuento->monto
									);

								return json_encode(array('estado' => true, 'parametros' => $xParams, 'mensaje'=> Sawubona::setIdiomaTexto("productoAgregado")));
								
							else:
								return json_encode(array('estado' => false, 'parametros'=> $xParams,  'mensaje'=> Sawubona::setIdiomaTexto("productoSinPrecio")));
							endif;
						else:
							return json_encode(array('estado' => false, 'parametros'=> $xParams,  'mensaje'=> Sawubona::setIdiomaTexto("productoExedido")));
						endif;
					else:
						return json_encode(array('estado' => false, 'parametros'=> $xParams,  'mensaje'=> Sawubona::setIdiomaTexto("productoSinStock")));
					endif;
				else:
					return json_encode(array('estado' => false, 'parametros'=> $xParams, 'mensaje'=> Sawubona::setIdiomaTexto("productoSinStock")));
				endif;
			else:
				return json_encode(array('estado' => false, 'parametros'=> $xParams,  'mensaje'=>Sawubona::setIdiomaTexto("cantidadMayorCero")));
			endif;
			} catch (Exception $e) {
				Log::error($e);
			}
	}

	/**
	* Modifica la cantidad de productos del carro
	**/
	public function changeCantidad(Request $request) {
		try {
			$xCarrito = new cCarrito();
			$xCarrito->iniciarCarrito();
			$xCarrito->changeCantidad($request['xIdProducto'], $request['xCantidad']);
			$xCarrito->calcularCostoTotal();
			$xCarrito->deleteEnvio();

			$xParams = array(
					'cantidadProductos' => $xCarrito->contCarrito(),
					'total' => session('carrito')->costoTotal,
					'subTotal' => session('carrito')->subTotal,
					'costoEnvio' => session('carrito')->envio->costo,
					'descuento' => session('carrito')->descuento->monto
				);

			return json_encode(array('estado' => true, 'parametros' => $xParams ));
		} catch (Exception $e) {
			Log::error($e);
		}
	}

	/**
	*	Funcion eliminar producto al carro
	**/
	public function deleteProducto(Request $request) {
		try {
			$xCarrito = new cCarrito();
			$xCarrito->iniciarCarrito();
			$xCarrito->deleteProducto($request['xIndex']);
			$xCarrito->calcularCostoTotal();
			$xCarrito->deleteEnvio();

			$xParams = array('cantidadProductos' => $xCarrito->contCarrito(), 'total' => session('carrito')->costoTotal, 'subTotal' => session('carrito')->subTotal, 'descuento' => session('carrito')->descuento->monto, 'costoEnvio' => session('carrito')->envio->costo,);

			if($xCarrito->contCarrito() == 0):
				$xCarrito->setPaso(0);
			else:
				$xCarrito->setPaso(1);
			endif;

			return json_encode(array('estado' => true, 'parametros' => $xParams));
		} catch (Exception $e) {
			return json_encode(array('estado' => false, 'Mensaje'=>"Ha ocurrido un error ".$e->getMessage() ));
		}
	}

	/**
	* Funcion para calcular el descuento
	**/
	public function calculardescuento(Request $request){
		try {
			if (!empty($request['codigo'])):
				$xCarrito = new cCarrito();
				$xCarrito->iniciarCarrito();
				$xDescuento = new Descuento();
				$descuento = json_decode($xDescuento->getDescuentobycodigo($request['codigo']));
				$xCarrito->setDescuento($xDescuento);
				$xCarrito->calcularCostoTotal();

				$xParams = array(
					'cantidadProductos' => $xCarrito->contCarrito(), 
					'total' => session('carrito')->costoTotal, 
					'subTotal' => session('carrito')->subTotal, 
					'costoEnvio' => session('carrito')->envio->costo,
					'descuento' => session('carrito')->descuento->monto
				);

				if(!$descuento->estado):
					return json_encode(array('estado' => false, 'parametros' => $xParams, 'mensaje' => $descuento->mensaje));
				else:
					return json_encode(array('estado' => true, 'parametros' => $xParams));
				endif;
			endif;
		} catch (Exception $e) {
			Log::error($e);
		}
	}


	/**
	* Elimina todos los productos del carrito
	**/
	public function deleteAll() {
		try {
			$xCarrito = new cCarrito();
			$xCarrito->iniciarCarrito();
			$xCarrito->deleteAll();
			return json_encode(array('estado' => true, 'parametros' => array('cantidadProductos' => $xCarrito->contCarrito())));

		} catch (Exception $e) {
			return json_encode(array('estado' => false));
			Log::error($e);
		}
	}

	/**
	* Retorna el carrito
	**/
	public function printMiniCarrito(){
		try {
			$xCarrito = new cCarrito();
			$xCarrito->iniciarCarrito();
			$oCarrito = session('carrito');

			return view('carrito.mini-carro', compact('oCarrito'));
		} catch (Exception $e) {
			Log::error($e);
		}
	}

	/**
	* Retorna el carrito
	**/
	public function printCarrito(){
		try {
			$xCarrito = new cCarrito();
			$xCarrito->iniciarCarrito();
			$oCarrito = session('carrito');

			return view('carrito.modulos.productos-carrito', compact('oCarrito'));
		} catch (Exception $e) {
			Log::error($e);
		}
	}

	/**
	* Obtiene los terminos y condiciones disponibles en el ecommerce
	**/
	public function getTerminos() {
		$xEcom = new Ecommerce();
		$xEcom->ecommerceConfiguracion();
		echo $xEcom->terminos;
		echo "TERMINOS: " . session('ecommerce')->terminos;
	}

	/**
	* Devuelve el numero de productos del carro
	**/
	public function contCarrito() {
		$xCarrito = new cCarrito();
		$xCarrito->iniciarCarrito();
		return json_encode(array('parametros' => array('cantidadProductos' => $xCarrito->contCarrito())));
	}

	/**
	* Setea la persona al carrito
	**/
	public function setpersona(Request $request) {
		if(session('carrito')->paso == 2):
			$rules = [
	            'nombre' => 'required|min:2',
	            'apellido' => 'required|min:2',
	            'dni' => 'required|numeric|min:7',
	            'email' => 'required|email',
	            'pref3' => 'required|min:2',
	            'movil' => 'required|min:7',
	        ];
	        
	        $message = [
	            'nombre.required' => Sawubona::setIdiomaTexto("nombreFormRequired"),
	            'nombre.min' => Sawubona::setIdiomaTexto("nombreFormMin"),
	            'apellido.required' => Sawubona::setIdiomaTexto("apellidoFormRequired"),
	            'apellido.min' => Sawubona::setIdiomaTexto("apellidoFormMin"),
	            'dni.required' => Sawubona::setIdiomaTexto("dniFormRequired"),
	            'dni.min' => Sawubona::setIdiomaTexto("dniFormMin"),
	            'dni.numeric' => Sawubona::setIdiomaTexto("dniFormNumerico"),
	            'email.required' => Sawubona::setIdiomaTexto("emailFormRequired"),
	            'email.email' => Sawubona::setIdiomaTexto("emailFormEmail"),
	            'pref3.required' => Sawubona::setIdiomaTexto("pref3Required"),
	            'movil.required' => Sawubona::setIdiomaTexto("movilRequired"),
	            'pref3.min' => Sawubona::setIdiomaTexto("pref3Min"),
	            'movil.min' => Sawubona::setIdiomaTexto("movilMin"),
	        ];

	        $this->validate($request, $rules, $message);
		
			try {
				if ($request) {
					$oPersona = new Persona();
					if (isset(session('carrito')->persona->idPersona)):
						$oPersona->idPersona = session('carrito')->persona->idPersona;
					endif;
					$oPersona->nombre = $request['nombre'];
					$oPersona->apellido = $request['apellido'];
					$oPersona->emails[] = $request['email'];
					$oPersona->telefonos[2] = new Telefono(null, $request['pref3'], $request['movil']);
					$oPersona->direccion = new Direccion();
					$oPersona->direccion->calle = $request['domicilio'];
					$oPersona->direccion->localidad = $request['localidad'];
					$oPersona->direccion->cp = $request['cp'];
					$oPersona->direccion->numero = $request['numero'];
					$oPersona->direccion->piso = $request['piso'];
					$oPersona->direccion->dpto = $request['dpto'];
					$oPersona->direccion->provincia = $request['provincia-nombre'];
					$oPersona->dni = $request['dni'];
					
					$xCarrito = new cCarrito();
					$xCarrito->iniciarCarrito();
					$xCarrito->setPersona($oPersona);
					$xCarrito->setPaso(3);
					$xCarrito->setObservaciones($request['observaciones']);
					$xCarrito->setTerminos();

					return json_encode(array('estado' => true));
				}
			} catch (Exception $e) {
				Log::error($e);
			}
		else:
			return json_encode(array('estado' => false));
		endif;
	}

	/**
	* Seteamos el tipo de envio en el Carrito
	**/
	public function setTipoEnvio(Request $request) {
		try {
			$xEcom = new Ecommerce();
			$xEcom->getConfiguracion();

			$xCarrito = new cCarrito();
			$auxEstado = false;

			if ($request):
				if($request['xIdTipoEnvio'] != 1):
					if(!empty($xEcom->eCommerceTipoEnvio)):
						foreach ($xEcom->eCommerceTipoEnvio as $key => $oEcomTipo):
							if($oEcomTipo->idEcommerceTipo == $request['xIdTipoEnvio']):
								if(!empty($oEcomTipo->listaCostoEnvioZona)):
									foreach ($oEcomTipo->listaCostoEnvioZona as $key => $oEcomZona):
										if($oEcomZona->idCostoEnvioZona == $request['xIdZona']):
											$oEcomZona->idEcommerceTipo = $request['xIdTipoEnvio'];
											session('carrito')->envio = $oEcomZona;
											$auxEstado = true;
											$xCarrito->setPaso(2);
											$xCarrito->calcularCostoTotal();
										endif;
									endforeach;
								endif;
							endif;
						endforeach;
					endif;
				else:
					$oEcomZona = new CostoEnvioZona(1,"Retiro por Sucursal",null,null,null,1);
					session('carrito')->envio = $oEcomZona;
					$auxEstado = true;
					$xCarrito->setPaso(2);
				endif;
			endif;
			$xParams = array(
				'cantidadProductos' => $xCarrito->contCarrito(),
				'total' => session('carrito')->costoTotal,
				'costoEnvio' => session('carrito')->envio->costo,
				'subTotal' => session('carrito')->subTotal,
				'descuento' => session('carrito')->descuento->monto
			);

			return json_encode(array('estado' => $auxEstado, 'parametros' => $xParams));
		} catch (Exception $e) {
			return json_encode(array('estado' => false));
		}
	}

	/**
	* Setea Ecommerce
	**/
	public function setGatewayPago(Request $request){
		try {
			$eCommerce = new Ecommerce();
			$eCommerce->getConfiguracion();

			/* Seteamos el ID del segmento Compradores para el modulo Ecommerce de Fidelitytools */
			$sessionEcommerce = new \stdClass();
			$sessionEcommerce->segmento_compradores = $eCommerce->segmento_compradores;
			session('carrito')->eCommerce = $sessionEcommerce;

			$xCarrito = new cCarrito();

			/* Guardamos el pedido */
			$xIdPedido = $xCarrito->guardarPedido();

			if(!empty($eCommerce->gatewayPagos) && is_numeric($xIdPedido)):
				session('carrito')->idpedido = $xIdPedido;
				foreach ($eCommerce->gatewayPagos as $key => $xGateway):
					switch ($xGateway->idGatewayPago):
					    case '1':
					    	/* Seteamos el tipo de Mercadopago */
					    	if($request['xGatewayPago'] == 1):
					    		$xPreference=$xCarrito->setMp($xGateway);
							endif; 
					        $url = $xPreference['response']['init_point']; 
					    break;
					    case '2': /* paypal */
					        $url = "/Paypal/Buy";
					    break;
					    case '3': /* Todo pago*/
					        $url = "/TodoPago/Buy";
					    break;
					    case '4': /* Decidir */
					        $url = "/Decidir/Buy";
					    break;
					    case '5': /* Gateway Directo */
					        $url = "/carrito/modoGateway";
					    break;

					endswitch;
				endforeach;

				return json_encode(array('estado' => true, 'url' => $url));
			else:
				return json_encode(array('estado' => false));
			endif;
		} catch (Exception $e) {
			
		}
	}

	/**
	* Gateway Directo
	**/
	public function gatewayDirecto(Request $request){
		$xCarrito = new cCarrito();
		$tokenTarjeta = $request['token'];
		$email = $request['email']; 
		$idPay = $request['paymentMethodId']; 
		$cuotas = $request['installments']; 
		$idmaster = $request['issuer'];
		$merchanid = $request['merchId']; 
		$total = session('carrito')->costoTotal;

		if (!empty($tokenTarjeta) && $tokenTarjeta != null && !empty($idPay) && !empty($cuotas) && !empty($merchanid)):
			
			$xPreference = $xCarrito->ModoGateway($tokenTarjeta, $email, $cuotas, $idPay, $idmaster, $merchanid);

			if ($xPreference['response']['status'] != "rejected" && ($xPreference['status'] == 201 || $xPreference['status'] == 200)):
				$Carrito = new cCarrito();
				$Carrito->iniciarCarrito();
				
				$xTitulo= "¡ Gracias !";
				$xMensaje = "Tu compra ha sido realizada con éxito.";				
				$xBajada = "ID Pedido : ".session('carrito')->idpedido;

				$Carrito->deleteSession();

				return view('mp/resultado', compact('xTitulo','xMensaje','xBajada'));
			else:
				$xTitulo= "ERROR";
				$xMensaje= "¡Algo ocurrió! Intentá realizar <br>  tu compra nuevamente.";
				$xBajada = ((!empty($xPreference['response']['status_detail'])) ? Sawubona::getEstadoMP($xPreference['response']['status_detail']) : "");

				return view('mp/resultado', compact('xTitulo','xMensaje','xBajada'));
			endif;
		endif;
	}

	/**
	* Mensaje de Error o Gracias en transaccion
	**/
	public function gracias() {
		return view('carrito.gracias');
	}

	/**
	* Envia el correo del pedido
	**/
	public function enviarMail(){
		$Carrito = new cCarrito();
		$Carrito->iniciarCarrito();

        if (session::has('carrito') && session('carrito')->paso == 3 && isset(session('carrito')->idpedido)):
			$xEcom = new Ecommerce();
			$xEcom->getConfiguracion();

			$body ="<div style='border: 1px solid #ccc!important;border-radius: 16px; width:80%'><strong style='padding-left: 20px; font-size: 25px;'>Pedido Pendiente</strong><br>";
			$body.="<table style='width:100%;padding:10px;'><tr><td colspan='4'>";
			$body.="Pedido N&deg; ".session('carrito')->idpedido."</td></tr>";
			$body.="<tr><td colspan='2'>Cliente: ".session('carrito')->persona->apellido." ".session('carrito')->persona->nombre;
			$body.="</td><td colspan='2'>DNI/CUIT: ".session('carrito')->persona->dni."</td></tr>";
			$body.="<tr><td colspan='2'>Email: ".session('carrito')->persona->emails[0];
			$body.="</td><td colspan='2'>Movil: (0".session('carrito')->persona->telefonos[2]->caracteristica.") ".session('carrito')->persona->telefonos[2]->numero."</td></tr>";

			$body.="<tr>
                    <td colspan='4'>
                        <b>Direccion Entrega:</b><br>";

            $body.= session('carrito')->persona->direccion->calle." ".session('carrito')->persona->direccion->numero." ".session('carrito')->persona->direccion->piso." ".session('carrito')->persona->direccion->dpto." ".session('carrito')->persona->direccion->barrio." ".session('carrito')->persona->direccion->cp." ".session('carrito')->persona->direccion->localidad." ".session('carrito')->persona->direccion->provincia."</td></tr>";

			$body.="<tr><td colspan='4'>Envio:".session('carrito')->envio->nombre."</td></tr><tr><td colspan='4'></td></tr>";
			$body.="<tr style='background:#ccc'><td>Cant.</td><td>Producto</td><td>Precio</td><td>subTotal</td></tr>";
			
            foreach(session('carrito')->productos as $xProducto):
				$body.= "<tr>
                        <td>".$xProducto->cantidad."</td>
                        <td>".$xProducto->codigo." ".$xProducto->titulo."</td>
                        <td>$ ".$xProducto->precio."</td>
                        <td>$".number_format($xProducto->precio*$xProducto->cantidad,2)."</td>
                    </tr>";
			endforeach;

            if(session('carrito')->descuento->valor != NULL):            
				$body.="<tr><td colspan='4' align='right'><b>Descuento: - $".number_format(session('carrito')->subTotal * session('carrito')->descuento->valor/100,2)."</b></td></tr>";
			endif;

			$body.= "<tr><td colspan='4' align='right'><b>Total de la compra: $".number_format(session('carrito')->subTotal,2)."</b></td></tr></table>";

			$from = "ecommerce@fidelitytools.com";

            //$to = $xEcom->emailAlerta;
			$to="lucio@sawubona.com.ar";

            $subject = "Ecommerce " . config("main.NOMBRE_SITIO") . "- Pedido Pendiente de Pago";

			$envio = array(
                "from"       => $from,
                "to"         => $to,
                "subject"    => $subject,
                "isBodyHtml" => true,
                "body"       => $body
            );

			$data_string = json_encode($envio);

			$ch = curl_init( config("main.URL_API") . 'Soporte?xKey=' . config("main.FIDELITY_KEY"));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string))
            );

			$result = curl_exec($ch);

			$ch1 = json_decode($result);


            $xFecha = new DateTime();
            $idPedido = session('carrito')->idpedido;
            
            
            $ch = file_get_contents( config("main.URL_API") . '/Pedidos?xKey=' . config("main.FIDELITY_KEY") . '&xIdPedido=' . $idPedido );
            $result = json_decode($ch);

            $logPedido = $result->data->pedidos[0]->logPedido;

            $persona = $result->data->pedidos[0]->persona;
            
            $segmento = array("idsegmento"=> $xEcom->segmento_compradores);
            $sitio = array("idsitio" => config("main.ID_SITIO"));
            
            $persona->sitio = $sitio;
            $persona->segmento = $segmento;
            $persona->tipoPers = 'persona';
            $persona->habilitado = 'S';
            
            $estadopago = 2;
            
            $enviarMail = 0;
            
            $logPedido.=$xFecha->format("d/m/Y").": Pendiente,";
            
            $estadoPago    = array("idEstado" => $estadopago);
            $estadoPedido  = array("idEstado" => 12);
            $sitio         = array("idsitio" => config("main.ID_SITIO"));
            $tipoContenido = array("idTipoContenido" => config("main.ID_ECOMMERCE"));
            
            $pedido = array(
                "idPedido"      => $idPedido,
                "sitio"         => $sitio,
                "persona"       => $persona,
                "tipoContenido" => $tipoContenido,
                "estado"        => "",
                "estadoPago"    => $estadoPago,
                "estadoPedido"  => $estadoPedido,
                "logPedido"     => $logPedido,
                "formaPago"     => "Pendiente - MercadoPago: "
            );
            $data_string = json_encode($pedido);

            $ch = curl_init(config("main.URL_API").'/Pedidos?xKey='.config("main.FIDELITY_KEY"));
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );

            $res = curl_exec($ch);
            $res1 = json_decode($res);
		endif;
	}
}