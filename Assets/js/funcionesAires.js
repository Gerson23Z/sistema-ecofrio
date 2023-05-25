let tblDetallesVntAire;

txtCodigo.addEventListener("keyup", function (event) {
  getCodigosAires(event);
});
txtCodigo.addEventListener("input", function () {
  lista.style.display = "none";
  getCodigosAires(event);
});

function getCodigosAires(event) {
  if (event.which == 13) {
    event.preventDefault();
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
  const codigo = txtCodigo.value;
  const lista = document.getElementById("lista");
  if (codigo.length > 0) {
    const url = base_url + "Ventas/getCodigosAires/" + codigo;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);

        lista.innerHTML = "";

        res.forEach(function (item) {
          const li = document.createElement("li");
          li.textContent = item;
          li.classList.add("item-lista");
          lista.appendChild(li);

          li.addEventListener("click", function () {
            txtCodigo.value = item;
            document.getElementById("txtCodigo").focus();
            lista.style.display = "none";
          });
        });

        lista.style.display = "block";
      }
    }
  } else {
    lista.style.display = "none";
  }
}

function calcularPrecioAire(event) {
  event.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (event.which == 13) {
    lista.style.display = "none";
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