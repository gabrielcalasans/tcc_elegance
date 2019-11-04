<?php include('header.php'); ?>
  <title>Visualizar Reservas | Pousada Hospedagem Elegance</title>
  <?php
    include('conn.php');
    //include('checarlogin.php');
    date_default_timezone_set('UTC');
  ?>
	<style type="text/css">
    body{
      background-color: #758DA3;
    }
    #imgquarto{
      position: relative;
      margin-left: 0%;
      width: 200px;
      height: 300px;
    }
    #informacoes{
      float: left;
    }
    #titulo{
      font-weight: 650;
    }
    #logo{
      width: 9%;
      transition: 0.5s;
    }
    #logo:hover{
      width: 9.5%;
    }
  </style>
  <?php
    $consulta = "SELECT * FROM tb_reserva";
    $executar = $mysqli->query($consulta);     
  ?>
	</head>
	<body>
    <center>
      <nav class="black darken-2">
        <div class="nav-wrapper">
          <a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
        </div>
      </nav>
    </center>
    <center>
      <h1>Reservas</h1>
      <a href="painel_admin.php" class="waves-effect waves-light indigo darken-3 btn">Painel de controle</a>
    </center>
    <?php

      while($row = $executar->fetch_object())
      {
        //echo $row->cd_reserva.'<p>';
        $codres = $row->cd_reserva;
        $idquarto = $row->id_quarto;
        $checkin = $row->dt_checkin;
        $checkout = $row->dt_checkout;
        $valor = $row->vl_reserva;
        $idcliente = $row->id_cliente;
        $registro = $row->dthr_registro;

        //Consulta nome do usuário----------------------
        $consultausuario = "SELECT nm_cliente, nm_sobrenome FROM tb_cliente WHERE cd_cliente = \"$idcliente\"";
        //echo $consultausuario.'<p>';
        $resultado = $mysqli->query($consultausuario);
        if($resultado->num_rows > 0)
        {
          while($dado = $resultado->fetch_object())
          {               
            $nome=$dado->nm_cliente;
            $sobrenome = $dado->nm_sobrenome;
            //echo $nome;
          }
        }         
        else
        {
          $nome = "Cliente não cadastrado";
          $sobrenome = "";
        }      
        
         
        $status_reserva = $row->st_reservas;
        if($status_reserva == 1)
        {
          $botao = "Desativar reserva";

        }   
        else
        {
          $botao = "Confirmar reserva";
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

        $div="<div class='container'><div class='card-panel' ><legend><span id='informacoes'><span id='titulo'>Informações Reserva</span></legend>Cód. Reserva: ".$codres." Cliente: ".$nome." ".$sobrenome. " <p> Check-in: ".$checkin." | Check-out: ".$checkout."<p>".""."<p>Número: ".$num." | Tipo de Quarto: ".$tipo."</span><p><img id='imgquarto' src='images/$endimagem''><p>";
        $botoes = "<p><a class='waves-effect waves-light btn-small green accent-4' href=ver_reserva.php?id=".$codres.">".$botao."</a> <a class='btn-small waves-effect waves-light blue' href=alteracao.php?idreserva=".$codres.">Alterar</a></div></div>";
        echo $div.$botoes;

        
      }
     
        $codigoreserva = $_GET['id'];
        $consultastatus = "SELECT st_reservas FROM tb_reserva WHERE cd_reserva = $codigoreserva";
        $resultadostatus = $mysqli->query($consultastatus);
         while($status = $resultadostatus->fetch_object())
          {
            $status = $status->st_reservas;
            echo $status;
          }

        if($status == 1)
        {
                    $sqlupdate ="UPDATE tb_reserva
                     SET st_reservas = 0
                     WHERE cd_reserva = $codigoreserva";
                    if(!$mysqli->query($sqlupdate))
                    {
                     echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                    }
                    else
                   {
                     // echo "<script type='text/javascript'>alert('Concluído 2');</script>";
                   }

        }
        else
        {
                    $sqlupdate ="UPDATE tb_reserva
                     SET st_reservas = 1
                     WHERE cd_reserva = $codigoreserva";
                    if(!$mysqli->query($sqlupdate))
                    {
                     echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                    }
                    else
                   {
                      //echo "<script type='text/javascript'>alert('Concluído 1');</script>";
                   }
        }
        
         
      
          


    ?>
	</body>
</html>
