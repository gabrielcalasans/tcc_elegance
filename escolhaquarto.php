<!DOCTYPE html>
<html>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


		<?php

		date_default_timezone_set('America/Sao_paulo');
		include 'conn.php';
		include 'checarlogin.php';
		include 'disponibilidade.php';



/*
		$contador = 0;
		$consultacheckout = "SELECT dt_checkout FROM tb_reserva ORDER BY dt_checkout DESC LIMIT 1";
		$resulcheckout = $mysqli->query($consultacheckout);
		while($lastcheck = $resulcheckout->fetch_object())
			{
				$lastcheckout = $lastcheck->dt_checkout;
			}

			$dataatual = date('Y-m-d');
			$data1 = new datetime($lastcheckout);
			$data2 = new datetime($dataatual);
			while($data1<=$data2)
				{
					$datacheckout = $data1;
					$consultagaragem = "SELECT sum(nr_garagem) as totaldia FROM tb_reserva WHERE dt_checkout = '$datacheckout'";
					$querygaragem = $mysqli->query($consultagaragem);
					if($querygaragem->num_rows>0)
						{
							while($linhagaragem = $querygaragem->fetch_object())
							{
								$vagasnagaragem+=$linhagaragem->totaldia;
							}
						}					
					$data1->modify('+1 day');
				}		

			
			echo '<br>'.$contador.'<br>';

		possibilidades de sucesso
			------------------------
				$consultagaragem = "SELECT count(nr_garagem) as qtdeocupada
							FROM tb_reserva
							WHERE 
							nr_garagem = 0
							AND
							dt_checkout >= '$lastcheckout'
							AND
							dt_checkout <= '$dataatual'";
		echo '<br>'.$consultagaragem.'<br>';
		$resulvagas = $mysqli->query($consultagaragem);
		while($resul = $resulvagas->fetch_object())
			{
				$vagas = $resul->qtdeocupada;
				echo $vagas;
			}

		?>



        $dataatual = date('Y-m-d');
			$data1 = new datetime($lastcheckout);
			$data2 = new datetime($dataatual);
			while($data1<=$data2)
				{
					$consultagaragem = "SELECT sum(nr_garagem) as totaldia FROM tb_reserva WHERE dt_checkout = $data2";
					$querygaragem = $mysqli->query($consultagaragem);
					if($querygaragem->num_rows>0)
						{
							while($linhagaragem = $querygaragem->fetch_object())
							{
								$vagasnagaragem+=$linhagaragem->totaldia;
							}
						}					
					$data1->modify('+1 day');
				}
				------------------------



*/
		?>
		

<head>
	<title>Escolher Acomodações</title>
