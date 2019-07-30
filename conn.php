<?php
	$login = "root";
	$senha = "usbw";
	$banco = "elegance";
	$endereco = "localhost";
	$mysqli = new mysqli($endereco, $login, $senha, $banco);	
	if ($mysqli->connect_errno) {
	    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$mysqli->set_charset("utf8");                                                                                                                  
?>