<?php
require '../conexao.php';
$conexao = conexao::getInstance();
$sql = 'SELECT id, nome   FROM tab_cursos';
$stm = $conexao->prepare($sql);
$stm->execute();
$Cursos = $stm->fetchAll(PDO::FETCH_OBJ);



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
			<legend><h1>Formulário - Cadastro de Turmas</h1></legend>
			
			<form action="action_turma.php" method="post" id='form-contato' enctype='multipart/form-data'>	
			    <div class="form-group">
			      <label for="nome">Nome</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
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
                            
                            <div class="form-group">
			      <label for="senha">Semestre</label>
                              <input type="number" class="form-control" id="senha" name="senha" maxlength="2" max="12" min="1" placeholder="Informe o Semestre">
			      <span class='msg-erro msg-senha'></span> 
			    </div>
                            
                            <div class="form-group">
			      <label for="periodo">Turno </label>
                              <select class="form-control" name="periodo" id="periodo">
                                  <option>Matutino</option>
                                  <option>Diurno</option>
                                  <option>Integral</option>
                                  <option>Noturno</option>
                                  
                                  
                              </select>
			     
			    </div>
                            <div class="form-group">
			      <label for="senha">Quantidade Máxima de Alunos</label>
                              <input type="number" class="form-control" id="senha" name="senha" maxlength="2" max="99" min="1" placeholder="Informe o Semestre">
			      <span class='msg-erro msg-senha'></span> 
			    </div>
			    
			    
                            
			    
                             
			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
                            <a href='index_turma.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
    <script type="text/javascript" src="../js/custom_turma.js"></script>
</body>
</html>