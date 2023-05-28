<?php
class UsuariosModel extends Query
{
  private $nombre, $apellido, $usuario, $password, $id, $estado;

  public function __construct()
  {
    parent::__construct();
  }
  public function getUsuario(string $txtUsuario, string $txtPassword)
  {
    $sql = "SELECT * FROM usuarios WHERE user = '$txtUsuario' AND password = '$txtPassword'";
    $data = $this->select($sql);
    return $data;
  }

  public function getUsuarios()
  {
    $sql = "SELECT * FROM usuarios WHERE estado = 1";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getPermisos()
  {
    $sql = "SELECT * FROM permisos";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getDetallesPermisos($id_usuario)
  {
    $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id_usuario";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function registrarUsuario(string $nombre, string $apellido, string $usuario, string $password)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->usuario = $usuario;
    $this->password = $password;
    $verificar = "SELECT * FROM usuarios WHERE user = '$this->usuario'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "INSERT INTO usuarios(nombre, apellido, user, password, estado) VALUES (?,?,?,?,?)";
      $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, 1);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "¡OK!";
      } else {
        $res = "error";
      }
    } else {
      $res = "existe";
    }
    return $res;
  }

  public function modificarUsuario(string $nombre, string $apellido, string $usuario, string $password, int $id)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->usuario = $usuario;
    $this->password = $password;
    $verificar = "SELECT * FROM usuarios WHERE user = '$this->usuario'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "UPDATE usuarios SET nombre = ?,apellido = ?,user = ?,password = ? WHERE id = ?";
      $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }
    } else {
      $verificar = "SELECT * FROM usuarios WHERE id = '$this->id'";
      $existe = $this->select($verificar);
      if ($existe['user'] == $usuario) {
        $sql = "UPDATE usuarios SET nombre = ?,apellido = ?,user = ?,password = ? WHERE id = ?";
        $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
          $res = "modificado";
        } else {
          $res = "error";
        }
      } else {
        $res = "existe";
      }
    }
    return $res;
  }

  public function editarUsuario(int $id)
  {
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function eliminarUsuario(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE usuarios SET estado = 0 WHERE id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }
  public function registrarPermisos($id_usuario, $id_permiso)
  {
    $sql = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
    $datos = array($id_usuario, $id_permiso);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = 'ok';
    } else {
      $res = 'error';
    }
    return $res;
  }
  public function eliminarPermisos($id_usuario)
  {
    $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
    $array = array($id_usuario);
    $data = $this->save($sql, $array);
    if ($data == 1) {
      $res = 'ok';
    } else {
      $res = 'error';
    }
    return $res;
  }
  public function verificarPermiso(int $id_usuario, string $nombre)
  {
      $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
      $data = $this->selectAll($sql);
      return $data;
  }
}
?>