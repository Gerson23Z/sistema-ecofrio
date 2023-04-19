<?php
class Usuarios extends Controller
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
    $data = $this->model->GetUsuarios();
    for ($i = 0; $i < count($data); $i++) {
        $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
        $data[$i]['acciones'] = '<div><button type="button" class="btn btn-primary" onclick="btnEditarUser(' . $data[$i]['id'] . ')">Editar</button>
            <button type="button" class="btn btn-danger"onclick="btnEliminarUser(' . $data[$i]['id'] . ')">Eliminar</button>
            </div>';
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function validar()
  {
    if (empty($_POST['txtUsuario']) || empty($_POST['txtPassword'])) {
      $msg = "Los Campos están vacios";
    } else {
      $txtUsuario = $_POST['txtUsuario'];
      $txtPassword = $_POST['txtPassword'];
      $hash = hash("SHA256", $txtPassword);
      $data = $this->model->getUsuario($txtUsuario, $hash);
      if ($data) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['usuario'] = $data['user'];
        $_SESSION['activo'] = true;
        $msg = "¡OK!";
      } else {
        $msg = "Usuario o Contraseña Incorrecta!";
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {
    $id = $_POST['id'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $usuario = $_POST['txtUsuario'];
    $password = $_POST['txtPassword'];
    $confirmar = $_POST['txtConfirmar'];
    $rol = $_POST['slctRol'];
    $hash = hash("SHA256", $password);
    if (empty($nombre) || empty($apellido) || empty($usuario) || empty($rol) || empty($password) || empty($confirmar)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
        if ($password != $confirmar) {
          $msg = "Las contraseñas no coinciden";
        } else {
          $data = $this->model->registrarUsuario($nombre, $apellido, $usuario, $hash, $rol);
          if ($data == "¡OK!") {
            $msg = "si";
          } else if ($data == "existe") {
            $msg = "El usuario ya existe";
          } else {
            $msg = "Error al registrar el usuario";
          }
        }
      } else {
        $data = $this->model->modificarUsuario($nombre, $apellido, $usuario,$hash, $rol, $id);
        if ($data == "modificado") {
          $msg = "modificado";
        } else if ($data == "existe") {
          $msg = "El usuario ya existe";
        } else {
          $msg = "Error al Modificar el Usuario";
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }


  public function editar(int $id)
  {
    $data = $this->model->editarUser($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {
    $data = $this->model->eliminarUser($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al eliminar el usuario";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function salir()
  {
    session_destroy();
    header("location:" . base_url);
  }

}
?>