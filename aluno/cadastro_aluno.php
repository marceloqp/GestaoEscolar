<?php
require '../conexao.php';

$conexao = conexao::getInstance();
$sql = "SELECT * from tab_cursos";
$stm = $conexao->prepare($sql);
$stm->execute();
$Cursos = $stm->fetchAll(PDO::FETCH_OBJ);

$conexao = conexao::getInstance();
$sql = "SELECT * from tab_turmas";
$stm2 = $conexao->prepare($sql);
$stm2->execute();
$Turmas = $stm2->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Alunos</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Cadastro de Alunos</h1></legend>
			
			<form action="action_aluno.php" method="post" id='form-contato' enctype='multipart/form-data'>	
			    <div class="form-group">
			      <label for="nome">Nome</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
			    </div>

			    <div class="form-group">
			      <label for="cpf">CPF</label>
			      <input type="cpf" class="form-control" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF">
			      <span class='msg-erro msg-cpf'></span>
			    </div>
                            
                            <div class="form-group">
			      <label for="senha">Senha</label>
                              <input type="password" class="form-control" id="senha" name="senha" maxlength="16" placeholder="Informe a Senha">
			      <span class='msg-erro msg-senha'></span> 
			    </div>
                            
                            <div class="form-group">
			      <label for="confirmasenha">Confirma Senha</label>
                              <input type="password" class="form-control" id="confirmasenha" name="confirmasenha" maxlength="16" placeholder="Confirme a Senha">
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
			    
                            
			    
                             
			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
                            <a href='index_aluno.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
    <script type="text/javascript" src="../js/custom_aluno.js"></script>
</body>
</html>