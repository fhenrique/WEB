<?php
	if(isset($_POST['submit']))
	{
		$host = "108.167.132.240";
		$usuario = "melho972_fabio";
		$senha = "senha@3762";
		$basededados = "melho972_tudoeu";
		
		$serv_tipo = $_POST['cboservico'];
		$serv_cidade = $_POST['cbocidade'];
		$serv_data = $_POST['txtdata'];
		$serv_hora = $_POST['txthora'];
		$serv_endereco = $_POST['txtendereco'];
		$serv_obs = $_POST['txtservicoobs'];
		$cl_nome = $_POST['txtclientenome'];
		$cl_telefone = $_POST['txtclientetelefone'];
		$cl_obs = $_POST['txtclienteobs'];
		$cl_notificado = "N";
		
		$conexao = new mysqli($host,$usuario,$senha,$basededados);
		
		//if($conexao->connect_errno)
		//{
		//	echo "Erro na conexão   -   ";
		//}
		//else
		//{
		//	echo "Conexao realizada   -   " ;
		//}

		
		if($result = mysqli_query($conexao,"INSERT INTO dados(srv_tipo, srv_cidade, srv_data, srv_hora, srv_endereco, srv_obs, cli_nome, cli_telefone, cli_obs, notificado) VALUES('$serv_tipo','$serv_cidade','$serv_data','$serv_hora', '$serv_endereco', '$serv_obs', '$cl_nome','$cl_telefone','$cl_obs','$cl_notificado')"))
		{
			sleep(6);
			//echo "Inseriu";
			
		}
		else
		{
			//echo "Nao inseriu";
		}
	}
?>

