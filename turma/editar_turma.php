<?php
require '../conexao.php';

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
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$turma->nome?>" placeholder="Infome o Nome">
				      <span class='msg-erro msg-nome'></span>
				    </div>

				    <div class="form-group">
			      <label for="semestre">Quantidade de Semestres</label>
                              <select class="form-control" name="semestre" id="semestre">
                                  <option>6 semestres</option>
                                  <option>8 semestres</option>
                                  <option>10 semestres</option>
                                  <option>12 semestres</option>
                                  
                                  
                              </select>
			      
			    </div>
                            
                            <div class="form-group">
			      <label for="periodo">Período de Aulas </label>
                              <select class="form-control" name="periodo"  id="periodo">
                                  <option>Matutino</option>
                                  <option>Diurno</option>
                                  <option>Integral</option>
                                  <option>Noturno</option>
                                  
                                  
                              </select>
			     
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
