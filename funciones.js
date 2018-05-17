var x;
x=$(document);
x.ready(inicializarEventos);

$(document).ready(function () {
    $('#buscador').keyup(buscador);
    $(document).on('click', 'li', function () {
        $('#buscador').val($(this).text());
        $('#autobuscador').fadeOut();
    });
});

function buscador() {
    var query = $(this).val();
    if (query != '')
    {
        $.ajax({
            url: "mysql.php",
            method: "POST",
            data: {query: query},
            success: function (data)
            {
                $('#autobuscador').fadeIn();
                $('#autobuscador').html(data);
            }
        });
    } else {
        $('#autobuscador').fadeOut();
        $('#autobuscador').html("");
    }
}


function inicializarEventos() {
    /*autoCompletado();*/
    var x;
   /* x = $("#buscador2");
    x.click(presionBuscador);*/
    x=$("#provincia");
    x.change(cambiaprovincia);
}


function cambiaprovincia()
{
    var provincia=$("#provincia").val();
    
    var ciudad = $("#city");
     $.ajax({
                    url:"provincias.php",
                    method:"POST",
                    data:{provincia:provincia},
                    dataType:'json',
                    success:function(data)
                    {
                        ciudad.empty();
                      for(var cont=0;cont<data.length;cont++)
                       {
                            ciudad.append('<option value=' + data[cont]['id_ciudad'] + '>'+ data[cont]['nombre'] + '</option>');
                       }
                    } ,
     });
}

function verifech()
{
    var fecha_aux = new Date(document.getElementById("fecha").value);
    var hoy = new Date();
    var Fecha1 = new Date(hoy.getUTCFullYear(), hoy.getMonth(), hoy.getDate() + 1);

    if (fecha_aux.getTime() < Fecha1.getTime())
    {
        alert("La fecha no puede ser anterior a mañana.");
        return false;
    } else
    {
        alert("ok");
        return true;
    }
}

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

