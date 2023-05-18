function alerta(variable, accion, estado) {
  Swal.fire("Listo", variable + " " + accion + " con exito", "success");
}
function alerterror() {
  Swal.fire("Error", res, "error");
}
function alerttime(titulo, icon) {
  Swal.fire({
    position: 'center',
    icon: icon,
    title: titulo,
    showConfirmButton: false,
    timer: 2000
  })
}

let tblUsuarios;
let tblUsuariosEliminados;
let tblCitas;
let tblDetallesCmp;
let tblDetallesVnt;
let tblHistorialCompras;
let tblHistorialVentas;

document.addEventListener("DOMContentLoaded", function () {
  $('#idCliente').select2();
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "user",
      },
      {
        data: "rol",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });

  tblUsuariosEliminados = $("#tblUsuariosEliminados").DataTable({
    ajax: {
      url: base_url + "UsuariosEliminados/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "user",
      },
      {
        data: "rol",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  tblCitas = $("#tblCitas").DataTable({
    ajax: {
      url: base_url + "Control/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "direccion",
      },
      {
        data: "tipo",
      },
      {
        data: "fecha_cita",
      },
      {
        data: "rest",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  tblCitasCom = $("#tblCitasCom").DataTable({
    ajax: {
      url: base_url + "ControlCompletados/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "direccion",
      },
      {
        data: "tipo",
      },
      {
        data: "fecha_cita",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  tblHistorialCompras = $("#tblHistorialCompras").DataTable({
    ajax: {
      url: base_url + "HistorialCompras/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "total",
      },
      {
        data: "fecha_compra",
      },
      {
        data: "acciones",
      },
    ],
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    }
  });
  tblHistorialVentas = $("#tblHistorialVentas").DataTable({
    ajax: {
      url: base_url + "HistorialVentas/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "total",
      },
      {
        data: "fecha_venta",
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

function frmLogin(event) {
  event.preventDefault();
  const txtUsuario = document.getElementById("txtUsuario");
  const txtPassword = document.getElementById("txtPassword");
  if (txtUsuario.value == "") {
    txtUsuario.classList.add("is-invalid");
    txtUsuario.focus();
  } else if (txtPassword.value == "") {
    txtPassword.classList.add("is-invalid");
    txtPassword.focus();
  } else {
    const url = base_url + "Usuarios/validar";
    const frm = document.getElementById("frmLogin");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "¡OK!") {
          window.location = base_url + "Principal";
        } else {
          document.getElementById("alerta").classList.remove("d-none");
          document.getElementById("alerta").innerHTML = res;
        }
      }
    };
  }
}

function frmUsuario() {
  document.getElementById("title").innerHTML = "Nuevo Usuario";
  document.getElementById("btnId").innerHTML = "Registrar";
  document.getElementById("frmUsuarios").reset();
  document.getElementById("id").value = "";
  $("#nuevo_usuario").modal("show");
}
function registrarUser(event) {
  event.preventDefault();
  const url = base_url + "Usuarios/registrar";
  const frm = document.getElementById("frmUsuarios");
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "si") {
        alerta("Usuario", "registrado");
        frm.reset();
        $("#nuevo_usuario").modal("hide");
        tblUsuarios.ajax.reload();
      } else if (res == "modificado") {
        alerta("Usuario", "modificado");
        $("#nuevo_usuario").modal("hide");
        tblUsuarios.ajax.reload();
      } else {
        alerterror();
      }
    }
  };
}

function btnEditarUsuario(id) {
  document.getElementById("title").innerHTML = "Actualizar Usuario";
  document.getElementById("btnId").innerHTML = "Modificar Usuario";
  const url = base_url + "Usuarios/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("txtNombre").value = res.nombre;
      document.getElementById("txtApellido").value = res.apellido;
      document.getElementById("txtUsuario").value = res.user;
      document.getElementById("slctRol").value = res.rol;
      document.getElementById("txtPassword");
      document.getElementById("txtConfirmar");
      $("#nuevo_usuario").modal("show");
    }
  };
}

function btnEliminarUsuario(id) {
  Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            alerta("Usuario", "borrado");
            tblUsuarios.ajax.reload();
          } else {
            alerterror();
          }
        }
      };
    }
  });
}

