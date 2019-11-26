
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
   
   <div class="card-panel">   
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

       <div class="row">
                       
                <div id="quartoespacos" class="col s12">
                    <?php 
                    
                    $sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$cd_tipo'";                
                    $result = $mysqli->query($sql); 
                    while($row = $result->fetch_object()){
                        $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$cd_tipo'";  
                        $result = $mysqli->query($sql2); 
                        while($rows = $result->fetch_object()){ 
                            $vl_quarto = $rows->vl_quarto;
                            $ds_tipo = $rows->nm_tipo;                
                        }
                        if($row->cd_quarto == $db_idquarto){
                             echo '
                                        <div class="col s4 m3">
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
                        else if($row->id_status != '1')
                        {
                           echo '
                                        <div class="col s4 m3">
                                          <div class="card">
                                            <div class="card-image">
                                              <img src="images/x.png">
                                              <span class="card-title">Nº '.$row->nr_quarto.'</span>
                                            </div>
                                            <div class="card-content">
                                              <label class="labelquarto" for="num'.$row->cd_quarto.'"> 
                                                     <input type="radio" value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
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









   </script>