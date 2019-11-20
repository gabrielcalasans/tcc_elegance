<?php include('header.php'); ?>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
		<title>Login | Pousada Elegance</title>
		<style type="text/css">
			body{
				background-color: #FFF7D9;
			}

			 /* label focus color */
			.input-field input[type=text]:focus + label {
			    color: #fbc02d !important;
			}

			.input-field input[type=password]:focus + label {
			    color: #fbc02d !important;
			}
			/* label underline focus color */
			.input-field input[type=text]:focus {
			    border-bottom: 1px solid #fbc02d !important;
			    box-shadow: 0 1px 0 0 #fbc02d !important;
			}
			.input-field input[type=password]:focus {
			    border-bottom: 1px solid #fbc02d !important;
			    box-shadow: 0 1px 0 0 #fbc02d !important;
			}

			#logo{
				width: 9%;
				transition: 0.5s;
			}

			#logo:hover{
				width: 9.5%;
			}
		</style>
	</head>
	<body>
		<?php
			include('conn.php');
			if(!empty($_SESSION['cliente'])){
				header('Location: index.php');
			}
			if(isset($_GET['log']) && $_GET['log'] == 0) {
                echo "<script>M.toast({html: 'Logue ao sistema para acessar a área do cliente.'});</script>";
            }
		?>
		<center>
			<nav class="grey darken-2">
				<div class="nav-wrapper">
					<a href="index.php"><img id="logo" src="images/logotipo2.png"></a>
				</div>			
			</nav>
			<br>
			<b style="font-size: 24px;">LOGIN</b>
			<div class="card-panel" style="width: 40%;">
				<div class="row">
				    <form class="col s12" method="post">
				      	<div class="row">
				        	<div class="input-field col s12">
				        		<i class="material-icons prefix">credit_card</i>
				          		<input id="cpf" type="text" name="cpf" required="">
				          		<label for="cpf">CPF</label>
				        	</div>
				    	</div>
				    	<div class="row">
				        	<div class="input-field col s12">
				        		<i class="material-icons prefix">lock</i>
				          		<input id="senha" type="password" name="senha" required="">
				          		<label for="senha">Senha</label>
				        	</div>
				    	</div>
				    	<a class="btn yellow darken-2" id="logar" name="action">Entrar
    						<i class="material-icons right">input</i>
  						</a>
					</form>
				</div>
	  		</div>
	  		<div class="card-panel" style="width: 40%;">
	  			Novo por aqui? <a href="cadastro.php">Crie uma conta</a>
	  		</div>
		</center>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#cpf").mask("999.999.999-99");
			$("#logar").click(function(){
				var verisenha = {verisenha: $("#senha").val()}; 
				var vericpf = {vericpf: $("#cpf").cleanVal()};
			        $.ajax({
			            type: 'POST',
			            url: 'php.php',
			            data: {'vericpf': vericpf, 'verisenha': verisenha, },
			            success: function(response){
			            	if(response == 1){
								window.location.href='index.php?logado=1';
			            	}
			            	else{
			            		M.toast({html: 'Usuário não existente! Tente novamente.'});
			            	}
			            }
		        	});
			});
		});
	</script>
</html>