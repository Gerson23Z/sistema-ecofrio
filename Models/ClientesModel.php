<?php
class ClientesModel extends Query
{
    private $id, $dui, $nombre, $telefono, $direccion;
    public function __construct()
    {
        parent::__construct();
    }
    public function getClientes()
    {
        $sql = "SELECT * FROM clientes";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function editarCliente(int $id)
    {
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function modificarCliente(string $dui, string $nombre, string $telefono, string $direccion, int $id)
    {
        $this->id = $id;
        $this->dui = $dui;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $verificar = "SELECT * FROM clientes WHERE dui = '$this->dui'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "UPDATE clientes SET dui = ?,nombre = ?,telefono = ?,direccion = ? WHERE id = ?";
            $datos = array($this->dui, $this->nombre, $this->telefono, $this->direccion, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "modificado";
            } else {
                $res = "error";
            }
        } else {
            $verificar = "SELECT * FROM clientes WHERE id = '$this->id'";
            $existe = $this->select($verificar);
            if ($existe['dui'] == $dui) {
                $sql = "UPDATE clientes SET dui = ?,nombre = ?,telefono = ?,direccion = ? WHERE id = ?";
                $datos = array($this->dui, $this->nombre, $this->telefono, $this->direccion, $this->id);
                $data = $this->save($sql, $datos);
                if ($data == 1) {
                    $res = "modificado";
                } else {
                    $res = "error";
                }
            } else {
                $res = "existe";
            }
        }
        return $res;
    }
    public function eliminar($id)
    {
        $sql = "DELETE FROM clientes WHERE id=?";
        $array = array($id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function verificarPermiso(int $id_usuario, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>