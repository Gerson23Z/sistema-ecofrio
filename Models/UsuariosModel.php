<?php
class UsuariosModel extends Query
{
  private $nombre, $apellido, $usuario, $password, $rol, $id, $estado;

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

  public function registrarUsuario(string $nombre, string $apellido, string $usuario, string $password, string $rol)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->usuario = $usuario;
    $this->password = $password;
    $this->rol = $rol;
    $verificar = "SELECT * FROM usuarios WHERE user = '$this->usuario'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "INSERT INTO usuarios(nombre, apellido, user, password, rol, estado) VALUES (?,?,?,?,?,?)";
      $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, $this->rol, 1);
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

  public function modificarUsuario(string $nombre, string $apellido, string $usuario, string $password,string $rol, int $id)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->usuario = $usuario;
    $this->password = $password;
    $this->rol = $rol;
    $verificar = "SELECT * FROM usuarios WHERE user = '$this->usuario'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "UPDATE usuarios SET nombre = ?,apellido = ?,user = ?,password = ?,rol = ? WHERE id = ?";
      $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, $this->rol, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }}
    else {
    $verificar = "SELECT * FROM usuarios WHERE id = '$this->id'";
    $existe = $this->select($verificar);
      if($existe['user']==$usuario){
        $sql = "UPDATE usuarios SET nombre = ?,apellido = ?,user = ?,password = ?,rol = ? WHERE id = ?";
      $datos = array($this->nombre, $this->apellido, $this->usuario, $this->password, $this->rol, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }
      }else{
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

}
?>