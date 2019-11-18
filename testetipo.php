<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>Cadastrar tipos de quarto | Elegance</title>
		<?php
			include('conn.php');
	  		date_default_timezone_set('America/Sao_paulo');
 		?>
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

			/* label focus color */
            .input-field input:focus + label {
                color: #283593 !important;
            }

            /* label underline focus color */
            .input-field input:focus {
                border-bottom: 1px solid #283593 !important;
                box-shadow: 0 1px 0 0 #283593 !important;
            }

            #lista{
				width: 100%;
				height: 90.5%;
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
    		<h1>Cadastrar Tipo de Quarto</h1>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<br><br>
    	</center>
    	<div class="container">
    		<form method="post" enctype="multipart/form-data">
    			<div class="row">
    				<div class="col s8 m8">
    					<div class="card-panel">
		    				<div class="row">
		    					<div class="input-field col s12 m12">
		    						<input id="nome" type="text" name="tipo" required=""><label for="nome">Nome do Tipo</label>
		    					</div>
		    				</div>
		    				<div class="row">
		    					<div class="input-field col s8 m8">
		    						<input id="descricao" type="text"><label for="descricao">O que o quarto contém</label>
		    					</div>
		    					<div class="col s4 m4">
		    						<br>
		    						<a  class="btn-small waves-effect waves-light blue" id="func">Adicionar à descrição<i class="material-icons right">add</i></a>
		    					</div>
		    				</div>
		    				<div class="row">
		    					<div class="input-field col s12 m12">
		    						<input id="dinheiro" type="number" name="dinheiro" required=""><label for="dinheiro">Valor do Quarto</label>
		    					</div>
		    				</div>
		    				<div class="row">
		    					<label>Adicione a foto do tipo</label>
			            		<div class="file-field input-field s12 m12">
			                		<div class="btn-small waves-effect waves-light blue">
			                    		<span>Procurar fotos<i class='material-icons right'>add_to_photos</i></span>
			                    		<input type="file" id="img" name="imagem" accept="image/x-png,image/gif,image/jpeg" />
			                  		</div>
			                  		<div class="file-path-wrapper">
			                    		<input class="file-path validate" type="text" placeholder="Carregue seu arquivo" />
			                  		</div>
			               		</div>
		    				</div>
		    				<div class="row">
		    					<div class="input-field col s12 m12">
		    						<center>
		    							<a href="ver_tipos.php" class="btn-small waves-effect waves-light blue">Voltar <i class="material-icons right">arrow_back</i></a>
		    							<button class="btn-small waves-effect waves-light blue" type="submit" id="enviar" name="action">Enviar<i class="material-icons right">send</i></button>
		    						</center>
		    					</div>
		    				</div>
		    			</div>
    				</div>
    				<div class="col s4 m4">
    					<fieldset class="card" id="listagem">Descrição:<br><br>
		 					<textarea id="lista" class="form-control" name="lista" disabled rows="3"></textarea>
		 				</fieldset>
    				</div>
    			</div>
    		</form>
    	</div>
    	<script>
			$(document).ready(function(){
				$('#func').click(function(){
					$('#lista').append('• '+$('#descricao').val()+'<br> ' );	
					$('#descricao').val('');				
				});	
				$('#enviar').click(function(){
					$('#lista').removeAttr('disabled');
				})
			});
		</script>
	</body>
	<?php 
		if(isset($_POST['tipo'])){
			$nome = $_POST['tipo'];
			$descricao = $_POST['lista'];
			$valor = $_POST['dinheiro'];	
			if(isset($_FILES['imagem'])){
		    	$extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
		    	if($extensao = "jpeg"){
		    		$imagem = time() .".". $extensao; //define o nome do arquivo
					$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
					move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload
		    	}
		    	else{
		    		$imagem = time() . $extensao; //define o nome do arquivo
			    	$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
			    	move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload
		    	} 
	    	}
    		else{
	    		$imagem = "";
	    	}
			$sql = "INSERT into tb_tipo VALUES(null,'$nome','$descricao','$valor','$imagem')";
			if(!$mysqli->query($sql)){
				echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
			}
			else{
				echo "<script>alert('Cadastrado com sucesso!');</script>";
				echo "<script>window.location.replace('cadastro_tipo.php');</script>";
			}
		}
	?>
</html>