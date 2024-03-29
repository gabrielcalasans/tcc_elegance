    <?php include('header.php'); ?>
        <title>Home | Hospedagem Elegance</title>
        <?php
            date_default_timezone_set('UTC');
            include('conn.php');
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
            .star{
                height: 30px;
                width:30px;
            }
            #comentario{
                font-size: 12px;
            }

            .dropdown-content li > a, .dropdown-content li > span {
                color: #fbc02d !important;
            }

            @font-face {
                font-family: "Lobster";
                src: url("fonts/lobster/Lobster.otf") format("truetype");
            }

            .lobster-font{
                font-family: "Lobster"; 
            }
        </style>
    </head>
	<body>
        <?php 
            include('menu.php');
            if(isset($_GET['logado']) && $_GET['logado'] == 1) {
                echo "<script>M.toast({html: '".$saudacao.$row->nm_cliente." ".$row->nm_sobrenome."!'});</script>";
            }
            if(isset($_POST['reservar'])){
                if(isset($_POST['checkin']) && isset($_POST['checkout'])){
                    $_SESSION['checkin'] = $_POST['checkin'];
                    $_SESSION['checkout'] = $_POST['checkout'];
                    if(!empty($_SESSION['cliente'])){
                        echo "<script>window.location.href='criar_reserva.php';</script>";
                    }
                    else{
                        echo "<script>window.location.href='login.php?notlog=1';</script>";
                    }
                }
            }
        ?>
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
                                        <i id="datas1" class="material-icons prefix">date_range</i>
                                        <input id="entrada" type="date" name="checkin" min="<?php echo date("Y-m-d"); ?>" required>
                                        <label for="entrada">Data de entrada</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i id="datas2" class="material-icons prefix">date_range</i>
                                        <input id="saida" type="date" readonly="" name="checkout" min="<?php echo date("Y-m-d"); ?>" required>
                                        <label for="saida">Data de saída</label>
                                    </div>
                                </div>
                                <button class="btn yellow darken-2" id="logar" type="submit" name="reservar" title="Reservar">Reservar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center>
        <div id="i1" class="section">
            <h4 class="lobster-font">Inclusos</h4>
            <br>
            <div class="row">
                <div class="col m4">
                    <div id="panel" class="card-panel yellow darken-3">
                        <span>
                            <div class="center promo promo-example">
                                <i class="large material-icons">wifi</i>
                                <br>
                                <p class="promo-caption">Wi-fi</p>  
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
            <h4 class="lobster-font">Depoimentos</h4>
            <div class="row">
                <div class="col s12">
                    <div class="carousel carousel-slider center">
                        <?php 
                            $sql = "SELECT
                                    com.cd_comentario as codcomentario,
                                    concat(cli.nm_cliente, ' ' ,cli.nm_sobrenome) as nome,
                                    com.ds_comentario as comentario,
                                    com.nr_nota as nota,
                                    cli.ds_avatar as avatar,
                                    date_format(com.dthr_comentario, '%e de %M de %Y, às %Hh%i.') as data
                                    from tb_comentario com
                                    inner join tb_cliente cli on(cli.cd_cliente = com.id_cliente)
                                    where com.st_comentario = 1
                                    order by data";
                            $mysqli->query('SET lc_time_names = "pt_br"');
                            $result = $mysqli->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_object()){
                                    echo '<div class="carousel-item" href="'.$row->codcomentario.'!">
                                            <div class="card-panel" style="width: 50%; margin-left: 25%; margin-top: 115px;">
                                                <p align="left"><b>'.$row->nome.'</b></p>
                                                <p align="center">"<i>'.$row->comentario.'</i>" - '.$row->nota.' estrelas</p>
                                                <p id="comentario" align="right">'.$row->data.'</p>
                                            </div>  
                                        </div>';
                                }  
                            }
                            
                        ?>
                    </div>
                </div>
            </div>
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
                $("#entrada").change(function(){
                    var entrada = $("#entrada").val();
                    if(entrada){
                        $("#datas1").html('event_available');
                        $("#saida").attr('min', entrada);
                        $("#saida").removeAttr('readonly');
                    }
                    else{
                        $("#datas1").html('date_range');   
                    }
                });
                $("#saida").change(function(){
                    var saida = $("#saida").val();
                    if(saida){
                        $("#datas2").html('event_available');
                    }
                    else{
                        $("#datas2").html('date_range');   
                    }
                    $("#datas2").html('event_available');
                });
                $(".dropdown-trigger").dropdown();
                $('.parallax').parallax();
                $('.carousel.carousel-slider').carousel({
                    fullWidth: true,
                    indicators: false
                });
                autoplay();
                function autoplay() {
                    $('.carousel.carousel-slider').carousel('next');
                    setTimeout(autoplay, 4000);
                }
            });
        </script>

<?php include('footer.php'); ?>

