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

    public function RegistrarDetalle(int $codigo, string $producto, string $precio, int $cantidad, string $subTotal)
    {
        $sql = "INSERT INTO detalles(codigo, producto, precio, cantidad, subtotal) VALUES (?,?,?,?,?)";
        $datos = array($codigo, $producto, $precio, $cantidad, $subTotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function actualizarDetalle(int $codigo, string $producto, string $precio, string $total_cantidad, string $subTotal, int $id)
    {
        $sql = "UPDATE detalles SET codigo = ?,producto = ?,precio = ?,cantidad = ?,subTotal = ? WHERE id = ?";
        $datos = array($codigo, $producto, $precio, $total_cantidad, $subTotal, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
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
    public function comprobarDetalle(int $codigo)
    {
        $sql = "SELECT * FROM detalles WHERE codigo = $codigo";
        $data = $this->select($sql);
        return $data;
    }
    public function guardarCompra($total)
    {
        $sql = "INSERT INTO compras(total) VALUES (?)";
        $datos = array($total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getIdCompra()
    {
        $sql = "SELECT MAX(id) AS id FROM compras";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarDetallesCompra(int $id_compra, string $producto, string $precio, int $cantidad, string $subtotal)
    {
        $sql = "INSERT INTO detalles_compras(id_compra, producto, precio, cantidad, subtotal) VALUES (?,?,?,?,?)";
        $datos = array($id_compra, $producto, $precio, $cantidad, $subtotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function vaciarDetalles()
    {
        $sql = "TRUNCATE detalles";
        $this->select($sql);

    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function getProCompras($id_compra)
    {
        $sql = "SELECT * FROM detalles_compras WHERE id_compra = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }

}
?>