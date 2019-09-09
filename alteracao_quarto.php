<meta charset="utf-8">
<?php
include('conn.php');

$codquarto = $_GET['idquarto'];
$consultaquarto = "SELECT * FROM tb_quarto WHERE cd_quarto=\"$codquarto\"";
$execucao = $mysqli->query($consultaquarto);
while($dados = $execucao->fetch_object())
{
  $nrquarto = $dados->nr_quarto;
  $dsquarto = $dados->ds_quarto;
  $idtipo = $dados->id_tipo;
  $idstatus = $dados->id_status;

}

?>
<body>
	<form method="POST">
			Cód. Quarto: <?php echo $codquarto; ?>
			<p>
			Número do Quarto: <input type="number" value="<?php echo $nrquarto; ?>" name="numeroquarto"><p>
			Status do Quarto: <select name="status">

				<?php

				$consultastatus="SELECT * FROM tb_status";
				$resultado=$mysqli->query($consultastatus);
				while($dado = $resultado->fetch_object())
					{
						if($dado->cd_status == $idstatus)
						{
							echo "<option selected value=".$dado->cd_status.">".$dado->ds_status."</option>";
						}
						else
						{
							echo "<option value=".$dado->cd_status.">".$dado->ds_status."</option>";

						}

					}


				?>


			</select>
			Descrição do Quarto: <textarea name="descricao"><?php echo $dsquarto;  ?></textarea>

			<?php

			$sql = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($sql);
			if($tipo)
			{
				while($linha = $tipo->fetch_object())
				{
					
					if($linha->cd_tipo == $idtipo)
					{
						echo '<label for='.$linha->cd_tipo.'><fieldset><img src="images/errado.png" alt=""><input type="radio" value= '.$linha->cd_tipo.' checked name="tipoquarto" id='.$linha->cd_tipo.' /><fieldset>'.$linha->nm_tipo.'<br><ul>'.$linha->ds_tipo.'</ul></fieldset></fieldset></label>';

					}
					else
					{
					
						echo '<label for='.$linha->cd_tipo.'><fieldset><img src="images/errado.png" alt=""><input type="radio" value= '.$linha->cd_tipo.' name="tipoquarto" id='.$linha->cd_tipo.' /><fieldset>'.$linha->nm_tipo.'<br><ul>'.$linha->ds_tipo.'</ul></fieldset></fieldset></label>';

					

					}

				}
			}

			//echo '<option>'..'</option>';

			?><p>
		<input type="submit" ><button><a href="ver_quarto.php">Ver quartos</a></button>
	</form>

</body>
<?php
if(isset($_POST['numeroquarto']))
{


	    $numquarto=$_POST['numeroquarto'];
	    $statusquarto=$_POST['status'];
	   	$descricaoquarto=$_POST['descricao'];
	   	$tipodequarto = $_POST['tipoquarto'];
	    


	        $sql = "UPDATE tb_quarto
	                SET   nr_quarto = \"$numquarto\",
	                      id_status = \"$statusquarto\",
	                      ds_quarto = \"$descricaoquarto\",
	                      id_tipo = \"$tipodequarto\"                    
	                WHERE cd_quarto = \"$codquarto\"";

	        if(!$mysqli->query($sql))
	        {

	          echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);

	        }
	        else
	        {

	          echo "<script type='text/javascript'>alert('Concluído'); window.location.href='alteracao_quarto.php?idquarto=".$codquarto."';</script>";

	        }
}    



	  //echo $_SESSION['quarto'];
	  //header('location:pagamento.php');


?>



<style type="text/css">
img{
width: 10%;
}
fieldset
{
width: 45%;
float:left;
}


</style>
