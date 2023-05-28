<?php
class Usuarios extends Controller
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
    $verificar = $this->model->verificarPermiso($id_usuario, 'Usuarios');
    if (!empty($verificar) || $id_usuario == 1) {
      $this->Views->getView($this, "index");
    } else {
      header("location:" . base_url . "Errors/permisos");
    }
  }
  public function permisos($id)
  {
    if (empty($_SESSION['activo'])) {
      header("location:" . base_url);
    }
    $data['datos'] = $this->model->getPermisos();
    $permisos = $this->model->getDetallesPermisos($id);
    $data['asignados'] = array();
    foreach($permisos as $permiso){
      $data['asignados'][$permiso['id_permiso']] = true;
    }
    $data['id_usuario'] = $id;
    $this->Views->getView($this, "permisos", $data);
  }

  public function listar()
  {
    $data = $this->model->GetUsuarios();
    for ($i = 0; $i < count($data); $i++) {
      if( $data[$i]['id']==1){
        $data[$i]['acciones'] = '<span class="badge badge-success">Administrador</span>';
      }else{
        $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
        $data[$i]['acciones'] = '<div>
        <a type="button" class="btn btn-dark" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . '"><i class="fas fa-key"></i></a>
        <button type="button" class="btn btn-primary" onclick="btnEditarUsuario(' . $data[$i]['id'] . ')"><i class="fas fa-pen-to-square"></i></button>
              <button type="button" class="btn btn-danger"onclick="btnEliminarUsuario(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
              </div>';
      }
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
    $hash = hash("SHA256", $password);
    if (empty($nombre) || empty($apellido) || empty($usuario) || empty($password) || empty($confirmar)) {
      $msg = "Todos los campos son obligatorios";
    } else {
      if ($id == "") {
        if ($password != $confirmar) {
          $msg = "Las contraseñas no coinciden";
        } else {
          $data = $this->model->registrarUsuario($nombre, $apellido, $usuario, $hash);
          if ($data == "¡OK!") {
            $msg = "si";
          } else if ($data == "existe") {
            $msg = "El usuario ya existe";
          } else {
            $msg = "Error al registrar el usuario";
          }
        }
      } else {
        if ($password != $confirmar) {
          $msg = "Las contraseñas no coinciden";
        } else {
          $data = $this->model->modificarUsuario($nombre, $apellido, $usuario, $hash, $id);
          if ($data == "modificado") {
            $msg = "modificado";
          } else if ($data == "existe") {
            $msg = "El usuario ya existe";
          } else {
            $msg = "Error al Modificar el Usuario";
          }
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }


  public function editar(int $id)
  {
    $data = $this->model->editarUsuario($id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {
    $data = $this->model->eliminarUsuario($id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = "Error al eliminar el usuario";
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrarPermiso()
  {
    $msg = '';
    $id_usuario = $_POST['id_usuario'];
    $eliminar = $this->model->eliminarPermisos($id_usuario);
    if ($eliminar == 'ok') {
      foreach ($_POST['permisos'] as $id_permiso) {
        $msg = $this->model->registrarPermisos($id_usuario, $id_permiso);
      }
      if ($msg == 'ok') {
        $msg = array('msg' => 'Permisos asignados', 'icono' => 'success');
      } else {
        $msg = array('msg' => 'Error al asignar los permisos', 'icono' => 'error');
      }
    } else {
      $msg = array('msg' => 'Error al eliminar los permisos anteriores', 'icono' => 'error');
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