var inputEmpresa = document.querySelector("input[name='empresaRate']");
var confRate = document.querySelector("#confRate");
var botoesRate = document.querySelectorAll(".but-avaliacao");
var estrelas = document.querySelectorAll(".rate-star");
var radiosEstrelas = document.querySelectorAll("input[type='radio']");

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function avaliarEmpresa(emp, nota){
    var data = new FormData();
	var request = new XMLHttpRequest();

    var idEmp = document.querySelector("input[name='empresaRate-"+emp+"']").value;
    var campoAviso = document.querySelector("#avisoEmpresa-"+emp+"");
    var load = document.querySelector("#load-"+emp);

    load.innerHTML = "<i class=\"fas fa-circle-notch spinner\"></i>";

    //Adicionar arquivo
	data.append('empresaRate', idEmp);
    data.append('estrelas', nota);

    request.addEventListener("load", function(){
        
        if(request.response.status == "success"){
            var dados = request.response.data.alertas;
            
            dados.forEach(aviso => {
                console.log(aviso.msg);
                campoAviso.classList.add("alert-"+aviso.tipo);
                campoAviso.classList.add("color-"+aviso.tipo);
                campoAviso.innerHTML = aviso.msg;
            });
        }else{
            console.log("aff");

        }

        load.innerHTML = "";

    });

    request.responseType = 'json';
    request.open("post", "alterar_avaliacao.php");
    request.send(data);
}

estrelas.forEach(star => {
    star.addEventListener("click", function(e){
        e.preventDefault();
        var aval = star.dataset.aval;

        estrelas.forEach(link_star => {
            if(link_star.dataset.aval == aval){
                link_star.classList.remove("clicado");   
            }
        });
        
        radiosEstrelas.forEach(radioStar => {
            radioStar.removeAttribute("checked");
        });
        
        var radCorresp = star.parentNode.getAttribute("for");
        
        document.querySelector("#"+radCorresp).setAttribute("checked",true);
        var nota_aval = document.querySelector("#"+radCorresp).value;

        if(!star.classList.contains("clicado"))
        {
            avaliarEmpresa(aval, nota_aval);
        }

        star.classList.add("clicado");
    });
});