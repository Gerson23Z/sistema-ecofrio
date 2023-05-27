<?php
class Configuracion extends Controller
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
    public function caja()
    {
        $this->Views->getView($this, "caja");
    }


    public function mostrar(int $id)
    {
        $data = $this->model->mostrarInfoEmpresa($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $dueno = $_POST['dueno'];
        $mensaje = $_POST['mensaje'];
        $data = $this->model->modificarInfo($nombre, $direccion, $telefono, $dueno, $mensaje, $id);
        if ($data == "modificado") {
            $msg = "modificado";
        } else {
            $msg = "Error al Modificar";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function abrirCaja()
    {
        $id = $_POST['id'];
        $montoInicial = $_POST['montoIncial'];
        $fechaApertura = date('Y-m-d');
        $id_usuario = $_SESSION['id'];
        if (empty($montoInicial)) {
            $msg = array('msg' => 'todos los campos son requeridos', 'estado' => false);
        } else {
            if ($id == "") {
                $data = $this->model->registrarArqueo($id_usuario, $montoInicial, $fechaApertura);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Caja abierta', 'estado' => true, 'tipo' => 'success');
                } elseif ($data == 'existe') {
                    $msg = array('msg' => 'La caja ya esta abierta', 'estado' => false, 'tipo' => 'danger');
                } else {
                    $msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'danger');
                }
            } else {
                $data['monto_ventas'] = $this->model->getVentas($id_usuario);
                $data['monto_aires'] = $this->model->getVentasAires($id_usuario);
                $montoFinal = $data['monto_ventas']['total'] + $data['monto_aires']['total'];
                $data['ventas'] = $this->model->getTotalVentas($id_usuario);
                $data['aires'] = $this->model->getTotalVentasAires($id_usuario);
                $totalVentas = $data['ventas']['total'] + $data['aires']['total'];
                $inicial = $this->model->getMontoInicial($id_usuario);
                $general = $montoFinal + $inicial['monto_inicial'];
                $data = $this->model->actualizarArqueo($id_usuario, $montoFinal, $fechaApertura, $totalVentas, $general, $inicial['id']);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Caja cerrada con exito', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'danger');
                }
            }
        }
        echo json_encode($msg);
    }
    public function listar()
    {
        $data = $this->model->getCajas();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Abierta</span>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Cerrada</span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    function cerrar()
    {

    }
    public function ventas()
    {
        $id_usuario = $_SESSION['id'];
        $data['monto_ventas'] = $this->model->getVentas($id_usuario);
        $data['monto_aires'] = $this->model->getVentasAires($id_usuario);
        $data['ventas'] = $this->model->getTotalVentas($id_usuario);
        $data['aires'] = $this->model->getTotalVentasAires($id_usuario);
        $data['monto_total_pre'] = $data['monto_ventas']['total'] + $data['monto_aires']['total'];
        $data['monto_total'] = number_format($data['monto_total_pre'], 2);
        $data['total_ventas'] = $data['ventas']['total'] + $data['aires']['total'];
        $data['inicial'] = $this->model->getMontoInicial($id_usuario);
        $data['monto_general_pre'] = $data['monto_total_pre'] + $data['inicial']['monto_inicial'];
        $data['monto_general'] = number_format($data['monto_general_pre'], 2);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>