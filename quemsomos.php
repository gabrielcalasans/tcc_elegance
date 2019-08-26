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
                width: 40%;
                border: 2px solid black;
            }

            #historia{
                width: 80%;
            }
        </style>
    </head>
	<body>
		<nav class="grey darken-2">
            <?php
                include('menu.php');
            ?>
        </nav>
        <center>
            <div class="section">
                <h4>Quem somos?</h4>
                <br>
                <div class="row">
                    <div id="historia">
                        <div class="col m6">
                            <img id="imagempousada" class="responsive-img" src="images/x.png">
                        </div>
                        <div class="col m6">
                            <h5>Pousada Elegance</h5>
                            <p>historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada historia da pousada.</p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="divider"></div>
            <div class="section">
                
            </div>
        </center>
<?php include('footer.php'); ?>