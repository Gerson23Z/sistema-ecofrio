<?php
class Clientes extends Controller
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
  public function Listar()
  {
    $data = $this->model->getClientes();
    for ($i = 0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarCliente(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-danger"onclick="btnEliminarCliente(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function editar(int $id)
  {
    $data = $this->model->editarCliente($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function modificar()
  {
    $id = $_POST['id'];
    $dui = $_POST['dui'];
    $nombre = $_POST['nombreCliente'];
    $telefono = $_POST['telefonoCliente'];
    $direccion = $_POST['direccionCliente'];
    if (empty($dui) || empty($nombre) || empty($telefono) || empty($direccion)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      $data = $this->model->modificarCliente($dui, $nombre, $telefono, $direccion, $id);
      if ($data == "modificado") {
        $msg = "modificado";
      } else if ($data == "existe") {
        $msg = "existe";
      } else {
        $msg = "Error al Modificar el cliente";
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function eliminar($id)
  {
    $data = $this->model->eliminar($id);
    if ($data == 'ok') {
      $msg = array('msg' => 'Cliente Eliminado', 'estado' => true, 'tipo' => 'success');
    } else {
      $msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'danger');
    }
    echo json_encode($msg);
    die();
  }
}

?>