function alerta(variable, accion) {
  Swal.fire("Listo", variable + " " + accion + " con exito", "success");
}
function alerterror() {
  Swal.fire("Error", "error");
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
let tblHistorialCompras;
let tblHistorialVentas;
let tblHistorialVentasAire;
let tblHistorialComprasAire;
let tblCaja;

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
  tblHistorialComprasAires = $("#tblHistorialComprasAires").DataTable({
    ajax: {
      url: base_url + "HistorialCompras/listarAires",
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
  tblCaja = $("#tblCaja").DataTable({
    ajax: {
      url: base_url + "Configuracion/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "usuario",
      },
      {
        data: "monto_inicial",
      },
      {
        data: "monto_final",
      },
      {
        data: "fecha_apertura",
      },
      {
        data: "fecha_cierre",
      },
      {
        data: "total_ventas",
      },
      {
        data: "monto_total",
      },
      {
        data: "estado",
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
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          tblCitas.ajax.reload();
        }
      };
    }
  });
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
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          tblClientes.ajax.reload();
        }
      };
    }
  });
}

function frmCaja() {
  document.getElementById("montoInicial").value = "";
  document.getElementById("id").value = "";
  document.getElementById("ocultarInput").classList.add('d-none');
  $("#nuevo_caja").modal("show");
}
function abrirCaja(e) {
  e.preventDefault();
  const monto_inicial = document.getElementById("montoInicial").value
  if(monto_inicial == ""){
    alerterror();
  }else{
    const frm = document.getElementById("frmAbrirCaja");
    const url = base_url + "Configuracion/abrirCaja";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        Swal.fire("Avisos", res.msg, res.tipo);
        tblCaja.ajax.reload();
        $("#nuevo_caja").modal("hide");
      }
    }
  }
}

function cerrarCaja(){
  const url = base_url + "Configuracion/ventas";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.inicial.id;
      document.getElementById("montoInicial").value = res.inicial.monto_inicial;
      document.getElementById("montoFinal").value = res.monto_total;
      document.getElementById("totalVentas").value = res.total_ventas;
      document.getElementById("montoTotal").value = res.monto_general;
      document.getElementById("ocultarInput").classList.remove('d-none');
      document.getElementById("btnId").innerHTML = "Cerrar Caja";
      tblCaja.ajax.reload();
      $("#nuevo_caja").modal("show");
    }
  }
}

