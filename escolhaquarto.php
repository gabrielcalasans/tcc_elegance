<!DOCTYPE html>
<html>
		<?php

		include 'conn.php';
		//include 'checarlogin.php';
		
		?>

<head>
	<title>Escolher Acomodações</title>
</head>
<body>
	<form method="POST">
		
			<?php

			$sql = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($sql);
			if($tipo)
			{	
				while($linha = $tipo->fetch_object())
				{
						
					echo '<input type="radio" value= '.$linha->cd_tipo.' name="tipoquarto" id='.$linha->cd_tipo.' />
						<label for='.$linha->cd_tipo.'><img src="ddd.png" alt=""></label>';

				}
			}

			//echo '<option>'..'</option>';

			?>
	
	</form>

</body>
</html>
<style type="text/css">
	img{
		width: 10%;
	}
</style>