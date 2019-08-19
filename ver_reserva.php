<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		    <title>Visualizar Reservas | Pousada Hospedagem Elegance</title>
        <?php
    			include('conn.php');
          //include('checarlogin.php');
    			date_default_timezone_set('UTC');
    		?>
		<style type="text/css">
		</style>
      <?php
          $consulta = "SELECT * FROM tb_reserva";
          $executar = $mysqli->query($consulta);


      ?>
	</head>
	<body>
    <h1>Reservas</h1>
    <?php

    while($row = $executar->fetch_object())
    {
      $cod = $row->cd_reserva;
      $idquarto = $row->id_quarto;
      $checkin = $row->dthr_checkin;
      $checkout = $row->dthr_checkout;
      $valor = $row->vl_reserva;
      $idcliente = $row->id_cliente;
      $registro = $row->dthr_registro;

      //Consulta nome do usuário----------------------
      $consultausuario = "SELECT nm_cliente FROM tb_cliente WHERE cd_cliente = \"$idcliente\"";
      echo $consultausuario.'<p>';
      $resultado = $mysqli->query($consultausuario);
      while($dado = $resultado->fetch_object())
      {
        $nome=$dado->nm_cliente;
        echo $nome;
      }
      //----------------------------------------------

      //Consulta de quarto----------------------
      $consultaquarto = "SELECT * FROM tb_quarto WHERE cd_quarto = \"$idquarto\"";
      $resultado2 = $mysqli->query($consultaquarto);
      while($dado2 = $resultado2->fetch_object())
      {
        $cod = $dado2->cd_quarto;
        $num = $dado2->nr_quarto;
        $descricao = $dado2->ds_quarto;
        $idtipo = $dado2->id_tipo;

          //Consulta tipo de quarto-------------------------------------------
          $consultatipo = "SELECT * FROM tb_tipo WHERE cd_tipo = \"$idtipo\"";
          $resultado3 = $mysqli->query($consultatipo);
          while($res = $resultado3->fetch_object())
          {
            $tipo = $res->nm_tipo;
            $descricao = $res->ds_tipo;
            $endimagem = $res->ds_imagem;
          }
          //------------------------------------------------- fim consulta tipo de quarto
      }
      //---------------------------------------------- fim consulta quarto

      //$div="<div>Cliente:".$nome."<p>"."<img src='$endimagem'";


    }

    ?>

	</body>

</html>
