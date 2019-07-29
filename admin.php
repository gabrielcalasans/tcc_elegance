<!DOCTYPE html>
<html>
<head>
	<title>Login Administrador</title>
</head>
<body>
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
	<form method="post">
		Login:<input type="text" name="login"></p>
		Senha:<input type="text" name="senha">
		<input type="submit">
	</form>

</body>
</html>