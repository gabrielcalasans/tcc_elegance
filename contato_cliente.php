<?php include('header.php'); setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); date_default_timezone_set('America/Sao_Paulo');?>
        <title>Contato | Hospedagem Elegance</title>
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

        .input-field input:focus + label {
            color: #fbc02d !important;
        }

        .input-field input:focus {
            border-bottom: 1px solid #fbc02d !important;
            box-shadow: 0 1px 0 0 #fbc02d !important;
        }

        [type="radio"]:checked + span:after,
        [type="radio"].with-gap:checked + span:before,
        [type="radio"].with-gap:checked + span:after {
            border: 2px solid #fbc02d;
        }

        [type="radio"]:checked + span:after,
        [type="radio"].with-gap:checked + span:after {
            background-color: #fbc02d;
        }

        .dropdown-content li > a, .dropdown-content li > span {
            color: #fbc02d !important;
        }

        .input-field textarea:focus + label {
            color: #fbc02d !important;
        }
        .input-field textarea:focus {
            border-bottom: 1px solid #fbc02d !important;
            box-shadow: 0 1px 0 0 #fbc02d !important
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <body>
        <?php
            include('conn.php');
            
            if(empty($_SESSION['cliente'])){
                header('Location: login.php?log=0');
            }
            if(isset($_GET['id']) && $_GET['id'] == 0){
                session_destroy();
                header('Location: index.php');
            }
            if(isset($_GET['men']) && $_GET['men'] == 1) {
                echo "<script>M.toast({html: 'Depoimento enviado com sucesso!'});</script>";
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
        <nav class="grey darken-2">
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="reservas_cliente.php" title="Área de reserva">Área de reserva</a></li>
                    <li><a href="cliente.php" title="Minha conta">Minha conta</a></li>
                    <li class="active"><a href="contato_cliente.php" title="Contato">Contato</a></li>
                    <li><a href="historico.php" title="Histórico">Histórico</a></li>
                    <li><a class="modal-trigger" href="#sair" title="Sair">Sair</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row" style="margin-top: 60px;">
                    <form method="post">
                        <div class="card-panel" style="width: 100%;">
                            <div class="row">
                                <center><h5><b id="titulo">Contato</b></h5></center>
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
            <?php
                if(isset($_POST['tipo'])){
                    if($_POST['tipo'] == 2){
                        $cliente = $_SESSION['cliente'];
                        $comentario = ucfirst($_POST['msg']);
                        $nota = $_POST['nota'];
                        $datetime = date('Y-m-d H:i:s');
                        $sql = "INSERT into tb_comentario values(null, '$comentario', '$cliente', '$nota', '$datetime', '')";
                        if($mysqli->query($sql)){
                            echo "<script type='text/javascript'>window.location.href='contato_cliente.php?men=1';</script>";
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
                        
                        echo "<script type='text/javascript'>alert('NÃO FUNCIONA EM SERVIDOR LOCAL'); window.location.href='contato_cliente.php';</script>";

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
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $('select').formSelect();
            $('input#input_text, textarea#digite').characterCounter();
            $(".dropdown-trigger").dropdown();
            $("#cel").mask("(99) 99999-9999");
            $("#nota").hide();
            $("input[type=radio]").click(function(){
                if($("#m2").is(":checked")){
                    $("#titulo").html('Depoimento');
                    $("#mensagem").attr('class', 'input-field col s9');
                    $("#estrelas").attr('required', 'required');
                    $("#ass").hide();
                    $("#assunto").removeAttr('required');
                    $("#celular").hide();
                    $("#cel").removeAttr('required');
                    $("#nota").show(310);
                }
                else{
                    $("#titulo").html('Mensagem por e-mail');
                    $("#mensagem").attr('class', 'input-field col s12');
                    $("#estrelas").removeAttr('required');
                    $("#ass").show();
                    $("#assunto").attr('required', 'required');
                    $("#celular").show();
                    $("#cel").attr('required', 'required');
                    $("#nota").hide();
                }  
            });
            $('.modal').modal();
        });
    </script>
</html>