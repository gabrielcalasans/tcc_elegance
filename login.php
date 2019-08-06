<?php include('header.php'); ?>
		<title>Login | Pousada Elegance</title>
		<style type="text/css">
			body{
				background-color: #FFF7D9;
			}

			 /* label focus color */
			.input-field input[type=text]:focus + label {
			    color: #fbc02d !important;
			}

			.input-field input[type=password]:focus + label {
			    color: #fbc02d !important;
			}
			/* label underline focus color */
			.input-field input[type=text]:focus {
			    border-bottom: 1px solid #fbc02d !important;
			    box-shadow: 0 1px 0 0 #fbc02d !important;
			}
			.input-field input[type=password]:focus {
			    border-bottom: 1px solid #fbc02d !important;
			    box-shadow: 0 1px 0 0 #fbc02d !important;
			}
		</style>
	</head>
	<body>
		<?php include('conn.php'); ?>
		<center>
			<nav class="grey darken-2">
				<div class="nav-wrapper">
					<i class="large material-icons">account_circle</i>
				</div>			
			</nav>
			<br>
			<b style="font-size: 24px;">LOGIN</b>
			<div class="card-panel" style="width: 40%;">
				<div class="row">
				    <form class="col s12" method="post">
				      	<div class="row">
				        	<div class="input-field col s12">
				          		<input id="cpf" type="text" class="validate" name="cpf" required="">
				          		<label for="cpf">CPF</label>
				        	</div>
				    	</div>
				    	<div class="row">
				        	<div class="input-field col s12">
				          		<input id="password" type="password" class="validate" name="senha" required="">
				          		<label for="password">Senha</label>
				        	</div>
				    	</div>
				    	<button class="btn waves-effect waves-light yellow darken-2" type="submit" name="action">Entrar
    						<i class="material-icons right">input</i>
  						</button>
					</form>
				</div>
	  		</div>
	  		<div class="card-panel" style="width: 40%;">
	  			Novo por aqui? <a href="cadastro.php">Crie uma conta</a>
	  		</div>
		</center>
		<?php
			if(isset($_POST['cpf']) && isset($_POST['senha'])){
				$cpf = $_POST['cpf'];
				$senha = md5($_POST['senha']);
				$sql = "SELECT * from tb_cliente where nr_cpf = '$cpf' and ds_senha = '$senha'";
				$result = $mysqli->query($sql);
				if($result->num_rows > 0){
					$row = $result->fetch_object();
					echo "Bem vindo, ".$row->nm_cliente;
				}
				else{
					echo "tente novamente.";
				}
			}
		?>
	</body>
</html>