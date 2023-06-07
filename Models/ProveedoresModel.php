<?php
class ProveedoresModel extends Query
{
  private $nombre, $telefono, $direccion, $id;
  public function __construct()
  {
    parent::__construct();
  }

  public function getProveedores()
  {
    $sql = "SELECT * FROM proveedores";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function registrarProveedor(string $nombre, int $telefono, string $direccion)
  {
    $this->nombre = $nombre;
    $this->telefono = $telefono;
    $this->direccion = $direccion;
    $sql = "INSERT INTO proveedores(nombre, telefono, direccion) VALUES (?,?,?)";
    $datos = array($this->nombre, $this->telefono, $this->direccion);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = "¡OK!";
    } else {
      $res = "error";
    }
    return $res;
  }
  public function modificarProveedor(string $nombre, string $telefono, string $direccion, int $id)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->telefono = $telefono;
    $this->direccion = $direccion;
    $sql = "UPDATE proveedores SET nombre = ?,telefono = ?,direccion = ? WHERE id = ?";
    $datos = array($this->nombre, $this->telefono, $this->direccion, $this->id);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $msg = 'ok';
    } else {
      $msg = 'error';
    }
    return $msg;
  }
  public function verificarPermiso(int $id_usuario, string $nombre)
  {
    $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function editar(int $id)
  {
    $sql = "SELECT * FROM proveedores WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function eliminar($id)
  {
    $sql = "DELETE FROM proveedores WHERE id=?";
    $array = array($id);
    $data = $this->save($sql, $array);
    if ($data == 1) {
      $res = 'ok';
    } else {
      $res = 'error';
    }
    return $res;
  }
}
?>