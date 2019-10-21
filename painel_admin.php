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
			transition: 0.5s;
		}
		#logo:hover{
			width: 9.5%;
		}
	    b{
	        font-size: 15px;
	    }
	    #but{
	      	margin-right: 3%;
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
		<div class="container">
			<div class="row" style="width: 80%;">
				<div class="input-field col s4 m4">
					<a id="but" href="ver_reserva.php" class="waves-effect waves-light indigo darken-3 btn">Visualizar reservas</a>
				</div>
				<div class="input-field col s4 m4">
					<a id="but" href="ver_quarto.php" class="waves-effect waves-light indigo darken-3 btn">Visualizar quartos</a>
				</div>
				<div class="input-field col s4 m4">
					<a id="but" href="estatisticas.php" class="waves-effect waves-light indigo darken-3 btn">Visualizar estatísticas</a>
				</div>
			</div>
			<div class="row" style="width: 50%;">
				<div class="input-field col s6 m6">
					<a id="but" href="ver_tipos.php" class="waves-effect waves-light indigo darken-3 btn">Visualizar tipos</a>
				</div>
				<div class="input-field col s6 m6">
					<a id="but" href="addfotos.php" class="waves-effect waves-light indigo darken-3 btn">Adicionar fotos</a>
				</div>
			</div>
		</div>
	</center>
</body>