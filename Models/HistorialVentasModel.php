<?php
class HistorialVentasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialVentas()
  {
    $sql = "SELECT v.*, u.user AS usuario FROM ventas v INNER JOIN usuarios u ON v.id_usuario = u.id";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialVentasProductos()
  {
    $sql = "SELECT v.*, u.user AS usuario FROM detalles_ventas v INNER JOIN usuarios u ON v.id_usuario = u.id";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialVentasAires()
  {
    $sql = "SELECT v.*, u.user AS usuario, c.nombre AS cliente FROM ventasaires v INNER JOIN usuarios u ON v.id_usuario = u.id INNER JOIN clientes c ON v.id_cliente = c.id";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialVentasAiresPro()
  {
    $sql = "SELECT v.*, u.user AS usuario, c.nombre AS cliente FROM detalles_ventasaires v INNER JOIN usuarios u ON v.id_usuario = u.id INNER JOIN clientes c ON v.id_cliente = c.id";
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