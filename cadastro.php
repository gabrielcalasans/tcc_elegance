<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title>Cadastro | Pousada Hospedagem Elegance</title>
		<style type="text/css">
			body{
				background-color: #FFF7D9; 
			}
			#logo{
				width: 8%;
				transition: 0.5s;
			}

			#logo:hover{
				width: 8.5%;
			}

			 /* label focus color */
			.input-field input:focus + label {
			    color: #fbc02d !important;
			}
			.input-field input:focus {
			    border-bottom: 1px solid #fbc02d !important;
			    box-shadow: 0 1px 0 0 #fbc02d !important;
			}
			
		</style>
	</head>
	<body>
		<center>
		<nav class="grey darken-2">
			<div class="nav-wrapper">
				<a href="index.php"><img id="logo" src="images/logotipo2.png"></a>
			</div>			
		</nav>
		<?php
			include('conn.php');
			date_default_timezone_set('UTC');
		?>
		</br>
			<b style="font-size: 24px;">CADASTRO</b>
		<p>
		<form class="col s12" method="post">
			<div class="card-panel" style="width: 60%;">
				<div class="row">
					<div class="input-field col s6">
						<input id="nome" type="text" name="nome" required="" class="validate"><label for="nome">Nome</label>
					</div>
					<div class="input-field col s6">
						<input id="sobrenome" type="text" name="sobrenome" required="" class="validate"><label for="sobrenome">Sobrenome</label>
					</div>
					<div class="input-field col s12">	
						Gênero:<p>
						<?php
							$sql = "SELECT * from tb_genero";
							$result = $mysqli->query($sql);
							while($row = $result->fetch_object()){
								echo "<label for='".$row->cd_genero."'>
										<input class='with-gap' id='".$row->cd_genero."' type='radio' name='genero' value='".$row->cd_genero."'><span>".$row->nm_genero."</span>
									</label>";
							}
						?>	
				    	</p>
					</div>
					<div class="input-field col s6">	
						<input id="cpf" type="text" name="cpf" required="" class="validate"><label for="cpf">CPF</label>
					</div>
					<div class="input-field col s6">
						<input id="email" type="email" name="email" required="" class="validate"><label for="email">E-mail</label>
					</div>
					
					<div class="input-field col s6">		
						<input id="celular" type="text" name="celular" required="" class="validate"><label for="celular">Celular</label>
					</div>
					<div class="input-field col s6">
						<input id="tel" type="text" name="telefone"><label for="tel">Telefone</label>
					</div>
					<div class="input-field col s6">
						<input id="rg" type="text" name="rg" required="" class="validate"><label for="rg">RG</label>
					</div>
					<div class="input-field col s6">
						<input id="orgao" type="text" name="orgao" required="" class="validate"><label for="orgao">Orgão Expedidor</label>
					</div>
					<div class="input-field col s6">
						<input id="nacionalidade" type="text" name="nacionalidade" required="" class="validate"><label for="nacionalidade">Nacionalidade</label>
					</div>
					<div class="input-field col s6">
						<input id="data" type="text" class="datepicker" name="datanasc" required="" class="validate"><label for="data">Data de Nascimento</label>
					</div>
					<div class="input-field col s6">
						<select name="profissao">
							<option value="" disabled selected><label for="profissao">Profissão</label></option>
							<?php
								$sql = "SELECT * from tb_profissao order by nm_profissao asc";
								$result = $mysqli->query($sql);
								while($row = $result->fetch_object()){
									echo "<option value='".$row->cd_profissao."'>".$row->nm_profissao."</option>";
								}
							?>
						</select>
					</div>
						<div class="input-field col s6"> 
							<input id="outra" type="text" name="outra"><label for="outra">Outra</label></p>
					</div>
				</div>
				</div>
					<div class="card-panel" style="width: 60%;">
						<div class="row">
							<div class="input-field col s8">
								<input id="endereco" type="text" name="endereco" required="" class="validate"><label for="endereco">Endereço</label>
							</div>
							<div class="input-field col s4">
								 <input type="text" id="numero" name="numero" required="" class="validate"><label for="numero">Número</label>
							</div>
							<div class="input-field col s6">
								<select id="estado" name="estado" required="">
									<option value="" disabled selected>Estado</option>
									<?php
										$sql = "SELECT * from tb_estado order by nm_estado asc";
										$result = $mysqli->query($sql);
										while($row = $result->fetch_object()){
											echo "<option value='".$row->cd_estado."'>".$row->nm_estado."</option>";
										}
									?>
								</select>
							</div>
							<div class="input-field col s6">
								<select id="cidade" name="cidade" required="">
									<option value="" disabled selected>Cidade</option>
								</select></p>
							</div>
							<div class="input-field col s6">
								<input id="bairro" type="text" name="bairro" required="" class="validate"><label for="bairro">Bairro</label></p>
							</div>
							<div class="input-field col s6">
								<input id="cep" type="text" name="cep" required="" class="validate"><label for="cep">CEP</label></p>
							</div>
						</div>
					</div>
			<div class="card-panel" style="width: 60%;">
				<div class="row">
						<div class="input-field col s6">
							<input id="s1" type="password" name="senha" required="" class="validate"><label for="s1">Senha</label><span class="senhas"></span></p>
						</div>
						<div class="input-field col s6">
							<input id="s2" type="password" name="senha1" required="" class="validate"><label for="s2">Confirmar senha</label><span class="senhas"></span></p>
						</div>
							<label for="termos">
								<div class="input-field col s12">
									<input id="termos" type="checkbox" name="termos" required=""  class="filled-in"><span> Li os <a href="#">termos de uso</a> e aceito todas as condições.</span>
								</div>
							</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light #64dd17 light-green accent-4" type="submit" id="cadastrar" name="action">
				Cadastrar
			</button>
			<button class="btn waves-effect waves-light #ff3d00 deep-orange accent-3" type="reset" id="limpar">
				Limpar
			</button>
		</form>
		</center>
		<?php
			if(isset($_POST['nome']) && isset($_POST['endereco'])){
				$nome = ucwords($_POST['nome']);
				$nacionalidade = ucwords($_POST['nacionalidade']);
				$cpf = $_POST['cpf'];
				$email = $_POST['email'];
				$celular = $_POST['celular'];
				$telefone = $_POST['telefone'];
				$rg = $_POST['rg'];
				$datanasc = $_POST['datanasc'];
				if(isset($_POST['profissao'])){
					$profissao = $_POST['profissao'];
				}
				$cidade = $_POST['cidade'];
				$cep = $_POST['cep'];
				$orgao = $_POST['orgao'];
				$bairro = ucwords($_POST['bairro']);
				$estado = $_POST['estado'];
				$senha = md5($_POST['senha1']);
				$endereco = $_POST['endereco'];
				$numero = $_POST['numero'];
				$senha1 = md5($_POST['senha']);
				if($senha != $senha1){
					echo "Senhas não correspondentes digite novamente.";
				}
				else{
					$sql = "INSERT into tb_endereco values(null, '$endereco', '$numero', '$cep', '$bairro', '$cidade')";
					if(!$mysqli->query($sql)){
						echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
					}
					else{
						$sql =  "SELECT * from tb_endereco where nm_endereco = '$endereco' and nr_endereco = '$numero' and nr_cep = '$cep' and nm_bairro = '$bairro' and id_cidade = '$cidade' LIMIT 1";
						$result = $mysqli->query($sql);
						$row = $result->fetch_object();
						$endereco = $row->cd_endereco;
						if(!empty($_POST['outra'])){
							$profissao = ucwords($_POST['outra']);
							$sql = "INSERT into tb_profissao values(null, '$profissao')";
							if(!$mysqli->query($sql)){
								echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
							}
							else{
								$sql = "SELECT * from tb_profissao where nm_profissao = '$profissao'";
								$result = $mysqli->query($sql);
								$row = $result->fetch_object();
								$profissao = $row->cd_profissao;
							}
						}
						$datetime = date('Y-m-d H:i:s');
						$sql = "INSERT into tb_cliente values(null, '$nome', '$cpf', '$email', '$celular', '$telefone', '$rg', '$orgao', '$nacionalidade', '$datanasc', '$senha', '$datetime', '$profissao', '$endereco')";
						if(!$mysqli->query($sql)){
							echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
						}
						else{
							echo "<script type='text/javascript'>alert('Cadastro efetuado com sucesso!!!'); window.location.href='login.php';</script>";
						}
					}
				}
			}
		?>
	</body>
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker();
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
			$("#cancelar").click(function(){
		    	$("#estado").val(null);
		    });
		    $("#cpf").mask("999.999.999-99");
		    $("#cep").mask("99999-999");
		    $("#celular").mask("(99) 99999-9999");
		    $("#tel").mask("(99) 9999-9999");
		    $("#rg").mask("99.999.999-9");
		    $("#cadastrar").click(function(){
				$("#cpf").val($("#cpf").cleanVal());
				$("#cep").val($("#cep").cleanVal());
				$("#tel").val($("#tel").cleanVal());
				$("#celular").val($("#celular").cleanVal());
				$("#rg").val($("#rg").cleanVal());
			});
		});
		 $(document).on('change', '#estado', function(){
		        var estado = {estado: $("#estado").val()};
		        $.ajax({
		            type: 'POST',
		            url: 'php.php',
		            data: estado,
		            success: function(response){
		                console.log(response);
		                $("#cidade").html(response);
		                $('select').formSelect();
		            }
		        });
		    });

		  $('select').formSelect();
	</script>
</html>