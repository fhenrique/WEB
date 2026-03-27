<h1>Novo livro</h1>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-– para exemplificar o uso do sweetalert -->
<form id="frm" name="frm" action="?page=salvar" method="POST" onsubmit="validarcampos(this); return false;">
  <input type="hidden" name="acao" value="cadastrar">
  <div class="mb-3">
    <label>Título</label>
    <input type="text" name="descricao" id="descricao" placeholder="Digite o título do livro" class="form-control">
  </div>
  <h4>Selecione a Editora</h4>
  <select name="select_editora" id="select_editora" class="form-control" required>    
    <?php
      if($res == true){
        
      }

      $sql = "SELECT * FROM editora";
      $res = $conn->query($sql);
      
      while($row = $res->fetch_object()){ ?>
        <option value="<?php echo $row->id; ?>"><?php echo $row->descricao; ?> 
        </option> <?php
      }
    ?>
  </select>
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