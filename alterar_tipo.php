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

			$cdtipo = $_GET['id'];
			$consultadados = "SELECT * FROM tb_tipo WHERE cd_tipo = \"$cdtipo\"";
			$dados = $mysqli->query($consultadados);
			while($linha = $dados->fetch_object()){	
				$descricao = $linha->ds_tipo;
				$nome = $linha->nm_tipo;
				$valor = $linha->vl_quarto;
				$endimagem = $linha->ds_imagem;
			}
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
 		</style>
	</head>
	<body>
		<nav class="black darken-2">
    		<div class="nav-wrapper" align="center">
        		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      		</div>      
    	</nav>
    	<center>
    		<h1 class="lobster-font">Alterar Tipo de Quarto</h1>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<a href="ver_tipos.php" class="waves-effect waves-light indigo darken-3 btn">Voltar visualizar tipos <i class="material-icons right">arrow_back</i></a>

    		<br><br>
    	</center>
    	<div class="container">
    		<form method="post" enctype="multipart/form-data">
    			<div class="card-panel">
		   			<div class="row">
		   				<div class="input-field col s6 m6">
		   					<input id="nome" type="text" name="tipo" required="" value="<?php echo $nome; ?>"><label for="nome">Nome do Tipo</label>
	 					</div>
	 					<div class="input-field col s6 m6">
		    				<label for="dinheiro">R$</label><input type="text" value="<?php echo $valor;  ?>" id="dinheiro" name="dinheiro" class="dinheiro form-control" style="display:inline-block" />
		    			</div>
	   				</div>
		    		<div class="row">		    			
		    		</div>
		    		<div class="row">
		    			<div class="col s12 m12">
    						<div id="listagem">
    							<label>Descrição:</label><br>
		 						<textarea id="lista" class="form-control" name="lista" rows="3"><?php echo $descricao; ?></textarea>
							</div>
    					</div>
		    		</div>
					<div class="row">
						
		    		</div>
					<div class="row">						
						<div class="col s6">
							<div id="foto_escolhida">
				    			<label>Adicione a foto do tipo</label>
					       		<div class="file-field input-field s6 m6">
					           		<div class="btn-small waves-effect waves-light blue">
				                  		<span>Procurar fotos<i class='material-icons right'>add_to_photos</i></span>
					               		<input type="file" value="<?php echo $endimagem; ?>" id="img" name="imagem" accept="image/x-png,image/gif,image/jpeg" />
				             		</div>
			                  		<div class="file-path-wrapper">
					               		<input class="file-path validate" value="<?php echo $endimagem; ?>" name="checar" type="text" placeholder="Carregue seu arquivo" />
					           		</div>
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
    	$(document).on("click","#dinheiro",function(){
	        $('.dinheiro').mask('#.##0,00', {reverse: true});
	   });

		</script>
	</body>
	<?php
		if(isset($_POST['tipo'])){
			$nome = $_POST['tipo'];
			$descricao = $_POST['lista'];
			$valor = $_POST['dinheiro'];
			$checar=$_POST['checar'];
			if($checar==$endimagem)
			{
				$imagem=$endimagem;
			}
			else{
				if(isset($_FILES['imagem']))
				{
			    	$extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
			    	if($extensao = "jpeg")
			    	{
			    		$imagem = time() .".". $extensao; //define o nome do arquivo
						$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
						move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload
			    	}
			    	else
			    	{
			    		$imagem = time() . $extensao; //define o nome do arquivo
				    	$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
				    	move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload
				    	$imagem = $diretorio.$imagem;
			    	}
		    	}
		    	else
		    	{
			    	$imagem = "";
			    }
			}	
			
			$sql = "UPDATE tb_tipo
					SET nm_tipo = '$nome',
					ds_tipo = '$descricao',
					vl_quarto = '$valor',
					ds_imagem = '$imagem'
					WHERE cd_tipo = '$cdtipo'";
			if(!$mysqli->query($sql)){
				echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
			}
			else{
				echo "<script>alert('Alterado com sucesso!'); window.location.href='ver_tipos.php';</script>";
			}
		}
	?>
</html>