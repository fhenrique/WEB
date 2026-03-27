<h1>Editar Editora</h1>
<?php

  $sql = "SELECT id, descricao FROM editora WHERE id=".$_REQUEST['id'];
  $res = $conn->query($sql);
  $row = $res->fetch_object();
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-– professor, este é um exemplo de uso do sweetalert -->
<form id="frm" name="frm" action="?page=salvar" method="POST" onsubmit="validarcampos(this); return false;">
  <input type="hidden" name="acao" value="editareditora">
  <input type="hidden" name="id" value="<?php print $row->id; ?>">
  <div class="mb-3">
    <label>Descrição</label>
    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php print $row->descricao ?>">
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
            titleText: "Informe o nome da editora",
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