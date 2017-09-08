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
			<legend>Formulário - Edição de Alunos</legend>
			
			<?php if(empty($aluno)):?>
				<h3 class="text-center text-danger">Cliente não encontrado!</h3>
			<?php else: ?>
				<form action="action_aluno.php" method="post" id='form-contato' enctype='multipart/form-data'>
					

				    <div class="form-group">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$aluno->nome?>" placeholder="Infome o Nome">
				      <span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
				      <label for="cpf">CPF</label>
				      <input type="cpf" class="form-control" id="cpf" maxlength="14" name="cpf" value="<?=$aluno->cpf?>" placeholder="Informe o CPF">
				      <span class='msg-erro msg-cpf'></span>
				    </div>
				    <div class="form-group">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha" value="<?=$aluno->senha?>" maxlength="16" placeholder="Informe a Senha">
                                         <span class='msg-erro msg-senha'></span>
                                    </div>
				    <div class="form-group">
                                        <label for="confirmasenha">Confirma Senha</label>
                                        <input type="password" class="form-control" id="confirmasenha" name="confirmasenha" value="<?=$aluno->senha?>" maxlength="16" placeholder="Confirme a Senha">
                                        <span class='msg-erro msg-confirmasenha'></span> 
                                    </div>
				    <div class="form-group">
                                        <label for="curso">Curso</label>
                                        <select class="form-control" name="curso" id="curso">
                                            
                                        <?php foreach($Cursos as $curso):?>
                                        <option value=<?=$curso->id?>><?=$curso->nome?></option>
                                        <?php endforeach;?>
                                        </select>
                                   <!--  <span class='msg-erro msg-curso'></span> -->
                        
			    </div>
				    

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?=$aluno->id?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
                                    <a href='index_aluno.php' class="btn btn-danger">Cancelar</a>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="../js/custom_aluno.js"></script>
</body>
</html>