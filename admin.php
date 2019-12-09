<?php include('header.php'); ?>
	<title>Login administrador | Pousada Elegance</title>
	<style type="text/css">
		body{
				background-color: #758DA3;
			}
		 /* label focus color */
		.input-field input[type=text]:focus + label {
		    color: #283593 !important;
		}

		.input-field input[type=password]:focus + label {
		    color: #283593 !important;
		}
		/* label underline focus color */
		.input-field input[type=text]:focus {
		    border-bottom: 1px solid #283593 !important;
		    box-shadow: 0 1px 0 0 #283593 !important;
		}
		.input-field input[type=password]:focus {
		    border-bottom: 1px solid #283593 !important;
		    box-shadow: 0 1px 0 0 #283593 !important;
		}
		.icon{
            padding: 5px;
            width: 20%;
            color: yellow;
            transition: 0.4s;
        }
        .icon:hover{
            width: 22%;
        }
		#lfooter{
            color: white;
            transition: 0.4s;
        }

        #lfooter:hover{
            color: #FFCA37; 
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
	<center>
		<nav class="black darken-2">
			<div class="nav-wrapper">
				<a href="index.php"><img id="logo" src="images/logotipo2.png"></a>
			</div>			
		</nav>
		<br>
	</center>
	<?php
		include('conn.php');
		if(isset($_GET['log']) && $_GET['log'] == 0) {
            echo "<script>M.toast({html: 'Logue ao sistema para acessar a área do administrador.'});</script>";
        }
	?>
	<center>
	<b style="font-size: 24px;">ADMINISTRADOR</b>
		<div class="card-panel" style="width: 40%;">
			<div class="row">
			    <form class="col s12" method="post">
				    <div class="row">
				       	<div class="input-field col s12">
				       		<i class="material-icons prefix">person</i>
				        	<input id="login" type="text" name="login" required="">
				          	<label for="login">Login</label>
				       	</div>
				    </div>
				   	<div class="row">
				       	<div class="input-field col s12">
				       		<i class="material-icons prefix">lock</i>
				        	<input id="senha" type="password" name="senha" required="">
				          	<label for="senha">Senha</label>
				       	</div>
				    </div>
				    <a class="btn indigo darken-3" id="logar" name="action">CONFIRMAR
  					</a>
				</form>
			</div>
	  	</div>
	</center>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
		$("#logar").click(function(){
			var loginadm = {loginadm: $("#login").val()}; 
			var senhadm = {senhadm: $("#senha").val()};
		    $.ajax({
		        type: 'POST',
		        url: 'php.php',
		        data: {'loginadm': loginadm, 'senhadm': senhadm, },
		        success: function(response){
		        	if(response == 1){
						window.location.href='painel_admin.php?log=1';
		        	}
		        	else{
		        		M.toast({html: 'Conta inexistente! Tente novamente.'});
		        	}
		        }
		    });
		});
	});
</script>
</html>
