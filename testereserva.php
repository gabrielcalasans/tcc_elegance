<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	    <link rel="shortcut icon" href="images/Logo.png" type="image/png" />
		<title>Alterar Reserva | Pousada Hospedagem Elegance</title>
		<?php
		    include('conn.php');
		    $cd_reserva = $_GET['reserva'];
		    $consultabanco = "SELECT * FROM tb_reserva WHERE cd_reserva = '$cd_reserva'";
		    $result = $mysqli->query($consultabanco);
		    while($row2 = $result->fetch_object()){                                   
		        $db_checkin = $row2->dt_checkin;
		        $db_checkout = $row2->dt_checkout;
		        $db_valor = $row2->vl_reserva;
		        $db_idquarto = $row2->id_quarto;
		            $_SESSION['codquarto']=$db_idquarto;
		        $db_garagem = $row2->id_garagem;
		    	$db_cliente = $row2->id_cliente;
		    }
		    $consultatipo = "SELECT * FROM tb_quarto WHERE cd_quarto = '$db_idquarto'";
		    $result2 = $mysqli->query($consultatipo);
		    while($row3 = $result2->fetch_object()){                                   
		    	$cd_tipo = $row3->id_tipo;
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

			@font-face {
    			font-family: "Lobster";
    			src: url("fonts/lobster/Lobster.otf") format("truetype");
    		}

    		.lobster-font{
    			font-family: "Lobster"; 
       		}

       		#listagem{
           		height:75px;
           		padding:10px;
         	}

         	#img_quarto{
           		width:35%;
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

       	</style>
	</head>
	<body>
		<nav class="black darken-2">
    		<div class="nav-wrapper" align="center">
        		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      		</div>      
    	</nav>
    	<center>
    		<h1 class="lobster-font">Alterar Reserva</h1>
    		<a href="ver_tipos.php" class="waves-effect waves-light indigo darken-3 btn">Ver reservas</a>
    		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
    		<br><br>
    	</center>
    	<div class="container">
    		<form method="post">
    			<div class="card-panel">
    				<div class="row">
    					<div class="col s6 m6">
    						Código da reserva: <?php echo $cd_reserva; ?>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col s6 m6">
    						<div class="input-field inline">
                        		<input id="checkin_inline" type="date" value="<?php echo $db_checkin; ?>" required name="entrada" class="validate">
                        		<label for="checkin_inline">Entrada</label>                    
                    		</div>
                    		<div class="input-field inline">
                        		<input id="checkout_inline" type="date" value="<?php echo $db_checkout; ?>" required name="saida" class="validate">
                        		<label for="checkout_inline">Saída</label>                    
                    		</div>
    					</div>
    					<div class="col s6 m6">
    						<label for="tp_quarto">Exibir quarto do tipo:</label> 
                       		<select required class="browser-default" id="tp_quarto" name="tipodoquarto">
                            	<option value="0">Todos</option>
                              	<?php
                                	$sql = "SELECT * FROM tb_tipo";
                                	$execucao = $mysqli->query($sql);
                                  	while($row = $execucao->fetch_object()){    
                                    	if($row->cd_tipo == $cd_tipo){
                                        	echo "<option selected value=".$row->cd_tipo.">".$row->nm_tipo."</option>";
                                      	}
                                      	else{
                                        	echo "<option value=".$row->cd_tipo.">".$row->nm_tipo."</option>";
                                      	}                               
                                  	} 
                               	?>
                       		</select>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col s6 m6">
    						<div id="garagem_escolha" class="col s12">                           
                                <label for="garagem_escolha">Deseja reservar  espaço na garagem?</label> 
                                <?php 
                                	$consultagaragem = "SELECT * FROM tb_garagem WHERE cd_garagem = '$db_garagem'";
                                    $resultado = $mysqli->query($consultagaragem); 
                                    while($row = $resultado->fetch_object()){ 
                                    	$qtdevagas = $row->nr_vagas; 
                                        if($qtdevagas==0){
                                        	$classe = "apagado";
                                        }                                  
                                    }
                                    if($qtdevagas == 0){
                                    	echo '<label for="sim">
                                        	<div class="card-panel">
                                            	<input type="radio" class="with-gap" name="opcgaragem" id="sim">
                                                <span>Sim</span>
                                            </div>
                                        </label>
                                        <label for="nao">
                                        	<div class="card-panel">
                                            	<input type="radio" class="with-gap" checked name="opcgaragem" id="nao">
                                                <span>Não</span>
                                            </div>
                                        </label><br>';
                                    }
                                    else{
                                    	echo '<label for="sim">
                                        	<div class="card-panel">
                                            	<input type="radio" class="with-gap" checked name="opcgaragem" id="sim">
                                                <span>Sim</span>
                                            </div>
                                        </label>
                                        <label for="nao">
                                        	<div class="card-panel">
                                            	<input type="radio" class="with-gap" name="opcgaragem" id="nao">
                                                <span>Não</span>
                                            </div>
                                       	</label><br>';
                                    }
                                ?>
                            </div>
    					</div>
    					<div class="col s6 m6" id="quartoespacos">
    						<label for="quartoespacos">Quartos:</label>
    						<div id="exibir_quartos">
    							<?php 
                          			$sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$cd_tipo'";                
                          			$result = $mysqli->query($sql); 
                          			while($row = $result->fetch_object()){
                              			$sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$cd_tipo'";  
                              			$resultados = $mysqli->query($sql2); 
                              			while($rows = $resultados->fetch_object()){ 
                                  			$vl_quarto = $rows->vl_quarto;
                                  			$ds_tipo = $rows->nm_tipo;                
                              			}
                              			if($row->cd_quarto == $_SESSION['codquarto']){
                                   			echo '<div class="row">
                                            	<div class="col s12">
                                                	<label class="labelquarto" for="num'.$row->cd_quarto.'">  
                                                    	<div id="listagem" class="card-panel">
                                                        	<div class="col m4">
                                                            	<img class="materialboxed" id="img_quarto" src="'.$row->ds_imagem.'">
                                                            </div>  
                                                            <div class="col m5">   
                                                            	'.$row->ds_quarto.'<br>
                                                                R$ '.number_format($vl_quarto, 2, ',', '.').' 
                                                            </div>
                                                            <div class="col m3">
                                                                <input type="radio" checked value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                                <span>Nº '.$row->nr_quarto.'</span>                        
                                                            </div>
                                                        </div>
                                                    </label>         
                                                </div>
                                            </div>';
                              			}  
                          			} 
                    			?>
    						</div>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col s6 m6">
    						<div class="<?php echo $classe; ?>" id="espacogaragem">
    							Quantidade máxima de vagas: <span id="max"></span>
    							<br>
    							Reservar 
                                <div class="input-field inline">
                                    <input id="reservagaragem" value="<?php echo $qtdevagas; ?>" required name="nvagas" type="number">
                                    <label for="reservagaragem">Nº de vagas</label>
                                    <span class="helper-text" id="valoradicional" data-success="right"></span>
                                </div>
                                vagas na garagem
    						</div>
    					</div>
    				</div>
    				<div class="row">
                  		<div class="col s12 m12">
                        	<center>
                          		<button class="btn waves-effect waves-light blue" type="submit" name="enviar">
                          			Enviar <i class="material-icons right">send</i>
                                </button>     
                        	</center>
                    	</div>
            		</div>  
    			</div>
    		</form>
    	</div>
    	<script>
   			$(document).ready(function(){
    			$('.materialboxed').materialbox();
  			});

   			$(document).on("change","#tp_quarto",function(){
      			var id_tipo = {id_tipo: $(this).val()};
      			console.log(id_tipo);   
       
        		$.ajax({
            		type: 'POST',
            		url: 'php.php',
            		data: id_tipo,
            		success: function(response){        
                  	$("#exibir_quartos").html(response);
                  	//console.log(response);
            		}        
        		});	//FECHANDO AJAX
   			});

   			$('#sim').click(function(){
      			$('#espacogaragem').fadeIn();
      			$('#mensagem2').fadeIn();
      			$('#mensagem3').fadeIn();
      			$("#reservagaragem").attr("min","1");
      			$("#reservagaragem").attr("max",vagas_maximas);
      			$(document).on("change","#reservagaragem",function(){            
            		vagas_requisitadas = $("#reservagaragem").val();
            		vagas_finais = vagas_maximas-vagas_requisitadas;
            		if(vagas_finais<0)
            		{
              			M.toast({html: 'Informe um valor menor ou igual a quantidade de vagas disponíveis'});
              			$("#reservagaragem").css("background-color","#ffebee");
              			$("#reservagaragem").val(" ");
              			//fazer a operacao para descobrir o custo da garagem pelos dias
            		}
            		else
            		{  
              			$('#mensagem2').fadeOut();            
              			$("#reservagaragem").css("background-color","#e8f5e9");
              			valor_totalgaragem = 50*(vagas_requisitadas-1)*total_dias;
              			$("#valoradicional").html("R$"+valor_totalgaragem+ " para "+ vagas_requisitadas+ " vagas em "+ total_dias+ " dias.");
              			$("#valorgaragem").html("R$ "+valor_totalgaragem);
              			$("#vagasconfirmadas").html(vagas_requisitadas+" vagas");
              			valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
              			$("#valortotalreserva").html("R$ "+ valor_total_de_tudo);
            		}
        		});
   			});   

    		$('#nao').click(function(){
      			$('#espacogaragem').fadeOut();
      			$('#mensagem2').fadeOut();
      			$('#mensagem3').fadeOut();
      			$("#reservagaragem").val("0");
      			$("#valorgaragem").html("R$0,00");
      			$("#vagasconfirmadas").html("0 vagas");
      			$('#reservagaragem').val(0);
      			valor_total_de_tudo = valor_totalquarto;
      			$("#valortotalreserva").html("R$ "+ valor_total_de_tudo);
   			});


   			$(document).on('change','#checkin_inline,#checkout_inline',function(){
            	var a = $('#checkin_inline').val();
                var b = $('#checkout_inline').val();                               
                // localStorage.setItem('entrada',a);
                // localStorage.setItem('saida',b);
                // $('#entradaconfirmada').html(a);
                // $('#saidaconfirmada').html(b);

            	if(b<a)
                {
                	console.log('data inválida');
                    $('#saida').css('background-color','#ffebee');
                    $('#entrada').css('background-color','#ffebee');
                    $('#proximo').hide();
                    M.toast({html: 'Data inválida!'});
                    $('.sw-btn-next').fadeOut();
                }
            	else
                {                    
                    $('#proximo').fadeIn();
                    $('#saida').css('background-color','#e8f5e9');
                    $('#entrada').css('background-color','#e8f5e9');
                    M.toast({html: 'Data válida!'});
                    $('.sw-btn-next').fadeIn();
                    $("#mensagem").fadeOut();

                    var entrada = {entrada: $("#checkin_inline").val()};
                    var saida = {saida: $("#checkout_inline").val()};
                    $.ajax({
                        type: 'POST',
                        url: 'php.php',
                        data: { 'entrada': entrada, 'saida': saida, },
                        success: function(response){
                            $("#max").html(response);
                            console.log('vagas na garagem '+response);
                        }        
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'php.php',
                        data: { 'data1': entrada, 'data2': saida, },
                        success: function(response){
                            $('#scripts_ajax').html(response);
                        }        
                    }); 
                }           
    		});
   		</script>

   		<?php 
	   		if(isset($_POST['entrada']))
	   		{
	   		//ISSET
	     		$entrada = $_POST['entrada'];
	     		$saida = $_POST['saida'];
	     		$quarto = $_POST['numdoquarto'];//Puxa o tipo com uma consulta
	     		$vagas = $_POST['nvagas'];
	     		$dias = $_SESSION['total_dias'];
	     		$regdate = date('Y-m-d h:i:s a', time());

     			//Puxando o tipo do quarto
     			$sql = "SELECT * FROM tb_quarto WHERE cd_quarto = $quarto";
     			$resultados = $mysqli->query($sql); 
     			while($row = $resultados->fetch_object()){ 
            		$idtipo = $row->id_tipo;
            		$consultapreco = "SELECT * FROM tb_tipo WHERE cd_tipo = $idtipo";
            		$resultado = $mysqli->query($consultapreco); 
            		while($rows = $resultado->fetch_object())
            		{
                		$valor = $rows->vl_quarto;
                		$valor_reserva = $valor*$dias;
                		//echo $valor_reserva;
            		} 
    			} 

	      		if($vagas==0){
	        		$valor_garagem = 0;
	      		}
	      		else
	      		{
	        		$valor_garagem = 50*($vagas-1)*$dias;
	      		}

	      		$valor_total = $valor_reserva+$valor_garagem;
	      
	      		$sql_update_garagem= "UPDATE tb_garagem
	                            	  SET   nr_vagas = $vagas                   
	                                  WHERE cd_garagem = \"$db_garagem\"";
	      		if(!$mysqli->query($sql_update_garagem))
	      		{
	            	echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	      		}   
	      		else
	      		{

	      		}
	      		$sql_update_quarto = "UPDATE tb_quarto
	                                  SET   id_status = 2                  
	                                  WHERE cd_quarto = \"$quarto\"";
	      		if(!$mysqli->query($sql_update_quarto))
	      		{
	            	echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	       		}
	       		else
	        	{
	           
	        	}
	    		$sql_update = "UPDATE tb_reserva
	                           SET st_reserva= 'Cancelado',
	                               id_quarto = $quarto,
	                               dt_checkin = '$entrada',
	                               dt_checkout ='$saida',
	                               vl_reserva = '$valor_total',
	                               dthr_registro =  '$regdate'                   
	                           WHERE cd_reserva = \"$cd_reserva\"";
	      		if(!$mysqli->query($sql_update))
	      		{
	            	echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
	       		}
	       		else
	        	{
	            	echo "<script type='text/javascript'>alert('Concluído'); window.location.href='alterar_reserva.php?reserva=".$cd_reserva."';</script>";
	          	}
   			}
   			//ISSET
    	?>
	</body>
</html>