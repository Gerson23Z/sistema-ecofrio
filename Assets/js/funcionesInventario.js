let tblInventarioAires;
let tblInventarioRespuestos;
let tblAiresEliminados;
let tblRespuestosEliminados;

document.addEventListener("DOMContentLoaded", function () {
  tblInventarioRespuestos = $("#tblInventarioRespuestos").DataTable({
    ajax: {
      url: base_url + "InventarioRespuestos/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "codigo",
      },
      {
        data: "producto",
      },
      {
        data: "marca",
      },
      {
        data: "fecha_cita",
      },
      {
        data: "unidades",
      },
      {
        data: "precio",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
      //Botón para Excel
      extend: 'excelHtml5',
      footer: true,
      title: 'Archivo',
      filename: 'Export_File',

      //Aquí es donde generas el botón personalizado
      text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
      extend: 'pdfHtml5',
      download: 'open',
      footer: true,
      title: 'Reporte de inventario',
      filename: 'Reporte de inventario',
      text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
      exportOptions: {
        columns: [0, ':visible']
      }
    },
    //Botón para copiar
    {
      extend: 'copyHtml5',
      footer: true,
      title: 'Reporte de inventario',
      filename: 'Reporte de inventario',
      text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
      exportOptions: {
        columns: [0, ':visible']
      }
    },
    //Botón para print
    {
      extend: 'print',
      footer: true,
      filename: 'Export_File_print',
      text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
      extend: 'csvHtml5',
      footer: true,
      filename: 'Export_File_csv',
      text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
      extend: 'colvis',
      text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
      postfixButtons: ['colvisRestore']
    }
    ]
  });

  tblRespuestosEliminados = $("#tblRespuestosEliminados").DataTable({
    ajax: {
      url: base_url + "RespuestosEliminados/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "codigo",
      },
      {
        data: "producto",
      },
      {
        data: "marca",
      },
      {
        data: "fecha_cita",
      },
      {
        data: "unidades",
      },
      {
        data: "precio",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>"
  });

  tblInventarioAires = $("#tblInventarioAires").DataTable({
    ajax: {
      url: base_url + "InventarioAires/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "codigo",
      },
      {
        data: "marca",
      },
      {
        data: "capacidad",
      },
      {
        data: "seer",
      },
      {
        data: "voltaje",
      },
      {
        data: "modelo",
      },
      {
        data: "caracteristica",
      },
      {
        data: "precio",
      },
      {
        data: "cantidad",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }
  });

  tblAiresEliminados = $("#tblAiresEliminados").DataTable({
    ajax: {
      url: base_url + "AiresEliminados/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "codigo",
      },
      {
        data: "marca",
      },
      {
        data: "capacidad",
      },
      {
        data: "seer",
      },
      {
        data: "voltaje",
      },
      {
        data: "modelo",
      },
      {
        data: "caracteristica",
      },
      {
        data: "precio",
      },
      {
        data: "cantidad",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }
  });
});

function frmInventarioRespuestos() {
  document.getElementById("title").innerHTML = "Nuevo Producto";
  document.getElementById("btnId").innerHTML = "Registrar";
  document.getElementById("frmRespuestos").reset();
  document.getElementById("id").value = "";
  $("#nuevo_respuesto").modal("show");
}

function frmInventarioAires() {
  document.getElementById("title").innerHTML = "Nuevo Producto";
  document.getElementById("btnId").innerHTML = "Registrar";
  document.getElementById("frmAires").reset();
  document.getElementById("id").value = "";
  $("#nuevo_aire").modal("show");
}

