<?php
class Errors extends Controller
{
    public function __construct()
    {
      parent::__construct();
    }

    public function index()
    {
      $this->Views->getView($this, "index");
    }
    public function permisos()
    {
      $this->Views->getView($this, "permisos");
    }
}
?>