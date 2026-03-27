<?php
	if(isset($_POST['submit']))
	{
		$host = "108.167.132.240";
		$usuario = "melho972_fabio";
		$senha = "senha@3762";
		$basededados = "melho972_tudoeu";
		
		$p_nome = $_POST['txtnome'];
		$p_telefone = $_POST['txttelefone'];
		$p_servico = $_POST['cboservico'];
		$p_tipocobranca = $_POST['cboTipoCobranca'];
		$p_valor = $_POST['txtvalor'];
		$p_endereco = $_POST['txtendereco'];
		$p_dias = $_POST['txtdiasdisponiveis'];
		$p_horas = $_POST['txthorariodisponivel'];
		$p_tempoexperiencia = $_POST['txttempoexperiencia'];
		$p_cidadeatende = $_POST['txtcidadesatende'];
		$p_obs = $_POST['txtobs'];
		
		$conexao = new mysqli($host,$usuario,$senha,$basededados);
		
		//if($conexao->connect_errno)
		//{
		//	echo "Erro na conexão   -   ";
		//}
		//else
		//{
		//	echo "Conexao realizada   -   " ;
		//}

		
		if($result = mysqli_query($conexao,"INSERT INTO prestadores(nome, telefone, servico, tipo_cobranca, valor, endereco, dias_disponiveis, horarios_disponiveis, tempo_experiencia, atende_cidade, obs) VALUES('$p_nome','$p_telefone','$p_servico', '$p_tipocobranca', '$p_valor', '$p_endereco','$p_dias','$p_horas','$p_tempoexperiencia','$p_cidadeatende','$p_obs')"))
		{

		function send_whatsapp($destino,$servico){
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://app.whatsgw.com.br/api/WhatsGw/Send',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>'{
			"apikey" : "b873afb6-6726-4d3e-a474-d07fb7cdaba3",
			"phone_number" : "5511987539544",
			"contact_phone_number" : "55'.$destino.'",
			"message_custom_id" : "0",
			"message_type" : "text",
			"message_body" : "👋Olá somos a Tudo Eu, seu cadastro foi realizado com sucesso e em breve entraremos em contato com você para prestar o serviço de: '.$servico.'",
			"check_status" : "0"
			}',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response;
		}

		send_whatsapp($p_telefone,$p_servico);			
			
			sleep(15);
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
			Tudo Eu!
		</title>	
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
			<style>
				select {
					font-size: 15px;
					width: 350px;
					height: 50x;
				}
				select:focus {
					min-width: 350px;
					width: 345px;
				}
			</style>
			
			<style>
				cboTipoCobranca {
					font-size: 15px;
					width: 345px;
					height: 50x;
				}
				select:focus {
					min-width: 100px;
					width: 345px;
				}
			</style>			

			<style>
				input[type='txtvalor'] { font-size: 15px; width: 150px;}
			</style>			
			
			<style>
				input[type='Text'] { font-size: 15px; width: 345px;}
			</style>			

			<style>
				input[type='Number'] { font-size: 15px; width: 345px;}
			</style>
			<style>
				input[type='Date'] { font-size: 15px;}
			</style>
			<style>
				input[type='Time'] { font-size: 15px; }
			</style>
			<style>
				input[type='submit'] { font-size: 15px; }
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
							<form action="prestador.php" method="POST">
								<h1 style="font-size: 15px; text-align: center; font-family:verdana; background-color:#dee5fc;">CADASTRO DE PRESTADOR DE SERVIÇO: </h1>
								<div style="padding-left:5px; text-align: center;">	
										<div align="left" style="padding-left:15px">
											<strong "style="font-size: 15px; font-family:verdana">Nome</strong>
											<input name="txtnome" id="txtnome" type="Text" class="form-control" placeholder="Informe seu nome" required>
										</div>
										<br>
										<div align="left" style="padding-left:15px">
											<strong "style="font-size: 15px; font-family:verdana">Telefone</strong>
											<input name="txttelefone" id="txttelefone" type="Number" class="form-control" placeholder="Ex: 87980352020" required>
										</div>
										<br>										
										<div align="left" style="padding-left:15px">
											<strong "style="font-size: 15px; font-family:verdana">Serviço</strong>
										</div>										
										<div align="left" style="padding-left:15px">
											<select name="cboservico" id="cboservico" class="form-control" required>
												<option value="">Qual serviço você fornece?</option>
												<option value="baba">Babá</option>
												<option value="barbeiro">Barbeiro(a)</option>
												<option value="barista">Barista</option>
												<option value="bombeiro">Bombeiro(a)</option>
												<option value="cabelereiro">Cabelereiro(a)</option>
												<option value="chaveiro">Chaveiro(a)</option>
												<option value="churrasqueiro">Churrasqueiro(a)</option>
												<option value="detran">Consultor(a) Serviços DETRAN</option>
												<option value="cuidador">Cuidador(a) de idoso(s))</option>
												<option value="copeiro">Copeiro(a)</option> 
												<option value="cozinheiro">Cozinheiro(a)</option>
												<option value="dedetizador">Dedetizador(a)</option>
												<option value="diarista">Diarista</option>
												<option value="djay">Djay</option>
												<option value="encanador">Encanador(a)</option>
												<option value="enfermeira">Enfermeiro(a)</option>
												<option value="eletricista">Eletricista</option>
												<option value="entrega.gas">Entregador(a) de gás</option>
												<option value="entrega.gas">Faxineiro(a)</option>
												<option value="garcom">Garçom(nete)</option>
												<option value="lavador.carro">Lavador(a) de carros</option>
												<option value="lpz.caixa.agua">Limpeza de caixas d'agua</option>
												<option value="lpz.quintal">Limpeza de quintais</option>
												<option value="lpz.terreno">Limpeza de terrenos</option>
												<option value="marceneiro">Marceneiro(a)</option>
												<option value="marido.aluguel">Marido de aluguel</option>
												<option value="manicure">Manicure</option>
												<option value="maoepe">Manicure/Pedicure</option>
												<option value="maquiador">Maquiador(a)</option>
												<option value="massagista">Massagista</option>
												<option value="mecanico">Mecânico(a)</option>
												<option value="motorista">Motorista</option>
												<option value="motoboy">Motoboy</option>
												<option value="musico">Músico de bar/festas</option>
												<option value="passeador.pet">Passeador de cães</option>
												<option value="pedreiro">Pedreiro(a)</option>
												<option value="pedicure">Pedicure</option>
												<option value="pintor">Pintor(a)</option>
												<option value="aux.pintor">Aux. de Pintor(a)</option>
												<option value="serralheiro">Serralheiro(a)</option>
												<option value="design.sobrancelha">Designer de Sobrancelha</option>
												<option value="tec.enfermagem">Técnico(a) em Enfermagem</option>
												<option value="tec.informatica">Técnico(a) em Informática</option>
												<option value="tec.prim.socorros">Técnico(a) em Primeiros Socorros</option>
												<option value="troca.oleo">Troca de óleo em domicílio</option>
												<option value="vigia">Vigilante</option>
												<option value="vigia">Segurança para evento(s)</option>
												<option value="bateria">Socorro veicular(Bateria)</option>
												<option value="bateria">Socorro veicular(Reboque/Guincho)</option>
												<option value="bateria">Socorro veicular(Mecânica)</option>
											</select>										
										</div>
										<div align="left" style="padding-left:15px">
											<br>
											<div>
												<strong "style="font-size: 15px; font-family:verdana">Tipo de cobrança</strong>
												<strong "style="font-size: 15px; font-family:verdana" style="padding-left:60px">Valor</strong>
											</div>
											<select name="cboTipoCobranca" id="cboTipoCobranca" class="form-control" style="max-width:50%;" required>
												<option value="porhora">Por hora</option>										
												<option value="pordia">Por diária</option>
												<option value="porempreitada">Por empreitada</option>
											</select>
											<input name="txtvalor" id="txtvalor" type="txtvalor" class="form-control" placeholder="A combinar..." required>
											
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Endereço</strong>
												<input name="txtendereco" id="txtendereco" type="Text" class="form-control" placeholder="Informe seu endereço" required>											
											</div>											
											
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Dias disponíveis</strong>
												<input name="txtdiasdisponiveis" id="txtdiasdisponiveis" type="Text" class="form-control" placeholder="Ex: segunda a sexta" required>
											</div>											
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Horário disponivel</strong>
												<input name="txthorariodisponivel" id="txthorariodisponivel" type="Text" class="form-control" placeholder="Ex: das 08 as 18:00" required>
											</div>																						
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Tempo de experiência</strong>
												<input name="txttempoexperiencia" id="txttempoexperiencia" type="Text" class="form-control" placeholder="Ex: 6 meses, 1 ano, 2 anos..." required>
											</div>
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Cidade(s) que você atende</strong>
												<input name="txtcidadesatende" id="txtcidadesatende" type="Text" class="form-control" placeholder="Ex: Garanhuns,..." required>
											</div>											
											<div>
												<br>
												<strong "style="font-size: 15px; font-family:verdana">Observações</strong>
												<input name="txtobs" id="txtobs" type="Text" class="form-control" placeholder="Caso haja alguma observação, informe aqui">
											</div>
											<br>
											<div align="left">
												<input type="submit" name="submit"id="enviar" style="height: 40px; width: 115px;" value="Cadastrar!" >
												<script>

													var campo1 = document.getElementById("txtnome");
													var campo2 = document.getElementById("txttelefone");
													var campo3 = document.getElementById("txtvalor");
													var campo4 = document.getElementById("txtendereco");
													var campo5 = document.getElementById("txtdiasdisponiveis");
													var campo6 = document.getElementById("txthorariodisponivel");
													var campo7 = document.getElementById("txttempoexperiencia");
													var campo8 = document.getElementById("txtcidadesatende");

													document.getElementById("enviar").addEventListener("click", exibemensagem)
													function exibemensagem()
													{
														if(campo1.value == ""){
															return;
														}			
														
														if(campo2.value == "" || campo3.value == "" || campo4.value == "" || campo5.value == "" || campo6.value == "" || campo7.value == "" || campo8.value == "") {
															return;
														}			

														Swal.fire(
														{
															icon: 'success',
															titleText: "Você está cadastrado no APP Tudo Eu! Agora podemos lhe acionar através do telefone informado para prestar seu serviço!",
															text: '',
															showCloseButton: true
														}
														);
													}
												</script>												
											</div>											
										</div>																		
								</div>

								<table align="center">
									<tr align="center">
											<div style="padding-left:215px">
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
									</tr>	
								</table>
							</form>							
						</td>												
					</tr>
				</table>				
			</div>
		</body>
</html>