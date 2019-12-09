<?php include('header.php'); setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); date_default_timezone_set('America/Sao_Paulo');?>
        <title>Histórico | Hospedagem Elegance</title>
    </head>
    <style type="text/css">
        #logo{
                width: 9%;
            }
        body{
            background-color: #FFF7D9;
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
                    <li><a href="contato_cliente.php" title="Contato">Contato</a></li>
                    <li class="active"><a href="historico.php" title="Histórico">Histórico</a></li>
                    <li><a class="modal-trigger" href="#sair" title="Sair">Sair</a></li>
                </ul>
            </div>
        </nav>
            <div class="row" style="margin-top: 30px;">
                    <form method="post">
                        <div class="card-panel" style="width: 97%; margin-left: 1.5%;">
                            <div class="row">
                                <center><h5><b id="titulo">Histórico de reservas</b></h5></center><br>
                                <table class="striped centered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Qtde. dias</th>
                                            <th>Quarto</th>
                                            <th>Garagem</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    $sql = "SELECT *
                                        from tb_cliente cli
                                        inner join tb_reserva res on ( res.id_cliente = cli.cd_cliente )
                                        inner join tb_quarto qua on ( res.id_quarto = qua.cd_quarto )
                                        inner join tb_tipo tip on ( tip.cd_tipo = qua.id_tipo )
                                        inner join tb_garagem gar on ( gar.cd_garagem = res.id_garagem )
                                        where cd_cliente = ".$_SESSION['cliente']." and id_streserva = 1";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_object()){
                                            $checkin = date_create($row->dt_checkin);
                                            $checkout = date_create($row->dt_checkout);
                                            $diferenca = strtotime($row->dt_checkout) - strtotime($row->dt_checkin);
                                            $dias = floor($diferenca / (60 * 60 * 24));
                                            if($row->nr_vagas > 0){
                                                $vagas = $row->nr_vagas - 1;
                                                $dia = $vagas * 50.00;
                                                $custo = $dias * $dia;
                                            }
                                            else{
                                                $custo = 0.00;
                                            }
                                            echo '<tr>
                                                    <td>'.$row->cd_reserva.'</td>
                                                    <td>'.date_format($checkin, 'd/m/Y').'</td>
                                                    <td>'.date_format($checkout, 'd/m/Y').'</td>
                                                    <td>'.$dias.'</td>
                                                    <td>'.$row->nm_tipo.'</td>
                                                    <td> R$'.number_format($custo, 2, ",", ".").'</td>
                                                    <td> R$'.number_format($row->vl_reserva, 2, ",", ".").'</td>
                                                </tr>';
                                        }
                                    }
                                    else{
                                        echo "<tr><td colspan='7'>Nenhuma reserva confirmada no histórico.</td></tr>";
                                    }
                                    
                                ?>
                                    
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </form>
                </div>
    </body>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
</html>