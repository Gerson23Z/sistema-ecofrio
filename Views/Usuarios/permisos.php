<?php include "Views/Templates/header.php"; ?>
<style>
    .card-body {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .card-body label {
        display: flex;
        align-items: center;
        width: 100%;
        /* Aumenta el ancho del label */
        margin-bottom: 30px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .content-input input,
    .content-select select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .content-input input {
        visibility: hidden;
        position: absolute;
        right: 0;
    }

    .content-input {
        position: relative;
        margin-bottom: 30px;
        padding: 5px 0 5px 60px;
        /* Damos un padding de 60px para posicionar 
        el elemento <i> en este espacio*/
        display: block;
    }

    /* Estas reglas se aplicarán a todos las elementos i 
después de cualquier input*/
    .content-input input+i {
        background: #f0f0f0;
        border: 2px solid rgba(0, 0, 0, 0.2);
        position: absolute;
        left: 0;
        top: 0;
    }

    /* Estas reglas se aplicarán a todos los i despues 
de un input de tipo checkbox*/
    .content-input input[type=checkbox]+i {
        width: 52px;
        height: 30px;
        border-radius: 15px;
    }

    /*
Creamos el círculo que aparece encima de los checkbox
con la etqieta before. Importante aunque no haya contenido
debemos poner definir este valor.
*/
    .content-input input[type=checkbox]+i:before {
        content: '';
        /* No hay contenido */
        width: 26px;
        height: 26px;
        background: #fff;
        border-radius: 50%;
        position: absolute;
        z-index: 1;
        left: 0px;
        top: 0px;
        -webkit-box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.2);
        box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.2);
    }

    .content-input input[type=checkbox]:checked+i:before {
        left: 22px;
        -webkit-box-shadow: -3px 0 3px 0 rgba(0, 0, 0, 0.2);
        box-shadow: 3px 0 -3px 0 rgba(0, 0, 0, 0.2);
    }

    .content-input input[type=checkbox]:checked+i {
        background: #2AC176;
    }
</style>
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header">
            Asignar permisos
        </div>
        <div class="card-body">
            <form id="formulario" onsubmit="registrarPermisos(event)">
                <div class="row">
                    <?php foreach ($data['datos'] as $row) { ?>
                        <div class="col-md-4">
                            <label class="content-input">
                                <input type="checkbox" name="permisos[]" id="" value="<?php echo $row['id']; ?>" <?php echo isset($data['asignados'][$row['id']]) ? 'checked' : '' ?>>
                                <i></i>
                                <span>
                                    <?php echo $row['permiso']; ?>
                                </span>
                            </label>
                        </div>
                    <?php } ?>
                    <input type="hidden" value="<?php echo $data['id_usuario']; ?>" name="id_usuario">
                </div>
                <button class="btn btn-primary" type="submit">Asignar permisos</button>
                <a class="btn btn-danger" href="<?php echo base_url . 'Usuarios' ?>" type="button">Volver</a>
            </form>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>