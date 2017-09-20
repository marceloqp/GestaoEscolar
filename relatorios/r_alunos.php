<link rel="stylesheet" type="text/css" href="css/custom.css"> 
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<?php
require '../conexao.php';
include ('../pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, cpf, id_curso,id_turma FROM tab_alunos';
$stm = $conexao->prepare($sql);
$stm->execute();
$alunos = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1 style='text-align: center'>RELATÓRIO DE ALUNOS</h1>";

$pagina .= "
        <table class=table table-striped width=100%>
          <tr>
            <th style='width: 20px; text-align: left'>RA</th>
            <th style='width: 100px; text-align: left'>Nome</th>
            <th style='width: 10px; text-align: left'>CPF</th>
            <th style='width: 200px; text-align: center'>Curso</th>
            <th style='width: 100px; text-align: left'>Turma</th>
           
          </tr>
";

foreach($alunos as $aluno):
    $sql = "SELECT c.nome as nome_curso from tab_cursos c, tab_alunos a WHERE c.id = a.id_curso = :id";
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':id', $aluno->id_curso);
    $stm->execute();
    $curso = $stm->fetch(PDO::FETCH_OBJ);
                                               
    $sql2 = "SELECT t.nome as nome_turma, t.serie as serie_turma, t.turno as   turno_turma from tab_turmas t, tab_alunos a WHERE t.id = a.id_turma = :id";
    $stm = $conexao->prepare($sql2);
    $stm->bindValue(':id', $aluno->id_turma);
    $stm->execute();
    $turma = $stm->fetch(PDO::FETCH_OBJ);
$pagina .= "
          
         <tr>
            <td style='width: 20px; text-align: left'>$aluno->id</td>
            <td style='width: 200px; text-align: left'>$aluno->nome</td>
            <td style='width: 10px; text-align: left'>$aluno->cpf</td>
            <td style='width: 300px; text-align: left'>$curso->nome_curso</td>
            <td style='width: 100px; text-align: left'>$turma->nome_turma, $turma->serie_turma , $turma->turno_turma</td>
        </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "r_alunos.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>