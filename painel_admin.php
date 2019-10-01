<?php include('header.php'); ?>
<meta charset="utf-8">
	    <style>
    	body{
        background-color: #758DA3; 
	      }
	      .mini{
	      width: 80px;
	      height: 50px;
	      }
	      #logo{
	        width: 9%;
	      }
	      b{
	        font-size: 15px;
	      }
	      #but{
	      	margin-right: 3%;
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
            footer{
            	margin-top: 15%;
            }
    </style>
</head>
<body>
	<nav class="black darken-2">
    	<div class="nav-wrapper" align="center">
        <a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      </div>      
    </nav>
<center>
<h1>Área do Administrador</h1>
<?php 
	include('conn.php');	
	$nmfuncionario = $_SESSION['nmadmin'];
?>
<h4>Funcionário: <?php echo $nmfuncionario; ?></p></h4>
<a id="but"href="ver_reserva.php" class="waves-effect waves-light teal darken-3 btn">Visualizar reservas</a>
<a id="but" href="ver_quarto.php" class="waves-effect waves-light teal darken-3 btn">Visualizar quartos</a>
<a id="but" href="ver_tipos.php" class="waves-effect waves-light teal darken-3 btn">Visualizar tipos</a>
<a id="but" href="estatisticas.php" class="waves-effect waves-light teal darken-3 btn">Visualizar estatísticas</a>
<a id="but" href="addfotos.php" class="waves-effect waves-light teal darken-3 btn">Adicionar fotos</a>
</center>
<?php include('footer.php'); ?>