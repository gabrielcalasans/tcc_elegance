<?php include('header.php'); ?>
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
		    <title>Visualizar Quartos | Pousada Hospedagem Elegance</title>
        <?php
          include('conn.php');
          include('disponibilidade.php');
          //include('checarlogin.php');
    			date_default_timezone_set('UTC');
    		?>
		<style type="text/css">
      body{
        background-color: #758DA3; 
      }
      .mini{
      width: 80px;
      height: 50px;
      }
      #logo{
        width: 9%;
      }
      .qua{
      font-family: 'Lobster', cursive;
      }
      b{
        font-size: 15px;
      }
    </style>
      <?php
          $consulta = "SELECT * FROM tb_quarto";
          $executar = $mysqli->query($consulta);
      ?>
	</head>
	<body>
    <nav class="black darken-2">
      <div class="nav-wrapper" align="center">
        <a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      </div>      
    </nav>
    <center><div class="qua"><h1>Quarto</h1></div><a class="waves-effect waves-light teal darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a> <a href="cadastroquarto.php" class="waves-effect waves-light teal darken-3 btn">Cadastrar novo quarto</a></p></center>
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
                    if($resultado_reserva->num_rows>0)
                    {
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
                    }
                    else
                    {
                            $nome = "Não reservado";
                            $checkin = $nome;
                            $checkout = $nome;
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



      $div="<div class='container'><div><div class='card-panel' style='width: 100%;'><legend><b><h3>Informações do Quarto</h3></b></legend> <b> Cód. Quarto: </b>".$codquarto." <p><b> Número: </b> ".$nrquarto."<p><b> Status: </b> ".$status."<p><b> Descrição: </b>".$dsquarto." <p><b> Reservado por: </b>".$nome."<p><b> Check-in: </b>".$checkin. "<p><b> Check-out: </b>".$checkout;
      if($status == "Disponível" || $nome == "Não reservado" )
      {
      $botoes = "<p><a class='waves-effect waves-light red accent-4 btn' href=ver_quarto.php?idquarto_del=".$codquarto.">Excluir</a> <a class='waves-effect waves-light orange btn' href=alteracao_quarto.php?idquarto=".$codquarto.">Alterar</a></div></div></div>";
      }
      else
      {
      $botoes = "<p><b>Não é possível alterar ou excluir um quarto com reserva ativa</b><p><button disabled>Excluir</button> <button disabled>Alterar</button></div></div></div>";
      }
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