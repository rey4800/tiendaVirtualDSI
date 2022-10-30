<?php
require_once("Models/TCategorias.php");
require_once("Models/TProducto.php");
class Tienda extends Controllers
{
	use TCategorias, TProducto;
	public function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function tienda()
	{


		$data['page_tag'] = "KayfaStore";
		$data['page_title'] = "Todos los productos";
		$data['page_name'] = "tienda";
		$data['productos'] = $this->getProductos();
		$this->views->getView($this, "tienda", $data);
	}
	public function categoria($params)
	{
		if (empty($params)) {
			header("Location: " . base_url());
		} else {
			$categoria = strClean($params);
			$data['page_tag'] = "KayfaStore" . " |  " . $categoria;
			$data['page_title'] = $categoria;
			$data['page_name'] = "categoria";
			$data['productos'] = $this->getProductosCategoriaT($categoria);
			$this->views->getView($this, "categoria", $data);
		}
	}
	public function producto($params)
	{
		if (empty($params)) {
			header("Location: " . base_url());
		} else {
			$producto = strClean($params);
			$arrProducto =   $this->getProductoT($producto);
			$data['page_tag'] = "KayfaStore" . " |  " . $producto;
			$data['page_title'] = $producto;
			$data['page_name'] = "producto";
			$data['producto'] =		$arrProducto;
			$data['productos'] = $this->getProductosRandom($arrProducto['categoriaid'], 8, "r");
			$this->views->getView($this, "producto", $data);
		}
	}


	public function addCarrito(){
		if($_POST){
			//unset($_SESSION['arrCarrito']);exit;
			$arrCarrito = array();
			$cantCarrito = 0;
			$idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
			$cantidad = $_POST['cant'];
			if(is_numeric($idproducto) and is_numeric($cantidad)){
				$arrInfoProducto = $this->getProductoIDT($idproducto);
				if(!empty($arrInfoProducto)){
					$arrProducto = array('idproducto' => $idproducto,
										'producto' => $arrInfoProducto['nombre'],
										'cantidad' => $cantidad,
										'precio' => $arrInfoProducto['precio'],
										'imagen' => $arrInfoProducto['images'][0]['url_image']
									);
					if(isset($_SESSION['arrCarrito'])){
						$on = true;
						$arrCarrito = $_SESSION['arrCarrito'];
						for ($pr=0; $pr < count($arrCarrito); $pr++) {
							if($arrCarrito[$pr]['idproducto'] == $idproducto){
								$arrCarrito[$pr]['cantidad'] += $cantidad;
								$on = false;
							}
						}
						if($on){
							array_push($arrCarrito,$arrProducto);
						}
						$_SESSION['arrCarrito'] = $arrCarrito;
					}else{
						array_push($arrCarrito, $arrProducto);
						$_SESSION['arrCarrito'] = $arrCarrito;
					}

					foreach ($_SESSION['arrCarrito'] as $pro) {
						$cantCarrito += $pro['cantidad'];
					}
					$htmlCarrito ="";
					$htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
					$arrResponse = array("status" => true, 
										"msg" => '¡Se agrego al corrito!',
										"cantCarrito" => $cantCarrito,
										"htmlCarrito" => $htmlCarrito
									);

				}else{
					$arrResponse = array("status" => false, "msg" => 'Producto no existente.');
				}
			}else{
				$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}
}
