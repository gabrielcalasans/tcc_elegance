<meta charset="utf-8">
<?php include('conn.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<form method="POST"><fieldset>
<h2>Deseja reservar um espaço na garagem?</h2>
	<!-- Realizar consulta na tabela para saber quantas vagas estão disponíveis
		 Comparar vagas disponíveis com o número colocado
	-->
	Sim<input type="radio" value="1" required id="sim" name="garagem">
	Não<input type="radio" value="2" required id="nao" name="garagem">
	<p>
	<span id="garagemsim">
		Quantidade de vagas <input type="number" name="nrvagas"> 
	</span>

<p>
<input type="submit" value="Confirmar">

</fieldset>

</form>

<script>
	$(document).ready(function(){
		$('#garagemsim').hide();
		  $("#nao").click(function(){
		    $("#garagemsim").fadeOut();
		  });
		  $("#sim").click(function(){
		    $("#garagemsim").fadeIn();
		  });
	});
</script>
<?php 

	$garagem = $_POST['garagem'];
	if($garagem == 1)
	{
		$qtde = $_POST['nrvagas'];
		echo $qtde;
	}
	





?>
