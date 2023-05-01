let tblUsuarios;
let tblUsuariosEliminados;
let tblMantenimientos;

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
  tblMantenimientos = $("#tblMantenimientos").DataTable({
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
        data: "fecha",
      },
      {
        data: "prox",
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

let tiposlct = document.getElementById("tipo");
function registrarMan(event) {
  event.preventDefault();
  const nombre = document.getElementById("nombre");
  const apellido = document.getElementById("apellido");
  const dui = document.getElementById("dui");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");
  const tipo = document.getElementById("tipo");
  const fecha = document.getElementById("fecha");

    const url = base_url + "Citas/registrar";
    const frm = document.getElementById("frmMan");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {

        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        Swal.fire("Aviso", res.msg, res.tipo);
        if (res.estado) {
          $("#nuevo_mantenimiento").modal("hide");
          tblMantenimientos.ajax.reload();
        }
      }
    };
}


function btnEditarMantenimiento(id) {
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
      tiposlct.classList.add("d-none");
      $("#nuevo_mantenimiento").modal("show");
    }
  };
}


