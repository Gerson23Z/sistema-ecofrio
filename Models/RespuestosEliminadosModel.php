<?php
class RespuestosEliminadosModel extends Query
{
    private $id;
    public function __construct()
    {
        parent::__construct();
    }
    public function getRespuestosEliminados()
    {
        $sql = "SELECT * FROM inventariorespuestos WHERE estado = 0";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function reingresarRespuesto(int $id)
    {
        $this->id = $id;
        $sql = "UPDATE inventariorespuestos SET estado = 1 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

}
?>