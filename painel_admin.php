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
	<?php include('conn.php'); ?>
	<!-- Modal Trigger -->
  	<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  	<!-- Modal Structure -->
  	<div id="modal1" class="modal bottom-sheet">
    	<div class="modal-content">
      		<h4>Depoimentos</h4>
      		<p>
      			<table class="striped centered highlights">
		        <thead>
		          	<tr>
		            	<th>#</th>
		            	<th>Cliente</th>
		            	<th>Depoimento</th>
		            	<th>Nota (1-5)</th>
		            	<th>Data</th>
		            	<th>Status</th>
		            	<th>Ação</th>
		          	</tr>
		        </thead>
		        <tbody>
		        	<?php 	
		        		$sql = "SELECT * from tb_comentario com inner join tb_cliente cli on (cli.cd_cliente = com.id_cliente);";
		        		$result = $mysqli->query($sql);
		        		while($row = $result->fetch_object()){
		        			echo '<tr>
					            	<td>'.$row->cd_comentario.'</td>
					            	<td>'.$row->cd_cliente.' - '.$row->nm_cliente.' '.$row->nm_sobrenome.'</td>
					            	<td>"<i>'.$row->ds_comentario.'</i>"</td>
					            	<td>'.$row->nr_nota.'</td>
					            	<td>'.$row->dthr_comentario.'</td>';
					    	if($row->st_comentario == 1){
					        	echo '<td><i style="color: blue;">Exibido</i></td>
					        		<td><a class="btn-small green" title="Exibir" href="painel_admin.php?exibir='.$row->cd_comentario.'" disabled><i class="tiny material-icons">visibility</i></a> <a class="btn-small orange" title="Ocultar" href="painel_admin.php?ocultar='.$row->cd_comentario.'"><i class="tiny material-icons">visibility_off</i></a> <a class="btn-small red" title="Excluir" href="painel_admin.php?apagar='.$row->cd_comentario.'"><i class="tiny material-icons">delete_forever</i></a>
					        		</td>
			        				</tr>';
					   		}
					   		else{
					   			echo '<td><i style="color: red;">Ocultado</i></td>
					        		<td><a class="btn-small green" href="painel_admin.php?exibir='.$row->cd_comentario.'" title="Exibir"><i class="tiny material-icons">visibility</i></a> <a class="btn-small orange" title="Ocultar" disabled href="painel_admin.php?ocultar='.$row->cd_comentario.'"><i class="tiny material-icons">visibility_off</i></a> <a class="btn-small red" title="Excluir" href="painel_admin.php?apagar='.$row->cd_comentario.'"><i class="tiny material-icons">delete_forever</i></a>
					        		</td>
			        				</tr>';
					   		}
		        		}
		        	?>
		        	
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
<?php 
	if(isset($_GET['apagar'])){
		$sql = "DELETE from tb_comentario where cd_comentario = ".$_GET['apagar'];
		if(!$mysqli->query($sql)){
		}
	}
	if(isset($_GET['exibir'])){
		$sql = "UPDATE tb_comentario set cd_comentario = 1 where cd_comentario = ".$_GET['apagar'];
		if(!$mysqli->query($sql)){
		}
	}
	if(isset($_GET['ocultar'])){
		$sql = "UPDATE tb_comentario set cd_comentario = 0 where cd_comentario = ".$_GET['apagar'];
		if(!$mysqli->query($sql)){
		}
	}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
    	$('.modal').modal();
  	});	
</script>
</html>