function btnReingresarUsuario(id) {
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
      const url = base_url + "UsuariosEliminados/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            alerta("Usuario", "reingresado");
            tblUsuariosEliminados.ajax.reload();
          } else {
            alerterror();
          }
        }
      };
    }
  });
}

let btnMarc = document.getElementById("btnIdMarcar");
let btnReg = document.getElementById("btnId");
function registrarCita(event) {
  event.preventDefault();
  const url = base_url + "Citas/registrar";
  const frm = document.getElementById("frmCita");
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      Swal.fire("Aviso", res.msg, res.tipo);
      if (res.estado) {
        $("#nuevo_cita").modal("hide");
        tblCitas.ajax.reload();
      }
    }
  };
}
function marcarCom() {
  const id = document.getElementById("id").value;
  Swal.fire({
    title: "Marcar como completado?",
    text: "Una vez marcado no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Control/marcar/" + id;
      const frm = document.getElementById("frmCita");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje", "Completado", "success");
            $("#nuevo_cita").modal("hide");
            tblCitas.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}

function btnEditarCita(id) {
  const url = base_url + "Control/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("apellido").value = res.apellido;
      document.getElementById("dui").value = res.dui;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("direccion").value = res.direccion;
      document.getElementById("tipo").value = res.tipo;
      document.getElementById("fecha").value = res.fecha;
      if (res.completado == 1) {
        btnMarc.classList.add("d-none");
        btnReg.classList.add("d-none");
        document.getElementById("id").disabled = true;
        document.getElementById("nombre").disabled = true;
        document.getElementById("apellido").disabled = true;
        document.getElementById("dui").disabled = true;
        document.getElementById("telefono").disabled = true;
        document.getElementById("direccion").disabled = true;
        document.getElementById("tipo").disabled = true;
        document.getElementById("fecha").disabled = true;
      }
      $("#nuevo_cita").modal("show");
    }
  };
}

function btnEliminarCita(id) {
  Swal.fire({
    title: "Advertencia",
    text: "Esta seguro de eliminar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url =
        base_url + "Citas/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          tblCitas.ajax.reload();
        }
      };
    }
  });
}

function buscarCodigoCompra(e) {
  e.preventDefault();
  if (e.which == 13) {
    const cod = document.getElementById("txtCodigo").value;
    const url = base_url + "Compras/buscarCodigo/" + cod;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "") {
          alerttime("El producto no existe", "error");
          document.getElementById("txtCodigo").value = "";
          document.getElementById("txtCodigo").focus();
        } else {
          document.getElementById("txtProducto").value = res[0].producto;
          document.getElementById("txtPrecio").value = res[0].precio;
          document.getElementById("id").value = res[0].id;
          document.getElementById("txtCantidad").focus();
        }
      }
    }
  }
}

function calcularPrecioCompra(e) {
  e.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (e.which == 13) {
    if (cantidad > 0) {
      const url = base_url + "Compras/ingresarCompra";
      const frm = document.getElementById("frmCompras");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            frm.reset();
            CargarDetallesCmp();
          } else if (res == "modificado") {
            frm.reset();
            CargarDetallesCmp();
          }
        }
      };
    }
  }
}

function CargarDetallesCmp() {
  const url = base_url + "Compras/listar";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = '';
      res['detalles'].forEach(row => {
        html += `<tr>
        <td>${row['codigo']}</td>
        <td>${row['producto']}</td>
        <td>${row['precio']}</td>
        <td>${row['cantidad']}</td>
        <td>${row['subtotal']}</td>
        <td>
        <button type="button" class="btn btn-danger" type="button" onclick="eliminarDetalleCmp('${row['id']}')"><i class="fas fa-trash"></i></button>

        </td>
        </tr>`;
      });

      document.getElementById("tblDetallesCmp").innerHTML = html;
      document.getElementById("txtTotal").value = res['total_pagar'].total;

    }
  };
}

