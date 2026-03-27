//  Objeto de submit
var botaoCadastro = document.querySelector("#butCadastro");

//  Dados das divs do campo NOME
var nome = document.querySelector('input[name="nome"]');
var avisoNome = buscaAviso(nome);
var nomeValido = false;

//  Dados das divs do campo EMAIL
var email = document.querySelector('input[name="email"]');
var avisoEmail = buscaAviso(email);
var emailValido = false;

//  Dados das divs do campo SENHA
var senha = document.querySelector('input[name="senha"]');
var avisoSenha = buscaAviso(senha);

//  Dados das divs do campo CONFIRMAR SENHA
var confSenha = document.querySelector('input[name="conf-senha"]');
var avisoConfSenha = buscaAviso(confSenha);

var senhaValida = false;

//  Mensagem caso o dado atual seja valido
var msgOk = "<span>Dados Validados</span>";

//  Verifica se o formuario está apto para o submit
function verificaSubmit(){
    if(nomeValido && emailValido && senhaValida){
        botaoCadastro.setAttribute("type", "submit");
    
    }else{
        botaoCadastro.setAttribute("type", "button");
    
    }
}

//  Busca a div de alerta do campo selecionado
function buscaAviso(campo){
    return campo.parentNode.querySelector(".alertaValidacao");
}

// Eventos do campo NOME
nome.addEventListener("blur", verificaSubmit);
nome.addEventListener("input", function(){
    
    if(nome.value.length < 3){
        avisoNome.innerHTML = "Tamanho Invalido.";

    }else{
        avisoNome.innerHTML = msgOk;
        nomeValido = true;

    }

});

// Eventos do campo EMAIL
email.addEventListener("blur", verificaSubmit);
email.addEventListener("input", function(){

    if(email.value.length < 10){
        avisoEmail.innerHTML = "Tamanho Inválido.";

    }else if(email.value.indexOf("@") < 0  || email.value.indexOf(".") < 0){
        avisoEmail.innerHTML = "Endereço de email inválido.";

    }else{
        avisoEmail.innerHTML = msgOk;
        emailValido = true;

    }

});

// Eventos do campo SENHA
senha.addEventListener("blur", verificaSubmit);
senha.addEventListener("input", function(){

    if(senha.value.length < 8){
        avisoSenha.innerHTML = "Tamanho mínimo: 8 caracteres.";

    }else if(senha.value != confSenha.value){
        avisoSenha.innerHTML = "Senhas não coincidem";

    }else{
        avisoSenha.innerHTML = msgOk;
        avisoConfSenha.innerHTML = msgOk;
        senhaValida = true;

    }

});

// Eventos do campo CONFIRMAR SENHA
confSenha.addEventListener("blur", verificaSubmit);
confSenha.addEventListener("input", function(){
    
    if(confSenha.value.length < 8){
        avisoConfSenha.innerHTML = "Tamanho mínimo: 8 caracteres.";

    }else if(senha.value != confSenha.value){
        avisoConfSenha.innerHTML = "Senhas não coincidem";

    }else{
        avisoSenha.innerHTML = msgOk;
        avisoConfSenha.innerHTML = msgOk;
        senhaValida = true;

    }

});