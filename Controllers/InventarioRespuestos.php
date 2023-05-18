<?php
class InventarioRespuestos extends Controller
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
    $data = $this->model->getInventarioRespuestos();
    for ($i = 0; $i < count($data); $i++) {
      $fechaCita=$data[$i]['fecha'];
      $fechaCita = date_create($fechaCita);
      $data[$i]['fecha_cita'] = date_format($fechaCita,"d-m-Y");
      if ($data[$i]['unidades'] > 0) {
        $data[$i]['estado'] = '<span class="badge badge-success">Disponible</span>';
      }else{
        $data[$i]['estado'] = '<span class="badge badge-danger">No Disponible</span>';
      }
      $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarRespuesto(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarRespuesto(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function registrar()
  {
    $id = $_POST['id'];
    $codigo = $_POST['txtCodigo'];
    $producto = $_POST['txtProducto'];
    $marca = $_POST['txtMarca'];
    $unidades = $_POST['txtUnidades'];
    $precio = $_POST['txtPrecio'];
    $precio = str_replace("$", "", $precio);
    if (empty($codigo) || empty($producto) || empty($marca)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
          $data = $this->model->registrarRespuesto($codigo, $producto, $marca, $unidades, $precio);
          if ($data == "¡OK!") {
            $msg = "si";
          } else if ($data == "existe") {
            $msg = "El Producto ya existe";
          } else {
            $msg = "Error al registrar el Producto";
          }
      } else {
        $data = $this->model->modificarRespuesto($codigo, $producto, $marca, $unidades, $precio, $id);
        if ($data == "modificado") {
          $msg = "modificado";
        } else if ($data == "existe") {
          $msg = "El Producto ya existe";
        } else {
          $msg = "Error al Modificar el Respuesto";
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function editar(int $id)
  {
    $data = $this->model->editarRespuesto($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {
    $data = $this->model->eliminarRespuesto($id);
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