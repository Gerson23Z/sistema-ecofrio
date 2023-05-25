function alerta(variable, accion) {
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
let tblClientes;
let tblUsuariosEliminados;
let tblCitas;
let tblDetallesCmp;
let tblDetallesVnt;
let tblDetallesVntAire;
let tblHistorialCompras;
let tblHistorialVentas;
let tblHistorialVentasAire;

document.addEventListener("DOMContentLoaded", function () {
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
  tblClientes = $("#tblClientes").DataTable({
    ajax: {
      url: base_url + "Clientes/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "dui",
      },
      {
        data: "nombre",
      },
      {
        data: "telefono",
      },
      {
        data: "direccion",
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
  tblHistorialVentasAires = $("#tblHistorialVentasAires").DataTable({
    ajax: {
      url: base_url + "HistorialVentas/listarAires",
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




const txtCodigo = document.getElementById("txtCodigo");
const lista = document.getElementById("lista");

// Agregar eventos de "keyup" y "input" al campo de entrada
txtCodigo.addEventListener("keyup", getCodigos);
txtCodigo.addEventListener("input", function () {
  lista.style.display = "none"; // Ocultar la lista al borrar un dígito
  getCodigos();
});

function getCodigos(e) {
  if (e.which == 13) {
    e.preventDefault();
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
  const codigo = txtCodigo.value;
  if (codigo.length > 0) {
    const url = base_url + "Ventas/getCodigos/" + codigo;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        // Limpiar la lista antes de agregar nuevos elementos
        lista.innerHTML = "";

        // ... Código anterior ...

        // Recorrer los elementos de la respuesta y crear los elementos de lista
        res.forEach(function (item) {
          const li = document.createElement("li");
          li.textContent = item;
          li.classList.add("item-lista"); // Agregar la clase CSS al elemento de lista
          lista.appendChild(li);

          // Agregar controlador de eventos para el clic en cada elemento de lista
          li.addEventListener("click", function () {
            // Asignar el valor del elemento de lista al campo de entrada
            txtCodigo.value = item;
            document.getElementById("txtCodigo").focus();
            // Ocultar la lista
            lista.style.display = "none";
          });
        });

        // ... Código posterior ...

        // Mostrar la lista
        lista.style.display = "block";
      }
    }
  } else {
    // Ocultar la lista si el campo de entrada está vacío
    lista.style.display = "none";
  }
}

function calcularPrecioVenta(e) {
  e.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (e.which == 13) {
    lista.style.display = "none";
    if (cantidad > 0) {
      const url = base_url + "Ventas/ingresarVenta";
      const frm = document.getElementById("frmVentas");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            frm.reset();
            CargarDetallesVnt();
          } else if (res == "modificado") {
            frm.reset();
            CargarDetallesVnt();
          } else if (res == "sobredemanda") {
            Swal.fire("Error", "Cantidad Insuficiente en Stock", "error");
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
      const url = base_url + "Ventas/registrarVenta";
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
          } else if (res == "vacioVenta") {
            alerttime("No hay ventas a registrar", "error");
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

function buscarCodigoAires(e) {
  e.preventDefault();
  if (e.which == 13) {
    const cod = document.getElementById("txtCodigo").value;
    const url = base_url + "Ventas/buscarAire/" + cod;
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
          document.getElementById("txtProducto").value = res[0].marca + " " + res[0].capacidad + " " + res[0].seer;
          document.getElementById("txtPrecio").value = res[0].precio;
          document.getElementById("id").value = res[0].id;
          document.getElementById("txtCantidad").focus();
        }
      }
    }
  }
}

function calcularPrecioAire(e) {
  e.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (e.which == 13) {
    if (cantidad > 0) {
      const url = base_url + "Ventas/ingresarAire";
      const frm = document.getElementById("frmAires");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            frm.reset();
            CargarDetallesVntAir();
          } else if (res == "modificado") {
            frm.reset();
            CargarDetallesVntAir();
          } else if (res == "sobredemanda") {
            Swal.fire("Error", "Cantidad Insuficiente en Stock", "error");
          }
        }
      };
    }
  }
}

function CargarDetallesVntAir() {
  const url = base_url + "Ventas/listaraire";
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
        <td>${row['marca']}</td>
        <td>${row['capacidad']}</td>
        <td>${row['seer']}</td>
        <td>${row['precio']}</td>
        <td>${row['cantidad']}</td>
        <td>${row['subtotal']}</td>
        <td>
        <button type="button" class="btn btn-danger" type="button" onclick="eliminarDetalleAire('${row['id']}')"><i class="fas fa-trash"></i></button>

        </td>
        </tr>`;
      });
      document.getElementById("tblDetallesVntAire").innerHTML = html;
      document.getElementById("txtTotal").value = res['total_pagar'].total;
    }
  };
}

function eliminarDetalleAire(id) {
  const url = base_url + "Ventas/eliminarAire/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        alerttime("Producto eliminado", "success");
        CargarDetallesVntAir();
      } else {
        alerttime("error", "error");
        CargarDetallesVntAir();
      }
    }
  };
}

function registrarVentaAire() {
  Swal.fire({
    title: 'Registrar venta?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Ventas/registrarVentaAire";
      const frm = document.getElementById("frmAires");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            alerttime("Venta registrada", "success");
            CargarDetallesVntAir();
            document.getElementById("dui").value = "";
            document.getElementById("nombreCliente").value = "";
            document.getElementById("telefonoCliente").value = "";
            document.getElementById("direccionCliente").value = "";
            const ruta = base_url + "Ventas/generarPDFAire/" + res.id_venta;
            window.open(ruta);
          } else if (res == "vacio") {
            alerttime("No puede dejar campos vacios", "error");
          } else if (res == "vacioVenta") {
            alerttime("No hay ventas a registrar", "error");
          } else {
            alerttime("error", "error");
          }
        }
      };
    }
  })
}

function clienteClck(event) {
  event.preventDefault();
  if (event.which == 13) {
    const numDui = document.getElementById("dui").value;
    const url = base_url + "Ventas/clientes/" + numDui;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "") {
          document.getElementById("nombreCliente").focus();
        } else {
          document.getElementById("nombreCliente").value = res[0].nombre;
          document.getElementById("telefonoCliente").value = res[0].telefono;
          document.getElementById("direccionCliente").value = res[0].direccion;
        }
      }
    }
  }
}

function sig(event, idSig) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById(idSig).focus();
  }
}

function mostrarPdfVntAire(id) {
  const ruta = base_url + "Ventas/generarPDFAire/" + id;
  window.open(ruta);
}

function btnEditarCliente(id) {
  const url = base_url + "Clientes/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("dui").value = res.dui;
      document.getElementById("nombreCliente").value = res.nombre;
      document.getElementById("telefonoCliente").value = res.telefono;
      document.getElementById("direccionCliente").value = res.direccion;
      $("#editar_cliente").modal("show");
    }
  };
}

function modificarCliente(event) {
  event.preventDefault();
  const url = base_url + "Clientes/modificar";
  const frm = document.getElementById("frmClientes");
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "modificado") {
        alerta("Cliente", "modificado");
        $("#editar_cliente").modal("hide");
        tblClientes.ajax.reload();
      } else if (res == "existe") {
        alerttime("El cliente ya existe", "error");
      }
      else {
        alerterror();
      }
    }
  };
}

function btnEliminarCliente(id) {
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
        base_url + "Clientes/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          tblClientes.ajax.reload();
        }
      };
    }
  });
}