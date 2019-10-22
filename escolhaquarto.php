<?php include('header.php'); ?>
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
	<nav class="grey darken-2">
			<ul id="dropdown1" class="drop dropdown-content">
                <li><a href="cliente.php">Minha conta</a></li>
                <li class="divider"></li>
                <li><a href="index.php?id=0">Sair</a></li>
            </ul>
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   <li><a href="">Configurações</a></li>
                   <li><a href="cliente.php?id=0">Sair</a></li>
                </ul>
            </div>
	</nav>
	<form method="POST">
		<div class="container">
			<div class="card-panel col s12" id="painel" style="width: 50%">
				<div id="data">
					Check in:  <input type="date" id="entrada" name="checkin"><p>
					Check out: <input type="date" id="saida" name="checkout"><p>
					<span id="msgdata"></span><p>
					<a class="waves-effect waves-light btn" id="proximo">Próximo</a>
				</div>
			</div>
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
									echo '<label for='.$row->cd_quarto.'><div class="card-panel" id="panel"><input type="radio" class="with-gap" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><span></span>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></div></label>';

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
									echo '<label for='.$row->cd_quarto.'><div class="card-panel" id="panel"><input type="radio" class="with-gap" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><span></span>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></div></label>';

								}
							}
						}



				?>
			<p>
		<a class="waves-effect waves-light btn" id="voltar">Voltar</a> <a class="waves-effect waves-light btn" id="proximo2">Próximo</a>
 
		</div>
	<div id="garagemcampo">
		<h2>Deseja reservar um espaço na garagem?</h2>
		<!-- Realizar consulta na tabela para saber quantas vagas estão disponíveis
			Comparar vagas disponíveis com o número colocado
		-->
		<a id="sim" class="btn">Sim</a>
		<a id="nao" class="btn">Não</a>
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
			var entradaArmazenada = localStorage.entrada;
			var saidaArmazenada = localStorage.saida;
			$('#entrada').val(entradaArmazenada);
			$('#saida').val(saidaArmazenada);
			var a = $('#entrada').val();
			var b = $('#saida').val();
			if(b!="" && a!="")
				{
					$('#proximo').hide();

				}
				else
				{
					$('#proximo').fadeIn();					
					localStorage.setItem('entrada',a);
					localStorage.setItem('saida',b);
				}


			$("#tipodequarto").hide();
			$('#garagemcampo').hide();
			$('#garagemsim').hide();
			$('#confirmar').hide();
			$('#proximo').click(function(){
				$('#tipodequarto').fadeIn();
				$('#proximo').hide();

			});
			$('#voltar').click(function(){
				$('#tipodequarto').hide();
				$('#data').fadeIn();
			});
			$('#proximo2').click(function(){
				$('#painel').hide();
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

			$(document).on('change','#saida',function(){
				var a = $('#entrada').val();
				var b = $('#saida').val();

				if(b<a)
				{
					console.log('data inválida');
					$('#saida').css('background-color','#ffebee');
					$('#entrada').css('background-color','#ffebee');
					$('#proximo').hide();
					M.toast({html: 'Data inválida!'});
					$('#tipodequarto').fadeOut();

				}
				else
				{
					$('#proximo').fadeIn();
					$('#saida').css('background-color','#e8f5e9');
					$('#entrada').css('background-color','#e8f5e9');
					M.toast({html: 'Data válida!'});
					localStorage.setItem('entrada',a);
					localStorage.setItem('saida',b);
				}


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
	body{
		background-color: #FFF7D9;
	}
	#logo{
	    width: 9%;
    }
    #panel{
    	width: 40%;
    }
</style>
