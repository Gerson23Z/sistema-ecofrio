<?php
class Compras extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $this->Views->getView($this, "index");
    }
    public function buscarCodigo($cod)
    {
        $data = $this->model->GetCodPro($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarCompra()
    {
        $id = $_POST['id'];
        $datos = $this->model->GetProducto($id);
        $codigo = $datos[0]['codigo'];
        $nombre = $datos[0]['producto'];
        $precio = $datos[0]['precio'];
        $cantidad = $_POST['txtCantidad'];
        $comprobar = $this->model->comprobarDetalle($datos[0]['codigo']);
        if (empty($comprobar)) {
            $subTotal = $precio * $cantidad;
            $data = $this->model->RegistrarDetalle($codigo, $nombre, $precio, $cantidad, $subTotal);
            if ($data == "¡OK!") {
                $msg = "si";
            } else {
                $msg = "Error al registrar";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $subTotal = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle($codigo, $nombre, $precio, $total_cantidad, $subTotal, $comprobar['id']);
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

        $data['detalles'] = $this->model->getDetalles();
        $data['total_pagar'] = $this->model->calcularCompra()['total'];
        echo json_encode($data);
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

    public function registrarCompra()
    {
        $datos = $this->model->calcularCompra()['total'];
        $data = $this->model->guardarCompra($datos);
        if ($data == "¡OK!") {
            $id_compra = $this->model->getIdCompra();
            $detalles = $this->model->getDetalles();
            foreach ($detalles as $row) {
                $producto = $row['producto'];
                $precio = $row['precio'];
                $cantidad = $row['cantidad'];
                $subtotal = $precio * $cantidad;
                $this->model->registrarDetallesCompra($id_compra['id'], $producto, $precio, $cantidad, $subtotal);
            }
            $this->model->vaciarDetalles();
            $msg = "ok";
        } else {
            $msg = "Error al registrar la compra";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}

?>