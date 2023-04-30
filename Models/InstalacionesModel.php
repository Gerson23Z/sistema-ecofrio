<?php
class InstalacionesModel extends Query
{
  public function __construct()
  {
    parent::__construct();
  }

  public function registrarCita($nombre, $apellido, $dui, $telefono, $direccion, $fecha, $color)
  {
      $sql = "INSERT INTO instalaciones(nombre, apellido, dui, telefono, direccion, fecha, color) VALUES (?,?,?,?,?,?,?)";
      $datos = array($nombre, $apellido, $dui, $telefono, $direccion, $fecha, $color);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
          $msg = 'ok';
      }else{
          $msg = 'error';
      }
      return $msg;
  }

  public function modificarCita($nombre, $apellido, $dui, $telefono, $direccion, $fecha, $color, $id)
  {
      $sql = "UPDATE instalaciones SET nombre = ?,apellido = ?,dui = ?,telefono = ?,direccion = ?,fecha = ?,color = ? WHERE id = ?";
      $datos = array($nombre, $apellido, $dui, $telefono, $direccion, $fecha, $color, $id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
          $msg = 'ok';
      }else{
          $msg = 'error';
      }
      return $msg;
  }

  public function getCitas()
  {
      $sql = "SELECT id, nombre as title, apellido, dui, telefono, direccion, fecha as start, color FROM instalaciones";
      return $this->selectAll($sql);
  }

  public function eliminar($id)
  {
      $sql = "DELETE FROM instalaciones WHERE id=?";
      $array = array($id);
      $data = $this->save($sql, $array);
      if ($data == 1) {
          $res = 'ok';
      } else {
          $res = 'error';
      }
      return $res;
  }

  public function dragUpdate($start, $id)
    {
        $sql = "UPDATE instalaciones SET fecha=? WHERE id=?";
        $array = array($start, $id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
}
?>