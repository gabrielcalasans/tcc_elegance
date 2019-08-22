<?php include('header.php'); ?>
    <title>Home | Hospedagem Elegance</title></head>
    <?php
        include('conn.php');
        session_start();
    ?>
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
        </style>
	<body>
        
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
                    <li><a href="#">Quem somos?</a></li>
                     <li><a href="#">Galeria</a></li>
                    <li><a href="#">Contato</a></li>
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
        <div class="parallax-container">    
            <div class="parallax"><img src="images/teste.jpg"></div>
            <div class="row">  
                <div class="col s6 offset-s2">
                    <div id="reserva" class="card-panel" style="width: 50%;">
                        <center><h5>Faça sua reserva!</h5></center>
                        <div class="row">
                            <form class="col s12" method="post">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="entrada" type="text" class="validate datepicker" name="checkin">
                                        <label for="entrada">Data de entrada</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="saida" type="text" class="validate datepicker" name="checkout">
                                        <label for="saida">Data de saída</label>
                                    </div>
                                </div>
                                <button class="btn waves-effect waves-light yellow darken-2" id="logar" type="submit" name="action">Reservar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center>
        <div id="i1" class="section">
            <h5>Inclusos</h5>
            <br>
            <div class="row">
                <div class="col m4">
                    <div id="panel" class="card-panel yellow darken-3">
                        <span>
                            <div class="center promo promo-example">
                                <i class="large material-icons">wifi</i>
                                <br>
                                <p class="promo-caption">Wifi</p>  
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col m4">
                    <div id="panel" class="card-panel yellow darken-3">
                        <span>
                            <div class="center promo promo-example">
                                <i class="large material-icons">free_breakfast</i>
                                <br>
                                <p class="promo-caption">Café da manhã</p>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col m4">
                    <div id="panel" class="card-panel yellow darken-3">
                        <span>
                            <div class="center promo">
                                <i class="large material-icons">directions_car</i>
                                <br>
                                <p class="promo-caption">Estacionamento</p>  
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h3>Depoimentos</h3>
        </div>
        </center>
        <?php
            if(isset($_GET['id'])){
                if($_GET['id'] == 1){
                    session_destroy();
                    echo "<script type='text/javascript'>window.location.href='index.php';</script>";
                }
            }
        ?>
        <script>
            $(document).ready(function(){
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',  
                });
                $(".dropdown-trigger").dropdown();
                $('.parallax').parallax();
            });
        </script>
<?php include('footer.php'); ?>

