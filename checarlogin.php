<?php

	//session_start();
	$statussessao=$_SESSION['status'];
	$cdcliente=$_SESSION['cliente'];
	$statuslogin="Logado";
	if($statuslogin==$statussessao)
	{
		$sql="SELECT * FROM tb_cliente WHERE cd_cliente = \"$cdcliente\"";
		$resultado = $mysqli->query($sql);
		while($dados = $resultado->fetch_object())
		{
			$nome=$dados->nm_cliente;
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('É NECESSÁRIO ESTAR LOGADO!!'); window.location.href='login.php';</script>";
		
	}

?>
