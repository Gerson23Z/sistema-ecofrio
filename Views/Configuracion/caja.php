<?php include "Views/Templates/header.php"; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cierre de caja</h1>
</div>
<?php
foreach($data as $row){
}
?>
<button class="btn btn-primary mb-2" type="button" <?php if($row['estado']==1){echo 'disabled';} ?> onclick="frmCaja()" ;>+</button>
<button class="btn btn-dark mb-2" type="button" <?php if($row['estado']==0){echo 'disabled';} ?> onclick="cerrarCaja()" ;>Cerrar caja</button>
<table class="table table-light" id="tblCaja">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Monto Inicial</th>
            <th>Monto Final</th>
            <th>Fecha Apertura</th>
            <th>Fecha Cierre</th>
            <th>Total Ventas</th>
            <th>Monto Total</th>
            <th>Estado</th>
        </tr>
    </thead>
</table>

<div id="nuevo_caja" class="modal fde" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="title">Abrir caja</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAbrirCaja" onsubmit="abrirCaja(event)">
                    <div class="form-group">
                        <label for="montoInicial">Monto Inicial</label>
                        <input type="hidden" id="id" name="id">
                        <input id="montoInicial" class="form-control" type="text" name="montoIncial">
                    </div>
                    <div id="ocultarInput">
                        <div class="form-group">
                            <label for="montoFinal">Monto Final</label>
                            <input id="montoFinal" class="form-control" type="text" name="montoFinal" disabled>
                        </div>
                        <div class="form-group">
                            <label for="totalVentas">Total Ventas</label>
                            <input id="totalVentas" class="form-control" type="text" name="totalVentas" disabled>
                        </div>
                        <div class="form-group">
                            <label for="montoTotal">Monto total</label>
                            <input id="montoTotal" class="form-control" type="text" name="montoTotal" disabled>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="btnId">Abrir</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include "Views/Templates/footer.php"; ?>