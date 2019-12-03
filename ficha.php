<?php
	session_start();
	include("pdf/mpdf.php");
	include("conn.php");
	$html = '
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Ficha cadastral</title>
		</head>
		<body style="font-family: helvetica;">
			<div class="row">
				<div align="center" class="col s12">
					<img src="images/logotipo3.png" style="width: 50%;">
				</div>
			</div><br>
			<div class="row">
				<div align="center" class="col s12">
					Av. Presidente Vargas, 1001. Centro. Itanhaém - São Paulo.<br>
					Telefones: (13) 99862-3243 - VIVO / 98116-1914 - TIM.
				</div>
			</div><br>
				<table>
					<tr>
						<td align="left"><b>Nome Completo:</b></td>
						<td align="left">Igor Oliveira</td>
					</tr>
					<tr>
						<td align="left"><b>Profissão:*</b></td>
						<td align="left">Engenherio Químico</td>
					</tr>
					<tr>
						<td align="left"><b>CPF:*</b></td>
						<td align="left">518.416.788-99</td>
						<td align="left"><b>RG:*</b></td>
						<td align="left">57.249.248-0</td>
						<td align="left"><b>Órgão:*</b></td>
						<td align="left">SSP</td>
					</tr>
					<tr>
						<td align="left"><b>Endereço:*</b></td>
						<td align="left">Av. Tô Cansadinho</td>
						<td align="left"><b>Bairro:*</b></td>
						<td align="left">Centro</td>
					</tr>
					<tr>
						<td align="left"><b>CEP:*</b></td>
						<td align="left">11740-000</td>
						<td align="left"><b>Cidade/Estado:*</b></td>
						<td align="left">Itanhaém/São Paulo</td>
					</tr>
					<tr>
						<td align="left"><b>Entrada/Check-in:*</b></td>
						<td align="left">21/01/2020</td>
						<td align="left"><b>Saída/Check-out:*</b></td>
						<td align="left">23/20/2020</td>
						<td align="left"><b>Nº Quarto:*</b></td>
						<td align="left">147</td>
					</tr>
					<tr>
						<td><b>Assinatura:</b> ________________________________________________</td>
					</tr>
				</table>
		</body>
	</html>';
	$arquivo = "Ficha_cadastral.pdf";
	$mpdf = new mPDF(); 
/*	$css = file_get_contents("https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css");*/
	$css1 = file_get_contents("pdf.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($css1,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo, 'I');
?>