<!DOCTYPE html>
<html>
	<head>
		<title>teste</title>
		<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    	<!-- Compiled and minified JavaScript -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function(){
                var elems = document.querySelectorAll('.parallax');
                var instances = M.Parallax.init(elems, options);
            });
        </script>

	</head>
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
            <div class="parallax"><img src="images/teste.jpg"></div>
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
        <footer class="page-footer grey darken-2">
            <div class="container">
                <div class="row">
                    <div class="col l4 s12">
                        <h5 class="white-text">Hospedagem Elegance</h5>
                        <p class="grey-text text-lighten-4">texto texto texto texto texto texto texto texto texto</p>
                    </div>
                    <div class="col l4 offset-l1 s12">
                        <h5 class="white-text">Links</h5>
                        <ul>
                            <li><a href="#!" id="lfooter">Acomodações</a></li>
                            <li><a href="#!" id="lfooter">Quem somos?</a></li>
                            <li><a href="#!" id="lfooter">Contato</a></li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <p class="grey-text text-lighten-4">Avenida Presidente Vargas, 910 - Itanhaém, SP</p>
                        <a href="#"><img src="images/facebook.png" class="icon"></a>
                        <a href="#"><img src="images/email.png" class="icon"></a>
                        <a href="#"><img src="images/instagram.png" class="icon"></a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <center>© 2019 Hospedagem Elegance - Todos os direitos reservados</center>
                </div>
            </div>
        </footer>
	</body>
</html>

