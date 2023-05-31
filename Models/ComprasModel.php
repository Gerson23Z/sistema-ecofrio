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
    public function GetCodAir(string $cod)
    {
        $sql = "SELECT * FROM inventarioaires WHERE codigo = $cod";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCodigoCompra($codigo)
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

    public function RegistrarDetalle(int $codigo, string $producto, string $precio, int $cantidad, string $subTotal, string $proveedor)
    {
        $sql = "INSERT INTO detallescmp(codigo, producto, precio, cantidad, subtotal, proveedor) VALUES (?,?,?,?,?,?)";
        $datos = array($codigo, $producto, $precio, $cantidad, $subTotal, $proveedor);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function RegistrarDetalleAire(int $codigo, string $marca, string $capacidad, string $seer, string $precio, int $cantidad, string $subTotal, string $proveedor)
    {
        $sql = "INSERT INTO detallescmpair(codigo, marca, capacidad, seer, precio, cantidad, subtotal, proveedor) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subTotal, $proveedor);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function actualizarDetalle(int $codigo, string $producto, string $precio, string $total_cantidad, string $subTotal,string $proveedor, int $id)
    {
        $sql = "UPDATE detallescmp SET codigo = ?,producto = ?,precio = ?,cantidad = ?,subTotal = ?,proveedor = ? WHERE id = ?";
        $datos = array($codigo, $producto, $precio, $total_cantidad, $subTotal, $proveedor, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function actualizarDetalleAire(int $codigo, string $marca, string $capacidad, string $seer, string $precio, string $total_cantidad, string $subTotal,string $proveedor, int $id)
    {
        $sql = "UPDATE detallescmpair SET codigo = ?,marca = ?,capacidad = ?,seer = ?,precio = ?,cantidad = ?,subTotal = ?,proveedor = ? WHERE id = ?";
        $datos = array($codigo, $marca, $capacidad, $seer, $precio, $total_cantidad, $subTotal, $proveedor, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
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
    public function getDetalles()
    {
        $sql = "SELECT * FROM detallescmp";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallesAire()
    {
        $sql = "SELECT * FROM detallescmpair";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function eliminarDetalle(int $id)
    {
        $sql = "DELETE FROM detallescmp WHERE id = ?";
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
        $sql = "DELETE FROM detallescmpair WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function calcularCompra()
    {
        $sql = "SELECT subtotal, SUM(subtotal) AS total FROM detallescmp";
        $data = $this->select($sql);
        return $data;
    }
    public function calcularCompraAire()
    {
        $sql = "SELECT subtotal, SUM(subtotal) AS total FROM detallescmpair";
        $data = $this->select($sql);
        return $data;
    }
    public function comprobarDetalle(int $codigo)
    {
        $sql = "SELECT * FROM detallescmp WHERE codigo = $codigo";
        $data = $this->select($sql);
        return $data;
    }
    public function comprobarDetalleAire(int $codigo)
    {
        $sql = "SELECT * FROM detallescmpair WHERE codigo = $codigo";
        $data = $this->select($sql);
        return $data;
    }
    public function registrarDetallesCompra(int $codigo, string $producto, string $precio, int $cantidad, string $subtotal, string $proveedor)
    {
        $sql = "INSERT INTO detalles_compras(codigo, producto, precio, cantidad, subtotal, proveedor) VALUES (?,?,?,?,?,?)";
        $datos = array($codigo, $producto, $precio, $cantidad, $subtotal, $proveedor);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "¡OK!";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function registrarDetallesCompraAire(int $codigo, string $marca, string $capacidad, string $seer, string $precio, int $cantidad, string $subtotal, string $proveedor)
    {
        $sql = "INSERT INTO detalles_comprasaires(codigo, marca, capacidad, seer, precio, cantidad, subtotal, proveedor) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($codigo, $marca, $capacidad, $seer, $precio, $cantidad, $subtotal, $proveedor);
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
        $sql = "TRUNCATE detallescmp";
        $this->select($sql);

    }
    public function vaciarDetallesAir()
    {
        $sql = "TRUNCATE detallescmpair";
        $this->select($sql);

    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function getProveedores()
    {
        $sql = "SELECT * FROM proveedores";
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