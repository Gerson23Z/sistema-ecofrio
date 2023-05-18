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
}
?>
