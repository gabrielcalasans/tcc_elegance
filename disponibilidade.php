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
    for($c = 1 ; $c<=$nrlinhas ; $c++)
    {
        $consulta_reserva = "SELECT * FROM tb_reserva WHERE id_quarto = \"$c\" ORDER BY dt_checkout DESC LIMIT 1";
        $resultado_reserva = $mysqli->query($consulta_reserva);
        while($inf = $resultado_reserva->fetch_object())
            {
              $checkout = $inf->dt_checkout;
              $hoje = date('Y-m-d');
              $idquarto = $inf->id_quarto;
              echo $checkout." Quarto : ".$idquarto.' '. $hoje .' ';

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
                      echo "Disponível<br>";
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
                    echo "Não Disponível<br>";
                  }

                }

            }

          }


   







?>
