var form = document.querySelector("#form-edit-empresa");
var alertas = document.querySelector("#alertaEmpresa");

var empresas = form.querySelector("select[name='select-edit-empresa']");

var form_logo = document.querySelector("#form-edit-logo-empresa");

var form_del = document.querySelector("#form-delete-empresa");

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

empresas.addEventListener("change", function(){
    if(empresas.value){
        var data = new FormData();
        var request = new XMLHttpRequest();

        var tagDelete = document.querySelector("#tag-empresa-delete");
        var nome = form.querySelector("input[name='nome-edit-empresa']");
        var telefone = form.querySelector("input[name='telefone-edit-empresa']");
        var endereco = form.querySelector("input[name='endereco-edit-empresa']");
        var link = form.querySelector("input[name='link-edit-empresa']");
        var segmento = form.querySelector("select[name='segmento-edit-empresa']");
        var textarea = form.querySelector("textarea[name='descricao-edit-empresa']");
        var editLogo = form_logo.querySelector("input[name='select-edit-logo-empresa']");
        
        var idDel = form_del.querySelector("input[name='select-del-empresa']");

        data.append('idEmpresa', empresas.value);

        //  ZERA OS CAMPOS ANTES DA BUSCA
        alertas.innerHTML = "<div class=\"alert alert-info color-info\">Buscando empresa...</div>";
        
        nome.value = "";
        
        telefone.value = "";

        endereco.value = "";

        link.value = "";
        
        textarea.value = "";
        
        editLogo.value = 0;
        
        tagDelete.innerHTML = "";
        
        idDel.value = 0;
        
        segmento.querySelectorAll("option").forEach(option => {
            if(option.value == ""){
                option.setAttribute("selected", true);
            }else{
                option.removeAttribute("selected");
            }
        })

        request.addEventListener("load", function(){
            if(request.response.status == "success"){

                nome.value = ucwords(request.response.nome);

                telefone.value = request.response.telefone;

                endereco.value = ucwords(request.response.endereco);

                link.value = request.response.link;
                
                textarea.value = ucfirst(request.response.descricao);
                
                editLogo.value = empresas.value;
                
                idDel.value = empresas.value;
                
                tagDelete.innerHTML = "confirmar";//(request.response.nome).toLowerCase().replace(" ","-");
                
                segmento.querySelectorAll("option").forEach(option => {
                    if(option.value == request.response.segmento){
                        option.setAttribute("selected", true);
                    
                    }else{
                        option.removeAttribute("selected");
                    }
                })
                
                alertas.innerHTML = "<div class=\"alert alert-success color-success\">Mostrando "+ucwords(request.response.nome)+" </div>";
            
            }else{
                alertas.innerHTML = "<div class=\"alert alert-danger color-danger\">Empresa não encontrada</div>";

            }
        });

        request.responseType = "json";

        request.open("post", "busca_empresa.php");
        request.send(data);

    }
});

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
        document.querySelector("#alertaEmpresa").innerHTML = "<div class=\"alert alert-danger color-danger\">Existem campos vazios.</div>"
    }

});

form_logo.querySelector("button").addEventListener("click", function(){
    var campos = form_logo.querySelectorAll("input");
    
    var continuar = true;

    campos.forEach(campo => {
        if(campo.value == undefined || campo.value == ""){
            continuar = false;
        }
    });


    if(continuar){
        form_logo.submit();
    }else{
        document.querySelector("#alertaEmpresa").innerHTML = "<div class=\"alert alert-danger color-danger\">Campo da Logo está vazio.</div>"
    }

});

form_del.querySelector("button").addEventListener("click", function(){
    var campos = form_logo.querySelectorAll("input");
    
    var continuar = true;

    campos.forEach(campo => {
        if(campo.name == "select-del-empresa" && campo.value != ""){
            continuar = true;
        }
    });


    if(continuar){
        form_del.submit();
    }else{
        document.querySelector("#alertaEmpresa").innerHTML = "<div class=\"alert alert-danger color-danger\">Campo da Exclusão está vazio.</div>"
    }

});