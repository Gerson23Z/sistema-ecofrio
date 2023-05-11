<?php
class Historial extends Controller
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
    $data = $this->model->getHistorialCompras();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-danger" onclick="mostrarPdf(' . $data[$i]['id'] . ')"><i class="fas fa-file-lines"></i></button>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>