document.addEventListener("DOMContentLoaded", function (){
    const url = base_url + "Configuracion/mostrar/" + 1;
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
      const url = base_url + "Configuracion/editar/" + 1;
      const frm = document.getElementById("frmInfo");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "modificado") {
            alerttime("informacion editada","success");
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else {
            alerttime("error","error");
          }
        }
      };
    }
  });
}