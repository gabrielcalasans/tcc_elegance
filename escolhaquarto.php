<!DOCTYPE html>
<html>
<meta charset="utf-8">
		<?php


		include 'conn.php';
		//include 'checarlogin.php';
		
		?>

<head>
	<title>Escolher Acomodações</title>
</head>
<body>
	<form method="POST">
			Check in<input type="date" name="checkin"><p>
			Check out<input type="date" name="checkout"><p>

			<?php

			$sql = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($sql);
			if($tipo)
			{	
				while($linha = $tipo->fetch_object())
				{
						
					echo '<label for='.$linha->cd_tipo.'><fieldset><img src="ddd.png" alt=""><input type="radio" value= '.$linha->cd_tipo.' name="tipoquarto" id='.$linha->cd_tipo.' /><fieldset>'.$linha->nm_tipo.'<br><ul>'.$linha->ds_tipo.'</ul></fieldset></fieldset></label>';

				}
			}

			//echo '<option>'..'</option>';

			?><p>
		<input type="submit" name="">
	</form>

</body>

		<?php
		if(isset($_POST['checkin']))
		{
			session_start();
			$_SESSION['quarto']=$_POST['tipoquarto'];
			$checkin=$_POST['checkin'];
			$checkout=$_POST['checkout'];
			echo $checkin;
			echo $checkout;

			date_default_timezone_set('America/Sao_paulo');
			$data1 = new datetime($_POST['checkin']);
			$data2 = new datetime($_POST['checkout']);
			while($data1<=$data2)
			{
				
				if($data1->format('D')=="Sun" || $data1->format('D')=="Mon" || $data1->format('D')=="Sat" || $data1->format('D')=="Fri" )
				{
					echo " é mais caro<br>";
					
				}
				else
				{
					echo "Não é caro<br>";

				}
				$data1->modify('+1 day');

			}


			


			//echo $_SESSION['quarto'];
			//header('location:pagamento.php');
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