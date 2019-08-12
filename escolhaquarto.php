<!DOCTYPE html>
<html>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<?php


		include 'conn.php';
		include 'checarlogin.php';

		?>

<head>
	<title>Escolher Acomodações</title>
</head>
<body>
	<form method="POST">
			Check in<input type="date" name="checkin"><p>
			Check out<input type="date" name="checkout"><p>

			<h3>Escolha seu tipo de quarto</h3>
			<ul>
				<li><a href="escolhaquarto.php">Exibir todos os quartos</a></li>
				<?php

					$sql = "SELECT * FROM tb_tipo";
					$tipo = $mysqli->query($sql);
					if($tipo)
					{
						while($linha = $tipo->fetch_object())
						{

							echo "<li><a href='escolhaquarto.php?id=".$linha->cd_tipo."'>".$linha->nm_tipo."</a></li>";

						}
					}

					//echo '<option>'..'</option>';

				?>
			</ul>
			<p>
			<h3>Quartos:</h3>
				<?php
					if(isset($_GET['id'])){
						if($_GET['id']!=null)
						{
							$codtipo=$_GET['id'];
							$sql = "SELECT * FROM tb_quarto WHERE id_tipo=\"$codtipo\"";
							$quarto = $mysqli->query($sql);
							if($quarto)
							{
								while($row = $quarto->fetch_object())
								{
									$consultapreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo = \"$row->id_tipo\"";
									$respreco = $mysqli->query($consultapreco);
									while($resul = $respreco->fetch_object())
									{
										$valor = $resul->vl_quarto;
									}

									$consultastatus="SELECT * FROM tb_status WHERE cd_status=\"$row->id_status\"";
									$status = $mysqli->query($consultastatus);
									if($status)
									{
										while($row2 = $status->fetch_object())
										{

											$st=$row2->ds_status;

										}
									}
									echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

								}
							}
						}
					}
						else
						{
							$sql = "SELECT * FROM tb_quarto";
							$quarto = $mysqli->query($sql);
							if($quarto)
							{
								while($row = $quarto->fetch_object())
								{

									$consultapreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo = \"$row->id_tipo\"";
									$respreco = $mysqli->query($consultapreco);
									while($resul = $respreco->fetch_object())
									{
										$valor = $resul->vl_quarto;
									}

									$consultastatus="SELECT * FROM tb_status WHERE cd_status=\"$row->id_status\"";
									$status = $mysqli->query($consultastatus);
									if($status)
									{
										while($row2 = $status->fetch_object())
										{

											$st=$row2->ds_status;

										}
									}
									echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

								}
							}
						}



				?>
			<p>




		<input type="submit" name="">
	</form>

</body>

		<?php
		if(isset($_POST['checkin']))
		{

				$idcliente=$_SESSION['cliente'];
				$checkin=$_POST['checkin'];
				$checkout=$_POST['checkout'];



				if($checkin<$checkout)
				{

							$idquarto=$_POST['quarto'];
							echo '<br>'.$checkin;
							echo '<br>'.$checkout;
							echo '<p>'.$idquarto.'<p>';
							$vlfinal=0;


							date_default_timezone_set('America/Sao_paulo');
							$regdate = date('Y-m-d h:i:s a', time());
							echo $regdate;

							$data1 = new datetime($_POST['checkin']);
							$data2 = new datetime($_POST['checkout']);
							while($data1<=$data2)
							{
								$sqltipo="SELECT * FROM tb_quarto WHERE cd_quarto=\"$idquarto\"";
								$resulsql = $mysqli->query($sqltipo);
								while($valor = $resulsql->fetch_object())
								{

										$sqlpreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo=\"$valor->id_tipo\"";

										$resulsql2 = $mysqli->query($sqlpreco);
										while($dado = $resulsql2->fetch_object())
										{
											//var_dump($dado->vl_quarto);
											$vlfinal+=floatval ($dado->vl_quarto);

										}

								}

								$data1->modify('+1 day');

							}
						echo $vlfinal;
						$sql = "INSERT INTO tb_reserva VALUES(null,'$idquarto','$checkin','$checkout','$vlfinal','$idcliente','$regdate')";
						if(!$mysqli->query($sql)){
							echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
						}
						else{
							echo "<script type='text/javascript'>alert('Reserva Efetuada!!!');</script>";
						}

					}
					else
					{
						 echo 'Data inválida';
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
