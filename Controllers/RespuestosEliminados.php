<?php
class RespuestosEliminados extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Inventario');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function listar()
  {
    $data = $this->model->getRespuestosEliminados();
    for ($i = 0; $i < count($data); $i++) {
      $data[$i]['precio'] = '$'.$data[$i]['precio'];
      $fechaCita = $data[$i]['fecha'];
      $fechaCita = date_create($fechaCita);
      $data[$i]['fecha_cita'] = date_format($fechaCita, "d-m-Y");
      if ($data[$i]['estado'] == 0) {
        $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
      }
      $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnReingresarRespuesto(' . $data[$i]['id'] . ')"><i class="fas fa-rotate-left"></i></button>
        </div> ';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresar(int $id)
  {
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Editar Inventarios');
    if (!empty($verificar) || $id_usuario == 1) {
    $data = $this->model->reingresarRespuesto($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al reingresar el producto";
    }
        } else {
      $msg = "denegado";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>