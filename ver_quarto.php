<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		    <title>Visualizar Quartos | Pousada Hospedagem Elegance</title>
        <?php
    			include('conn.php');
          //include('checarlogin.php');
    			date_default_timezone_set('UTC');
    		?>
		<style type="text/css">
		</style>
      <?php
          $consulta = "SELECT * FROM tb_quarto";
          $executar = $mysqli->query($consulta);


      ?>
	</head>
	<body>
    <h1>Quarto</h1>
    <?php

      while($row = $executar->fetch_object())
      {
          $codquarto = $row->cd_quarto;
          $nrquarto = $row->nr_quarto;
          $dsquarto = $row->ds_quarto;
          $id_status = $row->id_status;

          $consulta_status = "SELECT * FROM tb_status WHERE cd_status = \"$id_status\"";
          $resultado_status = $mysqli->query($consulta_status);
          while($rw = $resultado_status->fetch_object())
          {
                $status = $rw->ds_status;
                if($id_status==1)
                {

                    $consulta_reserva = "SELECT * FROM tb_reserva WHERE id_quarto = \"$codquarto\" ORDER BY dthr_checkout DESC LIMIT 1";
                    $resultado_reserva = $mysqli->query($consulta_reserva);
                    while($rw2 = $resultado_reserva->fetch_object())
                    {
                      $checkin = $rw2->dthr_checkin;
                      $checkout = $rw2->dthr_checkout;
                      $idcliente = $rw2->id_cliente;
                      $consulta_cliente = "SELECT * FROM tb_cliente WHERE cd_cliente = \"$idcliente\"";
                      $resultado_cliente = $mysqli->query($consulta_cliente);
                      while($rw3 = $resultado_cliente->fetch_object())
                      {
                        $nome = $rw3->nm_cliente." ".$rw3->nm_sobrenome;
                      }
                    }
                    //Criar Rotina de Troca de Disponibilidade

                }
                else
                {
                  $nome = "Não reservado";
                  $checkin = $nome;
                  $checkout = $nome;
                }

          }



      $div="<div><fieldset><legend>Informações Quarto</legend>Cód. Quarto: ".$codquarto." Número: ".$nrquarto."<p> Status: ".$status."<p> Descrição:".$dsquarto." <p> Reservado por:".$nome."<p> Check-in: ".$checkin. "<p> Check-out: ".$checkout;
      $botoes = "<p><button><a href=excluir_reserva.php?id=".$codquarto.">Excluir</a></button> <button><a href=alteracao.php?idreserva=".$codquarto.">Alterar</a></button></fieldset></div>";
      echo $div.$botoes;


    }

    ?>

	</body>

</html>
