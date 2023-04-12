let tblUsuarios;
let tblInventario;

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

  tblInventario = $("#tblInventario").DataTable({
    ajax: {
      url: base_url + "Inventario/listar",
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
        data: "tipo",
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
        data: "estado",
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

function frmInventario() {
  document.getElementById("title").innerHTML = "Nuevo Producto";
  document.getElementById("btnId").innerHTML = "Registrar";
  document.getElementById("frmProductos").reset();
  document.getElementById("id").value = "";
  $("#nuevo_producto").modal("show");
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

  if (
    txtNombre.value == "" ||
    txtApellido.value == "" ||
    txtUsuario.value == ""
  ) {
    Swal.fire("Error", "No puedes dejar campos vacios", "error");
  } else {
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
}

function btnEditarUser(id) {
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

function btnEliminarUser(id) {
  Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
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

function btnReingresarUser(id) {
  Swal.fire({
    title: "Esta seguro de reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje", "Usuario Reingresado Éxitosamente", "success");
            tblUsuarios.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}

function registrarProducto(event) {
  event.preventDefault();
  const txtCodigo = document.getElementById("txtCodigo");
  const txtProducto = document.getElementById("txtProducto");
  const slcTipo = document.getElementById("slcTipo");
  const txtEspecificaciones = document.getElementById("txtEspecificaciones");
  const txtUnidades = document.getElementById("txtUnidades");

  if (
    txtUnidades.value < 0
  ) {
    Swal.fire("Error", "No puedes poner unidades negativas", "error");
  } else {
    const url = base_url + "Inventario/registrar";
    const frm = document.getElementById("frmProductos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "si") {
          Swal.fire("Listo", "Producto registrado con exito", "success");
          frm.reset();
          $("#nuevo_producto").modal("hide");
          tblInventario.ajax.reload();
        } else if (res == "modificado") {
          Swal.fire("Listo", "Producto modificado con exito", "success");
          $("#nuevo_producto").modal("hide");
          tblInventario.ajax.reload();
        } else {
          Swal.fire("Error", res, "error");
        }
      }
    };
  }
}

function btnEditarProducto(id) {
  document.getElementById("title").innerHTML = "Actualizar Producto";
  document.getElementById("btnId").innerHTML = "Modificar Producto";
  const url = base_url + "Inventario/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("txtCodigo").value = res.codigo;
      document.getElementById("txtProducto").value = res.producto;
      document.getElementById("slcTipo").value = res.tipo;
      document.getElementById("txtEspecificaciones").value = res.especificaciones;
      document.getElementById("txtUnidades").value = res.unidades;
      $("#nuevo_producto").modal("show");
    }
  };
}

function btnEliminarProducto(id) {
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
      const url = base_url + "Inventario/eliminar/" + id;
      console.log(url)
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje", "Producto Borrado Éxitosamente", "success");
            tblInventario.ajax.reload();
          } else {
            Swal.fire("Mensaje", res, "error");
          }
        }
      };
    }
  });
}