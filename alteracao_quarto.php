<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Acomodações | Pousada Hospedagem Elegance</title>
		<?php
			include 'conn.php';
			$codquarto = $_GET['idquarto'];
			$consultaquarto = "SELECT * FROM tb_quarto WHERE cd_quarto=\"$codquarto\"";
			$execucao = $mysqli->query($consultaquarto);
			while($dados = $execucao->fetch_object()){
				$nrquarto = $dados->nr_quarto;
				$dsquarto = $dados->ds_quarto;
				$idtipo = $dados->id_tipo;
				$idstatus = $dados->id_status;
			}
		?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <style type="text/css">
	    	body{
        	background-color: #758DA3; 
		    }

		    #logo{
				width: 9%;
				transition: 0.5s;
			}

			#logo:hover{
				width: 9.5%;
			}

			.input-field input:focus + label {
			    color: #283593 !important;
			}

			.input-field input:focus {
			    border-bottom: 1px solid #283593 !important;
			    box-shadow: 0 1px 0 0 #283593 !important;
			}

			[type="radio"]:checked + span:after,
			[type="radio"].with-gap:checked + span:before,
			[type="radio"].with-gap:checked + span:after {
			  border: 2px solid #283593;
			}

			[type="radio"]:checked + span:after,
			[type="radio"].with-gap:checked + span:after {
			  background-color: #283593;
			}

			.dropdown-content li > a, .dropdown-content li > span {
				color: #283593 !important;
			}

            .input-field textarea:focus + label {
                color: #283593 !important;
            }

            .input-field textarea:focus {
                border-bottom: 1px solid #283593 !important;
                box-shadow: 0 1px 0 0 #283593 !important
            }

            @font-face {
    			font-family: "Lobster";
    			src: url("fonts/lobster/Lobster.otf") format("truetype");
    		}

    		.lobster-font{
    			font-family: "Lobster"; 
       		}
	    </style>
	</head>
	<body>
		<nav class="black darken-2">
    		<div class="nav-wrapper" align="center">
        		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      		</div>      
    	</nav>
    	<center>
    		<h1 class="lobster-font">Alterar Acomodação</h1>
    		<h4>Código do quarto: <?php echo $codquarto; ?></h4>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<br><br>
    	</center>
    	<div class="container">
    		<div class="card-panel">
    			<form method="post">
    				<div class="row">
    					<div class="input-field col s6 m6">
    						<input id="numero" type="number" name="numeroquarto" class="validate" value="<?php echo $nrquarto; ?>"><label for="numero">Número do Quarto </label>
    					</div>
    					<div class="input-field col s6 m6">
					    	<select name="status">
					      		<option value="" disabled selected></option>
					      		<?php
									$consultastatus="SELECT * FROM tb_status";
									$resultado=$mysqli->query($consultastatus);
									while($dado = $resultado->fetch_object()){
										if($dado->cd_status == $idstatus){
											echo "<option selected value=".$dado->cd_status.">".$dado->ds_status."</option>";
										}
										else{
											echo "<option value=".$dado->cd_status.">".$dado->ds_status."</option>";
										}
									}
								?>
					    	</select>
					    	<label>Status do quarto</label>
					  	</div>
    				</div>
    				<div class="row">
    					<div class="input-field col s12 m12">
    						<textarea id="digite" class="materialize-textarea" name="descricao"><?php echo $dsquarto; ?></textarea>
						    <label for="digite">Descrição do quarto</label>
    					</div>
    				</div>
    				<div class="row">
    					<?php
							$sql = "SELECT * FROM tb_tipo";
							$tipo = $mysqli->query($sql);
							if($tipo){
								while($linha = $tipo->fetch_object()){
									if($linha->cd_tipo == $idtipo){
										echo '<div class="col s4 m4">
											<label for='.$linha->cd_tipo.'>
												<div class="card">
													<div class="card-image">
														<img id="foto" src="images/x.png">
													</div>
													<div class="card-content">
														<p>'.$linha->ds_tipo.'</p>
													</div>
													<div class="card-action">
										          		<label>
													        <input name="tipoquarto" type="radio" checked id='.$linha->cd_tipo.' value='.$linha->cd_tipo.' class="with-gap" />
													    	<span style="color: black;"><b>'.$linha->nm_tipo.'</b></span>
													    </label>
										        	</div>
												</div>
											</label>
										</div>';
									}
									else{
										echo '<div class="col s4 m4">
											<label for='.$linha->cd_tipo.'>
												<div class="card">
													<div class="card-image">
														<img id="foto" src="images/x.png">
													</div>
													<div class="card-content">
														<p>'.$linha->ds_tipo.'</p>
													</div>
													<div class="card-action">
										          		<label>
													        <input name="tipoquarto" type="radio" id='.$linha->cd_tipo.' value='.$linha->cd_tipo.' class="with-gap" />
													    	<span style="color: black;"><b>'.$linha->nm_tipo.'</b></span>
													    </label>
										        	</div>
												</div>
											</label>
										</div>';
									}
								}
							}
						?>
    				</div>
    				<div class="row">
    					<div class="input-field col s12 m12">
    						<center>
	    						<button class="btn waves-effect waves-light blue" type="submit" name="enviar">Enviar
									<i class="material-icons right">send</i>
								</button>
	    						<a href="ver_quarto.php" class="waves-effect waves-light btn blue">Ver quartos</a>
    						</center>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
	</body>
	<?php
		if(isset($_POST['numeroquarto'])){
	    	$numquarto=$_POST['numeroquarto'];
	    	$statusquarto=$_POST['status'];
	   		$descricaoquarto=$_POST['descricao'];
	   		$tipodequarto = $_POST['tipoquarto'];
	        $sql = "UPDATE tb_quarto
	                SET   nr_quarto = \"$numquarto\",
	                      id_status = \"$statusquarto\",
	                      ds_quarto = \"$descricaoquarto\",
	                      id_tipo = \"$tipodequarto\"                    
	                WHERE cd_quarto = \"$codquarto\"";

	        if(!$mysqli->query($sql)){
	        	echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	        }
	        else{
	        	echo "<script type='text/javascript'>alert('Concluído'); window.location.href='alteracao_quarto.php?idquarto=".$codquarto."';</script>";
	        }
		}    
	  	//echo $_SESSION['quarto'];
	  	//header('location:pagamento.php');
	?>

	<script>
		$(document).ready(function(){
			$('select').formSelect();
		});
	</script>
</html>




