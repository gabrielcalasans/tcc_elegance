	<?php include('header.php'); ?>
		<title>Galeria | Hospedagem Elegance</title>
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

            #logo{
                width: 9%;
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
            .foto{
                width: 200px;
                height: 200px;
            }
	    </style>
	</head>
	<body>
        <?php
            include('menu.php');
        ?>
        <div class="section">
        	<h4 style="text-align: center;">Galeria</h4>
        	<div class="container">
                <div class="row">              
                    <?php 
                        $sql = "SELECT * from tb_galeria";
                        $result = $mysqli->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_object()){
                                echo '<div class="col s4 m4"><img style="width: 800px; height: 200px; border-radius: 5px;" src="'.$row->ds_endereco.'" alt="" class="foto materialboxed responsive-img"></div>';
                            }
                        }
                        else{
                            echo "Não há fotos adicionadas na galeria.";
                        }
                    ?>
                </div>
			</div>
        </div>
        <script>
			$(document).ready(function(){
                $('.materialboxed').materialbox();
                $(".dropdown-trigger").dropdown();
            });
		</script>
<?php include('footer.php'); ?>