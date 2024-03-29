<?php
	include('conn.php');
    if (isset($_SESSION['cliente'])) {
        $sql = "SELECT * from tb_cliente where cd_cliente = ".$_SESSION['cliente'];
        $result = $mysqli->query($sql);
        $row1 = $result->fetch_object();
    }
    function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k])){
                    $maskared .= $val[$k++];
                }
            }
            else{
                if(isset($mask[$i])){
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
    if(isset($_POST['estado'])){
        $estado = $_POST['estado'];
        $sql = "SELECT nm_cidade as cidade, cd_cidade as codcidade from tb_cidade cid
        inner join tb_estado est on (cid.id_estado = est.cd_estado)
        where est.cd_estado = '$estado'
        order by cid.nm_cidade asc";
        $result = $mysqli->query($sql); 
        $cidades = "<option value='' disabled selected>Selecione...</option>";
        while($row = $result->fetch_object()){
            $cidades .= "<option name='cidade' value='".$row->codcidade."'>".$row->cidade."</option>";
        }
        echo $cidades;
    }
	if(isset($_POST['senhatual'])){
        $senha = md5($_POST['senhatual']);
        $sql = "SELECT * from tb_cliente where ds_senha = '$senha'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo "Senha correspondente <i class='tiny material-icons left'>check</i>";
        }
        else{
            echo "Senha não correspondente <i class='tiny material-icons left'>clear</i>";
        }
    }
    if(isset($_POST['cpfinvalido'])){
        $cpf = $row1->nr_cpf;
        echo mask($cpf, '###.###.###-##');
    }
    if(isset($_POST['cpfduplicado'])){
        $cpfusuario = $row1->nr_cpf;
        $cpf = $_POST['cpfduplicado'];
        $sql = "SELECT nr_cpf from tb_cliente where nr_cpf = '$cpf' and nr_cpf <> '$cpfusuario'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            $cpf = $row1->nr_cpf;
            echo mask($cpf, '###.###.###-##');
        }
    }
    if(isset($_POST['rgduplicado'])){
        $rgusuario = $row1->nr_rg;
        $rg = $_POST['rgduplicado'];
        $sql = "SELECT nr_rg from tb_cliente where nr_rg = '$rg' and nr_rg <> '$rgusuario'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            $rg = $row1->nr_rg;
            echo mask($rg, '##.###.###-#');
        }
    }
    if(isset($_POST['cpfduplicado1'])){
        $cpf = $_POST['cpfduplicado1'];
        $sql = "SELECT * from tb_cliente where nr_cpf = '$cpf'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo "1";
        }
    }
    if(isset($_POST['rgduplicado1'])){
        $rg = $_POST['rgduplicado1'];
        $sql = "SELECT * from tb_cliente where nr_rg = '$rg'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo "1";
        }
    }
    if(isset($_POST['emailduplicado'])){
        $emailusuario = $row1->nm_email;
        $email = $_POST['emailduplicado'];
        $sql = "SELECT nm_email from tb_cliente where nm_email = '$email' and nm_email <> '$emailusuario'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo $row1->nm_email;
        }
    }
    if(isset($_POST['emailduplicado1'])){
        $email = $_POST['emailduplicado1'];
        $sql = "SELECT * from tb_cliente where nm_email = '$email'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            echo "1";
        }
    }
     if(isset($_POST['quarto'])){
        $cdtipo = $_POST['quarto'];
        $sql = "SELECT * FROM tb_tipo WHERE cd_tipo ='$cdtipo'";
        $result = $mysqli->query($sql);        
        while($row = $result->fetch_object()){
            echo $row->nm_tipo;            

        }
           
    }   
    if(isset($_POST['vericpf']) && isset($_POST['verisenha'])){
        $cpf = implode("", $_POST['vericpf']);
        $senha = md5(implode("", $_POST['verisenha']));
        $sql = "SELECT * from tb_cliente where nr_cpf = '$cpf' and ds_senha = '$senha'";
        $result = $mysqli->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_object();
            $_SESSION['cliente'] = $row->cd_cliente;;
            echo "1";
        }
    }
    if(isset($_POST['exibir'])){
        $exibir = $_POST['exibir'];        
        $sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$exibir' AND id_status = '1'";                
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){
            $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$exibir'";  
            $result = $mysqli->query($sql2); 
            while($rows = $result->fetch_object()){ 
                $vl_quarto = $rows->vl_quarto;                
            }

            echo '<div class="row">
                    <div class="col s12 m3">
                      <div class="card">
                        <div class="card-image">
                          <img src="'.$row->ds_imagem.'">
                          <span class="card-title">Nº '.$row->nr_quarto.'</span>
                        </div>
                        <div class="card-content">
                              <label class="labelquarto" for="num'.$row->cd_quarto.'">                             
                                 <input type="radio" value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                 <span>'.$row->ds_quarto.'</span>                   
                              </label><br>
                        </div> 
                         <div class="card-action">
                          Valor: R$ '.number_format($vl_quarto, 2, ',', '.').'

                        </div>                      
                      </div>
                    </div>
                  </div>';
        }
    }

     if(isset($_POST['entrada']) && isset($_POST['saida'])){
        $totalvagas = 0;        
        // Checagem das vagas da garagem        
        $entrada = implode("",$_POST['entrada']);
        $saida = implode("",$_POST['saida']);
        $checkin = create_data($entrada);
        $checkout = create_data($saida);
        $data1=date_format($checkin, 'd/m/Y');
        $data2=date_format($checkout, 'd/m/Y');
        $sql ="SELECT * FROM tb_reserva WHERE dt_checkin >='$entrada' AND dt_checkin <='$saida'";
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){ 
                $cdgaragem = $row->id_garagem;
                $sql2 ="SELECT * FROM tb_garagem WHERE cd_garagem = '$cdgaragem'";
                $resultado = $mysqli->query($sql2); 
                while($rows = $resultado->fetch_object()){
                    $vagas = $rows->nr_vagas;
                    $totalvagas += $vagas;
                } 
            }
        
        $qtdemaxima = 5 - $totalvagas;
        // if($qtdemaxima=0){
        //     echo '<script></script>';
        // }        
        echo $qtdemaxima;
        echo "<script>vagas_maximas = $qtdemaxima;
                     if(vagas_maximas<= 0)
                    {
                      
                       $('#sim').attr('disabled','disabled');
                       $('#sim').attr('onclick',M.toast({html: 'Não é possível reservar vagas: Garagem lotada!'}));
                       $('#mensagem5').fadeIn();
                    }
                </script>";       

    }
    if(isset($_POST['data1'])&&($_POST['data2']))
    {
        // Checagem dos dias de reserva
        date_default_timezone_set('America/Sao_Paulo');
        $entrada = implode("",$_POST['data1']);
        $saida = implode("",$_POST['data2']);
        $data_inicial = $entrada;
        $data_final = $saida;

        // Calcula a diferença em segundos entre as datas
        $diferenca = strtotime($data_final) - strtotime($data_inicial);

        if($diferenca == 0)
        {
          $dias = 1;
        }
        else
        {
         $dias = floor($diferenca / (60 * 60 * 24));

        }

        //Calcula a diferença em dias

        $_SESSION['total_dias'] = $dias;
                
        echo "<script>
                                total_dias = $dias;
                                valor_totalquarto = total_dias*valor_quarto;
                                $('#valorquarto').html('R$ '+valor_quarto*total_dias+' para '+total_dias+' dias');
                                valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
                                $('#valortotalreserva').html('R$ '+ valor_total_de_tudo);
                </script>";
    }

    if(isset($_POST['numeroquarto'])){
        $n = $_POST['numeroquarto'];    
        $sql = "SELECT * FROM tb_quarto WHERE cd_quarto = $n";
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){ 
                echo $row->nr_quarto;
                // echo '<script>
                //             enviar_idquarto = $n
                //     </script>';
        }

           
    }

    if(isset($_POST['numquarto'])){
        $n = $_POST['numquarto'];    
        $sql = "SELECT * FROM tb_quarto WHERE cd_quarto = '$n'";        
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){ 
                $tipo = $row->id_tipo;                
                $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$tipo'";
                $resultado = $mysqli->query($sql2); 
                while($rows = $resultado->fetch_object()){ 
                        $valor = $rows->vl_quarto;
                        $_SESSION['valor_quarto'] = $valor;
                        echo "<script>valor_quarto = $valor;
                                                valor_totalquarto = total_dias*valor_quarto;
                                                $('#valorquarto').html('R$ '+valor_quarto*total_dias+' para '+total_dias+' dias');
                                                valor_total_de_tudo = valor_totalgaragem+valor_totalquarto;
                                                $('#valortotalreserva').html('R$ '+ valor_total_de_tudo);
                               </script>";
                        //echo $valor;                        
                    } 
            } 
           
    }

    if(isset($_POST['cdreservaconf'])){
        $cd_reserva = $_POST['cdreservaconf'];
        $sql = "UPDATE tb_reserva SET id_streserva ='1' WHERE cd_reserva = $cd_reserva";
        if(!$mysqli->query($sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
        else
        {
            echo "<script> M.toast({html: 'Reserva confirmada!'});</script>";
        } 
    }
    if(isset($_POST['cdreservacanc'])){
        $cd_reserva = $_POST['cdreservacanc'];
        $sql = "UPDATE tb_reserva SET id_streserva ='3' WHERE cd_reserva = $cd_reserva";
        if(!$mysqli->query($sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
        else
        {
            echo "<script> M.toast({html: 'Reserva cancelada!'});</script>";
        } 
    }


    if(isset($_POST['cdquarto'])){
        $cdquarto = $_POST['cdquarto'];
        $sql = "DELETE FROM tb_quarto WHERE cd_quarto =$cdquarto";
        if(!$mysqli->query($sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
        else
        {
            echo "<script> M.toast({html: 'Quarto Excluído!'});</script>";
            echo '<script> M.toast({html: "Atualizando a Página!"});</script>';

        }
    }  

     if(isset($_POST['id_tipo'])){
        $id_tipo = $_POST['id_tipo'];
        if($id_tipo == 0)
        {
            $sql = "SELECT * FROM tb_quarto";                
            $result = $mysqli->query($sql); 
            while($row = $result->fetch_object())
            {
                    $tipodoquarto = $row->id_tipo;
                    $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$tipodoquarto'";  
                    $resultad = $mysqli->query($sql2); 
                    while($rows = $resultad->fetch_object())
                    { 
                        $vl_quarto = $rows->vl_quarto;                
                    }
                            if($row->cd_quarto == $_SESSION['codquarto'])
                            {
                                echo ' <div class="row">
                                                  <div class="col s12">
                                                    <label class="labelquarto" for="num'.$row->cd_quarto.'">
                                                           <div id="listagem" class="card-panel">
                                                               <div class="col s3">
                                                                   <img class="materialboxed" id="img_quarto" src="'.$row->ds_imagem.'">
                                                               </div>
                                                               
                                                               <div class="col s6">
                                                               
                                                               
                                                                  '.$row->ds_quarto.'<br>
                                                                  R$ '.number_format($vl_quarto, 2, ',', '.').'
                                                                 
                                                                </div>
                                                                <div class="col s3">
                                                                    <input type="radio" checked value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                                       <span>Nº '.$row->nr_quarto.'</span>                 
                                                                       
                                                                </div>
                                                                </label>
                                                              
                                                         </div>
                                                   
                                                 </div>
                                              </div>                                       
                                            ';
                            }
                    else if($row->id_status=='1')
                    {
                        echo ' <div class="row">
                                                  <div class="col s12">
                                                   <label class="labelquarto" for="num'.$row->cd_quarto.'">  
                                                           <div id="listagem" class="card-panel">
                                                               <div class="col s3">
                                                                   <img class="materialboxed" id="img_quarto" src="'.$row->ds_imagem.'">
                                                               </div>
                                                              
                                                               <div class="col s6">
                                                               
                                                                 
                                                                  '.$row->ds_quarto.'<br>
                                                                  R$ '.number_format($vl_quarto, 2, ',', '.').'
                                                                 
                                                                </div>
                                                                <div class="col s3">
                                                                    <input type="radio" value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                                       <span>Nº '.$row->nr_quarto.'</span>                 
                                                                       
                                                                </div>
                                                                </label>
                                                              
                                                         </div>
                                                   
                                                 </div>
                                              </div>                                       
                                            ';
                    }
                    
               }
            
        }
        else //SE FOR DIFERENTE DE 0
        {

        $sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$id_tipo'";                
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){
            $sql2 = "SELECT * FROM tb_tipo WHERE cd_tipo = '$id_tipo'";  
            $result = $mysqli->query($sql2); 
            while($rows = $result->fetch_object()){ 
                $vl_quarto = $rows->vl_quarto;                
            }
            if($row->cd_quarto == $_SESSION['codquarto'])
            {
                echo ' <div class="row">
                                                  <div class="col s12">
                                                   <label class="labelquarto" for="num'.$row->cd_quarto.'">
                                                           <div id="listagem" class="card-panel">
                                                               <div class="col s3">
                                                                   <img class="materialboxed" id="img_quarto" src="'.$row->ds_imagem.'">
                                                               </div>
                                                                
                                                               <div class="col s6">
                                                               
                                                                
                                                                  '.$row->ds_quarto.'<br>
                                                                  R$ '.number_format($vl_quarto, 2, ',', '.').'
                                                                 
                                                                </div>
                                                                <div class="col s3">
                                                                    <input type="radio" checked value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                                       <span>Nº '.$row->nr_quarto.'</span>                 
                                                                       
                                                                </div>
                                                                </label>
                                                              
                                                         </div>
                                                   
                                                 </div>
                                              </div>                                       
                                            ';
            }
            else if($row->id_status == '1')
            {
                echo ' <div class="row">
                                                  <div class="col s12">
                                                    <label class="labelquarto" for="num'.$row->cd_quarto.'">  
                                                           <div id="listagem" class="card-panel">
                                                               <div class="col s3">
                                                                   <img class="materialboxed" id="img_quarto" src="'.$row->ds_imagem.'">
                                                               </div>
                                                             
                                                               <div class="col s6">
                                                               
                                                               
                                                                  '.$row->ds_quarto.'<br>
                                                                  R$ '.number_format($vl_quarto, 2, ',', '.').'
                                                                 
                                                                </div>
                                                                <div class="col s3">
                                                                    <input type="radio" value="'.$row->cd_quarto.'" class="with-gap numerodoquarto" name="numdoquarto" id="num'.$row->cd_quarto.'">
                                                                       <span>Nº '.$row->nr_quarto.'</span>                 
                                                                       
                                                                </div>
                                                                </label>
                                                              
                                                         </div>
                                                   
                                                 </div>
                                              </div>                                       
                                            ';
            }
          }
        }

           
    }



     if(isset($_POST['inicio'])&&($_POST['fim']))
    {
        $inicio = implode($_POST['inicio']);
        $fim = implode($_POST['fim']);
        $consulta = "SELECT count(cd_reserva) as reserva , sum(vl_reserva) as lucro
                               FROM tb_reserva
                               WHERE DATE(dthr_registro)
                               BETWEEN '$inicio'
                               AND '$fim'";
        $resultado = $mysqli->query($consulta);
        while($dados = $resultado->fetch_object())
        {         
          $lucro_mes =  number_format($dados->lucro, 2, ',', '.');
          $reservas_mes = $dados->reserva;          
          echo "<script>
                            $('#ultimas_reservas').html($reservas_mes);
                            $('#ultimos_lucros').html('R$ '+$lucro_mes);



                    </script>";
        }
    }


    if(isset($_POST['senhadm']) && isset($_POST['loginadm'])){
        $login = implode("", $_POST['loginadm']);
        $senha = md5(implode("", $_POST['senhadm']));
        $sql = "SELECT * FROM tb_admin WHERE nm_login = '$login' AND ds_senha = '$senha'";
        $tipo = $mysqli->query($sql);
        if($tipo->num_rows>0){   
            $linha = $tipo->fetch_object();              
            $_SESSION['cdadmin'] = $linha->cd_admin;
            $_SESSION['nmadmin'] = $linha->nm_admin;
            $_SESSION['login'] = $linha->nm_login;
            $_SESSION['senha'] = $linha->ds_senha;
            echo "1";                            
        }
    }
?>
