<?php

class Principal extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        $this->Views->getView($this, "index");
    }
    public function reportes()
    {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['ventas'] = $this->model->getDatos('ventas');
        $data['ventasaires'] = $this->model->getDatos('ventasaires');
        $data['citas'] = $this->model->getDatos('citas', "");
        $data['inventariorespuestos'] = $this->model->getDatos('inventariores');
        $data['gananciasres'] = $this->model->getDatos('gananciasres');
        $data['gananciasair'] = $this->model->getDatos('gananciasair');
        $data['gananciastotales'] = $data['gananciasres']['total'] + $data['gananciasair']['total'];
        $data['compras'] = $this->model->getDatos('compras');
        $data['inventarioaires'] = $this->model->getDatos('inventarioaires');
        $this->Views->getView($this, "reportes", $data);
    }
}

?>