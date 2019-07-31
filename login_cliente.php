<?php include('header.php'); ?>
		<title>Login | Pousada Hospedagem Elegance</title>
	</head>
	<?php include('conn.php'); ?>
	<body>
		<form method="post">
			<fieldset>
				<legend align="center">Login</legend>
				<b>CPF:</b><input type="text" name="cpf" required="">
				<b>Senha:</b><input type="password" name="senha" required="">
				<input type="submit" value="Entrar">
			</fieldset>
		</form>
	</body>
	<?php
		if(isset($_POST['cpf']) && isset($_POST['senha'])){
			$cpf = $_POST['cpf'];
			$senha = $_POST['senha'];
			$sql = "SELECT * from tb_cliente where nr_cpf = '$cpf' and ds_senha = '$senha'";
			$result = $mysqli->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_object();
					
			}
			else{
				
			}
		}
	?>
<?php include('footer.php'); ?>