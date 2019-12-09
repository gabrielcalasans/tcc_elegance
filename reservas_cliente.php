<?php include('header.php'); ?>
		<title>Área de reserva | Hospedagem Elegance</title>
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

        #foto{
            width: 50%;
            border-radius: 3px;
        }
	</style><script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	
	<body>
        <?php
            include('conn.php');
            
            if(empty($_SESSION['cliente'])){
                header('Location: login.php?log=0');
            }
            if(isset($_GET['id']) and $_GET['id'] == 0){
                session_destroy();
                header('Location: index.php');
            }    
            if(isset($_GET['res']) and $_GET['res'] == 1){
                echo "<script>M.toast({html: 'Reserva cadastrada! Aguardar confirmação do Administrador.'});</script>";
            }
        ?>
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

        <div id="reservas" class="modal modal-fixed-footer" style="width: 80%;">
            <div class="modal-content">
                <center><h4>Visualizar reservas</h4></center>
                <hr>
                <?php 
                    if(!empty($_SESSION['cliente'])){
                        $sql = "SELECT * from tb_reserva re
                        inner join tb_quarto qua on (qua.cd_quarto = re.id_quarto)
                        inner join tb_tipo tip on (tip.cd_tipo = qua.id_tipo)
                        inner join tb_cliente cli on (cli.cd_cliente = re.id_cliente)
                        inner join tb_status_reserva stre on (stre.cd_streserva = re.id_streserva)
                        where cd_cliente = ".$_SESSION['cliente']." and id_streserva <> 3
                        order by dt_checkout asc";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            $c = 0;
                            while($row = $result->fetch_object()){
                                $checkin = date_create($row->dt_checkin);
                                $checkout = date_create($row->dt_checkout);
                                if ($c > 0) {
                                    echo "<br><hr><br>";
                                }
                                echo '<p align="left"><b>Status</b>: '.$row->ds_status.'.</p>';
                                echo '<p align="left"><b>Check-in</b>: '.date_format($checkin, 'd/m/Y').'</p>';
                                echo '<p align="left"><b>Check-out</b>: '.date_format($checkout, 'd/m/Y').'</p>';
                                echo '<p align="left"><b>Quarto</b>: '.$row->nm_tipo.' <b>Nº</b>: '.$row->nr_quarto.'</p>';
                                echo '<p align="left"><b>Descrição</b>: '.$row->ds_tipo.'</p>';
                                echo '<p align="left"><b>Valor</b>: R$'.number_format($row->vl_reserva, 2, ",", ".").'</p>';
                                echo '<p align="center"><img id="foto" src="'.$row->ds_imagem.'"></p>';
                                $c++;
                            }
                        }
                       	else{
                       		echo "Nenhuma reserva efetuada até o momento.";
                       	}
                    } 
                ?>
                            
               
            </div>

            <div class="modal-footer">
     			<a href="#!" class="modal-close btn-flat">Fechar</a>
    		</div>
        </div>
		<nav class="grey darken-2">
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                	<li class="active"><a href="reservas_cliente.php" title="Área de reserva">Área de reserva</a></li>
                	<li><a href="cliente.php" title="Minha conta">Minha conta</a></li>
                    <li><a href="contato_cliente.php" title="Contato">Contato</a></li>
                	<li><a href="historico.php" title="Histórico">Histórico</a></li>
                   	<li><a class="modal-trigger" href="#sair" title="Sair">Sair</a></li>
                </ul>
            </div>
	    </nav>
		<div class="container">
	        <div class="row" style="margin-top: 120px;">
	        	<div class="card-panel col s12" style="height: 300px;">
		    	<center>
                    <h4>Área de reserva</h4>
				    <div class="col s6">
				    	<a style="color: black;" title="Criar reserva" href="criar_reserva.php"><div id="panel" class="card-panel yellow darken-3">
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
				    	<a style="color: black;" title="Visualizar reservas" class="modal-trigger" href="#reservas"><div id="panel" class="card-panel yellow darken-3">
		                    <span>
		                        <div class="center promo promo-example">
		                            <i class="large material-icons">remove_red_eye</i>
		                            <br>
		                            <p class="promo-caption">Visualizar reservas</p>  
		                        </div>
		                    </span>
		                </div></a>
				    </div>
		     	</center>
		        </div>
	        </div>
		</div>
	</body>
	
	<script>
        $(document).ready(function(){
        	$('.modal').modal();
        });	
    </script>
</html>