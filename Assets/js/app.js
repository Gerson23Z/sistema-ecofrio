var myModal = new bootstrap.Modal(document.getElementById('myModal'));
let frm = document.getElementById("formulario");
let eliminar = document.getElementById("btnEliminar");
let checkbox = document.getElementById("check");
let labelcheck = document.getElementById("labelcheck");
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: "es",
    headerToolbar: {
      left: "prev next today",
      center: "title",
      right: "dayGridMonth timeGridWeek listWeek",
    },
    events: base_url + "Citas/listar",
    editable: true,
    dateClick: function (info) {
      frm.reset();
      document.getElementById("id").value = "";
      document.getElementById("fecha").value = info.dateStr;
      var fechaSeleccionada = new Date(info.dateStr);
      var fechaActual = new Date();
      if (fechaSeleccionada < fechaActual) {
        document.getElementById("btnAccion").disabled = true;
        document.getElementById("titulo").disabled = true;
      } else {
        document.getElementById("btnAccion").disabled = false;
        document.getElementById("titulo").disabled = false;
      }
      document.getElementById("btnAccion").textContent = "Registrar";
      document.getElementById("titulo").textContent = "Registrar Cita";
      eliminar.classList.add("d-none");
      checkbox.classList.add("d-none");
      labelcheck.classList.add("d-none");
      myModal.show();
    },
    eventClick: function (info) {
      document.getElementById("id").value = info.event.id;
      document.getElementById("nombre").value = info.event.title;
      document.getElementById("dui").value = info.event.extendedProps.dui;
      document.getElementById("telefono").value = info.event.extendedProps.telefono;
      document.getElementById("direccion").value = info.event.extendedProps.direccion;
      document.getElementById("tipo").value = info.event.extendedProps.tipo;
      document.getElementById("fecha").value = info.event.startStr;
      document.getElementById("btnAccion").textContent = "Modificar";
      document.getElementById("titulo").textContent = "Actualizar Cita";
      eliminar.classList.remove("d-none");
      checkbox.classList.remove("d-none");
      labelcheck.classList.remove("d-none");
      myModal.show();
    },
    eventDrop: function (info) {
      const fecha = info.event.startStr;
      const id = info.event.id;

      const url = base_url + "Citas/drag";
      const http = new XMLHttpRequest();
      const Data = new FormData();
      Data.append("fecha", fecha);
      Data.append("id", id);
      http.open("POST", url, true);
      http.send(Data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          if (res.estado) {
            myModal.hide();
            calendar.refetchEvents();
          }
        }
      };
    },
  });
  calendar.render();
  frm.addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      document.getElementById("dui").onkeyup(e);
    }
  });
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre").value;
    const dui = document.getElementById("dui").value;
    const telefono = document.getElementById("telefono").value;
    const direccion = document.getElementById("direccion").value;
    const tipo = document.getElementById("tipo").value;
    const fecha = document.getElementById("fecha").value;
    const check = document.getElementById("check").value;
    if (
      (nombre == "" ||
        dui == "" ||
        telefono == "" ||
        direccion == "" ||
        tipo == "" ||
        fecha == "")
    ) {
      Swal.fire("Avisos", "Todo los campos son obligatorios", "warning");
    } else {
      const numDui = document.getElementById("dui").value;
      const telefono = document.getElementById("telefono").value;
      maxLength = 8;
      minLength = 8;
      if (numDui.length < minLength || numDui.length > maxLength) {
        alerttime("Debe ingresar un numero de dui correcto", "error");
      } else {
        if (telefono.length < minLength || telefono.length > maxLength) {
          alerttime("Debe ingresar un numero de telefono correcto", "error");
        } else {
          const url = base_url + "Citas/registrar";
          const http = new XMLHttpRequest();
          http.open("POST", url, true);
          http.send(new FormData(frm));
          http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              const res = JSON.parse(this.responseText);
              Swal.fire("Aviso", res.msg, res.tipo);
              if (res.estado) {
                calendar.refetchEvents();
                myModal.hide();
                calendar.refetchEvents();
              }
            }
          };
        }
      }

    }
  })
  eliminar.addEventListener("click", function () {
    myModal.hide();
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
          base_url + "Citas/eliminar/" + document.getElementById("id").value;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            Swal.fire("Avisos", res.msg, res.tipo);
            if (res.estado) {
              calendar.refetchEvents();
            }
          }
        };
      }
    });
  });
});

document.getElementById("dui").addEventListener("keyup", function (event) {
  clienteClck(event);
});
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
          document.getElementById("nombre").focus();
        } else {
          document.getElementById("nombre").value = res[0].nombre;
          document.getElementById("telefono").value = res[0].telefono;
          document.getElementById("direccion").value = res[0].direccion;
        }
      }
    }
  }
}