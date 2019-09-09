<?php include('header.php'); setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); date_default_timezone_set('America/Sao_Paulo'); ?>
	<title>Contato | Hospedagem Elegance</title>
	</header>
	<style type="text/css">
            body{
                background-color: #FFF7D9;
            }

            nav{
                padding: 0 0 0 10px;
            }

            #i1{
                text-align: center;
                width: 60%;
            }

            .promo-caption{
                font-size: 1.4rem;
                font-weight: 500;
                margin-top: 5px;
                margin-bottom: 0;
            }

            #panel{
                transition: 0.4s;
            }

            #panel:hover{
                box-shadow: 0 6px 8px 0 rgba(0,0,0,0.24), 0 9px 40px 0 rgba(0,0,0,0.19);
            }

            .icon1{
                padding: 5px;
                width: 8%;
                color: yellow;
                transition: 0.4s;
            }

            .icon1:hover{
                filter: invert(25%);
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
            }

             /* label focus color */
            .input-field input:focus + label {
                color: #fbc02d !important;
            }

            /* label underline focus color */
            .input-field input:focus {
                border-bottom: 1px solid #fbc02d !important;
                box-shadow: 0 1px 0 0 #fbc02d !important;
            }

            #reserva{
                margin-top: 9%; 
            }
            #email1{
            	margin-left: 10%;
            	margin-top: -8%;
            }
            #instagram{
            	margin-left: 10%;
            	margin-top: -8%;
            }
            #facebook{
            	margin-left: 10%;
            	margin-top: -8%;
            }
        </style>
		<?php include('conn.php'); ?>
        <body>
        <?php include('menu.php'); ?>
		<div class="container-fluid">
        <div class="row">
            <div class="col s12">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3639.6593140516566!2d-46.78527668536784!3d-24.18367809075139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94d1d59cf263e053%3A0x81ea880496da1235!2sHospedagem%20Elegance!5e0!3m2!1spt-BR!2sbr!4v1566819445690!5m2!1spt-BR!2sbr" width="2000" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe> 
            </div>
        </div>  
	    </div>  
	    <div class="container">    
	      <div class="row">
      		<div class="col s6">
      			<h5>Localização:</h5>
      			Av. Presidente Vargas, 1001 - Itanhaém, SP
      		</div>
      		<div class="col s6">
      			<h5>Redes Sociais:</h5>
      			<a href="#"><img src="images/facebook.png" class="icon1"></a><div id="facebook">Pousada Elegance</div><br>
                <a href="#"><img src="images/email.png" class="icon1"></a><div id="email1"> pousadaelegance@gmail.com</div><br>
                <a href="#"><img src="images/instagram.png" class="icon1"></a><div id="instagram">@pousadaelegance</div>
      		</div>
      		</div>
      	</div>
      		<div class="container">
      			<div class="row">
		      		<form method="post">
						<div class="card-panel" style="width: 100%;">
							<div class="row">
								<center><h5 id="fale"><b>Fale Conosco:</b></h5></center>
                                <?php 
                                    if(!empty($_SESSION['cliente'])){
                                        echo "<div class='input-field col s12'>
                                                <p align='center'><label for='m1'>
                                                    <input class='with-gap' id='m1' type='radio' name='tipo' value='1' checked><span>Mensagem</span>
                                                </label>
                                                <label for='m2'>
                                                    <input class='with-gap' id='m2' type='radio' name='tipo' value='2'><span>Depoimento</span>
                                                </label></p>
                                            </div>";
                                        $sql = "SELECT * from tb_cliente where cd_cliente =".$_SESSION['cliente'];
                                        $result = $mysqli->query($sql);
                                        $row = $result->fetch_object();
                                    }
                                ?> 
								<div class="input-field col s6">
									<input id="nome" type="text" name="nome" required="" class="validate" value="<?php if(!empty($row->nm_cliente)){ echo $row->nm_cliente." ".$row->nm_sobrenome; } ?>" <?php if(!empty($row->nm_cliente)){ echo "readonly"; }?> ><label for="nome">Nome e Sobrenome</label>
								</div>
								<div id="ass" class="input-field col s6">
									<input id="assunto" type="text" name="assunto" required="" class="validate"><label for="assunto">Assunto</label>
								</div>
								<div id="celular" class="input-field col s6">
									<input id="cel" type="text" name="telefone" required="" class="validate" value="<?php if(!empty($row->nr_celular)){ echo $row->nr_celular; } ?>"><label for="cel">Celular</label>
								</div>
                                <div class="input-field col s6">
                                    <input id="email" type="email" name="email" required="" class="validate" value="<?php if(!empty($row->nm_email)){ echo $row->nm_email; } ?>"><label for="email">E-mail</label>
                                </div>
								<div id="mensagem" class="input-field col s12">
						            <textarea id="digite" class="materialize-textarea" name="msg" required="" data-length="200" maxlength="200"></textarea>
						            <label for="digite">Digite sua mensagem</label>
		      				    </div>
                                <div id="nota" class="input-field col s3">
                                    <select id="estrelas" class="icons" name="nota">
                                      <option value="" disabled selected>Avalie</option>
                                      <option value="5" data-icon="images/5star.png">5 estrelas</option>
                                      <option value="4" data-icon="images/4star.png">4 estrelas</option>
                                      <option value="3" data-icon="images/3star.png">3 estrelas</option>
                                      <option value="2" data-icon="images/2star.png">2 estrelas</option>
                                      <option value="1" data-icon="images/1star.png">1 estrela</option>
                                    </select>
                                    <label>Dê sua nota</label>
                                </div>
							</div>
                            <div class="row">
                                <div class="col s12">
                                    <center><button title="Enviar" class="btn waves-effect waves-light yellow darken-2" type="submit" id="enviar" name="action">
                                        Enviar
                                    </button></center>
                                </div>
                            </div>
						</div>
					</form>
				</div>
			</div>
			<?php
                if(isset($_POST['tipo'])){
                    if($_POST['tipo'] == 2){
                        $cliente = $_SESSION['cliente'];
                        $comentario = ucfirst($_POST['msg']);
                        $nota = $_POST['nota'];
                        $datetime = date('Y-m-d H:i:s');
                        $sql = "INSERT into tb_comentario values(null, '$comentario', '$cliente', '$nota', '$datetime', '')";
                        if($mysqli->query($sql)){
                            echo "<script type='text/javascript'>alert('Depoimento enviado com sucesso.'); window.location.href='contato.php';</script>";
                        }
                        else{
                            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }
                    }
                    else{
                        $nome = ucwords($_POST['nome']);
                        $email = $_POST['email'];
                        $telefone = $_POST['telefone'];
                        $assunto = ucwords($_POST['assunto']);
                        $mensagem = ucfirst($_POST['msg']);
                        $data_envio = date('d/m/Y');
                        $hora_envio = date('H:i:s');
                                // emails para quem será enviado o formulário
                        $emailenviar = "pousadaelegance@gmail.com";
                        $destino = $emailenviar;

                        // É necessário indicar que o formato do e-mail é html
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From: $nome <$email>';
                        //$headers .= "Bcc: $EmailPadrao\r\n";
                        
                        echo "<script type='text/javascript'>alert('NÃO FUNCIONA EM SERVIDOR LOCAL'); window.location.href='contato.php';</script>";

                        /*---------------------------------NÃO FUNCIONA EM SERVIDOR LOCAL---------------------------------*/
                        /*$enviaremail = mail($destino, $assunto,  $headers);
                        if($enviaremail){
                        $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                        echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
                        } else {
                        $mgm = "ERRO AO ENVIAR E-MAIL!";
                        echo "";
                        }*/
                        /*---------------------------------NÃO FUNCIONA EM SERVIDOR LOCAL---------------------------------*/
                    }
                }
				
			?>
<script>
	$(document).ready(function(){
        $('select').formSelect();
        $('input#input_text, textarea#digite').characterCounter();
        $(".dropdown-trigger").dropdown();
        $("#cel").mask("(99) 99999-9999");
        $("#nota").hide();
        $("input[type=radio]").click(function(){
            if($("#m2").is(":checked")){
                $("#mensagem").attr('class', 'input-field col s9');
                $("#estrelas").attr('required', 'required');
                $("#ass").hide();
                $("#assunto").removeAttr('required');
                $("#celular").hide();
                $("#cel").removeAttr('required');
                $("#nota").show(310);
            }
            else{
                $("#mensagem").attr('class', 'input-field col s12');
                $("#estrelas").removeAttr('required');
                $("#ass").show();
                $("#assunto").attr('required', 'required');
                $("#celular").show();
                $("#cel").attr('required', 'required');
                $("#nota").hide();
            }  
        });
    });
</script>
<?php include('footer.php'); ?>