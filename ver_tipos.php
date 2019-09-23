<meta charset="utf-8">
<?php include('conn.php'); ?>
<body>
	<h1>Ver Tipos</h1>
	<button><a href="cadastro_tipo.php">Cadastrar tipo</a></button>
	<p>

	<?php 
		$consultatipo = "SELECT * FROM tb_tipo";
		$tipo = $mysqli->query($consultatipo);
		while($linha = $tipo->fetch_object())
			{
				if($linha->ds_imagem!="")
				{
					echo '<fieldset>Tipo: '.$linha->nm_tipo.'<p> Descrição: '.$linha->ds_tipo.'<br>Valor: '.$linha->vl_quarto.'<p> <img src='.$linha->ds_imagem.'>';
				}
				else
				{
					echo '<fieldset>Tipo: '.$linha->nm_tipo.'<p> Descrição: '.$linha->ds_tipo.'<br>Valor: '.$linha->vl_quarto.' dsadasdsa';
				}

				echo '<p><button><a href="alterar_tipo.php?id='.$linha->cd_tipo.'">Alterar</a></button> <button><a href="ver_tipos.php?id='.$linha->cd_tipo.'">Excluir</a></button></fieldset><br>';

			}
		if(isset($_GET['id']))
      {

        $codtipo=$_GET['id'];
        $deletar_tipo="DELETE FROM tb_tipo WHERE cd_tipo=\"$codtipo\"";
        if(!$mysqli->query($deletar_reserva))
          {
            echo "<script>alert('Não é possível excluir!!');
                    window.location.href='ver_tipos.php';
               </script>";
          }
          else
          {
           echo "<script>alert('Reserva excluída!!');
                    window.location.href='ver_tipos.php';
               </script>";
          }

      }








	?>
	
</body>