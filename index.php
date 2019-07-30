<?php include('header.php'); ?>
    <title>Home | Hospedagem Elegance</title></head>
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
        </style>

        <script>
            $(document).ready(function(){
                $('.parallax').parallax();
            });
        </script>
	<body>
		<nav class="yellow darken-2">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="#">Acomodações</a></li>
                    <li><a href="#">Quem somos?</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </div>
        </nav>
        <div class="parallax-container">
            <div class="parallax"><img src="images/teste.jpg" style="transform: translate3d(-50%, 50px, 0px); opacity: 1;"></div>
        </div>
        <br>
        <div class="row">  
            <div class="col s6 offset-s2">
                <fieldset style="width: 50%;">
                    <center><h5>Faça sua reserva!</h5></center>
                    <br>
                    <input type="text" class="datepicker" placeholder="Data de entrada...">
                    <br>
                    <input type="text" class="datepicker" placeholder="Data de saída...">
                </fieldset>
            </div>
        </div>
        <br>
        <div class="divider"></div>
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
            </center>
        <div class="divider"></div>
<?php include('footer.php'); ?>

