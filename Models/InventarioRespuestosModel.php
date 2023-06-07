<?php
class InventarioRespuestosModel extends Query
{
  private $codigo, $producto, $marca, $unidades, $estado, $precio, $id;
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
  public function registrarRespuesto(string $codigo, string $producto, string $marca, int $unidades, float $precio)
  {
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->marca = $marca;
    $this->unidades = $unidades;
    $this->precio = $precio;
    $verificar = "SELECT * FROM inventariorespuestos WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "INSERT INTO inventariorespuestos(codigo, producto, marca, unidades, precio, estado) VALUES (?,?,?,?,?,?)";
      $datos = array($this->codigo, $this->producto, $this->marca, $this->unidades, $this->precio, 1);
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

  public function modificarRespuesto(string $codigo, string $producto, string $marca, string $unidades, float $precio, int $id)
  {
    $this->id = $id;
    $this->codigo = $codigo;
    $this->producto = $producto;
    $this->marca = $marca;
    $this->unidades = $unidades;
    $this->precio = $precio;
    $verificar = "SELECT * FROM inventariorespuestos WHERE codigo = '$this->codigo'";
    $existe = $this->select($verificar);
    if (empty($existe)) {
      $sql = "UPDATE inventariorespuestos SET codigo = ?,producto = ?,marca = ?,unidades = ?,precio = ? WHERE id = ?";
      $datos = array($this->codigo, $this->producto, $this->marca, $this->unidades, $this->precio, $this->id);
      $data = $this->save($sql, $datos);
      if ($data == 1) {
        $res = "modificado";
      } else {
        $res = "error";
      }
    } else {
      $verificar = "SELECT * FROM inventariorespuestos WHERE id = '$this->id'";
      $existe = $this->select($verificar);
      if ($existe['codigo'] == $codigo) {
        $sql = "UPDATE inventariorespuestos SET codigo = ?,producto = ?,marca = ?,unidades = ?,precio = ? WHERE id = ?";
        $datos = array($this->codigo, $this->producto, $this->marca, $this->unidades, $this->precio, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
          $res = "modificado";
        } else {
          $res = "error";
        }
      } else {
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
  public function verificarPermiso(int $id_usuario, string $nombre)
  {
    $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
    $data = $this->selectAll($sql);
    return $data;
  }
}
?>