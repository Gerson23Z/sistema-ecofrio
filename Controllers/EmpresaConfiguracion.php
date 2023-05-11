<?php
class EmpresaConfiguracion extends Controller
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
}
?>