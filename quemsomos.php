<?php include('header.php'); ?>
    <title>Sobre | Hospedagem Elegance</title>
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

            #imagempousada{
                width: 75%;
                border: 1px solid black;
                border-radius: 2px;
            }

            #historia{
                width: 80%;
            }

            .dropdown-content li > a, .dropdown-content li > span {
                color: #fbc02d !important;
            }
        </style>
    </head>
	<body>
        <?php
            include('menu.php');
        ?>
        <center>
            <div class="section">
                <h4>Quem somos?</h4>
                <br>
                <div class="row">
                    <div id="historia">
                        <div class="col m6">
                            <img id="imagempousada" class="responsive-img" src="images/quemsomos.jpg">
                        </div>
                        <div class="col m6">
                            <h5>Pousada Elegance</h5>
                            <p align="justify" style="text-indent: 45px;">Fundada em 15 de fevereiro de 2015, por Carlos Alberto Lima a Pousada Elegance Beira Mar tem grande nome em seu meio, sendo uma das mais procuradas por turistas. Situada no melhor bairro de Itanhaém na Orla do Centro, sua localização é um dos seus principais atrativos, pois conta com fácil mobilidade. Sua infraestrutura possui um dos melhores serviços da Cidade, contando com Internet, estacionamento, café da manhã, entre outros.</p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="divider"></div>
            <div class="section">
                
            </div>
        </center>
<?php include('footer.php'); ?>