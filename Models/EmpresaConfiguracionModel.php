<?php
class EmpresaConfiguracionModel extends Query
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
    public function getCajas()
    {
        $sql = "SELECT * FROM cierre_caja";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getVentas($id_usuario)
    {
        $sql = "SELECT total, SUM(total) AS total FROM ventas WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }
    public function getTotalVentas($id_usuario)
    {
        $sql = "SELECT COUNT(total) AS total FROM ventas WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }
    public function getMontoInicial($id_usuario)
    {
        $sql = "SELECT id, monto_inicial FROM cierre_caja WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }
}
?>