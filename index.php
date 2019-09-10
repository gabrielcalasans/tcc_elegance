    <?php include('header.php'); ?>
        <title>Home | Hospedagem Elegance</title>
        <?php
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
            .star{
                height: 30px;
                width:30px;
            }
            #comentario{
                font-size: 12px;
            }
        </style>
    </head>
	<body>
		<?php include('menu.php'); ?>
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
            <h4>Inclusos</h4>
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
            <h4>Depoimentos</h4>
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
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',  
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

