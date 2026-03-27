<h1>Pesquisar livro</h1>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-– para exemplificar o uso do sweetalert -->
<form id="frm" name="frm" action="?page=salvar" method="POST" onsubmit="validarcampos(this); return false;">
  
  <div class="mb-3">
    <label>Título</label>
    <input type="text" name="descricao" id="descricao" placeholder="Digite o título do livro ou parte dele" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary" id="enviar">Pesquisar</button>
  </div>


  

<script>
  var campo = document.getElementById("descricao");

  document.getElementById("enviar").addEventListener("click", validarcampos)

  function validarcampos()
  {
    
    if(campo.value == "")
    {
        /* exemplo de uso do sweetalert.js */
        Swal.fire(
          {
            icon: 'error',
            titleText: "Informe o título do livro",
            text: '',
            showCloseButton: true,
            footer: 'Claretiano > Licenciatura Computação > Programacao para Web - Portfolio2'
          }
        );                                
        return false;
    }

    frm.submit();

  }


  </script>


</form>