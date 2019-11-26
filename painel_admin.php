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
	<?php
		include('conn.php');
		if(empty($_SESSION['cdadmin'])){
			header('Location: admin.php?log=0');
		}
		if(isset($_GET['id']) and $_GET['id'] == 0){
			session_destroy();
			header('Location: admin.php');
		}
	?>
	<!-- Modal Structure -->
        <div id="sair" class="modal" style="width: 40%;">
            <div class="modal-content">
                <center><h4>Deseja sair?</h4></center>
            </div>
            <div class="modal-footer">
              <center><a href="painel_admin.php?id=0" title="Sim" class="btn modal-close green accent-4">Sim</a>
              <a href="#!" title="Não" class="btn modal-close red">Não</a></center>
            </div>
        </div>
  	<!-- Modal Structure -->
  	<div id="modal1" class="modal bottom-sheet">
    	<div class="modal-content">
      		<h4>Depoimentos</h4>
      		<p>
      			<table class="centered striped">
		        <thead>
		          	<tr>
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
		        		$sql = "SELECT * from tb_comentario com inner join tb_cliente cli on (cli.cd_cliente = com.id_cliente) order by dthr_comentario desc;";
		        		$result = $mysqli->query($sql);
		        		if($result->num_rows > 0){
		        			while($row = $result->fetch_object()){
			        			echo '<tr>
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
		        		}
			        	else{
			        		echo "<tr><td colspan='6'><i>Nenhum depoimento enviado até o momento.</i></td></tr>";
			        	}	
		        	?>
		        	
		        </tbody>
		      	</table>
      		</p>
    	</div>
    	<div class="modal-footer">
      		<a href="#!" title="Fechar" class="modal-close btn-flat">Fechar</a>
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
					<a id="but" href="ver_reserva.php" title="Visualizar reservas" class="waves-effect waves-light indigo darken-3 btn">Visualizar reservas</a>
				</div>
				<div class="input-field col s4 m4">
					<a id="but" href="ver_quarto.php" title="Visualizar quartos" class="waves-effect waves-light indigo darken-3 btn">Visualizar quartos</a>
				</div>
				<div class="input-field col s4 m4">
					<a id="but" href="estatisticas.php" title="Visualizar estatísticas" class="waves-effect waves-light indigo darken-3 btn">Visualizar estatísticas</a>
				</div>
			</div>
			<div class="row" style="width: 80%;">
				<div class="input-field col s4 m4">
					<a id="but" href="ver_tipos.php" title="Visualizar tipos" class="waves-effect waves-light indigo darken-3 btn">Visualizar tipos</a>
				</div>
				<div class="input-field col s4 m4">
					<a id="but" href="addfotos.php" title="Adicionar fotos" class="waves-effect waves-light indigo darken-3 btn">Adicionar fotos</a>
				</div>
				<div class="input-field col s4 m4">
					<a class="indigo darken-3 btn modal-trigger" href="#modal1" title="Depoimentos">Depoimentos
					<?php 
						$sql = "SELECT * from tb_comentario where st_comentario <> 1";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0){
							$linhas = $result->num_rows;
							echo "<i class='right'>".$linhas."</i>";
						}
					?>
					</a>
				</div>
			<a href="#sair" title="Sair" class="modal-trigger indigo darken-3 btn">Sair</a>
			</div>
		</div>
	</center>
</body>
<?php 
	if(isset($_GET['apagar'])){
		$sql = "DELETE from tb_comentario where cd_comentario = ".$_GET['apagar'];
		if(!$mysqli->query($sql)){
			echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
		}
		else{
			echo "<script type='text/javascript'>window.location.href='painel_admin.php';</script>";
		}
	}
	if(isset($_GET['exibir'])){
		$sql = "UPDATE tb_comentario set st_comentario = 1 where cd_comentario = ".$_GET['exibir'];
		if(!$mysqli->query($sql)){
			echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
		}
		else{
			echo "<script type='text/javascript'>window.location.href='painel_admin.php';</script>";
		}
	}
	if(isset($_GET['ocultar'])){
		$sql = "UPDATE tb_comentario set st_comentario = 0 where cd_comentario = ".$_GET['ocultar'];
		if(!$mysqli->query($sql)){
			echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
		}
		else{
			echo "<script type='text/javascript'>window.location.href='painel_admin.php';</script>";
		}
	}
	if(isset($_GET['log']) && $_GET['log'] == 1) {
        echo "<script>M.toast({html: 'Bem-vindo de volta, ".$_SESSION['nmadmin']."!'});</script>";
    }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
    	$('.modal').modal();
  	});	
</script>
</html>