<?php include('header.php'); ?>
	<style type="text/css">
		.mini{
			width: 80px;
			height: 50px;
		}
	</style>
	<title>Adicionar fotos | Hospedagem Elegance</title>
	</header>
	<body>
		<?php include('conn.php'); date_default_timezone_set('UTC');?>
		
		<table border="2">
			<tr>
				<th>#</th>
				<th>Foto</th>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
			<?php
				$sql = "SELECT * from tb_galeria gal";
				$result = $mysqli->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_object()){
						echo
							"<tr>
								<td>".$row->cd_foto."</td>
								<td><img class='mini' src='".$row->ds_endereco."' title='".substr($row->ds_endereco, 8)."'></td>
								<td>".substr($row->ds_endereco, 8)."</td>
								<td><a href='addfotos.php?codfoto=".$row->cd_foto."'><button id='apagar'>Apagar</button></a></td>
							</tr>";
					}
				}
				else{
					echo "<tr><td></td><td></td><td>Nenhuma foto adicionada.</td><td></tr>";
				}
			?>
		</table>
		<br><center><a href="addfotos.php"><button>Atualizar</button></a></center>	
		<form  action="addfotos.php" method="post" multipart="" enctype="multipart/form-data">
			<label for="img">
				<b>Adicionar fotos: </b><input type="file" name="img[]" id="img" multiple>
			</label>
			<br><br>
			<button type="submit">Adicionar</button>
		</form>
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
				$sql = "DELETE from tb_galeria where cd_foto = '$foto'";
				if(!$mysqli->query($sql)){
					echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
				}
				else{
					echo "<script type='text/javascript'>window.location.href='addfotos.php';</script>";
				}
			}
		?>
	</body>
</html>