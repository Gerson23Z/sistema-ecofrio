<?php
class HistorialComprasModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getHistorialCompras()
  {
    $sql = "SELECT * FROM compras";
    $data = $this->selectAll($sql);
    return $data;
  }

}
?>
