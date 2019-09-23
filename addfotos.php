<?php include('header.php'); ?>
	<style type="text/css">
		.mini{
			width: 80px;
			height: 50px;
		}
		#logo{
			width: 9%;
		}
		body{
			background-color: #758DA3;
		}
		#lista{
			min-height: 600px; 
			max-height: 800px;
			overflow: auto;
		}
	</style>
	<title>Adicionar fotos | Hospedagem Elegance</title>
	</header>

	<body>
		<?php include('conn.php'); date_default_timezone_set('UTC');?>
		<nav class="black darken-2">
			<div class="nav-wrapper" align="center">
				<a href="index.php"><img id="logo" src="images/logotipo2.png"></a>
			</div>			
		</nav>
		
		<form method="post">
			<center><div id="lista" class="card-panel" style="width: 95%;">
			<div class="row">
				<table class="striped centered">
					<thead>
						<tr>
							<th colspan="5"><h5>Fotos na Galeria</h5></th>
						</tr>
						<tr>
							<th>#</th>
							<th>Selecionar</th>
							<th>Foto</th>
							<th>Nome</th>
							<th>Ação</th>					
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * from tb_galeria gal";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0){
							$c = 0;
							while($row = $result->fetch_object()){
								$c++;
								echo
									"<tr>
										<td>".$row->cd_foto."</td>
										<td align='center'><label for='fotos".$c."'><input type='checkbox' name='fotos[]' id='fotos".$c."' class='fotos filled-in' value='".$row->cd_foto."'><span></span></label></td>
										<td><label for='fotos".$c."'><img class='mini' src='".$row->ds_endereco."' title='".substr($row->ds_endereco, 8)."'></label></td>
										<td>".substr($row->ds_endereco, 8)."</td>
										<td><a href='addfotos.php?codfoto=".$row->cd_foto."' class='btn-small waves-effect waves-light red' title='Apagar'>Apagar<i class='material-icons right'>delete</i></button></a></td>
				 						
									</tr>";
							}
						}
						else{
							echo "<tr><td colspan='5'>Nenhuma foto adicionada.</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div id="latualizar" class="col s12" align="center">
					<a href='addfotos.php' class='btn-small waves-effect waves-light yellow darken-2' title='Atualizar'>Atualizar<i class=" material-icons right">autorenew</i></a>
				</div>
				<div class="col s6" align="left">
					<button id="excluir" class="red btn-small waves-effect waves-light" type="submit">Excluir selecionados<i class='material-icons right'>delete</i></button>
				</div>
			</div></div>
		</form>
		<form action="addfotos.php" method="post" multipart="" enctype="multipart/form-data">
			<div class="card-panel" style="width: 95%;">
			<div class="row">
				<div class="col s12">
					<label>Adicione fotos na galeria</label>
	               <div class = "file-field input-field">
	                  <div class = "btn-small waves-effect waves-light yellow darken-2">
	                     <span>Procurar fotos<i class='material-icons right'>search</i></span>
	                     <input type="file" id="img" name="img[]" multiple />
	                  </div>
	                  <div class = "file-path-wrapper">
	                     <input id="img2" class = "file-path validate" type = "text" placeholder = "Carregue múltiplos arquivos" />
	                  </div>
	               </div> 
				</div>
            </div>
			<div class="row">
				<div class="col s12" align="center">
					<button id="add" type="submit" class="btn-large waves-effect waves-light yellow darken-2" title="Adicionar" disabled="disabled">Adicionar</button>
				</div>
			</div>
		</form></center>
		<?php
			if(isset($_FILES['img'])){
				$nomes = $_FILES['img']['name'];
				if($_FILES['img']['size'][0] > 0){
					for($i=0; $i<count($nomes); $i++){
						$ext = explode('.', $nomes[$i]);
						$ext = end($ext);
						$new_name = date("Y.m.d-H.i.s.") . "0" . $i . "." .$ext;
						$dir = "galeria/";
        				move_uploaded_file($_FILES['img']['tmp_name'][$i], $dir.$new_name);
        				$sql = "INSERT into tb_galeria values(null, '".$dir.$new_name."')";
        				if(!$mysqli->query($sql)){
        					echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        				}
					}
					echo "<script type='text/javascript'>window.location.href='addfotos.php';</script>";
				}
				else{
					echo "Selecione alguma foto para adicionar. nada mesmo";
				}
			}
			if(isset($_GET['codfoto'])){
				$foto = $_GET['codfoto'];
				$sql = "SELECT * from tb_galeria where cd_foto = '$foto'";
				$result = $mysqli->query($sql);
				if($result->num_rows > 0){
					$row = $result->fetch_object();
					$arquivo = $row->ds_endereco;
					$sql = "DELETE from tb_galeria where cd_foto = '$foto'";
					if(!$mysqli->query($sql)){
						echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
					}
					else{
						if(unlink($arquivo)){
							echo "<script type='text/javascript'>window.location.href='addfotos.php';</script>";
						}
					}
				}
			}
			if(isset($_POST['fotos'])) {
				foreach ($_POST['fotos'] as $foto){
					$sql = "SELECT * from tb_galeria where cd_foto = '$foto'";
					$result = $mysqli->query($sql);
					if($result->num_rows > 0){
						$row = $result->fetch_object();
						$arquivo = $row->ds_endereco;
						$sql = "DELETE from tb_galeria where cd_foto = '$foto'";
						if(!$mysqli->query($sql)){
							echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
						}
						else{
							unlink($arquivo);
						}
					}
				}
				echo "<script type='text/javascript'>window.location.href='addfotos.php';</script>";
			}
		?>
	</body>
	<script>
		$(document).ready(function(){
			$("#excluir").hide();
			$('.fotos').click(function(){
				if($(".fotos").is(":checked")){
					$("#latualizar").attr('class', 'col s6');
					$("#latualizar").attr('align', 'right');
					$("#excluir").show(20);
				}
				else{
					$("#excluir").hide();
					$("#latualizar").attr('class', 'col s12');
					$("#latualizar").attr('align', 'center');
				}  
			});
			$("#img2").change(function(){
				if($("#img2").val()){
					$("#add").removeAttr('disabled');
				}
				else{
					$("#add").attr('disabled', 'disabled');
				}
			});
				
			
		});
	</script>
</html>