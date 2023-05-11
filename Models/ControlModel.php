<?php
class ControlModel extends Query
{
  private $id;
  public function __construct()
  {
    parent::__construct();
  }

  public function GetCitasCompletadas()
  {
    $sql = "SELECT * FROM citas";
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

}
?>
