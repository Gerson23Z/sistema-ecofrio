<?php
class Ventas extends Controller
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
    public function aires()
    {
        $this->Views->getView($this, "aires");
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
    public function clientes($numDui)
    {
        $data = $this->model->getClientes($numDui);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getCodigosVentas($codigo)
    {
        $stmt = $this->model->getCodigoVenta($codigo);
        $response = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = $row["codigo"];
        }

        echo json_encode($response);
        die();
    }
    public function getCodigosAires($codigo)
    {
        $stmt = $this->model->getCodigoAire($codigo);
        $response = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = $row["codigo"];
        }

        echo json_encode($response);
        die();
    }
    public function ingresarVenta()
    {
        $id = $_POST['id'];
        $datos = $this->model->GetProducto($id);
        $codigo = $datos[0]['codigo'];
        $producto = $datos[0]['producto'];
        $precio = $datos[0]['precio'];
        $cantidad = $_POST['txtCantidad'];
        if ($datos[0]['unidades'] < $cantidad) {
            $msg = "sobredemanda";
        } else {
            $comprobar = $this->model->comprobarDetalle($datos[0]['codigo']);
            if (empty($comprobar)) {
                $subTotal = $precio * $cantidad;
                $data = $this->model->RegistrarDetalle($codigo, $producto, $precio, $cantidad, $subTotal);
                if ($data == "¡OK!") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar";
                }
            } else {
                $total_cantidad = $comprobar['cantidad'] + $cantidad;
                $subTotal = $total_cantidad * $precio;
                $data = $this->model->actualizarDetalle($codigo, $producto, $precio, $total_cantidad, $subTotal, $comprobar['id']);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al actualizar";
                }
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
        $precio = $datos[0]['precio'];
        $cantidad = $_POST['txtCantidad'];
        if ($datos[0]['cantidad'] < $cantidad) {
            $msg = "sobredemanda";
        } else {
            $comprobar = $this->model->comprobarDetalleAire($datos[0]['codigo']);
            if (empty($comprobar)) {
                $subTotal = $precio * $cantidad;
                $data = $this->model->RegistrarDetalleAire($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subTotal);
                if ($data == "¡OK!") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar";
                }
            } else {
                $total_cantidad = $comprobar['cantidad'] + $cantidad;
                $subTotal = $total_cantidad * $precio;
                $data = $this->model->actualizarDetalleAire($codigo, $marca, $capacidad, $seer, $precio, $total_cantidad, $subTotal, $comprobar['id']);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al actualizar";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data['detalles'] = $this->model->getDetalles();
        $data['total_pagar'] = $this->model->calcularVenta();
        echo json_encode($data);
        die();

    }
    public function listaraire()
    {
        $data['detalles'] = $this->model->getDetallesAire();
        $data['total_pagar'] = $this->model->calcularVentaAire();
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
    public function registrarVenta()
    {
        $cmpVenta = $this->model->getDetalles();
        if (empty($cmpVenta)) {
            $msg = 'vacioVenta';
        } else {
            $datos = $this->model->calcularVenta()['total'];
            $id_usuario = $_SESSION['id'];
            $data = $this->model->guardarVenta($datos, $id_usuario);
            if ($data == "¡OK!") {
                $id_venta = $this->model->getIdVenta();
                $detalles = $this->model->getDetalles();
                foreach ($detalles as $row) {
                    $producto = $row['producto'];
                    $precio = $row['precio'];
                    $cantidad = $row['cantidad'];
                    $subtotal = $precio * $cantidad;
                    $this->model->registrarDetallesVenta($id_venta['id'], $producto, $precio, $cantidad, $subtotal);
                    $codigoProducto = $row['codigo'];
                    $stockActual = $this->model->GetProductos($codigoProducto);
                    $stock = $stockActual[0]['unidades'] - $cantidad;
                    $this->model->actualizarStock($stock, $codigoProducto);
                }
                $this->model->vaciarDetalles();
                $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
            } else {
                $msg = "Error al registrar la venta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarVentaAire()
    {
        $dui = $_POST['dui'];
        $nombre = $_POST['nombreCliente'];
        $telefono = $_POST['telefonoCliente'];
        $direccion = $_POST['direccionCliente'];
        $cmpVenta = $this->model->getDetallesAire();
        if (empty($cmpVenta)) {
            $msg = 'vacioVenta';
        } else {
            if (empty($dui) || empty($nombre) || empty($telefono) || empty($direccion)) {
                $msg = 'vacio';
            } else {
                $data = $this->model->RegistrarInfoCliente($dui, $nombre, $telefono, $direccion);
                $datos = $this->model->calcularVentaAire()['total'];
                $id_usuario = $_SESSION['id'];
                $data = $this->model->guardarVentaAire($dui, $datos, $id_usuario);
                if ($data == "¡OK!") {
                    $id_venta = $this->model->getIdVentaAire();
                    $detalles = $this->model->getDetallesAire();
                    foreach ($detalles as $row) {
                        $marca = $row['marca'];
                        $capacidad = $row['capacidad'];
                        $seer = $row['seer'];
                        $precio = $row['precio'];
                        $cantidad = $row['cantidad'];
                        $subtotal = $precio * $cantidad;
                        $this->model->registrarDetallesVentaAire($id_venta['id'], $marca, $capacidad, $seer, $precio, $cantidad, $subtotal);
                        $codigoProducto = $row['codigo'];
                        $stockActual = $this->model->GetAires($codigoProducto);
                        $stock = $stockActual[0]['cantidad'] - $cantidad;
                        $this->model->actualizarStockAires($stock, $codigoProducto);
                    }
                    $this->model->vaciarDetallesAir();
                    $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
                } else {
                    $msg = "Error al registrar la venta";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPDF($id_venta)
    {
        $data = $this->model->getEmpresa();
        $productosCompras = $this->model->getProVentas($id_venta);
        $infoCompra = $this->model->getInfoVentas($id_venta);
        $fecha = date_create($infoCompra[0]['fecha']);
        $id_user = $infoCompra[0]['id_usuario'];
        $user = $this->model->getUser($id_user);
        $fecha = date_format($fecha, "d-m-Y H:i:s");
        //se llama la libreria
        require('Libraries/fpdf/fpdf.php');
        //ajustes
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Comprobante de venta');
        //Nombre
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 10, utf8_decode($data['nombre']), 0, 1, 'C');

        // Definir el tamaño de la fuente y el ancho de la celda
        $font_size = 10;
        $cell_width = 70;

        // Definir el texto largo
        $long_text = utf8_decode($data['direccion']);

        // Calcular la altura de la celda necesaria para contener todo el texto
        $cell_height = $font_size * 0.5;

        // Imprimir el texto en una celda MultiCell
        $pdf->SetFont('Arial', '', $font_size);
        $pdf->MultiCell($cell_width, $cell_height, $long_text, 0, 'J', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(65, 5, $fecha, 0, 1, 'C');
        $pdf->Cell(65, 5, 'Telefono: ' . utf8_decode($data['telefono']), 0, 1, 'C');
        $pdf->Cell(65, 5, utf8_decode($data['dueno']), 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 5, 'Folio: ', 0, 0, 'L');
        $pdf->Cell(0, 5, $id_venta, 0, 1, 'L');
        $pdf->Cell(10, 5, 'Caja: ', 0, 0, 'L');
        $pdf->Cell(0, 5, $user[0]['nombre'], 0, 1, 'L');
        $pdf->Cell(10, 5, '------------------------------------------------------------------', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 5, 'Cant: ', 0, 0, 'L');
        $pdf->Cell(33, 5, 'Desc: ', 0, 0, 'L');
        $pdf->Cell(12, 5, 'Precio: ', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Sub Total: ', 0, 1, 'L');
        $total = 0.00;
        $pdf->SetFont('Arial', '', 9);
        foreach ($productosCompras as $row) {
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(33, 5, utf8_decode($row['producto']), 0, 0, 'L');
            $pdf->Cell(12, 5, '$' . number_format($row['precio'], 2, '.', ','), 0, 0, 'L');
            $pdf->Cell(15, 5, '$' . number_format($row['subtotal'], 2, '.', ','), 0, 1, 'L');
            $total = $total + $row['subtotal'];
        }
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(10, 5, '------------------------------------------------------------------', 0, 1, 'L');
        $pdf->Cell(70, 5, 'Total a pagar:', 0, 1, 'R');
        $pdf->Cell(70, 5, '$' . number_format($total, 2, '.', ','), 0, 1, 'R');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(65, 10, utf8_decode($data['mensaje']), 0, 1, 'C');
        $pdf->Output();
    }

    public function generarPDFAire($id_venta)
    {
        $productosCompras = $this->model->getProVentasAire($id_venta);
        $infoCompra = $this->model->getInfoVentasAire($id_venta);
        $infoCliente = $this->model->getClientes($infoCompra[0]["dui"]);
        $fecha = date_create($infoCompra[0]['fecha']);
        $fecha = date_format($fecha, "d-m-Y");
        //se llama la libreria
        require('Libraries/fpdf/fpdf.php');
        //ajustes
        $pdf = new FPDF('P', 'mm', array(170, 200));
        $pdf->AddPage();
        $pdf->SetMargins(10, 0, 0);
        $pdf->SetTitle('Factura de venta');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(150, 35, $fecha, 0, 1, 'R');
        $pdf->Cell(35, 0, utf8_decode($infoCliente[0]["nombre"]), 0, 1, 'L');
        $pdf->Cell(35, 10, utf8_decode($infoCliente[0]["dui"]), 0, 1, 'L');
        $pdf->Cell(35, 0, utf8_decode($infoCliente[0]["direccion"]), 0, 1, 'L');
        $pdf->Ln();
        $pdf->Cell(10, 10, "", 0, 1, 'L');
        $total = 0.00;
        foreach ($productosCompras as $row) {
            $pdf->Cell(10, 10, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(30, 10, "Aire Acondicionado ", 0, 0, 'L');
            $pdf->Cell(20, 10, utf8_decode($row['marca']), 0, 0, 'L');
            $pdf->Cell(16, 10, "capacidad: ", 0, 0, 'L');
            $pdf->Cell(16, 10, utf8_decode($row['capacidad']), 0, 0, 'L');
            $pdf->Cell(8, 10, "seer: ", 0, 0, 'L');
            $pdf->Cell(18, 10, utf8_decode($row['seer']), 0, 0, 'L');
            $pdf->Cell(0, 10, '$' . number_format($row['precio'], 2, '.', ','), 0, 1, 'L');
            $total = $total + $row['subtotal'];
        }
        $pdf->Ln();
        $pdf->Cell(150, 70, '$' . number_format($total, 2, '.', ','), 0, 0, 'R');
        $pdf->Output();
    }
}

?>