</head>
<body>
	<form method="POST">
		<div id="data">
			Check in:  <input type="date" name="checkin"><p>
			Check out: <input type="date" name="checkout"><p>
			<a id="proximo">Próximo</a>
		</div>
		<div id="tipodequarto">
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
			<p>
			<h3>Quartos:</h3>
				<?php
					if(isset($_GET['id'])){
						if($_GET['id']!=null)
						{
							$codtipo=$_GET['id'];
							$sql = "SELECT * FROM tb_quarto WHERE id_tipo=\"$codtipo\" AND id_status = 1 ";
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
							$sql = "SELECT * FROM tb_quarto WHERE id_status = 1";
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
		<a id="voltar">Voltar</a> <a id="proximo2">Próximo</a>
 
		</div>
	<div id="garagemcampo">
		<h2>Deseja reservar um espaço na garagem?</h2>
		<!-- Realizar consulta na tabela para saber quantas vagas estão disponíveis
			Comparar vagas disponíveis com o número colocado
		-->
		Sim<input type="radio" value="1" required id="sim" name="garagem">
		Não<input type="radio" value="2" required id="nao" name="garagem">
		<p>
		<span id="garagemsim">
			Vagas disponíveis:<br>
			Quantidade de vagas: <input type="number" name="nrvagas"> 
		</span>
		<p>
			<a id="voltar2">Voltar</a>
		<p>
		<span id="confirmar">
			<input type="submit" value="Efetuar reserva" name="">
		</span>
		<br>
		

	</div>
	<p>	
<p>
		
	</form>

</body>
<script>
	$(document).ready(function(){


			$("#tipodequarto").hide();
			$('#garagemcampo').hide();
			$('#garagemsim').hide();
			$('#confirmar').hide();
			$('#proximo').click(function(){
				$('#data').hide();
				$('#tipodequarto').fadeIn();

			});
			$('#voltar').click(function(){
				$('#tipodequarto').hide();
				$('#data').fadeIn();
			});
			$('#proximo2').click(function(){
				$('#tipodequarto').hide();
				$('#garagemcampo').fadeIn();

			});
			$('#voltar2').click(function(){
				$('#garagemcampo').hide();
				$('#tipodequarto').fadeIn();
			});



			
			$("#nao").click(function(){
				$("#garagemsim").fadeOut();
				$('#confirmar').fadeIn();
			});
			$("#sim").click(function(){
				$("#garagemsim").fadeIn();
				$('#confirmar').fadeIn();

			});



			});
</script>

		<?php
		if(isset($_POST['checkin']))
		{

			if($_POST['garagem']==2)
			{
				$nrvagas = 'null';
				$sql = "INSERT INTO tb_garagem VALUES(null,'0')";
				if(!$mysqli->query($sql))
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
				}							
			}			
			else
			{
				$nrvagas = $_POST['nrvagas'];
				$sql = "INSERT INTO tb_garagem VALUES(null,'$nrvagas')";
				if(!$mysqli->query($sql))
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
				}

			}

			$sqlgaragem="SELECT * FROM tb_garagem  WHERE nr_vagas=\"$nrvagas\" ORDER BY cd_garagem DESC LIMIT 1";
			$resulsql = $mysqli->query($sqlgaragem);
			while($valor = $resulsql->fetch_object())
			{	
				$codgaragem = $valor->cd_garagem;
				echo $codgaragem;
			}
			$idcliente=$_SESSION['cliente'];
			$checkin=$_POST['checkin'];
			$checkout=$_POST['checkout'];



				if($checkin<$checkout)
				{

							$idquarto=$_POST['quarto'];
							//echo '<br>'.$checkin;
							//echo '<br>'.$checkout;
							//echo '<p>'.$idquarto.'<p>';
							$vlfinal=0;
							
							$sqlquartoexistente = "SELECT * FROM `tb_reserva` WHERE id_quarto = \"$idquarto\" ORDER BY dt_checkout DESC	LIMIT 1";
							$queryquarto = $mysqli->query($sqlquartoexistente);
							if($queryquarto->num_rows>0)
							{	
								while($linhaquarto = $queryquarto->fetch_object())
										{
											
											$checkout_banco = $linhaquarto->dt_checkout;
											if($checkin < $checkout_banco)
											{
												echo "<script>alert('Não foi possível reservar: Há um quarto já reservado nessa data');</script>";
											}

											else
											{

												date_default_timezone_set('America/Sao_paulo');
												$regdate = date('Y-m-d h:i:s a', time());
												//echo $regdate;

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
												$sql = "INSERT INTO tb_reserva VALUES(null,'$idquarto','$checkin','$checkout','$vlfinal','$idcliente','$codgaragem','$regdate')";
												if(!$mysqli->query($sql)){
													echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
												}
												else{
													$atualizarquarto = "UPDATE tb_quarto SET id_status = 2 WHERE cd_quarto =\"$idquarto\"";
													if(!$mysqli->query($atualizarquarto)){
														echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
													}
													echo "<script type='text/javascript'>alert('Reserva Efetuada!!'); window.location.href='escolhaquarto.php'; </script>";
												}
											}

									}
							}
							else
							{
												
								$regdate = date('Y-m-d H:i:s', time());
								//echo $regdate;

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
								//echo $vlfinal;
								$sql = "INSERT INTO tb_reserva VALUES(null,'$idquarto','$checkin','$checkout','$vlfinal','$idcliente','$codgaragem','$regdate')";
								if(!$mysqli->query($sql))
								{
									echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
								}
								else
								{
									$atualizarquarto = "UPDATE tb_quarto SET id_status = 2 WHERE cd_quarto =\"$idquarto\"";
													if(!$mysqli->query($atualizarquarto)){
														echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
													}
									echo "<script type='text/javascript'>alert('Reserva Efetuada!!!'); window.location.href='escolhaquarto.php'; </script>";
								}
				
							}

					}
					else
					{
						echo "<script>alert('Data inválida, o check-in está maior que o check-out');</script>";
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
