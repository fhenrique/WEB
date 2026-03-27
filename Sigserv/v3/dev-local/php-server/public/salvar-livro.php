<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
	switch ($_REQUEST["acao"]) {
		case 'cadastrar':
			$ideditora = $_POST["select_editora"];
			$descricao = $_POST["descricao"];

			$sql = "INSERT INTO acervo(id_editora, titulo) VALUES('{$ideditora}','{$descricao}')";

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na inclusão, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Cadastrado com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível cadastrar.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}


			break;

		case 'editar':
			$ideditora = $_POST["select_editora"];
			$descricao = $_POST["descricao"];

			$sql = "UPDATE acervo SET 
						titulo='{$descricao}'
					WHERE 
						id=".$_REQUEST["id"];

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na edição, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Atualizado com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível atualizar.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}

			break;

		case 'excluir':
			$sql = "DELETE FROM acervo WHERE id=".$_REQUEST["id"];

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na edição, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Excluído com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível excluir.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}

			break;
	}
?>