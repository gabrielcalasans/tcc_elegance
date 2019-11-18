
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
            <ul id="dropdown1" class="drop dropdown-content">
                <li><a href="reservas_cliente.php">Área de reserva</a></li>
                <li class="divider"></li>
                <li><a href="cliente.php">Minha conta</a></li>
                <li class="divider"></li>
                <li><a class="waves-effect waves-light modal-trigger" href="#sair">Sair</a></li>
            </ul>
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="#" title="Acomodações">Acomodações</a></li>
                    <li><a href="quemsomos.php" title="Quem somos?">Quem somos?</a></li>
                    <li><a href="galeria.php" title="Galeria">Galeria</a></li>
                    <li><a href="contato.php" title="Contato">Contato</a></li>
                    <?php
                        if(!empty($_SESSION['cliente'])){
                            $sql = "SELECT * from tb_cliente where cd_cliente =".$_SESSION['cliente'];
                            $result = $mysqli->query($sql);
                            $row = $result->fetch_object();
                            if($row->id_genero == 1){
                                $pronome = "Sr. ";
                                $saudacao = "Bem-vindo, ";
                            }
                            else if ($row->id_genero == 2) {
                                $pronome = "Sra. ";
                                $saudacao = "Bem-vinda, ";
                            }
                            else{
                                $pronome = "Sr(a). ";
                                $saudacao = "Bem-vindo(a), ";
                            }
                            $title = $pronome.$row->nm_cliente." ".$row->nm_sobrenome;
                            echo '<li><a class="dropdown-trigger" href="#!" data-target="dropdown1" title="'.$title.'"><b>'.
                            $pronome.$row->nm_cliente.'</b><i class="material-icons right"><img id="avatar" style="border-radius: 100%;" src="'.$row->ds_avatar.'" height="22px" width="22px"></i></a></li>';
                        }
                        else{
                            echo '<li><a href="login.php" title="Fazer login"><b>Fazer login<i class="material-icons right">account_circle</i></b></a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>