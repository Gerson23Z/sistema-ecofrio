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
        $fecha=$data[$i]['fecha'];
        $fechaAnterior = date_create($fecha);
        $fechaProx = date_create($fecha);
        date_add($fechaProx, date_interval_create_from_date_string("3 months"));
        $data[$i]['fecha'] = date_format($fechaAnterior,"d-m-Y");
        $data[$i]['prox'] = date_format($fechaProx,"d-m-Y");
        $data[$i]['acciones'] = ' <div>
        <button type="button" class="btn btn-success" type="button" onclick="btnEditarMantenimiento(' . $data[$i]['id'] . ')"><i class="fas fa-calendar"></i></button>
        </div> ';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function editar(int $id)
  {
    $data = $this->model->editarCitaMan($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>