function eliminarDetalleCmp(id) {
  const url = base_url + "Compras/eliminar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        alerttime("Producto eliminado", "success");
        CargarDetallesCmp();
      } else {
        alerttime("error", "error");
        CargarDetallesCmp();
      }
    }
  };
}

function registrarCompra() {
  Swal.fire({
    title: 'Registrar Compra?',
    text: "Quieres registrar la compra?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Compras/registrarCompra";
      const frm = document.getElementById("frmCompras");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            alerttime("Compra registrada", "success");
            CargarDetallesCmp();
            const ruta = base_url + "Compras/generarPDF/" + res.id_compra;
            window.open(ruta);
          } else {
            alerttime("error", "error");
          }
        }
      };
    }
  })
}

function mostrarPdfCmp(id) {
  const ruta = base_url + "Compras/generarPDF/" + id;
  window.open(ruta);
}


function buscarCodigoVenta(e) {
  e.preventDefault();
  if (e.which == 13) {
    const cod = document.getElementById("txtCodigo").value;
    const url = base_url + "Ventas/buscarCodigo/" + cod;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "") {
          alerttime("El producto no existe", "error");
          document.getElementById("txtCodigo").value = "";
          document.getElementById("txtCodigo").focus();
        } else {
          document.getElementById("txtProducto").value = res[0].producto;
          document.getElementById("txtPrecio").value = res[0].precio;
          document.getElementById("id").value = res[0].id;
          document.getElementById("txtCantidad").focus();
        }
      }
    }
  }
}

function calcularPrecioVenta(e) {
  e.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (e.which == 13) {
    if (cantidad > 0) {
      const url = base_url + "Ventas/ingresarVenta";
      const frm = document.getElementById("frmVentas");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            frm.reset();
            CargarDetallesVnt();
          } else if (res == "modificado") {
            frm.reset();
            CargarDetallesVnt();
          }
        }
      };
    }
  }
}

function CargarDetallesVnt() {
  const url = base_url + "Ventas/listar";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = '';
      res['detalles'].forEach(row => {
        html += `<tr>
        <td>${row['codigo']}</td>
        <td>${row['producto']}</td>
        <td>${row['precio']}</td>
        <td>${row['cantidad']}</td>
        <td>${row['subtotal']}</td>
        <td>
        <button type="button" class="btn btn-danger" type="button" onclick="eliminarDetalleVnt('${row['id']}')"><i class="fas fa-trash"></i></button>

        </td>
        </tr>`;
      });

      document.getElementById("tblDetallesVnt").innerHTML = html;
      document.getElementById("txtTotal").value = res['total_pagar'].total;

    }
  };
}

function eliminarDetalleVnt(id) {
  const url = base_url + "Ventas/eliminar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        alerttime("Producto eliminado", "success");
        CargarDetallesVnt();
      } else {
        alerttime("error", "error");
        CargarDetallesVnt();
      }
    }
  };
}

function registrarVenta() {
  Swal.fire({
    title: 'Registrar venta?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      const frm = document.getElementById("frmVentas");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            alerttime("Venta registrada", "success");
            CargarDetallesVnt();
            const ruta = base_url + "Ventas/generarPDF/" + res.id_venta;
            window.open(ruta);
          } else {
            alerttime("error", "error");
          }
        }
      };
    }
  })
}

function mostrarPdfVnt(id) {
  const ruta = base_url + "Ventas/generarPDF/" + id;
  window.open(ruta);
}

function obtenerClientes() {
  const url = base_url + "Ventas/clientes";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      const select = document.getElementById("idCliente"); // Reemplaza "mi-select" con el ID de tu select HTML

      // Limpiar opciones previas en caso de ser necesario
      select.innerHTML = "";

      // Iterar sobre los clientes y crear opciones
      res.forEach(function (cliente) {
        const option = document.createElement("option");
        option.value = cliente.id; // Reemplaza "id" con la propiedad que corresponda al ID del cliente
        option.textContent = cliente.nombre; // Reemplaza "nombre" con la propiedad que corresponda al nombre del cliente
        select.appendChild(option);
      });
    }
  }
}