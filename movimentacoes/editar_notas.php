<?php
require '../conexao.php';

// Recebe o id do cliente do cliente via GET
$id_aluno = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_aluno) && is_numeric($id_aluno)):

	// Captura os dados do cliente solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome, cpf, senha, id_curso FROM tab_alunos WHERE id = :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id_aluno);
	$stm->execute();
	$aluno = $stm->fetch(PDO::FETCH_OBJ);

	$conexao = conexao::getInstance();
        $sql = "SELECT * from tab_cursos";
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $Cursos = $stm->fetchAll(PDO::FETCH_OBJ);

endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Alunos</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
	<div class='container'>
		<fieldset>
                    <legend style="text-align: center">Lançamento de Notas</legend>
			
			<?php if(empty($aluno)):?>
				<h3 class="text-center text-danger">Aluno não encontrado!</h3>
			<?php else: ?>
                                <form action="action_movimentacoes.php" method="post" id='form-contato' enctype='multipart/form-data'>
					
                                    

				    <input type="hidden" name="acao" value="notas">
				    <input type="hidden" name="id" value="<?=$aluno->id?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
                                    <a href='index_notas.php' class="btn btn-danger">Cancelar</a>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="../js/custom_aluno.js"></script>
</body>
</html>