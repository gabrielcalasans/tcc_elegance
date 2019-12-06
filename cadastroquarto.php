<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Acomodações | Pousada Hospedagem Elegance</title>
		<?php
			include 'conn.php';
			//include 'checarlogin.php';
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
       		#cartao
       		{
       			height: 210px;
       		}
       		#footer-card
       		{
       			height: 70px;
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
    		<h1 class="lobster-font">Cadastrar Acomodações</h1>
    		<a href="ver_quarto.php" class="waves-effect waves-light indigo darken-3 btn">Ver quartos</a>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>		
    		<br><br>
    	</center>
    	<div class="container">
    		<div class="card-panel">
    			<form method="post" enctype="multipart/form-data">
    				<div class="row">
    					<div class="input-field col s6 m6">
    						<input id="numero" type="number" name="numeroquarto" class="validate"><label for="numero">Número do Quarto </label>
    					</div>
    					<div class="input-field col s6 m6">
					    	<select class="browser-default" name="status">
					      		
					      		<?php
									$consultastatus="SELECT * FROM tb_status";
									$resultado=$mysqli->query($consultastatus);
									while($dado = $resultado->fetch_object()){
										echo "<option value=".$dado->cd_status.">".$dado->ds_status."</option>";
									}
								?>
					    	</select>
					    	<label></label>
					  	</div>
    				</div>
    				<div class="row">
    					<div class="input-field col s6 m6">
    						<textarea id="digite" class="materialize-textarea" name="descricao"></textarea>
						    <label for="digite">Descrição do quarto</label>
    					</div>
    					<div class="input-field col s6 m6">
    						<label>Adicione a foto do tipo</label>
				       		<div class="file-field input-field s6 m6">
				           		<div class="btn-small waves-effect waves-light blue">
			                  		<span>Procurar fotos<i class='material-icons right'>add_to_photos</i></span>
				               		<input type="file" id="img" name="imagem" accept="image/x-png,image/gif,image/jpeg" />
			             		</div>
		                  		<div class="file-path-wrapper">
				               		<input class="file-path validate" type="text" placeholder="Carregue seu arquivo" />
				           		</div>
				       		</div>
    					</div>
    				</div>
    				<div class="row">
    					<?php
							$sql = "SELECT * FROM tb_tipo";
							$tipo = $mysqli->query($sql);
							if($tipo){
								while($linha = $tipo->fetch_object()){
									echo '<div class="col s4 m4">
										<label for='.$linha->cd_tipo.'>
											<div class="card">
												<div id="cartao" class="card-image">
													<img id="foto" src="'.$linha->ds_imagem.'">
												</div>
												<div class="card-content">
													<p>'.$linha->ds_tipo.'</p>
												</div>
												<div id="footer-card" class="card-action">
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
						?>
    				</div>
    				<div class="row">
    					<div class="input-field col s12 m12">
    						<center>
	    						<button class="btn waves-effect waves-light blue" type="submit" name="enviar">Enviar
									<i class="material-icons right">send</i>
								</button>
	    						
    						</center>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
	</body>
	<?php
		if(isset($_POST['numeroquarto'])){
			$numero=$_POST['numeroquarto'];
			if(isset($_FILES['imagem'])){
		    	$extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
		    	if($extensao = "jpeg"){
		    		
					$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
					$imagem = $diretorio.time() .".". $extensao; //define o nome do arquivo
					move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem); //efetua o upload
		    	}
		    	else{
		    		$imagem = "images/".time() . $extensao; //define o nome do arquivo
			    	//$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
			    	move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem); //efetua o upload
			    	
		    	} 
	    	}
    		else{
	    		$imagem = "";
	    	}
			$consultanumero="SELECT nr_quarto FROM tb_quarto WHERE nr_quarto=\"$numero\"";
			$executar=$mysqli->query($consultanumero);
			if(mysqli_num_rows($executar)>0){
				echo "<script type='text/javascript'>alert('NÚMERO DE QUARTO JÁ CADASTRADO!!');</script>";
			}			
			else{
				$status=$_POST['status'];
				$descricao=$_POST['descricao'];
				$tipo=$_POST['tipoquarto'];
				$pedido=0;
				$inserir="INSERT INTO tb_quarto VALUES(null,'$numero','$descricao','$tipo','$status','$pedido','$imagem')";
				//echo $inserir;
				if(!$mysqli->query($inserir)){
					echo "Error: " . $inserir . "<br>" . mysqli_error($mysqli);
				}
				else{
					echo "<script type='text/javascript'>alert('CADASTRADO COM SUCESSO!!');window.location.href='cadastroquarto.php';</script>";
				}
			}
		}
	?>

	<script>
		$(document).ready(function(){
			$('select').formSelect();
		});
	</script>
</html>
