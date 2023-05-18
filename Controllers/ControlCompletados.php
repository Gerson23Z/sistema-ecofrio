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
    $this->Views->getView($this, "index");
  }

  public function listar()
  {
    $data = $this->model->GetCitasCompletadas();
    for ($i = 0; $i < count($data); $i++) {
        $fechaCita=$data[$i]['fecha'];
        $fechaCita = date_create($fechaCita);
        $data[$i]['fecha_cita'] = date_format($fechaCita,"d-m-Y");
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