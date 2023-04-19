<?php
class ProductosEliminadosModel extends Query
{
    private $id;
    public function __construct()
    {
        parent::__construct();
    }
    public function getProductosEliminados()
    {
        $sql = "SELECT * FROM inventario WHERE estado = 0";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function reingresarProducto(int $id)
    {
        $this->id = $id;
        $sql = "UPDATE inventario SET estado = 1 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

}
?>