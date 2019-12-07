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
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
              var classe = $("#btn_status").attr("class");
              if(classe=="btn modal-close green accent-4")
              {
                $("#btn_status"+codreserva).attr("class","btn modal-close red accent-4");
                 setTimeout(function () {
                       window.location.href= 'ver_reserva.php'; // the redirect goes here
                  });                
              } 
              else{
                $("#btn_status"+codreserva).attr("class","btn modal-close green accent-4");
                  setTimeout(function () {
                       window.location.href= 'ver_reserva.php'; // the redirect goes here
                  });   
              } 

              }
        });        
   });

   $(document).ready(function(){
    $('.modal').modal();
    $("#cpf").mask("999.999.999-99");
    $("#cep").mask("99999-999");
    $("#celular").mask("(99) 99999-9999");
    $("#tel").mask("(99) 9999-9999");
    $("#rg").mask("99.999.999-9");
  });
   $(document).ready(function(){
    $('.materialboxed').materialbox();
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
    #avatar{
          width: 140px;
          height: 140px;
          border-radius: 100%;
          box-shadow: 5px 5px 5px rgba(0,0,0,0.3);
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
    <p></p>
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
        $idgaragem = $row->id_garagem;

        
        if($streserva == "Confirmado"){
            $botao = "Desativar reserva";
            $classe = "btn modal-close red accent-4";
        }
        else
        {
          $botao="Ativar reserva";
          $classe="btn modal-close green accent-4";
        }

        $consultagaragem = "SELECT * FROM tb_garagem WHERE cd_garagem =\"$idgaragem\"";
        $resultado_garagem = $mysqli->query($consultagaragem);
        while($row_garagem = $resultado_garagem->fetch_object())
        {
            $data_inicial = $checkin;
            $data_final = $checkout;
            $diferenca = strtotime($data_final) - strtotime($data_inicial);
            if($diferenca == 0)
            {
              $dias = 1;
            }
            else
            {
             $dias = floor($diferenca / (60 * 60 * 24));
            }            
            $qtdevagas = $row_garagem->nr_vagas;
            if($qtdevagas == 0){
              $valor_garagem=0;
            }
            else{
              $valor_garagem = 50*($qtdevagas-1)*$dias;

            }



        }
        

        //Consulta nome do usuário----------------------
        $consultausuario = "SELECT * FROM tb_cliente WHERE cd_cliente = \"$idcliente\"";
        //echo $consultausuario.'<p>';
        $resultado = $mysqli->query($consultausuario);
        if($resultado->num_rows > 0)
        {
          while($dado = $resultado->fetch_object())
          {               
            $nome=$dado->nm_cliente;
            $sobrenome = $dado->nm_sobrenome;
            $codcliente = $dado->cd_cliente;
            $cpfcliente = $dado->nr_cpf;
            $nomecompleto = $nome." ".$sobrenome;
            $email = $dado->nm_email;
            $celular = $dado->nr_celular;
            $rg = $dado->nr_rg;
            $org = $dado->ds_orgao;
            $nascimento = date("d/m/Y", strtotime($dado->dt_nascimento));
            $nacio = $dado->ds_nacionalidade;
            $avatar = $dado->ds_avatar;

            $idprof = $dado->id_profissao;
            $idgenero = $dado->id_genero;

            $consultaprof = "SELECT * FROM tb_profissao WHERE cd_profissao = $idprof";
            $resul = $mysqli->query($consultaprof);
            while($val = $resul->fetch_object())
            {
              $profisson = $val->nm_profissao; 
            }
            $consultagen = "SELECT * FROM tb_genero WHERE cd_genero = $idgenero";
            $resul = $mysqli->query($consultagen);
            while($val = $resul->fetch_object())
            {
              $genero = $val->nm_genero; 
            }

            if($dado->nr_telefone == "")
            {
              $telefone = "Não cadastrado";              
            }
            else
            {
              $telefone = $dado->nr_telefone;
            }
            //echo $nome;
          }
        }         
        else
        {
          $nome = "Cliente não cadastrado";
          $sobrenome = "";
          $nomecompleto = $nome." ".$sobrenome;
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
                          <div class='row'>
                            <div align='center' class='col s12'>
                              <legend><span id='informacoes'><span id='titulo'>INFORMAÇÕES DA RESERVA</span></legend>
                            </div>
                            </div>
                            <div class='row'>
                              <div class='col s6'>
                              <div class='row'>
                                <div class='col s12'>
                                  <b>Cód. Reserva:</b> ".$codres."
                                </div>
                              </div>
                               <div class='row'>
                                <div class='col s12'>
                                  <b>Cliente:</b>

                                  <span class='modal-trigger' data-target='modal-ficha".$idcliente."'>
                                        ".$nomecompleto. " <i class='material-icons'>zoom_in</i>
                                  </span>
                                </div>
                                </div>
                                <div class='row'> 
                                  <div class='col s6'>
                                    <b>Check-in:</b> ".date("d/m/Y", strtotime($checkin))." 
                                  </div>
                                  <div class='col s6'>
                                     <b>Check-out:</b> ".date("d/m/Y", strtotime($checkout))."".""."
                                  </div>
                                </div>
                                <div class='row'>
                                  <div class='col s6'>
                                   <b>Número:</b> ".$num."
                                  </div>
                                  <div class='col s6'>
                                    <b>Tipo de Quarto:</b> ".$tipo."</span>
                                  </div>
                                </div>
                                <div class='row'>
                                  <div class='col s6'>
                                    <b>Valor do quarto:</b> R$".number_format(($valor-$valor_garagem), 2, ',', '.')."
                                  </div>
                                  <div class='col s6'>
                                    <b>Valor da garagem:</b> R$".number_format($valor_garagem, 2, ',', '.')."
                                  </div>
                                </div>
                                <div class='row'>
                                 <div class='col s6'>
                                    <b>Vagas na garagem:</b> ".$qtdevagas."
                                  </div> 
                                  <div class='col s6'>
                                    <b>Valor da reserva:</b> R$ ".number_format($valor, 2, ',', '.')."
                                  </div>                                  
                                </div>


                            </div>
                            <div class='col s6'>                          
                             <img id='imgquarto' class='materialboxed' src='$endimagem''>
                             </div>
                            </div>
                            <p>";
        $botoes = "<p>
        <div class='row'>
          <div class='col s12'>
           <span data-target='modal".$codres."'  class='modal-trigger' id='detalhes'>
                <button type='button' id='btn_status".$codres."' class='".$classe."' value=".$codres.">               
                    <span id='streserva".$codres."'>
                      $botao                 
                  </span>
                </button>
             </span>             
                <a class='btn waves-effect waves-light blue accent-4' href=alterar_reserva.php?reserva=".$codres.">Alterar</a>
              </div>
            </div>
              </div>
        </div>";
         echo '<div id="modal'.$codres.'" class="modal">
                  <div class="modal-content">
                    <center><h4>Deseja alterar o status  <br> da reserva?</h4></center>
                  </div>
                <p>                                           
               <div class="modal-footer">
                  <center>
                    <button class="btn modal-close green accent-4" title="Sim" value='.$codres.' id="situacao">Sim</button>
                    <a href="#!" title="Não" class="btn modal-close red">Não</a>
                  </center>
                </div>
              </div>';
        echo '<div id="modal-ficha'.$idcliente.'" class="modal">
                  <div class="modal-content">
                    <div class="row">                    
                      <div align="center" class="col s12">
                              <img id="avatar" src='.$avatar.'>                         
                     </div>
                    </div>
                    <div align="center" class="col s12">
                          <h4>Informações do Cliente</h4>
                      </div>
                      <div class="row">
                      <div class="col s6">
                          Nome completo: '.$nomecompleto.'
                      </div>
                      <div class="col s6">
                          CPF: <span id="cpf">'.$cpfcliente.'</span>
                      </div>
                    </div>
                    <div class="row">                      
                      <div class="col s6">
                         Gênero: '.$genero.'
                      </div>                      
                      <div class="col s6">
                          Profissão: '.$profisson.'
                      </div>
                    </div>
                    <div class="row">                      
                      <div class="col s6">
                         Nacionalidade: '.$nacio.'
                      </div>                      
                      <div class="col s6">
                          Nascimento: '.$nascimento.'
                      </div>
                    </div>
                    <div class="row">                      
                      <div class="col s2">
                         Órgão: '.$org.'
                      </div>
                      <div class="col s4">
                          RG: <span id="rg">'.$rg.'</span>
                      </div>
                      <div class="col s6">
                          Celular: <span id="celular">'.$celular.'</span>
                      </div>
                    </div>                  
                  <div class="row">                      
                      <div class="col s6">
                         Telefone: <span id="tel">'.$telefone.'</span>
                      </div>                      
                      <div class="col s6">
                          Email: '.$email.'
                      </div>                      
                  </div>
                </div>
                <p>                                           
               <div class="modal-footer">
                  <center>
                    <a href="ficha.php?cli='.$idcliente.'" title="Imprimir" target="_blank"  class="btn modal-close green accent-4">Imprimir</a>                    
                    <a href="#!" title="Não" class="btn modal-close red">Fechar</a>
                  </center>
                </div>
              </div>';
        echo $div.$botoes;

        
      }    
        
    ?>
	</body>

</html>
