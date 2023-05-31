<?php
class HistorialVentas extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de ventas');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }
  public function aires()
  {
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de ventas');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "aires");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }
  public function productos()
  {
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de ventas');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "productos");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function airesven()
  {
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Historial de ventas');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "airesven");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
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
  public function listarProductos()
  {
    $data = $this->model->getHistorialVentasProductos();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['precio'] = '$'.$data[$i]['precio'];
      $data[$i]['subtotal'] = '$'.$data[$i]['subtotal'];
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['fecha_venta'] = date_format($fecha,"d-m-Y H:i:s");

    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function listarAires()
  {
    $data = $this->model->getHistorialVentasAires();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-danger" onclick="mostrarPdfVntAire(' . $data[$i]['id'] . ')"><i class="fas fa-file-lines"></i></button>';
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['total'] = '$'.$data[$i]['total'];
      $data[$i]['fecha_venta'] = date_format($fecha,"d-m-Y H:i:s");
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function listarAiresPro()
  {
    $data = $this->model->getHistorialVentasAiresPro();
    for ($i=0; $i < count($data); $i++) {
      $data[$i]['precio'] = '$'.$data[$i]['precio'];
      $data[$i]['subtotal'] = '$'.$data[$i]['subtotal'];
      $fecha=$data[$i]['fecha'];
      $fecha = date_create($fecha);
      $data[$i]['fecha_venta'] = date_format($fecha,"d-m-Y H:i:s");
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>