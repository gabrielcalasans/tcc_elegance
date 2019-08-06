<?php include('header.php'); ?>
	<title>Login administrador | Pousada Elegance<</title>
		<style type="text/css">
		body{
				background-color: #5C677D;
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
			.icon{
				width: 20%;
			}
		</style>
</head>
<body>
	<center>
		<nav class="black darken-2">
				<div class="nav-wrapper">
					<i class="large material-icons">account_circle</i>
				</div>			
		</nav>
	</center>
	<?php
	include('conn.php');


	if(isset($_POST['login'])){
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		
		$sql = "SELECT * FROM tb_administrador";
		$tipo = $mysqli->query($sql);
		if($tipo)
		{	
			while($linha = $tipo->fetch_object())
			{
				$administrador=$linha->nm_usuario;
				$senhaadmin=$linha->ds_senha;				
			}
		}

		if($login==$administrador && $senha==$senhaadmin)
		{
			echo "Funcionou";
		}
		else
		{
			echo "Tente novamente";
		}
	}
	?>

	<center>
	<b style="font-size: 24px;">ADMIN</b>
		<div class="card-panel" style="width: 30%;">
			<div class="row">
				<form class="col s12" method="post">
					<div class="row">
					<div class="row">
				        	<div class="input-field col s12">
				          		<input id="cpf" type="text" class="validate" name="login" required="">
				          		<label for="cpf">Login</label>
				        	</div>
				    	</div>
				    	<div class="row">
				        	<div class="input-field col s12">
				          		<input id="password" type="password" class="validate" name="senha" required="">
				          		<label for="password">Senha</label>
				        	</div>
				    	</div>
					<button class="btn waves-effect waves-light green darken-2" type="submit" name="action">CONFIRMAR</button>
				</form>
			</div>
		</div>
	</center>
</body>
<?php include('footer.php'); ?>
