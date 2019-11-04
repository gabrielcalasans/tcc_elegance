<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>  
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
	  include('conn.php');
	  date_default_timezone_set('America/Sao_paulo');
	  //adicionar imagem
 ?>
 <?php include('header.php'); ?>

<header>
	<?php 
		
		$cdtipo = $_GET['id'];
		$consultadados = "SELECT * FROM tb_tipo WHERE cd_tipo = \"$cdtipo\"";
		$dados = $mysqli->query($consultadados);
		while($linha = $dados->fetch_object())
		{	
			$descricao = $linha->ds_tipo;
			$nome = $linha->nm_tipo;
			$valor = $linha->vl_quarto;
			$endimagem = $linha->ds_imagem;
		}


	?>
		<title>
			Alterar tipos de quarto | Elegance
		</title>	


<style type="text/css">
	#lista
	{
		width: 100%;
		height: 90.5%;
		position: relative;
	}
	fieldset
	{

		float: left;
		width: 60%;
		padding: 10px;
	}
	#listagem
	{
		width: 20%;
		height:77.5%;
		margin-left: 5px;
	}
	#func
	{
		font-weight: 350;
		color:white;

	}	
	#func:active
	{
		background-color:#9ccc65;
	}
	#imgespaco
	{
		width: 100%;
		height:100%;
	}
	#imgcolocada
	{
		width: 100%;
		height: 100%;
	}
	#imagem
	{
		width: 20%;
		height: 30%;
		position: relative;
		margin-top:-6%;
	}
	#formulario
	{

	}
	body
	{
		padding: 15px;
		background-color: #758DA3; 
	}
	#return
	{
		margin-left:1%;
		
	}
	#return:hover
	{
		background-color: #ff8a65; 
		color:white;
	}
	#return:active
	{
		background-color: red;
	}
	#enviar:active
	{
		background-color: lightgreen;
	}
	#enviar:hover
	{
		background-color: darkgreen;
	}
	#logo{
		width: 9%;
		transition: 0.5s;
	}

	#logo:hover{
		width: 9.5%;
	}
	
</style>
</header>
<body>
<div class="container">
	<form method="POST" enctype="multipart/form-data">
		<fieldset class="card">
			Nome do Tipo: <br>
			<label>Adicione o nome do tipo  </label>
			<input type="text" value="<?php echo $nome; ?>" required name="tipo"><p>
			Contém: <br>
			<label>Adicione o que o tipo de quarto oferece  </label>
			
				<input type="text" id="descricao"> <a  class="waves-light btn-small" id="func">Adicionar à descrição<i class="material-icons right">add</i></a><p>	
			
			Valor R$:<br>
			<label>Adicione o valor do tipo do quarto</label>
				<input class="col s2" type="number" required id="dinheiro" value="<?php echo $valor; ?>" name="dinheiro" class="dinheiro form-control" style="display:inline-block" /><p>
			Imagem:<br>
			<label>Adicione fotos na galeria</label>
		               <div class = "file-field input-field">
		                  <div  class = "btn-small waves-light yellow darken-2">
		                     <span>Procurar fotos<i class='material-icons right'>add_to_photos</i></span>
		                     <input type="file" id="img" value="<?php echo $endimagem; ?>" name="imagem" accept="image/x-png,image/gif,image/jpeg"  />
		                  </div>              
		        <?php include('modal-imagem_alterar.php'); ?>
			<br><br><br><p>

	 <button class="btn waves-effect waves-light" type="submit" id="enviar" name="action">Enviar<i class="material-icons right">send</i></button>
	 <a href="ver_tipos.php" id="return" class="btn waves-effect waves-light">Voltar <i class="material-icons right">arrow_back</i></a>
		</fieldset>
	</fieldset>

		 <fieldset class="card" id="listagem">Descrição:<br>
		 	<label for="exampleFormControlTextarea1">Adicione ou edite a descrição aqui</label>
		 		<textarea id="lista" class="form-control" name="lista" id="exampleFormControlTextarea1" rows="3"><?php echo $descricao; ?></textarea>

		 </fieldset>
	</form>
</div>
<script>
			$(document).ready(function(){


				$('#func').click(function(){
					$('#lista').append('•'+$('#descricao').val()+'<br> ' );	
					$('#descricao').val('');		
					
					
				});	
				$('#enviar').click(function(){
					$('#lista').removeAttr('disabled');
				})




			});
		</script>
			</body>
			<?php
if(isset($_POST['tipo']))
{
	$nome = $_POST['tipo'];
	$descricao = $_POST['lista'];
	$valor = $_POST['dinheiro'];	
	if(isset($_FILES['imagem']))
		{

		    $extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
		    if($extensao = "jpeg")
		    {
		    	$imagem = time() .".". $extensao; //define o nome do arquivo
				$diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
				move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload

		    }
		    else
		    {
		    	$imagem = time() . $extensao; //define o nome do arquivo
			    $diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
			    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload
			    $imagem = $diretorio.$imagem;


		    }
		   
	    }
    else
	    {
	    	$imagem = "";
	    }
	$sql = "UPDATE tb_tipo
			SET nm_tipo = '$nome',
				ds_tipo = '$descricao',
				vl_quarto = '$valor',
				ds_imagem = '$imagem'
			WHERE cd_tipo = '$cdtipo'";
	if(!$mysqli->query($sql))
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
		}
	else
		{
			echo "<script>alert('Alterado com sucesso!'); window.location.href='ver_tipos.php';</script>";

		}
}





?>
