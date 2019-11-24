<meta charset="utf-8">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<link href="SmartWizard-master/SmartWizard-master/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" /> 
<link href="SmartWizard-master/SmartWizard-master/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script type="text/javascript" src="SmartWizard-master/SmartWizard-master/dist/js/jquery.smartWizard.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<head>
    <title>Criar reserva</title>
</head>
<?php 
include 'conn.php';
 ?>
 <div id="scripts_ajax"></div>
<form method="POST">
<div class="card-panel col s12" id="painel">
<div id="smartwizard">
    <ul>
        <li><a href="#step-1">Check-in e Check-out<br /><small>Aqui você escolherá<br> os dias que ficará em nossa pousada!</small></a></li>
        <li><a href="#step-2">Tipo de quarto<br /><small>Aqui você escolherá<br> o tipo de quarto</small></a></li>
        <li><a href="#step-3">Quarto<br /><small>Aqui você escolherá<br> o quarto</small></a></li>
        <li><a href="#step-4">Garagem<br /><small>Aqui você escolherá<br> opções sobre a garaegem</small></a></li>
        <li><a href="#step-5">Confirmação<br /><small>Confirme seus dados<br> antes de enviar</small></a></li>

    </ul>

    <div>
        <div id="step-1" class="">
        	<div class="data" style="width: 13%;">
					Check in:  <input type="date" id="entrada" name="checkin"><p>
					Check out: <input type="date" id="saida" name="checkout"><p>                       

			   </div>
      </div>
        <div id="step-2" class="">
            <div id="selecao">
       		<?php
					$sql = "SELECT * FROM tb_tipo";
					$tipo = $mysqli->query($sql);
					if($tipo)
					{
                        $c = 0;
						while($linha = $tipo->fetch_object())
						{
                            

                           
                        echo '<label  id="tipo" for='.$linha->cd_tipo.'>
                                    <div  class="card-panel"  id="panel">
                                        <input type="radio" class="with-gap tipodequarto" value= '.$linha->cd_tipo.' name="quarto" id='.$linha->cd_tipo.' />
                                            <span>'.$linha->nm_tipo.'</span>
                                            <span data-target="modal'.$linha->cd_tipo.'"  class="modal-trigger" id="detalhes">
                                              <i class="material-icons">add_circle_outline</i>
                                            </span>

                                </div>
                            </label>';  
                            echo '<div id="modal'.$linha->cd_tipo.'" class="modal">
                                    <div class="modal-content">
                                      <h4>'.$linha->nm_tipo.'</h4>
                                      <p>O quarto possui: <br>'.$linha->ds_tipo.'</p>
                                      <p>Valor: '.number_format($linha->vl_quarto, 2, ',', '.').'</p>
                                    </div>
                                    <p>
                                    <div class="img-box">
                                        <p><img id="imagemtipo" src="'.$linha->ds_imagem.'"></p>
                                    </div>                             
                                    <div class="modal-footer">

                                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                                    </div>
                                  </div>';                     
                           $c++;
                           if($c%3==0)
                           {
                            echo '<br>';
                           }
                        
                        }
                    }
						// INFORMAÇÕES DO QUARTO --- (da página php.php)
					 // '<label for="num'.$row->cd_quarto.'">
      //                   <div class="card-panel">
      //                   <div id="textoquarto"><input type="radio" class="with-gap" name="ola" id="num'.$row->cd_quarto.'">                       
      //                       <span>'.$row->ds_quarto.'</span><br>
      //                       <span>Nº: '.$row->nr_quarto.'</span><br>
      //                   </div>
      //                   </div>
      //           </label><br>'


       		?>                        
            </div>
            <div id="modal1" class="modal">
                
              </div>

        </div>
        <div id="step-3" class="">
            <div id="escolhaquarto">
                
            </div>
            <p>
        </div>
        <div id="step-4" class="">
         
              Deseja reservar um espaço na garagem:
              <br>
              <label for="sim">
                <div class="card-panel">
                   <input type="radio" class="with-gap" name="opcgaragem" id="sim">
                   <span>Sim</span>
               </div>
              </label>
              <label for="nao">
                <div class="card-panel">
                   <input type="radio" class="with-gap" name="opcgaragem" id="nao">
                   <span>Não</span>
               </div>
              </label><br>


              <div id="espacogaragem">
                Quantidade máxima: <span id="max"></span><br>
                Reservar <div id="espacodiv"><input type="number" id="reservagaragem" name="reservagaragem"></div> espaços na garagem<br>
                Valor adicional <span id="valoradicional"></span>
              </div>
      
        </div> 
    <div id="step-5" class="">

      <div class="card-panel">
        <div id="informacoes">
          Check-in: <span id="entradaconfirmada"></span> Check-out: <span id="saidaconfirmada"></span><br>
          Tipo de quarto: <span id="tipoconfirmado"></span> Número do quarto: <span id="numeroconfirmado"></span> Valor do quarto: <span id="valorquarto"></span><br>
          Vagas na garagem: <span id="vagasconfirmadas"></span> Valor da garagem: <span id="valorgaragem"></span><br>
          Valor da reserva: <span id="valortotalreserva"></span><br>
          <label for="confirmarreserva">
            <input id="confirmarreserva" type="checkbox"/>
            <span>Confirmar</span>
          </label>
          <div id="botaosubmit">
            <input type="submit" class="btn" id="botaoenviar" value="Cadastrar Reserva" name="">
          </div>


      </div>
    </div>
        
    </div> 

    
    
    <span id="mensagem"><i>Insira a data para iniciar o passo a passo</i><br></span>
    <span id="mensagem2"><i>Informe um valor menor ou igual às vagas disponíveis</i><br></span>
    <span id="mensagem3"><i>Uma vaga é inclusa na reserva a partir disso cada vaga custa um adicional de R$ 50,00 por dia</i><br></span>

