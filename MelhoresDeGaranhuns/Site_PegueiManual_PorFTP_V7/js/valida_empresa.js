var form = document.querySelector("#form-nova-empresa");

form.querySelector("button").addEventListener("click", function(){
    var campos = form.querySelectorAll("input");
    var selects = form.querySelectorAll("select");
    var textareas = form.querySelectorAll("textarea");

    var continuar = true;

    campos.forEach(campo => {
        if(campo.value == undefined || campo.value == ""){
            continuar = false;
        }
    });

    selects.forEach(campo => {
        if(campo.value == undefined || campo.value == ""){
            continuar = false;
        }
    });

    textareas.forEach(campo => {
        if(campo.value == undefined || campo.value == ""){
            continuar = false;
        }
    });

    if(continuar){
        form.submit();
    }else{
        document.querySelector("#alertaEmpresa").innerHTML = "<div class=\"alert alert-danger color-danger\">Existem campos vazios.</div>";
    }

});