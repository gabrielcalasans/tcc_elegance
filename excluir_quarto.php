<meta charset="utf-8">
<?php
include('conn.php');
$codquarto=$_GET['idquarto_del'];
//
//Juntar na mesma página;
//
$deletar_quarto="DELETE FROM tb_quarto WHERE cd_quarto=\"$codquarto\"";

	if(!$mysqli->query($deletar_quarto))
	{
		echo "<script>alert('Não é possível excluir, há uma reserva ativa!!');
					  window.location.href='ver_quarto.php';
			 </script>";
	}
	else{
		echo "Excluído";	
	}





?>
