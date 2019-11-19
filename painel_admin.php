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
	<!-- Modal Trigger -->
  	<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  	<!-- Modal Structure -->
  	<div id="modal1" class="modal bottom-sheet">
    	<div class="modal-content">
      		<h4>Depoimentos</h4>
      		<p>
      			<table class="striped">
		        <thead>
		          <tr>
		              <th>#</th>
		              <th>Cod. Cliente</th>
		              <th>Depoimento</th>
		              <th>Avaliação</th>
		              <th>Situação</th>
		          </tr>
		        </thead>

		        <tbody>
		          <tr>
		            <td>Alvin</td>
		            <td>Eclair</td>
		            <td>$0.87</td>
		          </tr>
		          <tr>
		            <td>Alan</td>
		            <td>Jellybean</td>
		            <td>$3.76</td>
		          </tr>
		          <tr>
		            <td>Jonathan</td>
		            <td>Lollipop</td>
		            <td>$7.00</td>
		          </tr>
		        </tbody>
		      	</table>
      		</p>
    	</div>
    	<div class="modal-footer">
      		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    	</div>
  	</div>


	<nav class="black darken-2">
    	<div class="nav-wrapper" align="center">
       		<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      	</div>      
    </nav>
	<center>
		<h1 class="lobster-font">Área do Administrador</h1>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
    	$('.modal').modal();
  	});	
</script>
</html>