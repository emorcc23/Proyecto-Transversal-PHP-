/*function verifech()
{
    alert("hola");
   var Fecha_aux = document.getElementById("fecha").value.split("/");
    var Fecha1 = new Date(parseInt(fecha_aux[2]),parseInt(fecha_aux[1]-1),parseInt(fecha_aux[0]));
    var hoy = new Date();
    
    alert(Fecha1);
    alert(hoy);
    if(Fecha1<hoy)
    {
        alert("La fecha no puede ser anterior a la actual.");
        return false;
    }
    else
    {
        return true;
    }
}*/

function verificapass() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    if (pass1 == pass2) {
        return true;
    } else
    {
        alert("Las contraseñas no son iguales");
        return false;
    }
}

var x;
x=$(document);
x.ready(inicializarEventos);

function inicializarEventos()
{
  var x=$("#boton1");
  x.click(ocultarRecuadro);
  x=$("#boton2");
  x.click(mostrarRecuadro);
}

function ocultarRecuadro()
{
  var x=$("#descripcion");
  x.fadeOut("slow");
}

function mostrarRecuadro()
{
  var x=$("#descripcion");
  x.fadeIn("slow");
}