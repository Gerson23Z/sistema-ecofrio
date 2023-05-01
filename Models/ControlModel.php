<?php
class ControlModel extends Query
{
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

  public function editarCitaMan(int $id)
  {
    $sql = "SELECT * FROM citas WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

}
?>
