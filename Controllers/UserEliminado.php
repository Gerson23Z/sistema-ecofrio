<?php
class UserEliminado extends Controller
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

  public function listar()
  {
    $data = $this->model->getUsuariosEliminados();
    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
        $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ')">Reingresar</button>
        </div> ';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresar(int $id)
  {
    $data = $this->model->reingresarUser($id);
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