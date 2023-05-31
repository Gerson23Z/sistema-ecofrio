let tblDetallesVnt;

txtCodigo.addEventListener("keyup", function (event) {
  getCodigosVentas(event);
});
txtCodigo.addEventListener("input", function () {
  lista.style.display = "none";
  getCodigosVentas(event);
});


function getCodigosVentas(event) {
  if (event.which == 13) {
    event.preventDefault();
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
          lista.style.display = "none";
          document.getElementById("txtProducto").value = res[0].producto;
          document.getElementById("txtPrecio").value = res[0].precio;
          document.getElementById("id").value = res[0].id;
          document.getElementById("txtStock").value = res[0].unidades;
          document.getElementById("txtCantidad").focus();
        }
      }
    }
  }
  const codigo = txtCodigo.value;
  const lista = document.getElementById("lista");
  if (codigo.length > 0) {
    const url = base_url + "Ventas/getCodigosVentas/" + codigo;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
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

function calcularPrecioVenta(event) {
  event.preventDefault();
  const cantidad = document.getElementById("txtCantidad").value;
  const precio = document.getElementById("txtPrecio").value;
  document.getElementById("txtSubTotal").value = cantidad * precio;
  if (event.which == 13) {
    lista.style.display = "none";
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
    confirmButtonText: 'Si'
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
          }
          else if (res == "cajaCerrada") {
            alerttime("Caja Cerrada", "error");
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