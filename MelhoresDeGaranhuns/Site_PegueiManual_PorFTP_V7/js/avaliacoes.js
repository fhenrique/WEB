var nome_empresa = document.querySelector("#nome_empresa");
var inputEmpresa = document.querySelector("input[name='empresaRate']");
var confRate = document.querySelector("#confRate");
var botoesRate = document.querySelectorAll(".but-avaliacao");
var estrelas = document.querySelectorAll(".rate-star");
var radiosEstrelas = document.querySelectorAll("#avaliacoes input[type='radio']");

console.log(radiosEstrelas);

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function buscaEmpresa(emp, but){
    var data = new FormData();
	var request = new XMLHttpRequest();

    //Adicionar arquivo
	data.append('idEmpresa', emp);

    but.innerHTML = "Avaliar <i class=\"fas fa-circle-notch spinner\"></i>";
    if(confRate != undefined){
        confRate.setAttribute("type", "button");   
    }

    request.addEventListener("load", function(){
        
        if(request.response.status == "success"){
            nome_empresa.innerHTML = ucwords(request.response.nome);
            if(inputEmpresa != undefined){
                inputEmpresa.value = emp;   
            }
            $('#avaliacoes').modal("show");
        }else{
            console.log("aff");

        }

        but.innerHTML = "Avaliar";
    });

    request.responseType = 'json';
    request.open("post", "busca_empresa.php");
    request.send(data);
}

botoesRate.forEach(botao => {
    botao.addEventListener("click", function(){
        estrelas.forEach(link_star => {
            link_star.classList.remove("clicado");
        });
        buscaEmpresa(botao.dataset.bus, botao);
    });
});

estrelas.forEach(star => {
    star.addEventListener("click", function(e){
        e.preventDefault();
        confRate.setAttribute("type", "submit");

        estrelas.forEach(link_star => {
            link_star.classList.remove("clicado");
        });
        
        radiosEstrelas.forEach(radioStar => {
            radioStar.removeAttribute("checked");
        })
        
        var radCorresp = star.parentNode.getAttribute("for");
        
        document.querySelector("#"+radCorresp).setAttribute("checked",true);

        star.classList.add("clicado");
    });
});