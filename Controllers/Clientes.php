<?php
class Clientes extends Controller
{
    public function index()
    {
        $this->Views->getView($this, "index");
    }
}

?>