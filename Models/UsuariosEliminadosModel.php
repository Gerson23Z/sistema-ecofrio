<?php
class UsuariosEliminadosModel extends Query
{
private $id;
  public function __construct()
  {
    parent::__construct();
  }
  public function getUsuariosEliminados()
  {
    $sql = "SELECT * FROM usuarios WHERE estado = 0";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function reingresarUsuario(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE usuarios SET estado = 1 WHERE id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }

}
?>