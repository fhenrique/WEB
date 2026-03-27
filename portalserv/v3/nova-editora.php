<h1>Nova Editora</h1>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-– para exemplificar o uso do sweetalert -->
<form id="frm" name="frm" action="?page=salvar" method="POST" onsubmit="validarcampos(this); return false;">
  <input type="hidden" name="acao" value="cadastrar-editora">
  <div class="mb-3">
    <label>Nome</label>
    <input type="text" name="descricao" id="descricao" placeholder="Digite o nome da Editora" class="form-control">
  </div>
    <br><br>
  <div class="mb-3">
    <button type="submit" class="btn btn-primary" id="enviar">Salvar</button>
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
            titleText: "Informe o nome da editora!",
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