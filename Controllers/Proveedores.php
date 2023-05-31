<?php
class Proveedores extends Controller
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
        $verificar = $this->model->verificarPermiso($id_usuario, 'Proveedores');
        if (!empty($verificar) || $id_usuario == 1) {
            $this->Views->getView($this, "index");
        } else {
            header("location:" . base_url . "Errors/permisos");
        }
    }
    public function registrar()
    {

        $id = $_POST['id'];
        $nombre = $_POST['nombreProveedor'];
        $telefono = $_POST['telefonoProveedor'];
        $direccion = $_POST['direccionProveedor'];
        if (empty($nombre) || empty($telefono) || empty($direccion)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarProveedor($nombre, $telefono, $direccion);
                if ($data == "¡OK!") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar el Proveedor";
                }
            } else {
                $id_usuario = $_SESSION['id'];
                $verificar = $this->model->verificarPermiso($id_usuario, 'Editar Proveedores');
                if (!empty($verificar) || $id_usuario == 1) {
                    $data = $this->model->modificarProveedor($nombre, $telefono, $direccion, $id);
                    if ($data == "ok") {
                        $msg = "modificado";
                    } else {
                        $msg = "Error al Modificar el Proveedor";
                    }
                } else {
                    $msg = "denegado";
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getProveedores();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
          <button type="button" class="btn btn-primary" onclick="btnEditarProveedor(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-danger"onclick="btnEliminarProveedor(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
                </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id)
    {
        $id_usuario = $_SESSION['id'];
        $verificar = $this->model->verificarPermiso($id_usuario, 'Editar Proveedores');
        if (!empty($verificar) || $id_usuario == 1) {
            $data = $this->model->eliminar($id);
            if ($data == 'ok') {
                $msg = array('msg' => 'Proveedor Eliminado', 'estado' => true, 'tipo' => 'success');
            } else {
                $msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'danger');
            }
        } else {
            $msg = "denegado";
        }
        echo json_encode($msg);
        die();
    }
}
?>