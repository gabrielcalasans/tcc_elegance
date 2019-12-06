
<?php include('header.php'); ?>
  <title>Alterar Reserva | Pousada Hospedagem Elegance</title>
  </head>
  <?php
    include('conn.php');
    $cd_reserva = $_SESSION['idreserva'];
    $consultabanco = "SELECT * FROM tb_reserva WHERE cd_reserva = '$cd_reserva'";
    $result = $mysqli->query($consultabanco);
    while($row2 = $result->fetch_object())
      {                                   
        $db_checkin = $row2->dt_checkin;
        $db_checkout = $row2->dt_checkout;
        $db_valor = $row2->vl_reserva;
        $db_idquarto = $row2->id_quarto;
                    $_SESSION['codquarto']=$db_idquarto;
        $db_garagem = $row2->id_garagem;
        $db_cliente = $row2->id_cliente;
     }
    $consultatipo = "SELECT * FROM tb_quarto WHERE cd_quarto = '$db_idquarto'";
    $result2 = $mysqli->query($consultatipo);
    while($row3 = $result2->fetch_object())
     {                                   
        $cd_tipo = $row3->id_tipo;
     }
        
   ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <style>
        .numerodo    
  </style>
   <div id="fundo" class="card-panel">   
     <form method="POST">
     <div class="row">
          <div class="col s3">                    
              Código da reserva: <?php echo $cd_reserva; ?><br>
             
           </div>              
       </div>
       <div class="row">
              <div class="col s4">                    
                    <div class="input-field inline">
                        <input id="checkin_inline" type="date" value="<?php echo $db_checkin; ?>" class="validate">
                        <label for="checkin_inline">Entrada</label>                    
                    </div>
                    <div class="input-field inline">
                        <input id="checkout_inline" type="date" value="<?php echo $db_checkout; ?>" class="validate">
                        <label for="checkout_inline">Saída</label>                    
                    </div>
              </div>
              <div class="col s2">
                      
              </div>
              <div class="col s4">
                      <h6>Exibir quartos do tipo:</h6>
                       <select class="browser-default" id="tp_quarto" name="tipodoquarto">
                              <option value="0">Todos</option>
                              <?php
                                  $sql = "SELECT * FROM tb_tipo";
                                  $execucao = $mysqli->query($sql);
                                  while($row = $execucao->fetch_object())
                                  {    
                                      if($row->cd_tipo == $cd_tipo){
                                          echo "<option selected value=".$row->cd_tipo.">".$row->nm_tipo."</option>";
                                      }
                                      else{
                                          echo "<option value=".$row->cd_tipo.">".$row->nm_tipo."</option>";
                                      }                               
                                     
                                  } 
                               ?>
                       </select>
                </div>
       </div>
       <style>
         #quartoespacos{
          overflow: ;
          height: 5%;
         }
         #fundo{
          height:70%;
         }
       </style>

       <div class="row">
                       
                <div id="quartoespacos" class="col s6">
                    <?php 
                    
                    $sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$cd_tipo'";                
                    $result = $mysqli->query($sql); 
                    while($row = $result->fetch_object()){
                        $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$cd_tipo'";  
                        $resultados = $mysqli->query($sql2); 
                        while($rows = $resultados->fetch_object()){ 
                            $vl_quarto = $rows->vl_quarto;
                            $ds_tipo = $rows->nm_tipo;                
                        }
                        if($row->cd_quarto == $_SESSION['codquarto']){
                             echo ' 
                                        <div class="col s2 m2">
                                          <div class="card">
                                            <div class="card-image">
                                              <img src="images/x.png">
                                              <span class="card-title">Nº '.$row->nr_quarto.'</span>
                                            </div>
                                            <div class="card-content">
                                              <label class="labelquarto" for="num'.$row->cd_quarto.'"> 
                                                     <input type="radio" checked value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                     <span>'.$row->ds_quarto.'</span>                   
                                                  </label><br>
                                            </div> 
                                             <div class="card-action">
                                              Valor:'.$vl_quarto.'
                                            </div>                      
                                          </div>
                                        </div>
                                      ';


                        }                         
                        
                       
                    } 
              ?>
                      
                </div>   
       

                             
                <div id="garagemespaco" class="col s6">
                  <div class="col s6">
                    Espaço na garagem:
                    <?php 
                    $consultagaragem = "SELECT * FROM tb_garagem WHERE cd_garagem = '$db_garagem'";
                    $resultado = $mysqli->query($consultagaragem); 
                    while($row = $resultado->fetch_object())
                    { 

                       $qtdevagas = $row->nr_vagas;                                   
                    }
                    if($qtdevagas == 0)
                    {
                      echo '<label for="sim">
                            <div class="card-panel">
                               <input type="radio" class="with-gap" name="opcgaragem" id="sim">
                               <span>Sim</span>
                           </div>
                          </label>
                          <label for="nao">
                            <div class="card-panel">
                               <input type="radio" class="with-gap" checked name="opcgaragem" id="nao">
                               <span>Não</span>
                           </div>
                          </label><br>';
                    }
                    else
                    {
                      echo '<label for="sim">
                            <div class="card-panel">
                               <input type="radio" class="with-gap" checked name="opcgaragem" id="sim">
                               <span>Sim</span>
                           </div>
                          </label>
                          <label for="nao">
                            <div class="card-panel">
                               <input type="radio" class="with-gap" name="opcgaragem" id="nao">
                               <span>Não</span>
                           </div>
                          </label><br>';
                    }



                    ?>
                  </div>
                
                <div class="col s3" id="espacogaragem">
                  Quantidade máxima: <span id="max"></span><br>
                  Reservar
                  <div id="espacodiv">
                    <input type="number" value="<?php echo $qtdevagas; ?>" id="reservagaragem" name="reservagaragem">
                  </div> espaços na garagem<br>
                  Valor adicional <span id="valoradicional"></span>
                

                </div>  
        </div>







     </form>     
   </div>
   <script>
   $(document).on("change","#tp_quarto",function(){
      var id_tipo = {id_tipo: $(this).val()};
      console.log(id_tipo);   
       
        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: id_tipo,
            success: function(response){        
                  $("#quartoespacos").html(response);
                  //console.log(response);

            }        
        });      //FECHANDO AJAX
   });
   $('#sim').click(function(){
      $('#espacogaragem').fadeIn();
      $('#mensagem2').fadeIn();
      $('#mensagem3').fadeIn();
      $("#reservagaragem").attr("min","1");
      $("#reservagaragem").attr("max",vagas_maximas);
      $(document).on("change","#reservagaragem",function(){            
            vagas_requisitadas = $("#reservagaragem").val();
            vagas_finais = vagas_maximas-vagas_requisitadas;
            if(vagas_finais<0)
            {
              M.toast({html: 'Informe um valor menor ou igual a quantidade de vagas disponíveis'});
              $("#reservagaragem").css("background-color","#ffebee");
              $("#reservagaragem").val(" ");
              //fazer a operacao para descobrir o custo da garagem pelos dias
            }
            else
            {  
              $('#mensagem2').fadeOut();            
              $("#reservagaragem").css("background-color","#e8f5e9");
              valor_totalgaragem = 50*(vagas_requisitadas-1)*total_dias;
              $("#valoradicional").html("R$"+valor_totalgaragem+ " para "+ vagas_requisitadas+ " vagas em "+ total_dias+ " dias.");
              $("#valorgaragem").html("R$ "+valor_totalgaragem);
              $("#vagasconfirmadas").html(vagas_requisitadas+" vagas");
              valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
              $("#valortotalreserva").html("R$ "+ valor_total_de_tudo);
              
            }
          


        }); 
   });   

    $('#nao').click(function(){
      $('#espacogaragem').fadeOut();
      $('#mensagem2').fadeOut();
      $('#mensagem3').fadeOut();
      $("#reservagaragem").val("0");
      $("#valorgaragem").html("R$0,00");
      $("#vagasconfirmadas").html("0 vagas");
      $('#reservagaragem').val(0);
      valor_total_de_tudo = valor_totalquarto;
      $("#valortotalreserva").html("R$ "+ valor_total_de_tudo);
   });









   </script>