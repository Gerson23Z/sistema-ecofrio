<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inventario Aires</h1>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a href="InventarioRespuestos" class="btn btn-secondary col-6">Ir a Respuestos</a>
    </div>
</div>

<button class="btn btn-success mb-2" type="button" onclick="frmInventarioAires()" ;>Agregar</button>
<a href="AiresEliminados" class="btn btn-primary mb-2 float-right">Aires Eliminados</a>

<table class="table table-light" id="tblInventarioAires">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Marca</th>
            <th>Capacidad</th>
            <th>Seer</th>
            <th>Voltaje</th>
            <th>Modelo</th>
            <th>Caracteristica</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>

<div id="nuevo_aire" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Añadir</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAires">
                    <div class="form-group">
                        <label for="slctMarca">Marca</label>
                        <input type="hidden" id="id" name="id">
                        <select id="slctMarca" class="form-control" name="slctMarca">
                            <option>Comfort Star</option>
                            <option>Gair</option>
                            <option>Daikin</option>
                            <option>Adina</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctCapacidad">Capacidad</label>
                        <select id="slctCapacidad" class="form-control" name="slctCapacidad">
                            <option>12,000btu</option>
                            <option>18,000btu</option>
                            <option>24,000btu</option>
                            <option>36,000btu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctSeer">Seer</label>
                        <select id="slctSeer" class="form-control" name="slctSeer">
                            <option>13</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctVoltaje">Voltaje</label>
                        <select id="slctVoltaje" class="form-control" name="slctVoltaje">
                            <option>110V</option>
                            <option>220V</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctModelo">Modelo</label>
                        <select id="slctModelo" class="form-control" name="slctModelo">
                            <option>Blue Series</option>
                            <option>Elite</option>
                            <option>Cristal</option>
                            <option>Cwi</option>
                            <option>Caray</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctCaracteristica">Caracteristica</label>
                        <select id="slctCaracteristica" class="form-control" name="slctCaracteristica">
                            <option>Inverter</option>
                            <option>Convencional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slctTipo">Tipo</label>
                        <select id="slctTipo" class="form-control" name="slctTipo">
                            <option>Mini Split</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtCantidad">Cantidad</label>
                        <input id="txtCantidad" class="form-control" type="number" name="txtCantidad">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarAire(event)"
                        id="btnId">Guardar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>