<meta charset="utf-8">
<?php
include('conn.php');
$codreserva = $_SESSION['idreserva'];
$consultareserva = "SELECT * FROM tb_reserva WHERE cd_reserva=\"$codreserva\"";
$execucao = $mysqli->query($consultareserva);
while($dados = $execucao->fetch_object())
{
  $checkin_db = $dados->dt_checkin;
  $checkout_db = $dados->dt_checkout;
  $quarto_db = $dados->id_quarto;
  $valor_db = $dados->vl_reserva;

}

?>
<form method="POST">
    Cód. da Reserva: <?php echo $codreserva; ?> <p>    
    Check in: <input type="date" value='<?php echo $checkin_db; ?>' name="checkin"><p>
    Check out: <input type="date" value='<?php echo $checkout_db; ?>' name="checkout"><p>

    <h3>Escolha seu tipo de quarto</h3>
    <ul>
      <li><a href="alterar_reserva.php">Exibir todos os quartos</a></li>
      <?php

        $sql = "SELECT * FROM tb_tipo";
        $tipo = $mysqli->query($sql);
        if($tipo)
        {
          while($linha = $tipo->fetch_object())
          {

            echo "<li><a href='alterar_reserva.php?id=".$linha->cd_tipo."'>".$linha->nm_tipo."</a></li>";

          }
        }

        //echo '<option>'..'</option>';

      ?>
    </ul>
    <p>
    <h3>Quartos:</h3>
      <?php
        if(isset($_GET['id'])){
          if($_GET['id']!=null)
          {
            $codtipo=$_GET['id'];
            $sql = "SELECT * FROM tb_quarto WHERE id_tipo=\"$codtipo\"";
            $quarto = $mysqli->query($sql);
            if($quarto)
            {
              while($row = $quarto->fetch_object())
              {
                $consultapreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo = \"$row->id_tipo\"";
                $respreco = $mysqli->query($consultapreco);
                while($resul = $respreco->fetch_object())
                {
                  $valor = $resul->vl_quarto;
                }

                $consultastatus="SELECT * FROM tb_status WHERE cd_status=\"$row->id_status\"";
                $status = $mysqli->query($consultastatus);
                if($status)
                {
                  while($row2 = $status->fetch_object())
                  {

                    $st=$row2->ds_status;

                  }
                }
                if($quarto_db == $row->cd_quarto)
                {
                  echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" checked value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

                }
                else
                {
                  echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';
                }
              }
            }
          }
        }
          else
          {

            $sql = "SELECT * FROM tb_quarto";
            $quarto = $mysqli->query($sql);
            if($quarto)
            {
              while($row = $quarto->fetch_object())
              {

                $consultapreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo = \"$row->id_tipo\"";
                $respreco = $mysqli->query($consultapreco);
                while($resul = $respreco->fetch_object())
                {
                  $valor = $resul->vl_quarto;
                }

                $consultastatus="SELECT * FROM tb_status WHERE cd_status=\"$row->id_status\"";
                $status = $mysqli->query($consultastatus);
                if($status)
                {
                  while($row2 = $status->fetch_object())
                  {

                    $st=$row2->ds_status;

                  }
                }
                if($quarto_db == $row->cd_quarto)
                {
                  echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" checked value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

                }
                else
                {
                  echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';
                }

              }
            }
          }



      ?>
    <p>




  <input type="submit"><button><a href="ver_reserva.php">Ver Reservas</a></button>
</form>
<?php
if(isset($_POST['checkin']))
{


    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];



    if($checkin<$checkout)
    {

          $idquarto=$_POST['quarto'];
          $vlfinal=0;


          date_default_timezone_set('America/Sao_paulo');
          $regdate = date('Y-m-d h:i:s a');


          $data1 = new datetime($_POST['checkin']);
          $data2 = new datetime($_POST['checkout']);
          while($data1<=$data2)
          {
            $sqltipo="SELECT * FROM tb_quarto WHERE cd_quarto=\"$idquarto\"";
            $resulsql = $mysqli->query($sqltipo);
            while($valor = $resulsql->fetch_object())
            {

                $sqlpreco = "SELECT vl_quarto FROM tb_tipo WHERE cd_tipo=\"$valor->id_tipo\"";

                $resulsql2 = $mysqli->query($sqlpreco);
                while($dado = $resulsql2->fetch_object())
                {
                  //var_dump($dado->vl_quarto);
                  $vlfinal+=floatval ($dado->vl_quarto);

                }

            }

            $data1->modify('+1 day');

          }

        $sql = "UPDATE tb_reserva
                SET id_quarto = \"$idquarto\",
                    dt_checkin = \"$checkin\",
                    dt_checkout = \"$checkout\",
                    vl_reserva = \"$vlfinal\",
                    dthr_registro = \"$regdate\"
                WHERE cd_reserva = \"$codreserva\"";
        if(!$mysqli->query($sql)){
          echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
        else{
          echo "<script type='text/javascript'>alert('Concluído'); window.location.href='alterar_reserva.php';</script>";
        }

      }
      else
      {
         echo "<script type='text/javascript'>alert('Data Inválida');</script>";
      }




  //echo $_SESSION['quarto'];
  //header('location:pagamento.php');
}

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
