<?php
class InventarioModel extends Query
{
  private $codigo, $producto,$tipo, $especificaciones,$unidades,$estado, $id;
    public function __construct()
    {
      parent::__construct();
    }
    public function getInventario()
    {
      $sql = "SELECT * FROM inventario WHERE est = 1";
      $data = $this->selectAll($sql);
      return $data;
    }
    public function registrarProducto(string $codigo, string $producto, string $tipo, string $especificaciones, int $unidades)
  {
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->tipo = $tipo;
    $this->especificaciones = $especificaciones;
    $this->unidades = $unidades;
    $verificar = "SELECT * FROM inventario WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "INSERT INTO inventario(codigo, producto, tipo, especificaciones, unidades, estado) VALUES (?,?,?,?,?,?)";
      $datos = array($this->codigo, $this->producto, $this->tipo, $this->especificaciones, $this->unidades, 1);
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

  public function modificarProducto(string $codigo, string $producto, string $tipo, string $especificaciones, string $unidades, int $id)
  {
    $this->id = $id;
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->tipo = $tipo;
    $this->especificaciones = $especificaciones;
    $this->unidades = $unidades;
    $verificar = "SELECT * FROM inventario WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "UPDATE inventario SET codigo = ?,producto = ?,tipo = ?,especificaciones = ?,unidades = ? WHERE id = ?";
      $datos = array($this->codigo, $this->producto, $this->tipo, $this->especificaciones, $this->unidades, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }}
    else {
    $verificar = "SELECT * FROM inventario WHERE id = '$this->id'";
    $existe = $this->select($verificar);
      if($existe['codigo']==$codigo){
        $sql = "UPDATE inventario SET codigo = ?,producto = ?,tipo = ?,especificaciones = ?,unidades = ? WHERE id = ?";
        $datos = array($this->codigo, $this->producto, $this->tipo, $this->especificaciones, $this->unidades, $this->id);
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

  public function editarProducto(int $id)
  {
    $sql = "SELECT * FROM inventario WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function eliminarProd(int $estado, int $id)
  {
    $this->id = $id;
    $this->estado = $estado;
    $sql = "UPDATE inventario SET est = ? WHERE id = ?";
    $datos = array($this->estado, $this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }
}
?>