<?php
class ControlModel extends Query
{
  private $id;
  public function __construct()
  {
    parent::__construct();
  }

  public function GetCitas()
  {
    $sql = "SELECT * FROM citas WHERE completado = 0";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function editarCita(int $id)
  {
    $sql = "SELECT * FROM citas WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }
  public function marcarCita(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE citas SET completado = 1 WHERE id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }
  public function verificarPermiso(int $id_usuario, string $nombre)
  {
    $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
    $data = $this->selectAll($sql);
    return $data;
  }
}
?>