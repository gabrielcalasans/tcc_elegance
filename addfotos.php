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
		<br>
		<form  action="addfotos.php" method="post" multipart="" enctype="multipart/form-data">
			<label for="img">
				<b>Adicionar fotos: </b><input type="file" name="img[]" id="img" multiple>
			</label>
			<br><br>
			<button type="submit">Adicionar</button>
		</form>
		<?php
			function reArrayFiles(&$file_post)
			{
			    $file_ary = array();
			    $multiple = is_array($file_post['name']);

			    $file_count = $multiple ? count($file_post['name']) : 1;
			    $file_keys = array_keys($file_post);

			    for ($i=0; $i<$file_count; $i++)
			    {
			        foreach ($file_keys as $key)
			        {
			            $file_ary[$i][$key] = $multiple ? $file_post[$key][$i] : $file_post[$key];
			        }
			    }

			    return $file_ary;
			}
			if(isset($_FILES['img'])){
				$img = $_FILES['img']['size'][0];
				if($img > 0){
					$img_desc = reArrayFiles($img);
					foreach($img_desc as $val){
						$ext = strtolower(substr($val['name'],-4));
						$new_name = date("Y.m.d-H.i.s") . $ext;
						$dir = "galeria/";
        				move_uploaded_file($val['tmp_name'], $dir.$new_name);
        				$sql = "INSERT into tb_galeria values(null, ".$dir.$new_name.")";
        				if(!$mysqli->query($sql)){
        					echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        				}
        				else{
        					echo "deu certo meu irmao";
        				}
					}

				}
				else{
					echo "Selecione alguma foto para adicionar.";
				}
			}
						
			
			
		?>
	</body>
</html>