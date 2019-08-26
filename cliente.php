<?php include('header.php'); ?>
		<title>Cliente | Hospedagem Elegance</title>
	</head>
	<style type="text/css">
		#logo{
                width: 9%;
            }
            body{
            	background-color: #FFF7D9;
            }
            
	</style>
	<body>
		<nav class="grey darken-2">
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   <li><a href="#">Configurações</a></li>
                   <li><a href="#">Sair</a></li>
                </ul>
            </div>
	    </nav>
		<div class="container">
	        <div class="row">
	        	<div class="card-panel col s12">
		    
				    <div class="col s6">
				    	<a href="escolhaquarto.php"><div id="panel" class="card-panel yellow darken-3">
		                    <span>
		                        <div class="center promo promo-example">
		                            <i class="large material-icons">add_box</i>
		                            <br>
		                            <p class="promo-caption">Criar reserva</p>  
		                        </div>
		                    </span>
		                </div></a>
				    </div>
				    <div class="col s6">
				    	<a href="#"><div id="panel" class="card-panel yellow darken-3">
		                    <span>
		                        <div class="center promo promo-example">
		                            <i class="large material-icons">remove_red_eye</i>
		                            <br>
		                            <p class="promo-caption">Visualizar reserva</p>  
		                        </div>
		                    </span>
		                </div></a>
				    </div>
		     
		        </div>
	        </div>
		</div>
	</body>
</html>