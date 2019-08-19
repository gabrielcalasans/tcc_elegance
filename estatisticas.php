<!DOCTYPE html>
<html>
    <head>
      <?php
          include('conn.php');
          date_default_timezone_set('UTC');
          date_default_timezone_set('America/Sao_paulo');
      ?>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title>Estatística | Pousada Hospedagem Elegance</title>
		<style type="text/css">

		</style>
	</head>
  <?php

    //CONSULTA QUANTIDADE DE RESERVAS
  $consulta = "SELECT count(cd_reserva) AS total, sum(vl_reserva) AS vltotal FROM tb_reserva";
  $resultado = $mysqli->query($consulta);
  while($dados = $resultado->fetch_object())
  {
    $reservas_totais = $dados->total;
    $lucro_total = $dados->vltotal;
  }

  //CONSULTA Lucro e Quantidade de Reservas
  $valor= "SELECT count(cd_reserva) as reserva , sum(vl_reserva) as lucro
           FROM tb_reserva
           WHERE MONTH(dthr_registro)
           BETWEEN MONTH( NOW() ) -1
           AND MONTH( NOW( ) )";

  $resultado = $mysqli->query($valor);
  while($dados = $resultado->fetch_object())
  {

    $lucro_mes = $dados->lucro;
    $reservas_mes = $dados->reserva;

  }





  ?>
	<body>
    <h1> Estatísticas da Pousada</h1>
    Total de reservas:
    <?php echo $reservas_totais; ?>
    <p>
    Lucro total:
    <?php echo $lucro_total; ?>
    <p>
    Reservas no último mês:
    <?php echo $reservas_mes;   ?>
    <p>
    Lucro do último mês:
    <?php echo $lucro_mes;   ?>
    <p>

	</body>

</html>
