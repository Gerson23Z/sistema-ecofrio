<?php
class Controller
{
  public function __construct()
  {
    $this->Views = new Views();
    $this->cargarModel();
    date_default_timezone_set('America/El_Salvador');
  }
  public function cargarModel()
  {
    $model = get_class($this) . "Model";
    $ruta = "Models/" . $model . ".php";
    if (file_exists($ruta)) {
      require_once $ruta;
      $this->model = new $model();
    }
  }
}
?>