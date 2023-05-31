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
        }else if($tabla=="ventasaires"){
            $sql = "SELECT COUNT(*) AS total FROM ventasaires";
        }else if($tabla=="inventariores"){
            $sql = "SELECT COUNT(*) AS total FROM inventariorespuestos WHERE estado = 1";
        }else if($tabla=="gananciasair"){
            $sql = "SELECT SUM(total) AS total FROM ventasaires WHERE apertura = 1";
        }else if($tabla=="gananciasres"){
            $sql = "SELECT SUM(total) AS total FROM ventas WHERE apertura = 1";
        }else if($tabla=="proveedores"){
            $sql = "SELECT COUNT(*) AS total FROM proveedores";
        }else if($tabla=="inventarioaires"){
            $sql = "SELECT COUNT(*) AS total FROM inventarioaires";
        }
        $data = $this->select($sql);
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