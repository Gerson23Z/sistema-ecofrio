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
        data: "especificaciones",
      },
      {
        data: "fecha",
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
        data: "especificaciones",
      },
      {
        data: "fecha",
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
        data: "tipo",
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
        data: "tipo",
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
  const txtCodigo = document.getElementById("txtCodigo");
  const txtProducto = document.getElementById("txtProducto");
  const txtEspecificaciones = document.getElementById("txtEspecificaciones");
  const txtUnidades = document.getElementById("txtUnidades");
  const txtPrecio = document.getElementById("txtPrecio");
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
          Swal.fire("Listo", "Producto registrado con exito", "success");
          frm.reset();
          $("#nuevo_respuesto").modal("hide");
          tblInventarioRespuestos.ajax.reload();
        } else if (res == "modificado") {
          Swal.fire("Listo", "Producto modificado con exito", "success");
          $("#nuevo_respuesto").modal("hide");
          tblInventarioRespuestos.ajax.reload();
        } else {
          Swal.fire("Error", res, "error");
        }
      }
    };
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
      document.getElementById("txtEspecificaciones").value = res.especificaciones;
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
      console.log(url);
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje", "Producto Borrado Éxitosamente", "success");
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
            Swal.fire(
              "Mensaje",
              "Producto Reingresado Éxitosamente",
              "success"
            );
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
  const slctMarca = document.getElementById("slctMarca");
  const slctCapacidad = document.getElementById("slctCapacidad");
  const slctSeer = document.getElementById("slctSeer");
  const slctVoltaje = document.getElementById("slctVoltaje");
  const slctModelo = document.getElementById("slctModelo");
  const slctCaracteristica = document.getElementById("slctCaracteristica");
  const slctTipo = document.getElementById("slctTipo");
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
          Swal.fire("Listo", "Producto registrado con exito", "success");
          frm.reset();
          $("#nuevo_aire").modal("hide");
          tblInventarioAires.ajax.reload();
        } else if (res == "modificado") {
          Swal.fire("Listo", "Producto modificado con exito", "success");
          $("#nuevo_aire").modal("hide");
          tblInventarioAires.ajax.reload();
        } else {
          Swal.fire("Error", res, "error");
        }
      }
    };
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
      document.getElementById("slctMarca").value = res.marca;
      document.getElementById("slctCapacidad").value = res.capacidad;
      document.getElementById("slctSeer").value = res.seer;
      document.getElementById("slctVoltaje").value = res.voltaje;
      document.getElementById("slctModelo").value = res.modelo;
      document.getElementById("slctCaracteristica").value = res.caracteristica;
      document.getElementById("slctTipo").value = res.tipo;
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
      console.log(url);
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