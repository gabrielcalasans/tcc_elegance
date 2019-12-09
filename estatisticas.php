<!DOCTYPE html>
<html>
  <head>
    <?php
      include('conn.php');
      if(empty($_SESSION['cdadmin'])){
        header('Location: admin.php?log=0');
      }
      date_default_timezone_set('UTC');
      date_default_timezone_set('America/Sao_paulo');
    ?>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="shortcut icon" href="images/Logo.png" type="image/png" />
		<title>Estatística | Pousada Hospedagem Elegance</title>
		<style type="text/css">
      body{
        background-color: #758DA3; 
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
	</head>
  <?php

      //CONSULTA QUANTIDADE DE RESERVAS
    $consulta = "SELECT count(cd_reserva) AS total, sum(vl_reserva) AS vltotal FROM tb_reserva";
    $resultado = $mysqli->query($consulta);
    while($dados = $resultado->fetch_object())
    {
      $reservas_totais = $dados->total;
      $lucro_total = $dados->vltotal;
    }

    //CONSULTA Lucro e Quantidade de Reservas
    $valor= "SELECT count(cd_reserva) as reserva , sum(vl_reserva) as lucro
                   FROM tb_reserva
                   WHERE MONTH(dthr_registro)
                   BETWEEN MONTH( NOW() ) -1
                   AND MONTH( NOW( ) )";

    $resultado = $mysqli->query($valor);
    while($dados = $resultado->fetch_object())
    {
      $fim = date('Y-m-d');
      $inicio =  date("Y-m-d",strtotime(date("Y-m-d")."-30 days"));
      $lucro_mes = $dados->lucro;
      $reservas_mes = $dados->reserva;

    }

  ?>
	<body>
    <nav class="black darken-2">
      <div class="nav-wrapper" align="center">
        <a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      </div>      
    </nav>
    <center>
      <h1 class="lobster-font">Estatísticas da Pousada</h1>
      <a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
      <br>
      <br>
      <div class="card panel" style="width: 40%; padding: 1%;">
          <div class="row">
                <div class="col s6">                      
                               <div class="input-field inline">
                                    <input id="inicio_inline" type="date" value="<?php echo $inicio; ?>" required name="inicio" >
                                    <label for="inicio_inline">De:</label>
                              </div>
                </div>
                <div class="col s6">
                              <div class="input-field inline">
                                    <input id="fim_inline" type="date" value="<?php echo $fim; ?>" required name="fim">
                                    <label for="fim_inline">Até:</label>
                              </div>
                </div>
          </div>
          <div class="divider"></div>
          <div class="row">
              <div class="col s6">
                <b>Total de reservas:</b>
              </div>
              <div class="col s6">
                <span id="qtde_reservas"><?php echo $reservas_totais; ?></span> 
              </div>               
          </div>
          
            <div class="divider"></div>
          
          
          <div class="row">
                <div class="col s6">
                  <b>Lucro total:</b>
                </div>
                <div class="col s6">
                  <span id="lucro"><?php echo "R$ ".number_format($lucro_total,2,',','.'); ?></span>                 
                </div>              
          </div>

            <div class="divider"></div>

          <div class="row">
                <div class="col s6">                
                  <b>Reservas do período selecionado:</b>
                </div>
                <div class="col s6">
                    <span id="ultimas_reservas"><?php echo $reservas_mes;   ?></span> 
                </div>              
          </div>

            <div class="divider"></div>

            <div class="row">
                <div class="col s6">                    
                    <b>Lucro do período selecionado:</b>
                  </div>
                  <div class="col s6">
                    <span id="ultimos_lucros"><?php echo "R$ ".number_format($lucro_mes,2,',','.'); ?></span>
                  <div>
            </div>

      </div>
      <div id="scripts_ajax">
      </div>
      
    </center>
    <script>
    $(document).on('change','#inicio_inline,#fim_inline',function(){
              var a = $('#inicio_inline').val();
              var b = $('#fim_inline').val();
              if(b<a)
                {
                  console.log('data inválida');
                    $('#inicio_inline').css('background-color','#ffebee');
                    $('#fim_inline').css('background-color','#ffebee');                    
                    M.toast({html: 'Data inválida!<br>Revisar por favor!'});
                    
                }
              else
                {                  
                    $('#inicio_inline').css('background-color','#e8f5e9');
                    $('#fim_inline').css('background-color','#e8f5e9');
                    M.toast({html: 'Data válida!'});
                    var inicio = {inicio: $("#inicio_inline").val()};
                    var fim = {fim: $("#fim_inline").val()};
                    $.ajax({
                        type: 'POST',
                        url: 'php.php',
                        data: { 'inicio': inicio, 'fim': fim, },
                        success: function(response){
                            $("#scripts_ajax").html(response);
                            console.log(response);
                        }        
                    });                    
                    
                }  
                                             
                          
        });
    </script>
	</body>

</html>
