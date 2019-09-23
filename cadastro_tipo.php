<meta charset="utf-8">
<?php include('conn.php');
	  date_default_timezone_set('America/Sao_paulo');
	  //adicionar imagem
 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
	#lista
	{
		width: 100%;
		height: 300px;
		position: relative;
	}
	fieldset
	{

		float: left;
		width: 70%;
		height: 300px;
		padding: 10px;
	}
	#listagem
	{
		width: 300px;
		height: 300px;
	}
</style>

<form method="POST" enctype="multipart/form-data">
	<fieldset>
		Nome do Tipo: <input type="text" required name="tipo"><br>
		Contém: <input type="text" id="descricao"> <a class="func">Adicionar</a><p>	
		Valor R$:<input type="number" required id="dinheiro" name="dinheiro" class="dinheiro form-control" style="display:inline-block" /><br>
		Imagem: <input type="file" name="imagem" accept="image/x-png,image/gif,image/jpeg" /><p>
		<div id="img"></div>
		<input type="submit" name="Enviar">
	</fieldset>
	 <fieldset id="listagem"><textarea id="lista"></textarea></fieldset>
</form>
		<script>
			$(document).ready(function(){

				$('.func').click(function(){
					$('#lista').append('•'+$('#descricao').val()+'<br> ' );
					
				});


			});
		</script>
<?php 
if(isset($_POST['tipo']))
{
	$nome = $_POST['tipo'];
	$descricao = $_POST['descricao'];
	$valor = $_POST['dinheiro'];	
	if(isset($_FILES['imagem']))
		{

		    $extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
		    $imagem = time() . $extensao; //define o nome do arquivo
		    $diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
		    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$imagem); //efetua o upload

	    }
    else
	    {
	    	$imagem = "";
	    }
	$sql = "INSERT into tb_tipo VALUES(null,'$nome','$descricao','$valor','$imagem')";
	if(!$mysqli->query($sql))
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
		}
	else
		{
			echo "<script type='text/javascript'>alert('Tipo de Quarto Cadastrado Com Sucesso!!'); window.location.href='cadastro_tipo.php';</script>";
		}

}





?>
