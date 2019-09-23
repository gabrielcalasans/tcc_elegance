<meta charset="utf-8">
<?php include('conn.php'); ?>

  
<form method="POST" enctype="multipart/form-data">
	Nome do Tipo: <input type="text" required name="tipo"><br>
	Descrição: <textarea required placeholder="Descrição do quarto" name="descricao"></textarea><br>
	Valor R$:<input type="number" required id="dinheiro" name="dinheiro" class="dinheiro form-control" style="display:inline-block" /><br>
	Imagem: <input type="file" name="imagem" accept="image/x-png,image/gif,image/jpeg" />
	<input type="submit" name="Enviar">
</form>
<?php 
if(isset($_POST['tipo']))
{
	if(isset($_FILES['imagem']))
	{

	    $extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //pega a extensao do arquivo
	    $novo_nome = time() . $extensao; //define o nome do arquivo
	    $diretorio = "images/"; //define o diretorio para onde enviaremos o arquivo
	    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome); //efetua o upload
	    
    }

}





?>
