<!DOCTYPE html>
<html>
  <head>
    <?php
      include('conn.php');
      if(empty($_SESSION['cdadmin'])){
        header('Location: admin.php?log=0');
      }
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
      body{
        background-color: #758DA3; 
      }

      #logo{
        width: 9%;
        transition: 0.5s;
      }

      #logo:hover{
        width: 9.5%;
      
      }

      @font-face {
        font-family: "Lobster";
        src: url("fonts/lobster/Lobster.otf") format("truetype");
      }

      .lobster-font{
        font-family: "Lobster"; 
      }
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
    <nav class="black darken-2">
      <div class="nav-wrapper" align="center">
        <a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      </div>      
    </nav>
    <center>
      <h1 class="lobster-font">Estatísticas da Pousada</h1>
      <a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
      <br>
      <br>
      <div class="card panel" style="width: 20%; padding: 1%;">
        <b>Total de reservas:</b>
        <?php echo $reservas_totais; ?>
        <p></p>
        <div class="divider"></div>
        <p></p>
        <b>Lucro total:</b>
        <?php echo $lucro_total; ?>
        <p></p>
        <div class="divider"></div>
        <p></p>
        <b>Reservas no último mês:</b>
        <?php echo $reservas_mes;   ?>
        <p></p>
        <div class="divider"></div>
        <p></p>
        <b>Lucro do último mês:</b>
        <?php echo $lucro_mes;   ?>
      </div>
      
    </center>

	</body>

</html>
