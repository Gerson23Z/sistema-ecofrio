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
        }else{
            $res = "existe";
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
}
?>