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
				print "<script>alert('Livro cadastrado com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível cadastrar o livro.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}


			break;
		case 'cadastrar-editora':
			$descricao = $_POST["descricao"];

			$sql = "INSERT INTO editora(descricao) VALUES('{$descricao}')";

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na inclusão, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Editora cadastrada com sucesso.');</script>";
				print "<script>location.href='?page=novaeditora';</script>";
			}else{
				print "<script>alert('Não foi possível cadastrar a editora.');</script>";
				print "<script>location.href='?page=novaeditora';</script>";
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
				print "<script>alert('Cadastro de livro atualizado com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível atualizar o cadastro do livro.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}

			break;

		case 'editareditora':
			$descricao = $_POST["descricao"];

			$sql = "UPDATE editora SET 
						descricao='{$descricao}'
					WHERE 
						id=".$_REQUEST["id"];

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na edição, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Cadastro de editora atualizado com sucesso.');</script>";
				print "<script>location.href='?page=listareditoras';</script>";
			}else{
				print "<script>alert('Não foi possível atualizar o cadastro da editora.');</script>";
				print "<script>location.href='?page=listareditoras';</script>";
			}

			break;			

		case 'excluir':
			$sql = "DELETE FROM acervo WHERE id=".$_REQUEST["id"];

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na edição, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Título excluído com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível excluir o título.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}

			break;
		case 'excluireditora':
			$sql = "DELETE FROM editora WHERE id=".$_REQUEST["id"];

				 
			$res = $conn->query($sql);

			//informo se houve sucesso ou não na edição, mas em ambos os casos envio para a página que lista as editoras	
			if($res == true){
				print "<script>alert('Editora excluída com sucesso.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}else{
				print "<script>alert('Não foi possível excluir a editora.');</script>";
				print "<script>location.href='?page=listar';</script>";
			}

			break;			
	}
?>