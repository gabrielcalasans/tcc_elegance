<?php

	session_start();
	$statussessao=$_SESSION['status'];
	$statuslogin="Logado";
	if($statuslogin==$statussessao)
	{

	}
	else
	{
		header('location:login.php');
	}

?>