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
					    	<select>
					      		<option value="" disabled selected></option>
					      		<option value="1">Disponível</option>
					      		<option value="2">Não disponível</option>
					    	</select>
					    	<label>Status do quarto</label>
					  	</div>
    				</div>
    				<div class="row">
    					<div class="input-field col s12 m12">
    						<textarea id="digite" class="materialize-textarea" name="descricao" required="" data-length="200" maxlength="200"></textarea>
						    <label for="digite">Descrição do quarto</label>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col s4 m4">
    						<label for="1">
						    	<div class="card">
						    		<div class="card-image">
						          		<img id="foto" src="images/x.png">
						        	</div>
						        	<div class="card-content">
						          		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ante ante, bibendum nec turpis tristique, fringilla luctus tellus.</p>
						        	</div>
						        	<div class="card-action">
						          		<label>
									        <input name="tipoquarto" type="radio" id="1" />
									    	<span>Tipo</span>
									    </label>
						        	</div>
						      	</div>
					      	</label>
					    </div>
					    <div class="col s4 m4">
    						<label for="2">
						    	<div class="card">
						    		<div class="card-image">
						          		<img id="foto" src="images/x.png">
						        	</div>
						        	<div class="card-content">
						          		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ante ante, bibendum nec turpis tristique, fringilla luctus tellus.</p>
						        	</div>
						        	<div class="card-action">
						          		<label>
									        <input name="tipoquarto" type="radio" id="2" />
									    	<span>Tipo</span>
									    </label>
						        	</div>
						      	</div>
					      	</label>
					    </div>
					    <div class="col s4 m4">
    						<label for="3">
						    	<div class="card">
						    		<div class="card-image">
						          		<img id="foto" src="images/x.png">
						        	</div>
						        	<div class="card-content">
						          		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ante ante, bibendum nec turpis tristique, fringilla luctus tellus.</p>
						        	</div>
						        	<div class="card-action">
						          		<label>
									        <input name="tipoquarto" type="radio" id="3" />
									    	<span>Tipo</span>
									    </label>
						        	</div>
						      	</div>
					      	</label>
					    </div>
    				</div>
    			</form>
    		</div>
    	</div>
    	<script>
			$(document).ready(function(){
			    $('select').formSelect();
			});
		</script>
	</body>
</html>