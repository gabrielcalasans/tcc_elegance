<?php include('header.php'); ?>
  <title>Visualizar Reservas | Pousada Hospedagem Elegance</title>
  <?php
    include('conn.php');
    if(empty($_SESSION['cdadmin'])){
      header('Location: admin.php?log=0');
    }
    //include('checarlogin.php');
    date_default_timezone_set('UTC');
  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).on("click","#situacao",function(){
       var cdreserva = {cdreserva: $(this).val()}; 
       var codreserva = $(this).val();
      $.ajax({
            type: 'POST',
            url: 'php.php',
            data: cdreserva,
            success: function(response){
              $("#streserva"+codreserva).html(response);
                
            }        
        });

        
   }); 





</script>
<style type="text/css">
    body{
      background-color: #758DA3;
    }
    #imgquarto{
      position: relative;
      margin-left: 0%;
      width: 400px;
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
    @font-face {
      font-family: "Lobster";
      src: url("fonts/lobster/Lobster.otf") format("truetype");
    }
    .lobster-font{
      font-family: "Lobster"; 
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
      <h1 class="lobster-font">Reservas</h1>
      <a href="painel_admin.php" class="waves-effect waves-light indigo darken-3 btn">Painel de controle</a>
    </center>
    <?php

      while($row = $executar->fetch_object())
      {
        //echo $row->cd_reserva.'<p>';
        $codres = $row->cd_reserva;
        $streserva = $row->st_reserva;
        $idquarto = $row->id_quarto;
        $checkin = $row->dt_checkin;
        $checkout = $row->dt_checkout;
        $valor = $row->vl_reserva;
        $idcliente = $row->id_cliente;
        $registro = $row->dthr_registro;

        if($streserva == "Confirmado"){
            $botao = "Desativar reserva";
        }
        else
        {
          $botao="Ativar reserva";
        }
        

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

        $div="<div class='container'>
                        <div class='card-panel' >
                            <legend><span id='informacoes'><span id='titulo'>Informações Reserva</span></legend>
                            Cód. Reserva: ".$codres." Cliente: ".$nome." ".$sobrenome. " 
                            <p> Check-in: ".$checkin." | Check-out: ".$checkout."<p>".""."
                            <p>Número: ".$num." | Tipo de Quarto: ".$tipo."</span><p>
                            <img id='imgquarto' src='$endimagem''>
                            <p>";
        $botoes = "<p>
              <button type='button' class='waves-light btn-small blue' id='situacao' value=".$codres.">
                <span data-target='modal".$codres."'  class='modal-trigger' id='detalhes'>
                  <span id='streserva".$codres."'>
                    $botao
                  </span>
                </span>
              </button>
              <a class='btn-small waves-effect waves-light blue' href=alteracao.php?idreserva=".$codres.">Alterar</a>
              </div>
        </div>";
        echo $div.$botoes;

        
      }    
        
    ?>
	</body>

</html>
