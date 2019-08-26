<meta charset="utf-8">
<?php
include('conn.php');
//criar uma pagina antes para enviar o codigo para a sessão, dps enviar para cá
$_SESSION['idreserva']=$_GET['id'];
$codreserva = $_SESSION['idreserva'];
$consultareserva = "SELECT * FROM tb_reserva WHERE cd_reserva=\"$codreserva\"";
$execucao = $mysqli->query($consultareserva);
while($dados = $execucao->fetch_object())
{
  $checkin_db = $dados->dthr_checkin;
  $checkout_db = $dados->dthr_checkout;

}

?>
<form method="POST">
    Check in<input type="date" value='<?php echo $checkin_db; ?>' name="checkin"><p>
    <?php echo $codreserva; ?>
    Check out<input type="date" value='<?php echo $checkout_db; ?>' name="checkout"><p>

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
                echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

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
                echo '<label for='.$row->cd_quarto.'><fieldset><input type="radio" value= '.$row->cd_quarto.' name="quarto" id='.$row->cd_quarto.' /><fieldset>'.'Quarto de número:'.$row->nr_quarto.'<br><ul>'.'<li id="descricao">Descrição do quarto: '.$row->ds_quarto.'</li>'.'<li id="status">Status: '.$st.'</li>'.'<li id="valor"> Valor: '.$valor.'</li>'.'</ul></fieldset></fieldset></label>';

              }
            }
          }



      ?>
    <p>




  <input type="submit" name="">
</form>
