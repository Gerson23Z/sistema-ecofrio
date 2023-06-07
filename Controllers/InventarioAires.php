<?php
class InventarioAires extends Controller
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
    $data = $this->model->GetInventarioAires();
    for ($i = 0; $i < count($data); $i++) {
      $data[$i]['precio'] = '$' . $data[$i]['precio'];
      if ($data[$i]['cantidad'] > 0) {
        $data[$i]['estado'] = '<span class="badge badge-success">Disponible</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarAire(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarAire(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
      } else {
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
    $codigo = $_POST['codigo'];
    $marca = $_POST['slctMarca'];
    $capacidad = $_POST['slctCapacidad'];
    $seer = $_POST['slctSeer'];
    $voltaje = $_POST['slctVoltaje'];
    $modelo = $_POST['slctModelo'];
    $caracteristica = $_POST['slctCaracteristica'];
    $precio = $_POST['precio'];
    $precio = str_replace("$", "", $precio);
    $cantidad = $_POST['txtCantidad'];
    if (empty($cantidad)) {
      $cantidad = 0;
    }
    if (empty($codigo) || empty($marca) || empty($capacidad) || empty($seer) || empty($voltaje) || empty($modelo) || empty($caracteristica) || empty($precio)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
        $data = $this->model->registrarAire($codigo, $marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $precio, $cantidad);
        if ($data == "¡OK!") {
          $msg = "si";
        } else {
          $msg = "Error al registrar el producto";
        }
      } else {
        $id_usuario = $_SESSION['id'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'Editar Inventarios');
        if (!empty($verificar) || $id_usuario == 1) {
          $data = $this->model->modificarAire($codigo, $marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $precio, $cantidad, $id);
          if ($data == "modificado") {
            $msg = "modificado";
          } else {
            $msg = "Error al Modificar el Producto";
          }
        } else {
          $msg = "denegado";
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
    $id_usuario = $_SESSION['id'];
    $verificar = $this->model->verificarPermiso($id_usuario, 'Editar Inventarios');
    if (!empty($verificar) || $id_usuario == 1) {
      $data = $this->model->eliminarAire($id);
      if ($data == 1) {
        $msg = "ok";
      } else {
        $msg = "Error al eliminar el producto";
      }
    } else {
      $msg = "denegado";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
}
?>