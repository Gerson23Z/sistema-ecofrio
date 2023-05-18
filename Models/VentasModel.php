<?php
class VentasModel extends Query
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
    public function comprobarDetalle(int $codigo)
    {
        $sql = "SELECT * FROM detallesvnt WHERE codigo = $codigo";
        $data = $this->select($sql);
        return $data;
    }
    public function RegistrarDetalle(int $codigo, string $producto, string $precio, int $cantidad, string $subTotal)
    {
        $sql = "INSERT INTO detallesvnt(codigo, producto, precio, cantidad, subtotal) VALUES (?,?,?,?,?)";
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
        $sql = "UPDATE detallesvnt SET codigo = ?,producto = ?,precio = ?,cantidad = ?,subTotal = ? WHERE id = ?";
        $datos = array($codigo, $producto, $precio, $total_cantidad, $subTotal, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function calcularVenta()
    {
        $sql = "SELECT subtotal, SUM(subtotal) AS total FROM detallesvnt";
        $data = $this->select($sql);
        return $data;
    }
    public function eliminarDetalle(int $id)
    {
        $sql = "DELETE FROM detallesvnt WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function guardarVenta($total)
    {
        $sql = "INSERT INTO ventas(total) VALUES (?)";
        $datos = array($total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getIdVenta()
    {
        $sql = "SELECT MAX(id) AS id FROM ventas";
        $data = $this->select($sql);
        return $data;
    }
    public function getDetalles()
    {
        $sql = "SELECT * FROM detallesvnt";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarDetallesVenta(int $id_venta, string $producto, string $precio, int $cantidad, string $subtotal)
    {
        $sql = "INSERT INTO detalles_ventas(id_venta, producto, precio, cantidad, subtotal) VALUES (?,?,?,?,?)";
        $datos = array($id_venta, $producto, $precio, $cantidad, $subtotal);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    function GetProductos($codigoProducto)
    {
        $sql = "SELECT * FROM inventariorespuestos WHERE codigo = $codigoProducto";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function actualizarStock(int $stock, int $codigoProducto)
    {
        $sql = "UPDATE inventariorespuestos SET unidades = ? WHERE codigo = ?";
        $datos = array($stock, $codigoProducto);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function vaciarDetalles()
    {
        $sql = "TRUNCATE detallesvnt";
        $this->select($sql);
    }
    public function getProVentas($id_venta)
    {
        $sql = "SELECT * FROM detalles_ventas WHERE id_venta = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getInfoVentas($id_venta)
    {
      $sql = "SELECT fecha FROM ventas WHERE id = $id_venta";
      $data = $this->selectAll($sql);
      return $data;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function getClientes()
    {
        $sql = "SELECT * FROM clientes";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>