<!DOCTYPE html>
<html lang = "en">
<html>
	<head>
		<meta charset="utf-8">
		<title>
			Tudo Eu! Principal.php
		</title>	
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
			<style>
				select {
					font-size: 20px;
					width: 345px;
					height: 50x;
				}
				select:focus {
					min-width: 345px;
					width: 345px;
				}
			</style>

			<style>
				input[type='Text'] { font-size: 20px; width: 345px;}
			</style>

			<style>
				input[type='Number'] { font-size: 20px; width: 345px;}
			</style>
			<style>
				input[type='Date'] { font-size: 20px;}
			</style>
			<style>
				input[type='Time'] { font-size: 20px; }
			</style>
			<style>
				input[type='submit'] { font-size: 20px; }
			</style>		
	</head>
		<body style="background-color:#dee5fc;">
			<div class="box">
				<table style = "width:100%; border=0; border-collapse:collapse; background-color:#07183f;" >
					<thead>
					<tr align= "center">
						<td style="font size='25'">
							<strong style="font-size: 25px; color:#e84026; font-family:verdana;">Tudo Eu!</strong>
						</td>
					</tr>
				</table>
				
				
				<table style = "height:100%; width:100%; border=0; border-collapse:collapse; background-color:#dee5fc;" >
					<tr>
						<td>
							<form action="principal.php" method="POST" onsubmit="submitForm(event)">
								<h1 style="font-size: 15px; text-align: center; font-family:verdana; background-color:#dee5fc;">DADOS DO SERVIÇO: </h1>
								<div style="padding-left:5px; text-align: center;">	
										<div align="left" style="padding-left:20px">
											<strong "style="font-size: 15px; font-family:verdana">Tipo</strong>
										</div>
										<select name="cboservico" id="cboservico" class="form-control" required>
												<option value="">Selecione aqui o serviço</option>
												<!-- <option value="baba">Babá</option>  -->
												<!--  <option value="barbeiro">Barbeiro(a)</option>-->
												<option value="bateria">Bateria Veicular</option>
												<option value="bicas_inst">Bicas/Calhas (instalação)</option>
												<option value="bicas_limp">Bicas/Calhas (limpeza)</option>												
												<!-- <option value="bombeiro">Bombeiro(a)</option>-->
												<option value="cabelereiro">Cabelereiro(a) masculino</option>
												<option value="chaveiro">Chaveiro(a)</option>
												<option value="detran">Consultor(a) Serviços DETRAN</option>
												<!-- <option value="copeiro">Copeiro(a)</option> -->
												<!-- <option value="cozinheiro">Cozinheiro(a)</option>
												<!-- <option value="cuid.idoso">Cuidador(a) de idosos</option>-->
												<option value="dezentupidor">Desentupidor(a)</option>
												<option value="dedetizador">Dedetizador(a)</option>
												<!-- <option value="diarista">Diarista</option>-->
												<!-- <option value="djay">Djay</option>-->
												<!-- <option value="encanador">Encanador(a)</option>-->
												<option value="enfermeira">Enfermeiro(a)</option>
												<option value="eletricista">Eletricista</option>
												<option value="entrega.gas">Entregador(a) de gás</option>
												<option value="garcom">Garçom(nete)</option>
												<option value="lavador.carro">Lavador(a) de carros</option>
												<option value="lpz.caixa.agua">Limpeza de caixas d'agua</option>
												<!-- <option value="lpz.quintal">Limpeza de quintais</option>-->
												<!-- <option value="lpz.terreno">Limpeza de terrenos</option>-->
												<!-- <option value="marceneiro">Marceneiro(a)</option>-->
												<option value="marido.aluguel">Reparos domésticos</option>
												<option value="manicure">Manicure</option>
												<option value="maoepe">Manicure/Pedicure</option>
												<!-- <option value="maquiador">Maquiador(a)</option>-->
												<!-- <option value="mecanico">Mecânico(a)</option>-->
												<option value="motoboy">Motoboy</option>
												<option value="montador">Montador(a) de móveis</option>												
												<option value="musico">Músico de bar/festas</option>
												<option value="passeador.pet">Passeador de cães</option>
												<option value="pedreiro">Pedreiro(a)</option>
												<option value="pedicure">Pedicure</option>
												<option value="pintor">Pintor(a)</option>
												<option value="aux.pintor">Aux. de Pintor(a)</option>
												<!-- <option value="serralheiro">Serralheiro(a)</option>-->
												<option value="guincho">Rebocador/Guincho veículo</option>
												<!-- <option value="design.sobrancelha">Designer de Sobrancelha</option>-->
												<option value="tec.enfermagem">Técnico(a) em Enfermagem</option>
												<!-- <option value="tec.informatica">Técnico(a) em Informática</option>-->
												<option value="tec.prim.socorros">Técnico(a) em Primeiros Socorros</option>
												<option value="troca.oleo">Troca de óleo em domicílio</option>
										</select>
								</div>
								<div style="padding-left:5px; text-align: center;">	
										<div align="left" style="padding-left:20px">
											<strong "style="font-size: 15px; font-family:verdana">Cidade</strong>
										</div>
										<select name="cbocidade" id="cbocidade" class="form-control" required>
												<option value="">Lista de cidades atendidas</option>
												<option value="garanhuns">Garanhuns</option>
										</select>
								</div>								
								<div style="padding-left:5px; text-align: center;">
									<table style = "width:100%; border=0; border-collapse:collapse; background-color:#dee5fc;" >
										<tr align= "center">
											<td style="font size="15"">
												<div align="left" style="padding-left:20px">
													<br>
													<strong style="font-size: 15px; font-family:verdana;">Data</strong>
												</div>
											</td>
											<td style="font size="15"">
												<div align="left" style="padding-left:20px">
													<br>
													<strong style="font-size: 15px; font-family:verdana">Hora</strong>
												</div>
											</td>										
										</tr>
										<tr align= "center">
											<td style="font size="15"">
												<input name="txtdata" id="txtdata" value="<?php echo date('Y-m-d');?>" size="15" style="height: 30px; width: 150px;" type="Date" class="form-control" required>																	
											</td>
											<td style="font size="15"">
												<input name="txthora" id="txthora" value="00:00" size="15" style="height: 30px; width: 150px;" type="Time" class="form-control" required>																		
												<br>
											</td>
										<table align="center">
											<tr align= "center">
												<td>
													<div align="left">
														<br>
														<strong style="font-size: 15px; font-family:verdana">Endereço</strong>
													</div>
													<input name="txtendereco" id="txtendereco" type="Text" class="form-control" placeholder="Informe aqui o endereço" required>
												</td>
											</tr>
											<tr align= "center">
												<td>
													<div align="left">
														<br>
														<strong style="font-size: 15px; font-family:verdana">Observações</strong>
													</div>
													<input name="txtservicoobs" id="txtservicoobs" type="Text" class="form-control" placeholder="Informe observações caso existam">
													<br>
													<h1 style="font-size: 15px; text-align: center; font-family:verdana; background-color:#dee5fc;">DADOS DO CLIENTE: </h1>																							
												</td>
											</tr>										
											<tr align="center">
												<td>
													<div align="left">
														<strong style="font-size: 15px; font-family:verdana">Nome</strong>
													</div>
													<input name="txtclientenome" id="txtclientenome" type="Text" class="form-control" placeholder="Informe o nome do cliente" required>
												</td>
											</tr>																		
										
											<tr align="center">
												<td>
													<div align="left">
														<br>
														<strong style="font-size: 15px; font-family:verdana">Telefone</strong>
													</div>
													<input name="txtclientetelefone" id="txtclientetelefone" type="Number" class="form-control" placeholder="Ex: 87991234567" required> 
												</td>
											</tr>																											
											
											<tr align="center">
												<td>
													<div align="left">
														<br>
														<strong style="font-size: 15px; font-family:verdana">Observações</strong>
													</div>
													<input name="txtclienteobs" id="txtclienteobs" type="Text" class="form-control" placeholder="Informe observações caso existam">
													<br>
													<br>													
													<div align="left">
													<input type="submit" name="submit"id="enviar" style="height: 40px; width: 200px;" value="Orçamento rápido!" >
													</div>
													<script>

														var campo1 = document.getElementById("cboservico");
														var campo2 = document.getElementById("cbocidade");
														var campo3 = document.getElementById("txtdata");
														var campo4 = document.getElementById("txthora");
														var campo5 = document.getElementById("txtendereco");
														var campo6 = document.getElementById("txtclientenome");
														var campo7 = document.getElementById("txtclientetelefone");

														document.getElementById("enviar").addEventListener("click", exibemensagem)
														function exibemensagem()
														{
															if(campo1.value == ""){
																return;
															}			
															
															if(campo7.value.length != 11)
															{
																	Swal.fire(
																	{
																		icon: 'error',
																		titleText: "O Telefone informado está inválido, verifique! Exemplo de número válido: 87959584398",
																		text: '',
																		showCloseButton: true
																	}
																	);																
																	return;
															}																																												
															
															if(campo2.value == "" || campo3.value == "" || campo4.value == "" || campo5.value == "" || campo6.value == "" || campo7.value == "") {
																return;
															}			

															Swal.fire(
															{
																icon: 'success',
																titleText: "Solicitação enviada, em instantes lhe passaremos o orçamento através do telefone informado!",
																text: '',
																showCloseButton: true
															}
															);
														}
														
														function submitForm(event){
															if(campo7.value.length != 11)
															{
																event.preventDefault();
															}
														}																											
														
													</script>
													<div style="padding-left:220px">
														<img src="https://www.melhoresdegaranhuns.com.br/tudoeu/marca.png" width="100" height="80">
														<br>
														<br>
														<br>
														<br>
														<br>
														<br>
														<br>
														<br>
														<br>														
													</div>													
												</td>
											</tr>	
										</table>
									</table>							
									
								</div>
							</form>
						</td>												
					</tr>
				</table>				

			</div>
		</body>
</html>