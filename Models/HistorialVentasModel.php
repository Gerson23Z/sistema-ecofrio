<?php
class HistorialVentasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialVentas()
  {
    $sql = "SELECT v.*,v.id_usuario, u.user AS usuario FROM ventas v INNER JOIN usuarios u ON v.id_usuario = u.id";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialVentasAires()
  {
    $sql = "SELECT v.*,v.id_usuario, u.user AS usuario FROM ventasaires v INNER JOIN usuarios u ON v.id_usuario = u.id";
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
