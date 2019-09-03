<meta charset="utf-8">
<?php
include('conn.php');
date_default_timezone_set('America/Sao_paulo');
//criar rotina para verificar disponibilidade td vez que entrar na página
//Criar laço para percorrer a tabela reserva checando os ultimos checkouts
//com os ultimos checkouts checar com o dia e dar update na tabela;
    $consulta_linhas = "SELECT count(cd_quarto) as qtde FROM tb_quarto";
    $resultado_linhas = $mysqli->query($consulta_linhas);
    while($linhas = $resultado_linhas->fetch_object())
    {
      $nrlinhas = $linhas->qtde;
      echo $nrlinhas.'<br>';
    }
    $consulta_reserva = "SELECT * FROM tb_reserva GROUP BY id_quarto ORDER BY dt_checkout DESC ";
    $resultado_reserva = $mysqli->query($consulta_reserva);
    while($inf = $resultado_reserva->fetch_object())
        {
          $checkout = $inf->dt_checkout;
          $idquarto = $inf->id_quarto;
          $hoje = date('Y-m-d');
          echo $checkout." Quarto : ".$idquarto.' '. $hoje .'<br>';


          if($checkout < $hoje)
            {
                $sql = "UPDATE tb_quarto
                        SET id_status = 1
                        WHERE cd_quarto = \"$idquarto\"";

                if(!$mysqli->query($sql))
                  {
                    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                  }
                else
                  {
                    echo "alterado";
                  }

            }
            else if($checkout > $hoje)
            {
              $sql = "UPDATE tb_quarto
                      SET id_status = 2
                      WHERE cd_quarto = \"$idquarto\"";

              if(!$mysqli->query($sql))
                {
                  echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                }
              else
                {
                  echo "alteradinho";
                }

            }

        }







?>
