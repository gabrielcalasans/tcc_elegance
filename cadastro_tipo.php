<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	    
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

			@font-face {
    			font-family: "Lobster";
    			src: url("fonts/lobster/Lobster.otf") format("truetype");
    		}

    		.lobster-font{
    			font-family: "Lobster"; 
       		}
       		#listagem{
       			padding:15px;
       		}
 		</style>
	</head>
	<script>
		$(document).on("click","#dinheiro",function(){
	        $('.dinheiro').mask('#.##0,00', {reverse: true});
	   });
		
	</script>
	<body>
		<nav class="black darken-2">
    		<div class="nav-wrapper" align="center">
        		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      		</div>      
    	</nav>
    	<center>
    		<h1 class="lobster-font">Cadastrar Tipo de Quarto</h1>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<a href="ver_tipos.php" class="waves-effect waves-light indigo darken-3 btn">Voltar visualizar tipos <i class="material-icons right">arrow_back</i></a>
    		<br><br>
    	</center>
    	<div class="container">
    		<form method="post" enctype="multipart/form-data">
    			<div class="card-panel">
		   			<div class="row">
		   				<div class="input-field col s6 m6">
		   					<input id="nome" type="text" name="tipo" required=""><label for="nome">Nome do Tipo</label>
	 					</div>
	 					<div class="input-field col s6 m6">
		    				<label for="dinheiro">R$</label><input type="text" id="dinheiro" name="dinheiro" class="dinheiro form-control" style="display:inline-block" />
		    			</div>
	   				</div>
		    		<div class="row">
		    			<!-- <div class="input-field col s8 m8">
		    				<input id="descricao" type="text"><label for="descricao">O que o quarto contém</label>
		    			</div>
		    			<div class="col s4 m4">
		    				<br>
		    				<a  class="btn-small waves-effect waves-light blue" id="func">Adicionar à descrição<i class="material-icons right">add</i></a>
		    			</div> -->
		    		</div>
		    		<div class="row">
		    			<div class="col s12 m12">
    						<div id="listagem">Descrição:<p>
		 						<textarea id="lista" class="form-control" name="lista" rows="3"></textarea>
							</div>
    					</div>
		    		</div>
					<div class="row">
						
		    		</div>
					<div class="row">
						<div class="col s5">
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
		    			<div class="input-field col s12 m12">
		    				<center>		    					
		    					<button class="btn-small waves-effect waves-light blue" type="submit" id="enviar" name="action">Enviar<i class="material-icons right">send</i></button>
							</center>
		    			</div>
		    		</div>
		   		</div>
    		</form>
    	</div>
    	<script>
							
			
		</script>
	</body>
	<?php 

		if(isset($_POST['tipo'])){

			$nome = $_POST['tipo'];
			$descricao = $_POST['lista'];			 
			$valor=number_format($_POST['dinheiro'], 2, ',', '.');	
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