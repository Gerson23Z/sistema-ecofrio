let tblDetallesCmpAire;

txtCodigo.addEventListener("keyup", function (event) {
  getCodigosComprasAires(event);
});
txtCodigo.addEventListener("input", function () {
  lista.style.display = "none";
  getCodigosComprasAires(event);
});

function getCodigosComprasAires(event) {
  if (event.which == 13) {
    event.preventDefault();
    const cod = document.getElementById("txtCodigo").value;
    const url = base_url + "Compras/buscarAire/" + cod;
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
          document.getElementById("id").value = res[0].id;
          document.getElementById("txtCantidad").focus();
        }
      }
    }
  }
  const codigo = txtCodigo.value;
  const lista = document.getElementById("lista");
  if (codigo.length > 0) {
    const url = base_url + "Compras/getCodigosAire/" + codigo;
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

function calcularPrecioCompraAire(event) {
  event.preventDefault();
  if (event.which == 13) {
    lista.style.display = "none";
      const url = base_url + "Compras/ingresarAire";
      const frm = document.getElementById("frmCompraAires");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            frm.reset();
            CargarDetallesCmpAir();
          } else if (res == "modificado") {
            frm.reset();
            CargarDetallesCmpAir();
          }
        }
      };
  }
}

function CargarDetallesCmpAir() {
  const url = base_url + "Compras/listaraire";
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
      document.getElementById("tblDetallesCmpAire").innerHTML = html;
      document.getElementById("txtTotal").value = res['total_pagar'].total;
    }
  };
}

function eliminarDetalleAire(id) {
  const url = base_url + "Compras/eliminarAire/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        alerttime("Producto eliminado", "success");
        CargarDetallesCmpAir();
      } else {
        alerttime("error", "error");
        CargarDetallesCmpAir();
      }
    }
  };
}

function registrarCompraAire() {
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
      const url = base_url + "Compras/registrarCompraAire";
      const frm = document.getElementById("frmCompraAires");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            alerttime("Venta registrada", "success");
            CargarDetallesCmpAir();
            const ruta = base_url + "Compras/generarPDFAire/" + res.id_compra;
            window.open(ruta);
          } else if (res == "vacioCompra") {
            alerttime("No hay Compras a registrar", "error");
          } else {
            alerttime("error", "error");
          }
        }
      };
    }
  })
}

function mostrarPdfVntAire(id) {
  const ruta = base_url + "Compras/generarPDFAire/" + id;
  window.open(ruta);
}

function salto(e) {
  e.preventDefault();
  if (e.which == 13) {
    lista.style.display = "none";
    document.getElementById("txtPrecio").focus();
  }
}