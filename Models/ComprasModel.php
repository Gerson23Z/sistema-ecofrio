<?php
class ComprasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function GetCodPro(string $cod)
    {
        $sql = "SELECT * FROM inventariorespuestos WHERE codigo = $cod";
        $data = $this->selectAll($sql);
        return $data;
    }
    function GetProducto($id)
    {
        $sql = "SELECT * FROM inventariorespuestos WHERE id = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function RegistrarDetalle(int $codigo, string $nombre, int $precio, int $cantidad, int $subTotal)
    {
        $sql = "INSERT INTO detalles(codigo, producto, precio, cantidad, subtotal) VALUES (?,?,?,?,?)";
        $datos = array($codigo, $nombre, $precio, $cantidad, $subTotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getDetalles()
    {
        $sql = "SELECT * FROM detalles";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularCompra()
    {
        $sql = "SELECT subtotal, SUM(subtotal) AS total FROM detalles";
        $data = $this->select($sql);
        return $data;
    }
    public function eliminarDetalle(int $id)
    {
        $sql = "DELETE FROM detalles WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
}
?>