</div>
</div>
</form>
<style>
.sw-btn-next{
    display: none;
}
#tipo
{
    margin-left: 1%;
}
#descricao
{
    display: none;
}
#toast-container {
  width: 35%;
  margin-top: 5%;
  right: 3%;
 
 
}
#detalhes
{
    font-family: 'Work Sans', sans-serif;

}
#imagemtipo{
    width: 45%;
    height: 45%;
}
.img-box
{
    text-align: center;
}
#textoquarto
{
    text-align: center;
}
.t3
{
    width: 100px;
}
#espacodiv
{
  width: 5%;
}


</style>
<script type="text/javascript">
   
$(document).ready(function(){


  $(document).ready(function(){
    $('.modal').modal();
  });
     
    $('#smartwizard').smartWizard();

    $(document).on("click",".tipodequarto",function(){
        console.log('FOI');
        var quarto = {quarto: $("input[name='quarto']:checked").val()};    
        var exibir = {exibir: $("input[name='quarto']:checked").val()};       
        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: exibir,
            success: function(response){
                $("#escolhaquarto").html(response);
                $('#tipoconfirmado').html(localStorage.getItem(tipoquarto));
            }        
        });
        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: quarto,
            success: function(response){                
                $('#tipoconfirmado').html(response);
            }        
        });

        
   });     
   

 });

  // jQuery da escolha do numero de quarto necessario colocar em algum lugar o reponse
  $(document).on("change",".numerodoquarto",function(){
      console.log('Entrou');
      var numeroquarto = {numeroquarto: $("input[name='numdoquarto']:checked").val()};
      var numquarto = {numquarto: $("input[name='numdoquarto']:checked").val()};    
       $.ajax({
            type: 'POST',
            url: 'php.php',
            data: numeroquarto,
            success: function(response){        
                  $('#numeroconfirmado').html(response);

            }        
        });
        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: numquarto,
            success: function(response){        
                  $('#scripts_ajax').html(response);
                  console.log('Script do valor quarto =  '+response);

            }        
        });      




   });
   

   $(document).on('change','#saida,#entrada',function(){
                var a = $('#entrada').val();
                var b = $('#saida').val();                               
                localStorage.setItem('entrada',a);
                localStorage.setItem('saida',b);
                $('#entradaconfirmada').html(a);
                $('#saidaconfirmada').html(b);

            if(b<a)
                {
                    console.log('data inválida');
                    $('#saida').css('background-color','#ffebee');
                    $('#entrada').css('background-color','#ffebee');
                    $('#proximo').hide();
                    M.toast({html: 'Data inválida!'});
                    $('.sw-btn-next').fadeOut();

                }
            else
                {                    
                    $('#proximo').fadeIn();
                    $('#saida').css('background-color','#e8f5e9');
                    $('#entrada').css('background-color','#e8f5e9');
                    M.toast({html: 'Data válida!'});
                    $('.sw-btn-next').fadeIn();
                    $("#mensagem").fadeOut();

                    var entrada = {entrada: $("#entrada").val()};
                    var saida = {saida: $("#saida").val()};
                    $.ajax({
                        type: 'POST',
                        url: 'php.php',
                        data: { 'entrada': entrada, 'saida': saida, },
                        success: function(response){
                            $("#max").html(response);
                            console.log('vagas na garagem '+response);
                        }        
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'php.php',
                        data: { 'data1': entrada, 'data2': saida, },
                        success: function(response){
                            $('#scripts_ajax').html(response);
                        }        
                    });
                    valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
                    $("#valortotalreserva").html("R$ "+ valor_total_de_tudo);

                }           
    });
   $("#mensagem2").hide(); 
   $("#mensagem3").hide();


   $('#espacogaragem').hide();

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
   });

   // $(document).on("change"," #saida, #entrada, .numerodoquarto, #reservagaragem",function(){
   //        valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
   //        alert(valor_total_de_tudo);

   // }); 
             

    $('#botaoenviar').hide();
    $("#confirmarreserva").change(function(){
      if($("#confirmarreserva").is(":checked")){
        $('#botaoenviar').fadeIn();
      }
      else{
        $('#botaoenviar').fadeOut();
      }
    });

    

       
   










</script>