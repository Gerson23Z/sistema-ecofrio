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

}
?>