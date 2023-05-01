<?php
class CitasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registrarCita($nombre, $apellido, $dui, $telefono, $direccion, $tipo, $fecha)
    {
        if ($tipo == "Instalacion") {
            $color = "#E34234";
        } else {
            $color = "#006400";
        }
        $sql = "INSERT INTO citas(nombre, apellido, dui, telefono, direccion, tipo, fecha, color, completado) VALUES (?,?,?,?,?,?,?,?,?)";
        $datos = array($nombre, $apellido, $dui, $telefono, $direccion, $tipo, $fecha, $color, 0);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        return $msg;
    }

    public function modificarCita($nombre, $apellido, $dui, $telefono, $direccion, $tipo, $fecha, $id, $check)
    {
        if ($tipo == "Instalacion") {
            $color = "#E34234";
        } else {
            $color = "#006400";
        }
        $sql = "UPDATE citas SET nombre = ?,apellido = ?,dui = ?,telefono = ?,direccion = ?, tipo = ?, fecha = ?,color = ?,completado = ? WHERE id = ?";
        $datos = array($nombre, $apellido, $dui, $telefono, $direccion, $tipo, $fecha, $color, $check, $id);
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
        $sql = "SELECT id, nombre as title, apellido, dui, telefono, direccion, tipo, fecha as start, color FROM citas";
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
}
?>