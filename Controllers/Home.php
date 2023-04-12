<?php
Class Home extends Controller
{
    public function index()
    {
        $this->Views->getView($this, "index");
    }
}

?>