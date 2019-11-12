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
            echo '<div class= "modal-content>"';
            echo '<h4>'.$row->nm_tipo.'</h4>';
            echo '<p>'.$row->ds_tipo.'</p>';
            echo '</div>';

        }
           
    }
    if(isset($_POST['exibir']) && isset($_POST['entrada']) && isset($_POST['saida'])){
        $exibir = implode($_POST['exibir']);
        $entrada = implode($_POST['entrada']);
        $saida = implode($_POST['saida']);
        $sql = "SELECT * FROM tb_quarto WHERE id_tipo = '$exibir' AND id_status = '1'";                
        $result = $mysqli->query($sql); 
        while($row = $result->fetch_object()){
            echo '<label for="'.$row->cd_quarto.'"><div class="card-panel"><input type="radio" class="with-gap" name="ola" id="'.$row->cd_quarto.'"><span>'.$row->ds_quarto.'</span></div></label><br>';
        }
    }
?>
