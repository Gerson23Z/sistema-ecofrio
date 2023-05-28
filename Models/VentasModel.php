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
    public function GetCodAir(string $cod)
    {
        $sql = "SELECT * FROM inventarioaires WHERE codigo = $cod";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getCodigoVenta($codigo)
    {
        $variable = $codigo . '%';
        $sql = "SELECT codigo FROM inventariorespuestos WHERE codigo LIKE ? ORDER BY codigo ASC LIMIT 0, 10";
        $stmt = $this->selectCo($sql, [$variable]);
        return $stmt;
    }
    public function getCodigoAire($codigo)
    {
        $variable = $codigo . '%';
        $sql = "SELECT codigo FROM inventarioaires WHERE codigo LIKE ? ORDER BY codigo ASC LIMIT 0, 10";
        $stmt = $this->selectCo($sql, [$variable]);
        return $stmt;
    }
    function GetProducto($id)
    {
        $sql = "SELECT * FROM inventariorespuestos WHERE id = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    function GetAire($id)
    {
        $sql = "SELECT * FROM inventarioaires WHERE id = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function comprobarDetalle(int $codigo)
    {
        $sql = "SELECT * FROM detallesvnt WHERE codigo = $codigo";
        $data = $this->select($sql);
        return $data;
    }
    public function comprobarDetalleAire(int $codigo)
    {
        $sql = "SELECT * FROM detallesvntair WHERE codigo = $codigo";
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
    public function RegistrarDetalleAire(int $codigo, string $marca, string $capacidad, string $seer, string $precio, int $cantidad, string $subTotal)
    {
        $sql = "INSERT INTO detallesvntair(codigo, marca, capacidad, seer, precio, cantidad, subtotal) VALUES (?,?,?,?,?,?,?)";
        $datos = array($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subTotal);
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
    public function actualizarDetalleAire(int $codigo, string $marca, string $capacidad, string $seer, string $precio, string $total_cantidad, string $subTotal, int $id)
    {
        $sql = "UPDATE detallesvntair SET codigo = ?,marca = ?,capacidad = ?,seer = ?,precio = ?,cantidad = ?,subTotal = ? WHERE id = ?";
        $datos = array($codigo, $marca, $capacidad, $seer, $precio, $total_cantidad, $subTotal, $id);
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
    public function calcularVentaAire()
    {
        $sql = "SELECT subtotal, SUM(subtotal) AS total FROM detallesvntair";
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
    public function eliminarDetalleAire(int $id)
    {
        $sql = "DELETE FROM detallesvntair WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function guardarVenta($total, $id_usuario)
    {
        $verificar = "SELECT * FROM cierre_caja WHERE estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $res = "vacio";
        } else {
            $sql = "INSERT INTO ventas(total, id_usuario) VALUES (?,?)";
            $datos = array($total, $id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "¡OK!";
            } else {
                $res = "error";
            }
        }
        return $res;
    }
    public function guardarVentaAire($dui, $total, $id_usuario)
    {
        $verificar = "SELECT * FROM cierre_caja WHERE estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $res = "vacio";
        } else {
            $sql = "INSERT INTO ventasaires(dui, total, id_usuario) VALUES (?,?,?)";
            $datos = array($dui, $total, $id_usuario);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "¡OK!";
            } else {
                $res = "error";
            }
        }
        return $res;
    }
    public function getIdVenta()
    {
        $sql = "SELECT MAX(id) AS id FROM ventas";
        $data = $this->select($sql);
        return $data;
    }
    public function getIdVentaAire()
    {
        $sql = "SELECT MAX(id) AS id FROM ventasaires";
        $data = $this->select($sql);
        return $data;
    }
    public function getDetalles()
    {
        $sql = "SELECT * FROM detallesvnt";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallesAire()
    {
        $sql = "SELECT * FROM detallesvntair";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarDetallesVenta(int $id_venta, string $producto, string $precio, int $cantidad, string $subtotal, string $id_usuario)
    {
        $sql = "INSERT INTO detalles_ventas(id_venta, producto, precio, cantidad, subtotal, id_usuario) VALUES (?,?,?,?,?,?)";
        $datos = array($id_venta, $producto, $precio, $cantidad, $subtotal, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function registrarDetallesVentaAire(int $id_venta, string $marca, string $capacidad, string $seer, string $precio, int $cantidad, string $subtotal)
    {
        $sql = "INSERT INTO detalles_ventasaires(id_venta, marca,capacidad,seer, precio, cantidad, subtotal) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id_venta, $marca, $capacidad, $seer, $precio, $cantidad, $subtotal);
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
    function GetAires($codigoProducto)
    {
        $sql = "SELECT * FROM inventarioaires WHERE codigo = $codigoProducto";
        $data = $this->selectAll($sql);
        return $data;
    }
    function comprobarCaja()
    {
        $sql = "SELECT * FROM cierre_caja WHERE estado = 1";
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
    public function actualizarStockAires(int $stock, int $codigoProducto)
    {
        $sql = "UPDATE inventarioaires SET cantidad = ? WHERE codigo = ?";
        $datos = array($stock, $codigoProducto);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function vaciarDetalles()
    {
        $sql = "TRUNCATE detallesvnt";
        $this->select($sql);
    }
    public function vaciarDetallesAir()
    {
        $sql = "TRUNCATE detallesvntair";
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
        $sql = "SELECT id_usuario, fecha FROM ventas WHERE id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUser($id_usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentasAire($id_venta)
    {
        $sql = "SELECT * FROM detalles_ventasaires WHERE id_venta = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getInfoVentasAire($id_venta)
    {
        $sql = "SELECT dui, fecha FROM ventasaires WHERE id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function RegistrarInfoCliente(int $dui, string $nombre, string $telefono, string $direccion)
    {
        $sql = "INSERT INTO clientes(dui, nombre, telefono, direccion) VALUES (?,?,?,?)";
        $datos = array($dui, $nombre, $telefono, $direccion);
        $this->save($sql, $datos);
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function getClientes($numDui)
    {
        $sql = "SELECT * FROM clientes WHERE dui = $numDui";
        $data = $this->selectAll($sql);
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