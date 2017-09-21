<?php
require '../conexao.php';
$conexao = conexao::getInstance();
$sql = 'SELECT id, nome   FROM tab_cursos';
$stm = $conexao->prepare($sql);
$stm->execute();
$Cursos = $stm->fetchAll(PDO::FETCH_OBJ);
// Recebe o id do cliente do cliente via GET
$id_turma = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_turma) && is_numeric($id_turma)):

	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome,curso, semestre, turno, qtd_max, qtd_matric FROM tab_turmas WHERE id LIKE :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id_turma);
	$stm->execute();
	$turma = $stm->fetch(PDO::FETCH_OBJ);

	
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Turma</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
	<div class='container'>
		<fieldset>
                    <legend style="text-align: center">Formulário - Edição de Turma</legend>
			
			<?php if(empty($turma)):?>
				<h3 class="text-center text-danger">Turma não encontrada!</h3>
			<?php else: ?>
                        <form action="action_turma.php" method="post" id='form-contato' enctype='multipart/form-data'>	
			    <div class="form-group">
			      <label for="nome">Nome</label>
                              <input type="text" class="form-control" id="nome" value="<?=$turma->nome?>" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
			    </div>

			    <div class="form-group">
                            <label for="curso">Curso</label>
			     <select class="form-control" name="curso" id="curso" >
                                <?php foreach($Cursos as $curso):?>
                                    <option value=<?=$curso->id?>><?=$curso->nome?></option>
                                <?php endforeach;?>
                              </select>
                           <!--  <span class='msg-erro msg-curso'></span> -->
                        
			    </div>
                            
                            <div class="form-group">
			      <label for="senha">Semestre</label>
                              <input type="number" class="form-control" id="senha"   name="senha" maxlength="2" max="12" min="1" placeholder="Informe o Semestre">
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
                        
			   
				    

				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id" value="<?=$turma->id?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
                                    <a href='index_turma.php' class="btn btn-danger">Cancelar</a>
			
			<?php endif; ?>
                </form>                
                          </div>
		

	<script type="text/javascript" src="../js/custom_curso.js"></script>
</body>
</html>
