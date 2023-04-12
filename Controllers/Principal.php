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
}

?>