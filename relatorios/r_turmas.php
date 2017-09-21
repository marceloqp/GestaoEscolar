<link rel="stylesheet" type="text/css" href="css/custom.css"> 
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<?php
require '../conexao.php';
include ('../pdf/mpdf.php');
$conexao = conexao::getInstance();
$sql2 = "SELECT * from tab_turmas";
$stm = $conexao->prepare($sql2);
$stm->execute();
$turma = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1 style='text-align: center'>RELATÓRIO DE TURMAS</h1>";
$pagina .= "
            <table class='table table-striped ' >
		<tr class='active'>
		<th style='width: 10px; text-align: left'>CÓD</th>
		<th style='width: 110px; text-align: left'>NOME</th>
                <th style='width: 250px; text-align: left'>CURSO</th>
                <th style='width: 110px; text-align: left'>SEMESTRE</th>
                <th>TURNO</th>
                <th>QTDE MAX </th>
                <th>MATRICULADOS</th>
               
                </tr>
";
foreach($turma as $t):
$pagina .= "
    <tr>
	<td>$t->id</td>
	<td>$t->nome</td>
        <td>$t->curso</td>
        <td>$t->semestre</td>
        <td>$t->turno</td>
        <td>$t->qtd_max</td>
        <td>$t->qtd_matric</td>
    </tr>
";
endforeach;
$pagina .= "</table>";

$arquivo = "r_turmas.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');
