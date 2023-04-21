<?php
class RespuestosEliminados extends Controller
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
    $data = $this->model->getRespuestosEliminados();
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 0) {
        $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
        $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnReingresarRespuesto(' . $data[$i]['id'] . ')"><i class="fas fa-rotate-left"></i></button>
        </div> ';
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresar(int $id)
  {
    $data = $this->model->reingresarRespuesto($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al reingresar el producto";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>