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
                echo "<script>localStorage.setItem('tipoquarto','$rows->nm_tipo');</script>";

            }

            echo '<div class="row">
                    <div class="col s12 m3">
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
                  </div>';
        }
    }
     if(isset($_POST['entrada']) && isset($_POST['saida'])){
        $totalvagas = 0;        
        $entrada = implode("",$_POST['entrada']);
        $saida = implode("",$_POST['saida']);
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
        echo 5-$totalvagas;
    }
    if(isset($_POST['numeroquarto'])){
        $n = $_POST['numeroquarto'];    
        echo $n;
           
    }  

?>
