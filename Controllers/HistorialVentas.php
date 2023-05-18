<?php
class HistorialVentas extends Controller
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
    $data = $this->model->getHistorialVentas();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-danger" onclick="mostrarPdfVnt(' . $data[$i]['id'] . ')"><i class="fas fa-file-lines"></i></button>';
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['total'] = '$'.$data[$i]['total'];
      $data[$i]['fecha_venta'] = date_format($fecha,"d-m-Y H:i:s");
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>