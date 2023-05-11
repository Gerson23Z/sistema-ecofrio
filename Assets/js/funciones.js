let tblUsuarios;
let tblUsuariosEliminados;
let tblCitas;
let tblDetalles;
let tblHistorialCompras;

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
  tblHistorialCompras = $("#tblHistorialCompras").DataTable({
    ajax: {
      url: base_url + "Historial/listar",
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
        data: "fecha",
      },
      {
        data: "acciones",
      },
    ],
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
  const txtNombre = document.getElementById("txtNombre");
  const txtApellido = document.getElementById("txtApellido");
  const txtUsuario = document.getElementById("txtUsuario");
  const slctRol = document.getElementById("slctRol");
  const txtPassword = document.getElementById("txtPassword");
  const txtConfirmar = document.getElementById("txtConfirmar");

  const url = base_url + "Usuarios/registrar";
  const frm = document.getElementById("frmUsuarios");
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "si") {
        Swal.fire("Listo", "Usuario registrado con exito", "success");
        frm.reset();
        $("#nuevo_usuario").modal("hide");
        tblUsuarios.ajax.reload();
      } else if (res == "modificado") {
        Swal.fire("Listo", "Usuario modificado con exito", "success");
        $("#nuevo_usuario").modal("hide");
        tblUsuarios.ajax.reload();
      } else {
        Swal.fire("Error", res, "error");
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
    text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
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
            Swal.fire("Mensaje", "Usuario Borrado Éxitosamente", "success");
            tblUsuarios.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
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
            Swal.fire("Mensaje", "Usuario Reingresado Éxitosamente", "success");
            tblUsuariosEliminados.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
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
  const nombre = document.getElementById("nombre");
  const apellido = document.getElementById("apellido");
  const dui = document.getElementById("dui");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");
  const tipo = document.getElementById("tipo");
  const fecha = document.getElementById("fecha");

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
    title: "Esta seguro de eliminar?",
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

function buscarCodigo(e) {
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
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'El producto no existe',
            showConfirmButton: false,
            timer: 2000
          })
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

function calcularPrecio(e) {
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
            cargarDetalles();
          } else if (res == "modificado") {
            frm.reset();
            cargarDetalles();
          }
        }
      };
    }
  }
}

function cargarDetalles() {
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
        <button type="button" class="btn btn-danger" type="button" onclick="eliminarDetalle('${row['id']}')"><i class="fas fa-trash"></i></button>

        </td>
        </tr>`;
      });

      document.getElementById("tblDetalles").innerHTML = html;
      document.getElementById("txtTotal").value = res['total_pagar'].total;

    }
  };
}

function eliminarDetalle(id) {
  const url = base_url + "Compras/eliminar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Producto eliminado',
          showConfirmButton: false,
          timer: 2000
        })
        cargarDetalles();
      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Error',
          showConfirmButton: false,
          timer: 2000
        })
        cargarDetalles();
      }
    }
  };
}

function registrarCompra() {
  Swal.fire({
    title: 'jfjh?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Compras/registrarCompra";
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          console.log(res);
          if (res.msg == "ok") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Venta 5t5t5',
              showConfirmButton: false,
              timer: 2000
            })
            cargarDetalles();
            const ruta = base_url + "Compras/generarPDF/" + res.id_compra;
            window.open(ruta);
          } else {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Error',
              showConfirmButton: false,
              timer: 2000
            })
          }
        }
      };
    }
  })
}

function mostrarPdf(id) {
  const ruta = base_url + "Compras/generarPDF/" + id;
  window.open(ruta);
}

document.addEventListener("DOMContentLoaded", function (){
    const url = base_url + "EmpresaConfiguracion/mostrar/" + 1;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        document.getElementById("nombre").value = res.nombre;
        document.getElementById("direccion").value = res.direccion;
        document.getElementById("telefono").value = res.telefono;
        document.getElementById("dueno").value = res.dueno;
        document.getElementById("mensaje").value = res.mensaje;
      }
    };
});

function actualizar(event) {
  event.preventDefault();
  const nombre = document.getElementById("nombre");
  const direccion = document.getElementById("direccion");
  const telefono = document.getElementById("telefono");
  const dueno = document.getElementById("dueno");
  const mensaje = document.getElementById("mensaje");
  Swal.fire({
    title: "Esta seguro de actualizar la informacion?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "EmpresaConfiguracion/editar/" + 1;
      const frm = document.getElementById("frmInfo");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          console.log(res);
          if (res == "modificado") {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Modificado con exito',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else {
            Swal.fire("Error", res, "error");
          }
        }
      };
    }
  });
}

