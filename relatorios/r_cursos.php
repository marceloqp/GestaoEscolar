<?php
require '../conexao.php';
include ('../pdf/mpdf.php');
$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, semestre, periodo   FROM tab_cursos';
$stm = $conexao->prepare($sql);
$stm->execute();
$cursos = $stm->fetchAll(PDO::FETCH_OBJ);
$pagina = "";

$pagina .= "<h1 style='text-align: center'>RELATÓRIO DE CURSOS</h1>";

$pagina .= "
    <table class=table table-striped width=100% >
    <tr>
        <th style='width: 10px; text-align: left'>Código</th>
        <th style='width: 190px; text-align: left'>Nome do Curso</th>
        <th style='width: 110px; text-align: left'> Semestres</th>
        <th style='width: 40px; text-align: left'>Período</th>
    </tr>
";
foreach($cursos as $curso):
$pagina .= "                                               
						
    <tr>
        <td style='width: 10px; text-align: left'>$curso->id</td>
	<td style='width: 200px; text-align: left'>$curso->nome</td>
        <td style='width: 60px; text-align: left'>$curso->semestre</td>
        <td style='width: 50px; text-align: left'>$curso->periodo</td>
";
endforeach;
$pagina .= "</table>";

$arquivo = "r_alunos.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>