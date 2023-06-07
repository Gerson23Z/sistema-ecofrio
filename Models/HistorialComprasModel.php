<?php
class HistorialComprasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialCompras()
  {
    $sql = "SELECT d.*, p.nombre AS proveedor FROM detalles_compras d INNER JOIN proveedores p ON d.id_proveedor = p.id";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialComprasAires()
  {
    $sql = "SELECT d.*, p.nombre AS proveedor FROM detalles_comprasaires d INNER JOIN proveedores p ON d.id_proveedor = p.id";
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