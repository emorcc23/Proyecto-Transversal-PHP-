function verificapass() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    if (pass1 == pass2) {
        return true;
    }
    else
    {
        alert("Las contraseñas no son iguales");
        return false;
    }  
}
