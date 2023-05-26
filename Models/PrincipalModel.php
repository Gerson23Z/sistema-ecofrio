<?php
class PrincipalModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDatos($tabla)
    {
        if($tabla=="usuarios"){
            $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE estado = 1";
        }else if($tabla=="ventas"){
            $sql = "SELECT COUNT(*) AS total FROM ventas";
        }elseif($tabla=="citas"){
            $sql = "SELECT COUNT(*) AS total FROM citas WHERE completado = 0";
        }
        $data = $this->select($sql);
        return $data;
    }
}
?>