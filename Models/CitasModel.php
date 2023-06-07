<?php
class CitasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrarCita($nombre, $dui, $telefono, $direccion, $tipo, $fecha)
    {
        if ($tipo == "Instalacion") {
            $color = "#E34234";
        } else {
            $color = "#006400";
        }
        $sql = "INSERT INTO citas(nombre, dui, telefono, direccion, tipo, fecha, color, completado) VALUES (?,?,?,?,?,?,?,?)";
        $datos = array($nombre, $dui, $telefono, $direccion, $tipo, $fecha, $color, 0);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        return $msg;
    }

    public function modificarCita($nombre, $dui, $telefono, $direccion, $tipo, $fecha, $id, $check)
    {
        if ($tipo == "Instalacion") {
            $color = "#E34234";
        } else {
            $color = "#006400";
        }
        $sql = "UPDATE citas SET nombre = ?,dui = ?,telefono = ?,direccion = ?, tipo = ?, fecha = ?,color = ?,completado = ? WHERE id = ?";
        $datos = array($nombre, $dui, $telefono, $direccion, $tipo, $fecha, $color, $check, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        return $msg;
    }

    public function getCitas()
    {
        $sql = "SELECT id, nombre as title, dui, telefono, direccion, tipo, fecha as start, color FROM citas WHERE completado = 0";
        return $this->selectAll($sql);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM citas WHERE id=?";
        $array = array($id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }

    public function dragUpdate($start, $id)
    {
        $sql = "UPDATE citas SET fecha=? WHERE id=?";
        $array = array($start, $id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
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
    public function RegistrarInfoCliente(int $dui, string $nombre, string $telefono)
    {
        $verificar = "SELECT * FROM clientes WHERE dui = $dui";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes(dui, nombre, telefono) VALUES (?,?,?)";
            $datos = array($dui, $nombre, $telefono);
            $this->save($sql, $datos);
        } else {
            $sql = "UPDATE clientes SET dui = ?,nombre = ?,telefono = ? WHERE id = ?";
            $datos = array($dui, $nombre, $telefono, $existe['id']);
            $this->save($sql, $datos);
        }
    }
}
?>