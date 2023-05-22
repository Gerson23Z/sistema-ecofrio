<?php
class InventarioAiresModel extends Query
{
  private $codigo, $marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $precio, $cantidad, $id;
  public function __construct()
  {
    parent::__construct();
  }
  public function GetInventarioAires()
  {
    $sql = "SELECT * FROM inventarioaires WHERE estado = 1";
    $data = $this->selectAll($sql);
    return $data;
  }

  public function registrarAire(string $codigo, string $marca, string $capacidad, int $seer, string $voltaje, string $modelo, string $caracteristica, string $precio, int $cantidad)
  {
    $this->codigo = $codigo;
    $this->marca = $marca;
    $this->capacidad = $capacidad;
    $this->seer = $seer;
    $this->voltaje = $voltaje;
    $this->modelo = $modelo;
    $this->caracteristica = $caracteristica;
    $this->precio = $precio;
    $this->cantidad = $cantidad;

    $sql = "INSERT INTO inventarioaires(codigo, marca, capacidad, seer, voltaje, modelo,  caracteristica, precio, cantidad, estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $datos = array($this->codigo,$this->marca, $this->capacidad, $this->seer, $this->voltaje, $this->modelo, $this->caracteristica, $this->precio, $this->cantidad, 1);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = "¡OK!";
    } else {
      $res = "error";
    }
    return $res;
  }

  public function modificarAire(string $codigo, string $marca, string $capacidad, int $seer, string $voltaje, string $modelo, string $caracteristica, string $precio, int $cantidad, int $id)
  {
    $this->id = $id;
    $this->codigo = $codigo;
    $this->marca = $marca;
    $this->capacidad = $capacidad;
    $this->seer = $seer;
    $this->voltaje = $voltaje;
    $this->modelo = $modelo;
    $this->caracteristica = $caracteristica;
    $this->precio = $precio;
    $this->cantidad = $cantidad;

    $sql = "UPDATE inventarioaires SET codigo = ?,marca = ?,capacidad = ?,seer = ?,voltaje = ?,modelo = ?,caracteristica = ?,precio = ?, cantidad = ? WHERE id = ?";
    $datos = array($this->codigo,$this->marca, $this->capacidad, $this->seer, $this->voltaje, $this->modelo, $this->caracteristica, $this->precio, $this->cantidad, $this->id);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = "modificado";
    } else {
      $res = "error";
    }
    return $res;
  }

  public function editarAire(int $id)
  {
    $sql = "SELECT * FROM inventarioaires WHERE id = $id";
    $data = $this->select($sql);
    return $data;
  }

  public function eliminarAire(int $id)
  {
    $this->id = $id;
    $sql = "UPDATE inventarioaires SET estado = 0 WHERE id = ?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }
}
?>