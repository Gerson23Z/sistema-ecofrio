<?php
class UsuariosEliminados extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Usuarios');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function listar()
  {
    $data = $this->model->getUsuariosEliminados();
    for ($i = 0; $i < count($data); $i++) {
      $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
      $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnReingresarUsuario(' . $data[$i]['id'] . ')"><i class="fas fa-rotate-left"></i></button>
        </div> ';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresar(int $id)
  {
    $data = $this->model->reingresarUsuario($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al reingresar el usuario";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>