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
        $producto = $datos[0]['producto'];
        $precio = $datos[0]['precio'];
        $cantidad = $_POST['txtCantidad'];
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
                $codigoProducto = $row['codigo'];
                $stockActual = $this->model->GetProductos($codigoProducto);
                $stock = $stockActual[0]['unidades'] + $cantidad;
                $this->model->actualizarStock($stock, $codigoProducto);
            }
            $this->model->vaciarDetalles();
            $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
        } else {
            $msg = "Error al registrar la compra";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function generarPDF($id_compra)
    {
        $data = $this->model->getEmpresa();
        $productosCompras = $this->model->getProCompras($id_compra);
        //se llama la libreria
        require('Libraries/fpdf/fpdf.php');
        //ajustes
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Comprobante de compra');
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
        //telefono
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Telefono: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, utf8_decode($data['telefono']), 0, 1, 'L');
        //dueño
        $pdf->Cell(20, 5, utf8_decode($data['dueno']), 0, 1, 'L');
        //folio
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(18, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        $pdf->Ln();
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
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Total a pagar:', 0, 1, 'R');
        $pdf->Cell(70, 5, '$' . number_format($total, 2, '.', ','), 0, 1, 'R');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(65, 10, utf8_decode($data['mensaje']), 0, 1, 'C');
        $pdf->Output();
    }
}

?>