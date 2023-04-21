<?php
class InventarioAires extends Controller
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
    $data = $this->model->GetInventarioAires();
    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['cantidad'] > 0) {
        $data[$i]['estado'] = '<span class="badge badge-success">Disponible</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarAire(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarAire(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
      }else{
        $data[$i]['estado'] = '<span class="badge badge-danger">No Disponible</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarAire(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarAire(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
      }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {
    $id = $_POST['id'];
    $marca = $_POST['slctMarca'];
    $capacidad = $_POST['slctCapacidad'];
    $seer = $_POST['slctSeer'];
    $voltaje = $_POST['slctVoltaje'];
    $modelo = $_POST['slctModelo'];
    $caracteristica = $_POST['slctCaracteristica'];
    $tipo = $_POST['slctTipo'];
    $cantidad = $_POST['txtCantidad'];
    if(empty($cantidad)){
      $cantidad=0;
    }
    if (empty($marca) || empty($capacidad) || empty($seer) || empty($voltaje) || empty($modelo) || empty($caracteristica) || empty($tipo)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
          $data = $this->model->registrarAire($marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $tipo, $cantidad);
          if ($data == "¡OK!") {
            $msg = "si";
          }else {
            $msg = "Error al registrar el producto";
          }
      } else {
        $data = $this->model->modificarAire($marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $tipo, $cantidad, $id);
        if ($data == "modificado") {
          $msg = "modificado";
        }else {
          $msg = "Error al Modificar el Producto";
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function editar(int $id)
  {
    $data = $this->model->editarAire($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {
    $data = $this->model->eliminarAire($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al eliminar el producto";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>