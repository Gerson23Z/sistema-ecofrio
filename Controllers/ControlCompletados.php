<?php
class ControlCompletados extends Controller
{
  public function __construct()
  {
    session_start();
    parent::__construct();
  }

  public function index()
  {
    if (empty($_SESSION['activo'])) {
      header("location:" . base_url);
    }
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'ControlCompletados');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function listar()
  {
    $data = $this->model->GetCitasCompletadas();
    for ($i = 0; $i < count($data); $i++) {
      $fechaCita = $data[$i]['fecha'];
      $fechaCita = date_create($fechaCita);
      $data[$i]['fecha_cita'] = date_format($fechaCita, "d-m-Y");
      $data[$i]['estado'] = '<span class="badge badge-primary">Completado</span>';
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarCita(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarCita(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>