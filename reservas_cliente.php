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
            
        #panel{
            transition: 0.4s;
            width: 80%;
        }

        #panel:hover{
            box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 40px 0 rgba(0,0,0,0.19);
        }

        .promo-caption{
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 5px;
            margin-bottom: 0;
        }
	</style>
	<?php
		include('conn.php');
		
		if(empty($_SESSION['cliente'])){
			header('Location: index.php');
		}
		if(isset($_GET['id']) and $_GET['id'] == 0){
			session_destroy();
			header('Location: index.php');
		}
	?>
	<body>
		<!-- Modal Structure -->
        <div id="sair" class="modal" style="width: 40%;">
            <div class="modal-content">
                <center><h4>Deseja sair?</h4></center>
                
                <?php 
                    if(!empty($_SESSION['cliente'])){
                        $sql = "SELECT * from tb_cliente where cd_cliente = ".$_SESSION['cliente'];
                        $result = $mysqli->query($sql);
                        $row = $result->fetch_object();
                        echo '<p align="center"><img style="width: 140px; height: 140px; border-radius: 100%; box-shadow: 5px 5px 5px rgba(0,0,0,0.3);" src="'.$row->ds_avatar.'"></p>';
                        echo '<p align="center">'.$row->nm_cliente.' '.$row->nm_sobrenome.'</p>';
                    } 
                ?>
                            
               
            </div>
            <div class="modal-footer">
              <center><a href="cliente.php?id=0" title="Sim" class="btn modal-close green accent-4">Sim</a>
              <a href="#!" title="Não" class="btn modal-close red">Não</a></center>
            </div>
        </div>
		<nav class="grey darken-2">
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                	<li class="active"><a href="reservas_cliente.php" title="Área de reserva">Área de reserva</a></li>
                	<li><a href="cliente.php" title="Minha conta">Minha conta</a></li>
                	<li><a href="#" title="Histórico">Histórico</a></li>
                   	<li><a class="modal-trigger" href="#sair" title="Sair">Sair</a></li>
                </ul>
            </div>
	    </nav>
		<div class="container">
	        <div class="row">
	        	<div class="card-panel col s12">
		    	<center>
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
		     	</center>
		        </div>
	        </div>
		</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
        $(document).ready(function(){
        	$('.modal').modal();
        });	
    </script>
</html>