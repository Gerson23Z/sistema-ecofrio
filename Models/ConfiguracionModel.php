<?php
class ConfiguracionModel extends Query
{
    private $id, $nombre, $direccion, $telefono, $dueno, $mensaje;

    public function __construct()
    {
        parent::__construct();
    }

    public function getInfoEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function mostrarInfoEmpresa(int $id)
    {
        $sql = "SELECT * FROM empresa WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarInfo(string $nombre, string $direccion, string $telefono, string $dueno, string $mensaje, int $id)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->dueno = $dueno;
        $this->mensaje = $mensaje;
        $sql = "UPDATE empresa SET nombre = ?,direccion = ?,telefono = ?,dueno = ?,mensaje = ? WHERE id = ?";
        $datos = array($this->nombre, $this->direccion, $this->telefono, $this->dueno, $this->mensaje, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarArqueo($id_usuario, $montoInicial, $fechaApertura)
    {
        $verificar = "SELECT * FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO cierre_caja(id_usuario, monto_inicial, fecha_apertura) VALUES (?,?,?)";
            $datos = array($id_usuario, $montoInicial, $fechaApertura);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $msg = 'ok';
            } else {
                $msg = 'error';
            }
        } else {
            $msg = 'existe';
        }
        return $msg;
    }
    public function actualizarArqueo($id_usuario, $montoFinal, $fechaCierre, $totalVentas, $general, $id)
    {
        $sql = "UPDATE cierre_caja SET id_usuario = ?,monto_final = ?,fecha_cierre = ?,total_ventas = ?,monto_total=?, estado = ? WHERE id = ?";
        $datos = array($id_usuario, $montoFinal, $fechaCierre, $totalVentas, $general,0, $id);
        $data = $this->save($sql, $datos);
        $sql = "UPDATE ventas SET apertura = ? WHERE id_usuario = ? AND apertura = 1";
        $datos = array(0, $id_usuario);
        $this->save($sql, $datos);
        $sql = "UPDATE ventasaires SET apertura = ? WHERE id_usuario = ? AND apertura = 1";
        $datos = array(0, $id_usuario);
        $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getCajas()
    {
        $sql = "SELECT c.*,c.id_usuario, u.user AS usuario FROM cierre_caja c JOIN usuarios u ON c.id_usuario = u.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getVentas($id_usuario)
    {
        $sql = "SELECT total, SUM(total) AS total FROM ventas WHERE id_usuario = $id_usuario AND apertura =1";
        $data = $this->select($sql);
        return $data;
    }
    public function getVentasAires($id_usuario)
    {
        $sql = "SELECT total, SUM(total) AS total FROM ventasaires WHERE id_usuario = $id_usuario AND apertura =1";
        $data = $this->select($sql);
        return $data;
    }
    public function getTotalVentas($id_usuario)
    {
        $sql = "SELECT COUNT(total) AS total FROM ventas WHERE id_usuario = $id_usuario AND apertura =1";
        $data = $this->select($sql);
        return $data;
    }
    public function getTotalVentasAires($id_usuario)
    {
        $sql = "SELECT COUNT(total) AS total FROM ventasaires WHERE id_usuario = $id_usuario AND apertura =1";
        $data = $this->select($sql);
        return $data;
    }
    public function getMontoInicial($id_usuario)
    {
        $sql = "SELECT id, monto_inicial FROM cierre_caja WHERE id_usuario = $id_usuario AND estado = 1";
        $data = $this->select($sql);
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