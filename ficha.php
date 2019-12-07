<?php
	if(isset($_GET['cli'])){
		include("conn.php");
		include("pdf/mpdf.php");
		function mask($val, $mask){
	 		$maskared = '';
	 		$k = 0;
	 		for($i = 0; $i<=strlen($mask)-1; $i++){
	 			if($mask[$i] == '#'){
	 				if(isset($val[$k]))
	 				$maskared .= $val[$k++];
	 			}
	 			else{
	 				if(isset($mask[$i]))
	 				$maskared .= $mask[$i];
	 			}
			}
	 		return $maskared;
		}
		$sql = "SELECT *
			from tb_cliente cli
			inner join tb_profissao pro on ( pro.cd_profissao = cli.id_profissao )
			inner join tb_endereco ende on ( ende.cd_endereco = cli.id_endereco )
			inner join tb_cidade cid on ( cid.cd_cidade = ende.id_cidade )
			inner join tb_estado est on ( est.cd_estado = cid.id_estado )
			inner join tb_reserva res on ( res.id_cliente = cli.cd_cliente )
			inner join tb_quarto qua on ( res.id_quarto = qua.cd_quarto )
			inner join tb_tipo tip on ( tip.cd_tipo = qua.id_tipo )
			inner join tb_garagem gar on ( gar.cd_garagem = res.id_garagem )
			where cd_cliente = ".$_GET['cli'];
		$result = $mysqli->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_object();
			$checkin = date_create($row->dt_checkin);
			$checkout = date_create($row->dt_checkout);
			$nascimento = date_create($row->dt_nascimento);
			if($row->nr_vagas > 0){
       			$diferenca = strtotime($row->dt_checkout) - strtotime($row->dt_checkin);
       			$dias = floor($diferenca / (60 * 60 * 24));
				$vagas = $row->nr_vagas - 1;
				$dia = $vagas * 50.00;
				$custo = $dias * $dia;
				$garagem = "Sim";
			}
			else{
				$garagem = "Não";
				$custo = 0.00;
			}
			if($row->nr_telefone){
				$telefone = mask($row->nr_telefone, "(##) ####-####");
			}
			else{
				$telefone = "Não cadastrado";
			}
			$html = '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<title>#'.$row->cd_cliente.$row->cd_reserva.'_Ficha cadastral | Hospedagem Elegance</title>
				</head>
				<body style="font-family: helvetica;">
					<div align="center">
						<img src="images/logotipo3.png" style="width: 50%;">
					</div><br>
					<div align="center">
						Av. Presidente Vargas, 1001. Centro. Itanhaém - São Paulo.<br>
						Telefones: (13) 99862-3243 - VIVO / 98116-1914 - TIM.
					</div><br>
						<h3 align="center">Dados cadastrais</h3>
						<div class="tabela">
							<table>
								<tr>
									<td align="left"><b>Nome Completo:</b> '.$row->nm_cliente.' '.$row->nm_sobrenome.'</td>
									<td align="right"><b>Data de Nascimento:</b> '.date_format($nascimento, 'd/m/Y').'</td>
								</tr>
							</table>
							<table>
								<tr>
									<td align="left"><b>E-mail:</b> '.$row->nm_email.'</td>
									<td align="center"><b>Profissão:</b> '.$row->nm_profissao.'</td>
									<td align="right"><b>Celular:</b> '.mask($row->nr_celular, "(##) #####-####").'</td>
								</tr>
							</table>
							<table>
								<tr>
									<td align="left"><b>CPF:</b> '.mask($row->nr_cpf, '###.###.###-##').'</td>
									<td align="center"><b>RG:</b> '.mask($row->nr_rg, '##.###.###-#').'</td>
									<td align="right"><b>Órgão Exp.:</b> '.$row->ds_orgao.'</td>
								</tr>
							</table>	
							<table>
								<tr>
									<td align="left"><b>Endereço:</b> '.$row->nm_endereco.',  '.$row->nr_endereco.'</td>
									<td align="right"><b>Bairro:</b> '.$row->nm_bairro.'</td>
								</tr>
							</table>	
							<table>
								<tr>
									<td align="left"><b>Telefone:</b> '.$telefone.'</td>
									<td align="center"><b>CEP:</b> '.mask($row->nr_cep, '#####-###').'</td>
									<td align="right"><b>Cidade/Estado:</b> '.$row->nm_cidade.'/'.$row->ds_uf.'</td>
								</tr>
							</table>
						</div><br>
						<h3 align="center">Quarto</h3>
						<div class="tabela">
							<table>
								<tr>
									<td align="left"><b>Tipo:</b> '.$row->nm_tipo.'</td>
									<td align="center"><b>Diária:</b> R$'.number_format($row->vl_quarto, 2, ",", ".").'</td>
									<td align="right"><b>Nº Quarto:</b> '.$row->nr_quarto.'</td>
								</tr>
							</table>
							<table>
								<tr>
									<td align="left"><b>Descrição:</b> '.$row->ds_tipo.'</td>
								</tr>
							</table>
						</div><br>
						<h3 align="center">Reserva</h3>
						<div class="tabela">
							<table>
								<tr>
									<td align="left"><b>Entrada/Check-in:</b> '.date_format($checkin, 'd/m/Y').'</td>
									<td align="center"><b>Saída/Check-out:</b> '.date_format($checkout, 'd/m/Y').'</td>
									<td align="right"><b>Garagem:</b> '.$garagem.'</td>
								</tr>
							</table>
							<table>
								<tr>
									<td align="left"><b>Nº Vagas:</b> '.$row->nr_vagas.'</td>
									<td align="center"><b>Custo adicional:</b> R$'.number_format($custo, 2, ",", ".").'</td>
									<td align="right"><b>Total:</b> R$'.number_format($row->vl_reserva, 2, ",", ".").'</td>
								</tr>
							</table>
						</div>
						<br><br><br>
						<table>
							<tr>
								<td align="center"><b>Assinatura do Cliente:</b> ______________________________________</td>
							</tr>
						</table>
				</body>
			</html>';
			$arquivo = "#".$row->cd_cliente.$row->cd_reserva."_Ficha.pdf";
			$mpdf = new mPDF(); 
			$css = file_get_contents("pdf.css");
			$mpdf->WriteHTML($css,1);
			$mpdf->WriteHTML($html);
			$mpdf->Output($arquivo, 'I');
		}
	}
	else{
		header('Location: ver_reserva.php');
	}
?>