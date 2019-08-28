<?php include('header.php'); date_default_timezone_set('UTC'); ?>
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
                width: 10%;
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
            .input-field input[type=text]:focus + label {
                color: #fbc02d !important;
            }

            /* label underline focus color */
            .input-field input[type=text]:focus {
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
            #fale{

            }

        </style>
		<?php include('conn.php'); session_start(); ?>
		<nav class="grey darken-2">
            <ul id="dropdown1" class="drop dropdown-content">
                <li><a href="#!">Minha conta</a></li>
                <li class="divider"></li>
                <li><a href="index.php?id=1">Sair</a></li>
            </ul>
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="#">Acomodações</a></li>
                    <li><a href="">Quem somos?</a></li>
                     <li><a href="galeria.php">Galeria</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <?php
                        if(!empty($_SESSION['cliente'])){
                            $sql = "SELECT * from tb_cliente where cd_cliente =".$_SESSION['cliente'];
                            $result = $mysqli->query($sql);
                            $row = $result->fetch_object();
                            if($row->id_genero == 1){
                                $pronome = "Sr. ";
                            }
                            else if ($row->id_genero == 2) {
                                $pronome = "Sra. ";
                            }
                            else{
                                $pronome = "Sr(a). ";
                            }
                            echo '<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><b>'.
                            $pronome.$row->nm_cliente.'</b><i class="material-icons right">account_circle</i></a></li>';
                        }
                        else{
                            echo '<li><a href="login.php"><b>Fazer login<i class="material-icons right">account_circle</i></b></a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
	      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3639.6593140516566!2d-46.78527668536784!3d-24.18367809075139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94d1d59cf263e053%3A0x81ea880496da1235!2sHospedagem%20Elegance!5e0!3m2!1spt-BR!2sbr!4v1566819445690!5m2!1spt-BR!2sbr" width="2000" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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
		      		<form class="col s12" method="post">
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
                                    }
                                ?> 
								<div class="input-field col s6">
									<input id="nome" type="text" name="nome" required="" class="validate"><label for="nome">Nome</label>
								</div>
								<div class="input-field col s6">
									<input id="assunto" type="text" name="assunto" required="" class="validate"><label for="assunto">Assunto</label>
								</div>
								<div class="input-field col s6">
									<input id="telefone" type="text" name="telefone" required="" class="validate"><label for="telefone">Telefone</label>
								</div>
                                <?php 
                                    if(!empty($_SESSION['cliente'])){
                                        $sql = "SELECT * from tb_cliente where cd_cliente =".$_SESSION['cliente'];
                                        $result = $mysqli->query($sql);
                                        $row = $result->fetch_object();
                                        echo '<div class="input-field col s6">
                                                <input id="email" type="text" name="email" required="" class="validate" value="'.$row->ds_email.'"><label for="email">E-mail</label>
                                            </div>';
                                    }
                                    else{
                                        echo '<div class="input-field col s6">
                                    <input id="email" type="text" name="email" required="" class="validate"><label for="email">E-mail</label>
                                </div>';
                                    }
                                ?>
                                
								
								<div class="input-field col s12">
						            <textarea id="digite" class="materialize-textarea" name="msg" data-length="200" maxlength="200"></textarea>
						            <label for="digite">Digite sua mensagem</label>
		      				    </div>
		      				    <center>
			      				    <button class="btn waves-effect waves-light accent-4" type="submit" id="enviar" name="action">
									Enviar
									</button>
								</center>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
                if(isset($_POST['nome'])){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $telefone = $_POST['telefone'];
                    $assunto = $_POST['assunto'];
                    $mensagem = $_POST['msg'];
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

                    $enviaremail = mail($destino, $assunto,  $headers);
                    if($enviaremail){
                    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
                    } else {
                    $mgm = "ERRO AO ENVIAR E-MAIL!";
                    echo "";
                    }
                }
				
			?>
</body>
<script>
	$(document).ready(function(){
        $('select').formSelect();
        $('input#input_text, textarea#digite').characterCounter();
    });
</script>
<?php include('footer.php'); ?>