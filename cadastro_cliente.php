<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Compiled and minified CSS -->


        <!-- Compiled and minified JavaScript -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

		<title>Cadastro | Pousada Hospedagem Elegance</title>
	</head>
	<body>
		<?php
			include('conn.php');
		?>
		<form method="post">
			<fieldset>
				<legend><b>Dados pessoais</b></legend>
				Nome:<input type="text" name="nome" required=""></p>
				CPF:<input type="text" name="cpf" required=""></p>
				E-Mail:<input type="email" name="email" required=""></p>
				Celular:<input type="text" name="celular" required=""> Telefone:<input type="text" name="telefone"></p>
				RG:<input type="text" name="rg" required=""> Orgão Expeditor:<input type="text" name="orgao" required=""></p>
				Nacionalidade:<input type="text" name="nacionalidade" required=""></p>
				Data de nascimento: <input type="date" name="datanasc" required=""></p>
				Profissão:
				<select name="profissao">
					<option value="" disabled selected>Selecione...</option>
					<?php
					$sql = "SELECT * from tb_profissao order by nm_profissao asc";
						$result = $mysqli->query($sql);
						while($row = $result->fetch_object()){
							echo "<option value='".$row->cd_profissao."'>".$row->nm_profissao."</option>";
						}
					?>
				</select> Outra: <input type="text" name="profissao"></p>
			</fieldset>
			<fieldset>
				<legend><b>Endereço</b></legend>
				Endereço:<input type="text" name="endereco"> Nº:<input type="text" name="numero" required=""></p>
				CEP:<input type="text" name="cep" required=""></p>
				Estado:
				<select id="estado" name="estado" required="">
					<option>Selecione...</option>
					<?php
						$sql = "SELECT * from tb_estado order by nm_estado asc";
						$result = $mysqli->query($sql);
						while($row = $result->fetch_object()){
							echo "<option value='".$row->cd_estado."'>".$row->nm_estado."</option>";
						}
					?>
				</select></p>
				Cidade:
				<select id="cidade" name="cidade" required="">
					<option value="" disabled selected>Selecione...</option>
				</select></p>
				Bairro:<input type="text" name="bairro" required=""></p>
			</fieldset>
			<fieldset>
				<legend><b>Confirmar conta</b></legend>
				Senha: <input id="s1" type="password" name="senha" required=""><span class="senhas"></span></p>
				Confrimar senha: <input id="s2" type="password" name="senha1" required=""><span class="senhas"></span></p>
				<label for="termos">
					<input id="termos" type="checkbox" name="termos"> Li os <a href="#">termos de uso</a> e aceito todas as condições.
				</label>
			</fieldset></p>
			<input type="submit">
		</form>
		<?php
			if(isset($_POST['nome']) && isset($_POST['endereco'])){
				$nome = ucfirst($_POST['nome']);
				$nacionalidade = ucfirst($_POST['nacionalidade']);
				$cpf = $_POST['cpf'];
				$email = $_POST['email'];
				$celular = $_POST['celular'];
				$telefone = $_POST['telefone'];
				$rg = $_POST['rg'];
				$orgao = $_POST['orgao'];
				$datanasc = $_POST['datanasc'];
				$profissao = $_POST['profissao'];
				$cidade = $_POST['cidade'];
				$cep = $_POST['cep'];
				$bairro = ucfirst($_POST['bairro']);
				$estado = $_POST['estado'];
				$senha = $_POST['senha1'];
				$outra = ucfirst($_POST['outra']);
				$endereco = $_POST['endereco'];
				$numero = $_POST['numero'];
				$senha1 = $_POST['senha'];
				if(isset($_POST['termos'])){
					if($senha != $senha1){
						echo "Senhas não correspondentes digite novamente.";
					}
					else{
						$sql = "INSERT into tb_endereco values(null, '$endereco', '$numero', '$cep', '$bairro', '$cidade')";
						if(!$mysqli->query($sql)){
							echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
						}
						else{
							$sql =  "SELECT * from tb_endereco where nm_endereco = '$endereco' and nr_endereco = '$numero' and nr_cep = '$cep' and nm_bairro = '$bairro' and id_cidade = '$cidade'";
							$result = $mysqli->query($sql);
							$row = $result->fetch_object();
							$endereco = $row->cd_endereco;
							if(!empty($outra)){
								$profissao = ucfirst($outra);
								$sql = "INSERT into tb_profissao values(null, '$profissao')";
								if(!$mysqli->query($sql)){
									echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
								}
								$sql = "SELECT * from tb_profissao where nm_profissao = '$profissao'";
								$result = $mysqli->query($sql);
								$row = $result->fetch_object();
								$profissao = $row->cd_profissao;	
							}
							$datetime = now();
							$sql = "INSERT into tb_cliente values(null, '$nome', '$cpf', '$email', '$celular', '$telefone', '$rg', '$orgao', '$nacionalidade', '$datanasc', '$senha', '$datetime', '$tb_profissao', '$endereco')";
							if(!$mysqli->query($sql)){
								echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
							}
						}
					}
				}
				else{
					echo "NÃO SE ESQUEÇA DOS TERMOS";
				}
				
			}
		?>
	</body>
	<script>
		$(document).ready(function(){
			$("#s2").change(function(){
				var s1 = $("#s1").val();
				var s2 = $("#s2").val();
				if(s1 == s2){
					if(s1){
						$(".senhas").html(" <img src='images/certo.png' width='15px' height='15px' title='As senhas correspondentes'>");
					}
					else{
						$(".senhas").html(null);
					}
				}
				else{
					$(".senhas").html(" <img src='images/errado.png' width='15px' height='15px' title=''> Senhas não correspondentes.");
				}
			});
		    $("#estado").click(function(){
		        var estado = {estado: $("#estado").val()};
		        $.ajax({
		            type: 'POST',
		            url: 'php.php',
		            data: estado,
		            success: function(response){
		                $("#cidade").html(response);
		            }
		        });
		    });
			$("#cancelar").click(function(){
		    	$("#estado").val(null);
		    });
		});
	</script>
</html>