function registrarRespuesto(event) {
  event.preventDefault();
  const cod = document.getElementById("txtCodigo").value;
  maxLength = 8;
  minLength = 8;
  if (cod.length < minLength || cod.length > maxLength) {
    alerttime("Debe ingresar codigo de 8 digitos", "error");
  } else {
    const txtUnidades = document.getElementById("txtUnidades");
    if (txtUnidades.value < 0) {
      Swal.fire("Error", "No puedes poner unidades negativas", "error");
    } else {
      const url = base_url + "InventarioRespuestos/registrar";
      const frm = document.getElementById("frmRespuestos");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            alerta("Producto", "registrado");
            frm.reset();
            $("#nuevo_respuesto").modal("hide");
            tblInventarioRespuestos.ajax.reload();
          } else if (res == "modificado") {
            alerta("Producto", "modificado");
            $("#nuevo_respuesto").modal("hide");
            tblInventarioRespuestos.ajax.reload();
          } else {
            Swal.fire("Error", res, "error");
          }
        }
      };
    }
  }
}

function btnEditarRespuesto(id) {
  document.getElementById("title").innerHTML = "Actualizar Producto";
  document.getElementById("btnId").innerHTML = "Modificar Producto";
  const url = base_url + "InventarioRespuestos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("txtCodigo").value = res.codigo;
      document.getElementById("txtProducto").value = res.producto;
      document.getElementById("txtMarca").value = res.marca;
      document.getElementById("txtUnidades").value = res.unidades;
      document.getElementById("txtPrecio").value = res.precio;
      $("#nuevo_respuesto").modal("show");
    }
  };
}

function btnEliminarRespuesto(id) {
  Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El producto se eliminara de forma permanente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "InventarioRespuestos/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            alerta("Producto", "borrado");
            tblInventarioRespuestos.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}

function btnReingresarRespuesto(id) {
  Swal.fire({
    title: "Esta seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "RespuestosEliminados/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            alerta("Producto", "reingrsado");
            tblRespuestosEliminados.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}

function registrarAire(event) {
  event.preventDefault();
  const cod = document.getElementById("codigo").value;
  maxLength = 8;
  minLength = 8;
  if (cod.length < minLength || cod.length > maxLength) {
    alerttime("Debe ingresar codigo de 8 digitos", "error");
  } else {
    const txtCantidad = document.getElementById("txtCantidad");
    if (txtCantidad.value < 0) {
      Swal.fire("Error", "No puedes poner unidades negativas", "error");
    } else {
      const url = base_url + "InventarioAires/registrar";
      const frm = document.getElementById("frmAires");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            alerta("Producto", "registrado");
            frm.reset();
            $("#nuevo_aire").modal("hide");
            tblInventarioAires.ajax.reload();
          } else if (res == "modificado") {
            alerta("Producto", "modificado");
            $("#nuevo_aire").modal("hide");
            tblInventarioAires.ajax.reload();
          } else {
            Swal.fire("Error", res, "error");
          }
        }
      };
    }
  }

}

function btnEditarAire(id) {
  document.getElementById("title").innerHTML = "Actualizar Producto";
  document.getElementById("btnId").innerHTML = "Modificar Producto";
  const url = base_url + "InventarioAires/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("codigo").value = res.codigo;
      document.getElementById("slctMarca").value = res.marca;
      document.getElementById("slctCapacidad").value = res.capacidad;
      document.getElementById("slctSeer").value = res.seer;
      document.getElementById("slctVoltaje").value = res.voltaje;
      document.getElementById("slctModelo").value = res.modelo;
      document.getElementById("slctCaracteristica").value = res.caracteristica;
      document.getElementById("precio").value = res.precio;
      document.getElementById("txtCantidad").value = res.cantidad;
      $("#nuevo_aire").modal("show");
    }
  };
}

function btnEliminarAire(id) {
  Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El producto se eliminara de forma permanente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "InventarioAires/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje", "Producto Borrado Éxitosamente", "success");
            tblInventarioAires.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}

function btnReingresarAire(id) {
  Swal.fire({
    title: "Esta seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "AiresEliminados/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire(
              "Mensaje",
              "Producto Reingresado Éxitosamente",
              "success"
            );
            tblAiresEliminados.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}