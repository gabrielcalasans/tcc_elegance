<?php include('header.php'); ?>
	<meta charset="utf-8">
	<?php
		include('conn.php');
		if(empty($_SESSION['cdadmin'])){
			header('Location: admin.php?log=0');
		}
	?>
	<style type="text/css">
		body{
        	background-color: #758DA3; 
	    }

	    #logo{
			width: 9%;
			transition: 0.5s;
		}

		#logo:hover{
			width: 9.5%;
		}

		#imgtipo
		{
			height: 35%;
			width: 45%;
		}

		#painel{
			width: 80%;
			position: absolute;
    		left: 10%;
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
	<nav class="black darken-2">
    	<div class="nav-wrapper" align="center">
        	<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      	</div>      
    </nav>
	<center>
		<h1 class="lobster-font">Ver Tipos</h1>
		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
      	<a href="cadastro_tipo.php" class="waves-effect waves-light indigo darken-3 btn">Cadastrar tipo</a>
	</center>
	<p>
	<div id="painel" class="card panel">
		<?php 
			$consultatipo = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($consultatipo);
			while($linha = $tipo->fetch_object())
				{				
					if($linha->ds_imagem!="")
					{
						echo '<div class="card panel" style="padding: 1%;"><b>Tipo: </b>'.$linha->nm_tipo.'<p><b>Descrição: </b>'.$linha->ds_tipo. '<p><b>Valor: </b>'.$linha->vl_quarto.'<p><img id="imgtipo" src="images/'.$linha->ds_imagem.'">';
					}
					else
					{
						echo '<div class="card panel" style="padding: 1%;"><b>Tipo: </b>'.$linha->nm_tipo.'<p><b>Descrição: </b>'.$linha->ds_tipo. '<p><b>Valor: </b>'.$linha->vl_quarto.'';
					}
					
					echo '<p><a href="alterar_tipo.php?id='.$linha->cd_tipo.'" class="btn-small waves-effect waves-light blue">Alterar</a> <a href="ver_tipos.php?id='.$linha->cd_tipo.'" class="btn-small waves-effect waves-light red">Excluir</a></div>';
												
				}
			if(isset($_GET['id']))
	    		{
	        		$codtipo=$_GET['id'];
	        		$deletar_tipo="DELETE FROM tb_tipo WHERE cd_tipo=\"$codtipo\"";
	        		if(!$mysqli->query($deletar_tipo))
	          		{
	            		echo "<script>alert('Não é possível excluir!! Há um quarto cadastrado com esse tipo!!');
	           		  	window.location.href='ver_tipos.php';                   
	               		</script>";
	          		}
	          		else
	          		{
	           			echo "<script>alert('Tipo excluída!!');
	                    window.location.href='ver_tipos.php';
	               		</script>";
	          		}
	      		}
		?>
	</div>
</body>