<?php include "Views/Templates/header.php"; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"> Informacion de la empresa</h1>
</div>
<form id="frmInfo">
  <div class="form-group">
    <label for="nombre"> <i class="fas fa-building"></i> Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
  </div>
  <div class="form-group">
    <label for="direccion"><i class="fas fa-location-dot"></i> Direccion</label>
    <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="telefono"><i class="fas fa-phone"></i> Telefono</label>
    <input type="text" class="form-control" id="telefono" name="telefono">
  </div>
  <div class="form-group">
    <label for="dueno"><i class="fas fa-user"></i> Dueño</label>
    <input type="text" class="form-control" id="dueno" name="dueno">
  </div>
  <div class="form-group">
    <label for="mensaje"><i class="fas fa-comment"></i> Mensaje</label>
    <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
  </div>
  <div class="d-flex justify-content-center">
    <button class="btn btn-info center" type="button" onclick="actualizar(event)" id="btnInfo">Guardar</button>
  </div>
</form>
<script src="<?php echo base_url; ?>Assets/js/funcionesInfo.js"></script>

<?php include "Views/Templates/footer.php"; ?>