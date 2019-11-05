<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar Acomodações | Pousada Hospedagem Elegance</title>
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
	    </style>
	</head>
	<body>
		<nav class="black darken-2">
    		<div class="nav-wrapper" align="center">
        		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      		</div>      
    	</nav>
    	<center>
    		<h1>Cadastrar Acomodações</h1>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<br><br>
    	</center>
    	<div class="container">
    		<div class="card-panel">
    			<form method="post">
    				<div class="row">
    					<div class="input-field col s6 m6">
    						<input id="numero" type="number" name="numeroquarto" required="" class="validate"><label for="numero">Número do Quarto </label>
    					</div>
    					<div class="input-field col s6 m6">
    						<select name="status" id="status">
								<option value="" disabled selected>Status</option>
								<option value="1">Disponível</option>
								<option value="2">Não disponível</option>
							</select><label for="status">Status do Quarto</label>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
	</body>
</html>