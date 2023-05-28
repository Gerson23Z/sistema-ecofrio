<?php
class Control extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Control de citas');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }

  public function listar()
  {
    $data = $this->model->GetCitas();
    for ($i = 0; $i < count($data); $i++) {
      $fechaActual = strtotime("today");
      $fechaCita = strtotime($data[$i]['fecha']);
      $diferencia_ts = $fechaCita - $fechaActual;
      $diferencia_dias = round($diferencia_ts / 86400);
      $diferencia_dias = $diferencia_dias;
      $data[$i]['rest'] = "Cita en ".$diferencia_dias." días";
      $fechaCita = date_create($data[$i]['fecha']);
      $data[$i]['fecha_cita'] = date_format($fechaCita, "d-m-Y");
      if ($diferencia_dias < 0) {
          $data[$i]['estado'] = '<span class="badge badge-danger">Retrasado</span>';
          $data[$i]['rest'] = "Vencido hace " . abs($diferencia_dias) . " días";
      } elseif ($diferencia_dias == 0) {
          $data[$i]['estado'] = '<span class="badge badge-warning">Hoy</span>';
      } else {
          $data[$i]['estado'] = '<span class="badge badge-success">Pendiente</span>';
      }
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarCita(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarCita(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function editar(int $id)
  {
    $data = $this->model->editarCita($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function marcar(int $id)
  {
    $data = $this->model->marcarCita($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al marcar la cita";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>