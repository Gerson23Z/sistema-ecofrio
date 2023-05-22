<?php
class HistorialVentasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialVentas()
  {
    $sql = "SELECT * FROM ventas";
    $data = $this->selectAll($sql);
    return $data;
  }
  public function getHistorialVentasAires()
  {
    $sql = "SELECT * FROM ventasaires";
    $data = $this->selectAll($sql);
    return $data;
  }
}
?>
