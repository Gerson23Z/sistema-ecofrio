<?php
class Inventario extends Controller
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
    $data = $this->model->getInventario();
    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['unidades'] > 0) {
        $data[$i]['estado'] = '<span class="badge badge-success">Disponible</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarProducto(' . $data[$i]['id'] . ')">Editar</button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarProducto(' . $data[$i]['id'] . ')">Eliminar</button>
            </div>';
      }else{
        $data[$i]['estado'] = '<span class="badge badge-danger">No Disponible</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarProducto(' . $data[$i]['id'] . ')">Editar</button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarProducto(' . $data[$i]['id'] . ')">Eliminar</button>
            </div>';
      }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function registrar()
  {
    $id = $_POST['id'];
    $codigo = $_POST['txtCodigo'];
    $producto = $_POST['txtProducto'];
    $tipo = $_POST['slcTipo'];
    $especificaciones = $_POST['txtEspecificaciones'];
    $unidades = $_POST['txtUnidades'];
    if (empty($codigo) || empty($producto) || empty($tipo) || empty($especificaciones) || empty($unidades)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
          $data = $this->model->registrarProducto($codigo, $producto, $tipo, $especificaciones, $unidades);
          if ($data == "¡OK!") {
            $msg = "si";
          } else if ($data == "existe") {
            $msg = "El producto ya existe";
          } else {
            $msg = "Error al registrar el producto";
          }
      } else {
        $data = $this->model->modificarProducto($codigo, $producto, $tipo, $especificaciones, $unidades, $id);
        if ($data == "modificado") {
          $msg = "modificado";
        } else if ($data == "existe") {
          $msg = "El Producto ya existe";
        } else {
          $msg = "Error al Modificar el Producto";
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function editar(int $id)
  {
    $data = $this->model->editarProducto($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {
    $data = $this->model->eliminarProducto($id);
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