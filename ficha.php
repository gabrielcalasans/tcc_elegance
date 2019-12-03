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
			</div>
			<div class="row">
				<div align="center" class="col s12">
					Av. Presidente Vargas, 1001. Centro. Itanhaém - São Paulo.<br>
					Telefones: (13) 99862-3243 - VIVO / 98116-1914 - TIM.
				</div>
			</div>
			<div class="row">
				<table>
					<tr>
						<td class="col s12"><b>Nome Completo:*</b></td>
					</tr>
					<tr>
						<td class="col s6"><b>Profissão:*</b></td>
						<td class="col s6"><b>E-mail:*</b></td>
					</tr>
					<tr>
						<td class="col s4"><b>CPF:*</b></td>
						<td class="col s4"><b>RG:*</b></td>
						<td class="col s4"><b>Órgão Exp.:*</b></td>
					</tr>
					<tr>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
					</tr>
					<tr>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
					</tr>
					<tr>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
					</tr>
					<tr>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
						<td class="col s4">lalalallaal: </td>
					</tr>
				</table>
				<div align="center" class="col s12">
					
				</div>
			</div>
		</body>
	</html>';
	$arquivo = "Ficha_cadastral.pdf";
	$mpdf = new mPDF(); 
	$css = file_get_contents("https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo, 'I');
?>