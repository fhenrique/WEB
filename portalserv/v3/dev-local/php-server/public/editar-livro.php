<h1>Editar livro</h1>
<?php

// SELECT a.id, a.titulo, b.descricao FROM acervo a INNER JOIN editora b ON a.id_editora = b.id WHERE a.id = 1;

  $sql = "SELECT a.id, a.titulo, b.descricao FROM acervo a INNER JOIN editora b ON a.id_editora = b.id WHERE a.id=".$_REQUEST['id'];
  $res = $conn->query($sql);
  $row = $res->fetch_object();
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-– para exemplificar o uso do sweetalert -->
<form id="frm" name="frm" action="?page=salvar" method="POST" onsubmit="validarcampos(this); return false;">
  <input type="hidden" name="acao" value="editar">
  <input type="hidden" name="id" value="<?php print $row->id; ?>">
  <div class="mb-3">
    <label>Descrição</label>
    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php print $row->titulo ?>">
  </div>
  <h4>Selecione a Editora</h4>
  <select name="select_editora" id="select_editora" class="form-control" required>    
    <?php
      if($res == true){
        
      }

      $sql = "SELECT * FROM editora";
      $res = $conn->query($sql);
      
      while($row = $res->fetch_object()){ ?>
        <option name="cboeditora" value="<?php echo $row->id; ?>"><?php echo $row->descricao; ?> 
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
        /* exemplo de uso do sweetalert.js */
        Swal.fire(
          {
            icon: 'error',
            titleText: "Informe o nome do livro",
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