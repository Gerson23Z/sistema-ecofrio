<?php
class Control extends Controller
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
    $data = $this->model->GetCitasCompletadas();
    for ($i = 0; $i < count($data); $i++) {
        $fechaActual = date("Y-m-d");
        $fechaCita=$data[$i]['fecha'];
        $fechaActual_ts = strtotime($fechaActual);
        $fechaCita_ts = strtotime($fechaCita);
        $diferencia_ts = $fechaCita_ts - $fechaActual_ts;
        $diferencia_dias = round($diferencia_ts / 86400);
        $data[$i]['rest'] = "Cita en ".$diferencia_dias." dias";
        $fechaCita = date_create($fechaCita);
        $data[$i]['fecha_cita'] = date_format($fechaCita,"d-m-Y");
        if($data[$i]['completado'] == 1){
          $data[$i]['estado'] = '<span class="badge badge-primary">Completado</span>';
        }elseif($data[$i]['completado'] == 0 && $diferencia_dias<$fechaActual){
          $data[$i]['estado'] = '<span class="badge badge-danger">Retrasado</span>';
        }else{
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