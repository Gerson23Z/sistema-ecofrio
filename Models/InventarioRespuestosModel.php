<?php
class InventarioRespuestosModel extends Query
{
  private $codigo, $producto, $especificaciones,$unidades,$estado, $id;
    public function __construct()
    {
      parent::__construct();
    }
    public function getInventarioRespuestos()
    {
      $sql = "SELECT * FROM inventariorespuestos WHERE estado = 1";
      $data = $this->selectAll($sql);
      return $data;
    }
    public function registrarRespuesto(string $codigo, string $producto, string $especificaciones, int $unidades)
  {
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->especificaciones = $especificaciones;
    $this->unidades = $unidades;
    $verificar = "SELECT * FROM inventariorespuestos WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "INSERT INTO inventariorespuestos(codigo, producto, especificaciones, unidades, estado) VALUES (?,?,?,?,?)";
      $datos = array($this->codigo, $this->producto, $this->especificaciones, $this->unidades, 1);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "¡OK!";
      } else {
        $res = "error";
      }
    } else {
      $res = "existe";
    }
    return $res;
  }

  public function modificarRespuesto(string $codigo, string $producto, string $especificaciones, string $unidades, int $id)
  {
    $this->id = $id;
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->especificaciones = $especificaciones;
    $this->unidades = $unidades;
    $verificar = "SELECT * FROM inventariorespuestos WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "UPDATE inventariorespuestos SET codigo = ?,producto = ?,especificaciones = ?,unidades = ? WHERE id = ?";
      $datos = array($this->codigo, $this->producto, $this->especificaciones, $this->unidades, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }}
    else {
    $verificar = "SELECT * FROM inventariorespuestos WHERE id = '$this->id'";
    $existe = $this->select($verificar);
      if($existe['codigo']==$codigo){
        $sql = "UPDATE inventariorespuestos SET codigo = ?,producto = ?,especificaciones = ?,unidades = ? WHERE id = ?";
        $datos = array($this->codigo, $this->producto, $this->especificaciones, $this->unidades, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
          $res = "modificado";
        } else {
          $res = "error";
        }
      }else{
        $res = "existe";
      }
    }
    return $res;
  }

  public function editarRespuesto(int $id)
  {
    $sql = "SELECT * FROM inventariorespuestos WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function eliminarRespuesto(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE inventariorespuestos SET estado = 0 WHERE id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }
}
?>