<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include('conn.php');
	  date_default_timezone_set('America/Sao_paulo');
	  //adicionar imagem
 ?>
 <?php include('header.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
	#lista
	{
		width: 50%;
		height: 70.5%;
		position: relative;
	}
	fieldset
	{

		float: left;
		width: 60%;
		height:75.5%;
		padding: 10px;
	}
	#listagem
	{
		width: 40%;
		height:70.5%;
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


	
	
	
</style>

<form method="POST" enctype="multipart/form-data">
	<fieldset id="formulario">
		Nome do Tipo: <br>
		<label>Adicione o nome do tipo  </label>
		<input type="text" required name="tipo"><p>
		Contém: <br>
		<label>Adicione o que o tipo de quarto oferece  </label>
		<div class="row">
			<input class="col s2" type="text" id="descricao"> <a  class="waves-effect waves-light btn-small" id="func">Adicionar à descrição</a><p>	
		</div>
		Valor R$:<br>
		<label>Adicione o valor do tipo do quarto</label>
		<input type="number" required id="dinheiro" name="dinheiro" class="dinheiro form-control" style="display:inline-block" /><p>
		Imagem:<br>
		<label>Adicione fotos na galeria</label>
	               <div class = "file-field input-field">
	                  <div class = "btn-small waves-effect waves-light yellow darken-2">
	                     <span>Procurar fotos<i class='material-icons right'>search</i></span>
	                     <input type="file" id="img" name="imagem" accept="image/x-png,image/gif,image/jpeg"  />
	                  </div>
	                  
		              
	     <br><br><br><p>            

 <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
    <i class="material-icons right">send</i>
  </button>

	</fieldset>


	 <fieldset id="listagem">Descrição:<br>
	 	<label for="exampleFormControlTextarea1">Adicione ou edite a descrição aqui</label>
	 		<textarea id="lista" class="form-control" name="lista" id="exampleFormControlTextarea1" rows="3"></textarea>
	 	</fieldset>

	 	<fieldset id="imagem"><div id="imgespaco"></div></fieldset> 

</form>
		<script>
			$(document).ready(function(){

				$('#func').click(function(){
					$('#lista').append('•'+$('#descricao').val()+'<br> ' );				
					
					
				});

			$('input[type="file"]').on('change', function() {
			  var files = this.files;
			  $(files).each(function(index, file) {
			    // Still don't know why you want this...
			    var fakepath = 'C:\\fakepath\\';
			    $('#imgespaco').append('' +
			      // build  a fake path string for each File
			      '<p class="path"></p>' +
			      // all that is really needed to display the image
			      '<img id="imgcolocada" src="'+URL.createObjectURL(file)+'">' +
			     '');
			    $('#imgcolocada').attr('class', 'form-control');
			  });
			});



			});
		</script>
<?php 
if(isset($_POST['tipo']))
{
	$nome = $_POST['tipo'];
	$descricao = $_POST['lista'];
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
			echo "<script>alert('Cadastrado com sucesso!');</script>";
			echo "<script>window.location.replace('cadastro_tipo.php');</script>";
		}

}





?>
