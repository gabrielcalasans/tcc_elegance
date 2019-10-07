<meta charset="utf-8">
<?php include('conn.php'); ?>
<style type="text/css">
	#imgtipo
	{
		height: 35%;
		width: 45%;
	}
</style>
<body>
	<h1>Ver Tipos</h1>
	<button><a href="cadastro_tipo.php">Cadastrar tipo</a></button> <a href="painel_admin.php">Painel de Controle</a>
	<p>

	<?php 
		$consultatipo = "SELECT * FROM tb_tipo";
		$tipo = $mysqli->query($consultatipo);
		while($linha = $tipo->fetch_object())
			{				
				if($linha->ds_imagem!="")
				{
					echo '<fieldset>Tipo: '.$linha->nm_tipo.'<p> Descrição: '.$linha->ds_tipo.'<br>Valor: '.$linha->vl_quarto.'<p> <img id="imgtipo" src="images/'.$linha->ds_imagem.'">';
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
        if(!$mysqli->query($deletar_tipo))
          {
            echo "<script>alert('Não é possível excluir!! Há um quarto cadastrado com esse tipo!!');
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