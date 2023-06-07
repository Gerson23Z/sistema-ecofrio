<?php
class Compras extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location:" . base_url);
        }
        parent::__construct();
    }

    public function index()
    {
        $id_usuario = $_SESSION['id'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'Compras');
        if (!empty($verificar) || $id_usuario == 1) {
            $data = $this->model->getProveedores();
            $this->Views->getView($this, "index", $data);
        } else {
            header("location:" . base_url . "Errors/permisos");
        }
    }
    public function aires()
    {
        $id_usuario = $_SESSION['id'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'Compras');
        if (!empty($verificar) || $id_usuario == 1) {
            $data = $this->model->getProveedores();
            $this->Views->getView($this, "aires", $data);
        } else {
            header("location:" . base_url . "Errors/permisos");
        }
    }
    public function buscarCodigo($cod)
    {
        $data = $this->model->GetCodPro($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarAire($cod)
    {
        $data = $this->model->GetCodAir($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarCompra()
    {
        $id = $_POST['id'];
        $datos = $this->model->GetProducto($id);
        $codigo = $datos[0]['codigo'];
        $producto = $datos[0]['producto'];
        $precio = $_POST['txtPrecio'];
        $precio = str_replace("$", "", $precio);
        $cantidad = $_POST['txtCantidad'];
        $proveedor = $_POST['slctProveedor'];
        $comprobar = $this->model->comprobarDetalle($datos[0]['codigo']);
        if (empty($comprobar)) {
            $subTotal = $precio * $cantidad;
            $data = $this->model->RegistrarDetalle($codigo, $producto, $precio, $cantidad, $subTotal, $proveedor);
            if ($data == "¡OK!") {
                $msg = "si";
            } else {
                $msg = "Error al registrar";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $subTotal = $precio;
            $data = $this->model->actualizarDetalle($codigo, $producto, $precio, $total_cantidad, $subTotal, $proveedor, $comprobar['id']);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarAire()
    {
        $id = $_POST['id'];
        $datos = $this->model->GetAire($id);
        $codigo = $datos[0]['codigo'];
        $marca = $datos[0]['marca'];
        $capacidad = $datos[0]['capacidad'];
        $seer = $datos[0]['seer'];
        $precio = $_POST['txtPrecio'];
        $precio = str_replace("$", "", $precio);
        $cantidad = $_POST['txtCantidad'];
        $proveedor = $_POST['slctProveedor'];
        $comprobar = $this->model->comprobarDetalleAire($datos[0]['codigo']);
        if (empty($comprobar)) {
            $subTotal = $precio * $cantidad;
            $data = $this->model->RegistrarDetalleAire($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subTotal, $proveedor);
            if ($data == "¡OK!") {
                $msg = "si";
            } else {
                $msg = "Error al registrar";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $subTotal = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalleAire($codigo, $marca, $capacidad, $seer, $precio, $total_cantidad, $subTotal, $proveedor, $comprobar['id']);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data['detalles'] = $this->model->getDetalles();
        $data['total_pagar'] = $this->model->calcularCompra();
        echo json_encode($data);
        die();
    }
    public function listaraire()
    {
        $data['detalles'] = $this->model->getDetallesAire();
        $data['total_pagar'] = $this->model->calcularCompraAire();
        echo json_encode($data);
        die();

    }

    public function getCodigosCompras($codigo)
    {
        $stmt = $this->model->getCodigoCompra($codigo);
        $response = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = $row["codigo"];
        }

        echo json_encode($response);
        die();
    }

    public function getCodigosAire($codigo)
    {
        $stmt = $this->model->getCodigoAire($codigo);
        $response = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = $row["codigo"];
        }

        echo json_encode($response);
        die();
    }

    public function eliminar($id)
    {
        $data = $this->model->eliminarDetalle($id);
        if ($data == "¡OK!") {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el detalle";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminarAire($id)
    {
        $data = $this->model->eliminarDetalleAire($id);
        if ($data == "¡OK!") {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el detalle";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarCompra()
    {
        $cmpCompra = $this->model->getDetalles();
        if (empty($cmpCompra)) {
            $msg = 'vacioCompra';
        } else {
            $detalles = $this->model->getDetalles();
            foreach ($detalles as $row) {
                $codigo = $row['codigo'];
                $producto = $row['producto'];
                $precio = $row['precio'];
                $cantidad = $row['cantidad'];
                $proveedor = $row['id_proveedor'];
                $subtotal = $precio * $cantidad;
                $this->model->registrarDetallesCompra($codigo, $producto, $precio, $cantidad, $subtotal, $proveedor);
                $codigoProducto = $row['codigo'];
                $stockActual = $this->model->GetProductos($codigoProducto);
                $stock = $stockActual[0]['unidades'] + $cantidad;
                $this->model->actualizarStock($stock, $codigoProducto);
            }
            $this->model->vaciarDetalles();
            $msg = array('msg' => 'ok');

        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarCompraAire()
    {
        $cmpCompra = $this->model->getDetallesAire();
        if (empty($cmpCompra)) {
            $msg = 'vacioCompra';
        } else {
            $detalles = $this->model->getDetallesAire();
            foreach ($detalles as $row) {
                $codigo = $row['codigo'];
                $marca = $row['marca'];
                $capacidad = $row['capacidad'];
                $seer = $row['seer'];
                $precio = $row['precio'];
                $cantidad = $row['cantidad'];
                $proveedor = $row['id_proveedor'];
                $subtotal = $precio * $cantidad;
                $this->model->registrarDetallesCompraAire($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subtotal, $proveedor);
                $codigoProducto = $row['codigo'];
                $stockActual = $this->model->GetAires($codigoProducto);
                $stock = $stockActual[0]['cantidad'] + $cantidad;
                $this->model->actualizarStockAires($stock, $codigoProducto);
            }
            $this->model->vaciarDetallesAir();
            $msg = array('msg' => 'ok');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>