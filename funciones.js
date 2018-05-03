
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

