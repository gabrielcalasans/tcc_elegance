<?php include('header.php'); ?>
		<title>Cadastro | Pousada Hospedagem Elegance</title>
	</head>
	<body>
		<?php
			include('conn.php');
		?>
		<form method="post">
			<fieldset>
				Nome:<input type="text" name="nome"></p>
				CPF:<input type="text" name="cpf"></p>
				E-Mail:<input type="text" name="email"></p>
				Celular:<input type="text" name="celular"></p>
				Telefone:<input type="text" name="telefone"></p>
				Endereço:<input type="text" name="endereco"></p>
				N:<input type="text" name="numero"></p>
				CEP:<input type="text" name="cep"></p>
				Profissão:<input type="text" name="profissao"></p>
				N de identificação:<input type="text" name="rg"></p>
				Orgão Expeditor:<input type="text" name="orgao"></p>
				Nacionalidade:<input type="text" name="nacionalidade"></p>
				Estado:
				<select id="estado" name="estado">
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
				<select id="cidade" name="cidade">
					<option value="" disabled selected>Selecione...</option>
				</select></p>
				Bairro:<input type="text" name="bairro"></p>
				Senha<input type="text" name="senha">
				<input type="submit">
			</fieldset>
		</form>
		<script>
			$(document).ready(function(){
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
	</body>
<?php include('header.php'); ?>