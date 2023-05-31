<?php
class HistorialComprasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialCompras()
  {
    $sql = "SELECT * FROM detalles_compras";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialComprasAires()
  {
    $sql = "SELECT * FROM detalles_comprasaires";
    $data = $this->selectAll($sql);
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
