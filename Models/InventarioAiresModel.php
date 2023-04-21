<?php
class InventarioAiresModel extends Query
{
  private $marca, $capacidad, $seer, $voltaje, $modelo, $caracteristica, $tipo, $cantidad, $id;
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

  public function registrarAire(string $marca, string $capacidad, int $seer, string $voltaje, string $modelo, string $caracteristica, string $tipo, int $cantidad)
  {
    $this->marca = $marca;
    $this->capacidad = $capacidad;
    $this->seer = $seer;
    $this->voltaje = $voltaje;
    $this->modelo = $modelo;
    $this->caracteristica = $caracteristica;
    $this->tipo = $tipo;
    $this->cantidad = $cantidad;

    $sql = "INSERT INTO inventarioaires(marca, capacidad, seer, voltaje, modelo,  caracteristica, tipo, cantidad, estado) VALUES (?,?,?,?,?,?,?,?,?)";
    $datos = array($this->marca, $this->capacidad, $this->seer, $this->voltaje, $this->modelo, $this->caracteristica, $this->tipo, $this->cantidad, 1);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = "¡OK!";
    } else {
      $res = "error";
    }
    return $res;
  }

  public function modificarAire(string $marca, string $capacidad, int $seer, string $voltaje, string $modelo, string $caracteristica, string $tipo, int $cantidad, int $id)
  {
    $this->id = $id;
    $this->marca = $marca;
    $this->capacidad = $capacidad;
    $this->seer = $seer;
    $this->voltaje = $voltaje;
    $this->modelo = $modelo;
    $this->caracteristica = $caracteristica;
    $this->tipo = $tipo;
    $this->cantidad = $cantidad;

    $sql = "UPDATE inventarioaires SET marca = ?,capacidad = ?,seer = ?,voltaje = ?,modelo = ?,caracteristica = ?,tipo = ?, cantidad = ? WHERE id = ?";
    $datos = array($this->marca, $this->capacidad, $this->seer, $this->voltaje, $this->modelo, $this->caracteristica, $this->tipo, $this->cantidad, $this->id);
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