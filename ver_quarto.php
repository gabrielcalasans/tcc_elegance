<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		    <title>Visualizar Quartos | Pousada Hospedagem Elegance</title>
        <?php
          include('conn.php');
          include('disponibilidade.php');
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
    <h1>Quarto</h1><a href="painel_admin.php"><button>Painel de controle</button></a> <a href="cadastroquarto.php"><button>Cadastrar novo quarto</button></a>
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
                if($id_status==2)
                {
                    //Consertar aqui
                    //Realizar consulta certo
                    $consulta_reserva = "SELECT * FROM tb_reserva WHERE id_quarto = \"$codquarto\" ORDER BY dt_checkout DESC LIMIT 1";
                    $resultado_reserva = $mysqli->query($consulta_reserva);
                    while($rw2 = $resultado_reserva->fetch_object())
                    {
                      $checkin = $rw2->dt_checkin;
                      $checkout = $rw2->dt_checkout;
                      $idcliente = $rw2->id_cliente;
                      $consulta_cliente = "SELECT * FROM tb_cliente WHERE cd_cliente = \"$idcliente\"";
                      $resultado_cliente = $mysqli->query($consulta_cliente);
                      if($resultado_cliente->num_rows>0)
                      {
                        while($rw3 = $resultado_cliente->fetch_object())
                        {
                          $nome = $rw3->nm_cliente." ".$rw3->nm_sobrenome;
                        }
                      }
                      else
                      {
                        $nome = "Não reservado";
                        $checkin = $nome;
                        $checkout = $nome;
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
      $botoes = "<p><button><a href=ver_quarto.php?idquarto_del=".$codquarto.">Excluir</a></button> <button><a href=alteracao_quarto.php?idquarto=".$codquarto.">Alterar</a></button></fieldset></div>";
      echo $div.$botoes;


    }

    if(isset($_GET['idquarto_del']))
    {
        $codquarto=$_GET['idquarto_del'];
        //
        //Juntar na mesma página;
        //
        $deletar_quarto="DELETE FROM tb_quarto WHERE cd_quarto=\"$codquarto\"";

          if(!$mysqli->query($deletar_quarto))
          {
            echo "<script>alert('Não é possível excluir, há uma reserva ativa!!');
                    window.location.href='ver_quarto.php';
               </script>";
          }
          else
          {
           echo "<script>alert('Quarto excluído!!');
                    window.location.href='ver_quarto.php';
               </script>";
          }

      }

    ?>

	</body>

</html>
