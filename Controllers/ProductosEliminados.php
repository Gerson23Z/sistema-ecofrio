<?php
class ProductosEliminados extends Controller
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
    $data = $this->model->getProductosEliminados();
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 0) {
        $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
        $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnReingresarProducto(' . $data[$i]['id'] . ')">Reingresar</button>
        </div> ';
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresar(int $id)
  {
    $data = $this->model->reingresarProducto($id);
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