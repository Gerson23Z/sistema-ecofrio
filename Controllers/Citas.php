<?php
class Citas extends Controller
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
    public function registrar()
    {
        if (empty($_POST['nombre']) || empty($_POST['dui']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['fecha'])) {
            $msg = array('msg' => 'todos los campos son requeridos', 'estado' => false);
        } else {
            $nombre = $_POST['nombre'];
            $dui = $_POST['dui'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $tipo = $_POST['tipo'];
            $fecha = $_POST['fecha'];
            if (isset($_POST['check'])) {
                $check = 1;
            } else {
                $check = 0;
            }
            $id = $_POST['id'];
            if ($id == '') {
                $data = $this->model->registrarCita($nombre, $dui, $telefono, $direccion, $tipo, $fecha);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Cita Registrada', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'danger');
                }
            } else {
                $data = $this->model->modificarCita($nombre, $dui, $telefono, $direccion, $tipo, $fecha, $id, $check);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Cita Modificada', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'danger');
                }
            }
        }
        echo json_encode($msg);
    }
    public function listar()
    {
        $data = $this->model->getCitas();
        echo json_encode($data);
        die();
    }
    public function clientes($numDui)
    {
        $data = $this->model->getClientes($numDui);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->eliminar($id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Cita Eliminada', 'estado' => true, 'tipo' => 'success');
        } else {
            $msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'danger');
        }
        echo json_encode($msg);
        die();
    }

    public function drag()
    {
        if (empty($_POST['id']) || empty($_POST['fecha'])) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'estado' => false, 'tipo' => 'danger');
        } else {
            $fecha = $_POST['fecha'];
            $id = $_POST['id'];
            $data = $this->model->dragUpdate($fecha, $id);
            if ($data == 'ok') {
                $msg = array('msg' => 'Cita Modificada', 'estado' => true, 'tipo' => 'success');
            } else {
                $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'danger');
            }
        }
        echo json_encode($msg);

        die();
    }
}
?>