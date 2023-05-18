<?php
class ControlCompletadosModel extends Query
{
  private $id;
  public function __construct()
  {
    parent::__construct();
  }
  public function GetCitasCompletadas()
  {
    $sql = "SELECT * FROM citas WHERE completado = 1";
    $data = $this->selectAll($sql);
    return $data;
  }
}
?>