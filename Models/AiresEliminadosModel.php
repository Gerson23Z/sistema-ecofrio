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
}
?>