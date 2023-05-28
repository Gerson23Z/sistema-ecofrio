<?php
class AiresEliminadosModel extends Query
{
    private $id;
    public function __construct()
    {
        parent::__construct();
    }
    public function GetAiresEliminados()
    {
        $sql = "SELECT * FROM inventarioaires WHERE estado = 0";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function reingresarAire(int $id)
    {
        $this->id = $id;
        $sql = "UPDATE inventarioaires SET estado = 1 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
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