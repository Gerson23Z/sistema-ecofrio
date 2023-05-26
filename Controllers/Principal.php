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
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['ventas'] = $this->model->getDatos('ventas');
        $data['mantenimientos'] = $this->model->getDatos('citas');
        $this->Views->getView($this, "index", $data); // Pasar los datos a la vista
    }
}

?>