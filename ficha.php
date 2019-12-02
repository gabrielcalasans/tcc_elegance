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
		<body>
			<table border="3">
				<tr>
					<td>ihuuu</td>
					<td>aaaaaaaaaa</td>
				</tr>
			</table>
		</body>
	</html>';
	$arquivo = "Ficha_cadastral.pdf";
	$mpdf = new mPDF(); 
	$css = file_get_contents("css/pdf.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo, 'I');
?>