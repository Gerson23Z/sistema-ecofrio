let tblDetallesCmp;

txtCodigo.addEventListener("keyup", function (event) {
  getCodigosCompras(event);
});
txtCodigo.addEventListener("input", function () {
  lista.style.display = "none";
  getCodigosCompras(event);
});

function getCodigosCompras(event) {
  if (event.which == 13) {
    event.preventDefault();
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
  const codigo = txtCodigo.value;
  const lista = document.getElementById("lista");
  if (codigo.length > 0) {
    const url = base_url + "Compras/getCodigosCompras/" + codigo;
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

  function calcularPrecioCompra(event) {
    event.preventDefault();
    const cantidad = document.getElementById("txtCantidad").value;
    const precio = document.getElementById("txtPrecio").value;
    document.getElementById("txtSubTotal").value = cantidad * precio;
    if (event.which == 13) {
      lista.style.display = "none";
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
