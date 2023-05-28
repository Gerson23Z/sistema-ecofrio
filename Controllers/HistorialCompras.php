<?php
class HistorialCompras extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de Compras');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function aires()
  {
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de Compras');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "aires");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function listar()
  {
    $data = $this->model->getHistorialCompras();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-danger" onclick="mostrarPdfCmp(' . $data[$i]['id'] . ')"><i class="fas fa-file-lines"></i></button>';
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['total'] = '$'.$data[$i]['total'];
      $data[$i]['fecha_compra'] = date_format($fecha,"d-m-Y H:i:s");
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function listarAires()
  {
    $data = $this->model->getHistorialComprasAires();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-danger" onclick="mostrarPdfVntAire(' . $data[$i]['id'] . ')"><i class="fas fa-file-lines"></i></button>';
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['total'] = '$'.$data[$i]['total'];
      $data[$i]['fecha_compra'] = date_format($fecha,"d-m-Y H:i:s");
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>