<!DOCTYPE html>
<html>
<meta charset="utf-8">
		<?php


		include 'conn.php';
		//include 'checarlogin.php';

		?>

<head>
	<title>Cadastrar Acomodações | Pousada Hospedagem Elegance</title>

</head>
<body>
	<form method="POST">

			Número do Quarto: <input type="number" name="numeroquarto"><p>
			Status do Quarto: <select name="status">

				<?php

				$consultastatus="SELECT * FROM tb_status";
				$resultado=$mysqli->query($consultastatus);
				while($dado = $resultado->fetch_object())
					{

						echo "<option value=".$dado->cd_status.">".$dado->ds_status."</option>";

					}


				?>


			</select>
			Descrição do Quarto: <textarea name="descricao"></textarea>

			<?php

			$sql = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($sql);
			if($tipo)
			{
				while($linha = $tipo->fetch_object())
				{

					echo '<label for='.$linha->cd_tipo.'><fieldset><img src="images/errado.png" alt=""><input type="radio" value= '.$linha->cd_tipo.' name="tipoquarto" id='.$linha->cd_tipo.' /><fieldset>'.$linha->nm_tipo.'<br><ul>'.$linha->ds_tipo.'</ul></fieldset></fieldset></label>';

				}
			}

			//echo '<option>'..'</option>';

			?><p>
		<input type="submit" name="enviar"><a href="ver_quarto.php">Ver quartos</a>
	</form>

</body>

	<?php
	if(isset($_POST['numeroquarto']))
	{

		$numero=$_POST['numeroquarto'];
			$consultanumero="SELECT nr_quarto FROM tb_quarto WHERE nr_quarto=\"$numero\"";
			$executar=$mysqli->query($consultanumero);
			if(mysqli_num_rows($executar)>0)
			{
				echo "<script type='text/javascript'>alert('NÚMERO DE QUARTO JÁ CADASTRADO!!');</script>";
			}
			else
			{
				$status=$_POST['status'];
				$descricao=$_POST['descricao'];
				$tipo=$_POST['tipoquarto'];
				$pedido=0;
				$inserir="INSERT INTO tb_quarto VALUES(null,'$numero','$descricao','$tipo','$status','$pedido')";
				//echo $inserir;
				if(!$mysqli->query($inserir)){
						echo "Error: " . $inserir . "<br>" . mysqli_error($mysqli);
					}
				else
				{
					echo "<script type='text/javascript'>alert('QUARTO CADASTRADO COM SUCESSO!!');window.location.href='cadastroquarto.php';</script>";
				}

			}


	}
	?>

</html>
<style type="text/css">
	img{
		width: 10%;
	}
	fieldset
	{
		width: 45%;
		float:left;
	}


</style>
