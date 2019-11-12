<meta charset="utf-8">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<link href="SmartWizard-master/SmartWizard-master/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" /> 
<link href="SmartWizard-master/SmartWizard-master/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script type="text/javascript" src="SmartWizard-master/SmartWizard-master/dist/js/jquery.smartWizard.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<?php 
include 'conn.php';
 ?>
<form method="POST">
<div class="card-panel col s12" id="painel">
<div id="smartwizard">
    <ul>
        <li><a href="#step-1">Check-in e Check-out<br /><small>Aqui você escolherá<br> os dias que ficará em nossa pousada!</small></a></li>
        <li><a href="#step-2">Tipo de quarto<br /><small>Aqui você escolherá<br> o tipo de quarto</small></a></li>
        <li><a href="#step-3">Quarto<br /><small>Aqui você escolherá<br> o quarto</small></a></li>
        <li><a href="#step-4">Step Title<br /><small>Step description</small></a></li>

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
                            

                            // MODAL COM AS INFORMACOES DO QUARTO E A IMAGEM
                        echo '<label id="tipo" for='.$linha->cd_tipo.'><div class="card-panel" id="panel"><input type="radio" class="with-gap tipodequarto" value= '.$linha->cd_tipo.' name="quarto" id='.$linha->cd_tipo.' /><span>'.$linha->nm_tipo.'</span></div></label>';

                           $c++;
                           if($c%3==0)
                           {
                            echo '<br>';
                           }
                        
                        }
                    }
						
					


       		?>
            <div id="descricaocampo">
                
            </div>
            </div>
        </div>
        <div id="step-3" class="">
            
        </div>
        <div id="step-4" class="">
            Step Content
        </div>
    </div>
    <span id="mensagem"><i>Insira a data para iniciar o passo a passo</i></span>

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


</style>
<script type="text/javascript">
   
$(document).ready(function(){

    $(document).ready(function(){
        
        $('.tooltipped').tooltip();
    });

    $('#smartwizard').smartWizard();

    $('.tipodequarto').change(function(){
        var quarto = {quarto: $("input[name='quarto']:checked").val()};    
        var exibir = {exibir: $("input[name='quarto']:checked").val()};
        var entrada = {entrada: $("#entrada").val()};
        var saida = {saida: $("#saida").val()};
        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: quarto,
            success: function(response){
                console.log(response);
                 M.toast({html: response});


            }        
        });

        $.ajax({
            type: 'POST',
            url: 'php.php',
            data: {exibir, saida, entrada,},
            success: function(response){
                $("#step-3").html(response);
            }        
        });
   });
   

 });
   

   $(document).on('change','#saida',function(){
                var a = $('#entrada').val();
                var b = $('#saida').val();

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
                }           
    });

       
   










</script>