
        <!-- Modal Structure -->
        <div id="sair" class="modal" style="width: 40%;">
            <div class="modal-content">
              <center><h4>Deseja sair?</h4></center>
            </div>
            <div class="modal-footer">
              <center><a href="index.php?id=1" title="Sim" class="btn green modal-close waves-effect waves-green">Sim</a>
              <a href="#!" title="Não" class="btn red modal-close waves-effect waves-green">Não</a></center>
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
                            }
                            else if ($row->id_genero == 2) {
                                $pronome = "Sra. ";
                            }
                            else{
                                $pronome = "Sr(a). ";
                            }
                            $title = $pronome.$row->nm_cliente." ".$row->nm_sobrenome;
                            echo '<li><a class="dropdown-trigger" href="#!" data-target="dropdown1" title="'.$title.'"><b>'.
                            $pronome.$row->nm_cliente.'</b><i class="material-icons right"><img id="avatar" src="'.$row->ds_avatar.'" height="22px" width="22px"></i></a></li>';
                        }
                        else{
                            echo '<li><a href="login.php"><b>Fazer login<i class="material-icons right">account_circle</i></b></a></li>';
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