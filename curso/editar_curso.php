<?php
require '../conexao.php';

// Recebe o id do cliente do cliente via GET
$id_curso = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_curso) && is_numeric($id_curso)):

	// Captura os dados do cliente solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome,semestre, periodo FROM tab_cursos WHERE id = :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id', $id_curso);
	$stm->execute();
	$curso = $stm->fetch(PDO::FETCH_OBJ);

	
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Cursos</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
	<div class='container'>
		<fieldset>
			<legend>Formulário - Edição de Cursos</legend>
			
			<?php if(empty($curso)):?>
				<h3 class="text-center text-danger">Curso não encontrado!</h3>
			<?php else: ?>
				<form action="action_curso.php" method="post" id='form-contato' enctype='multipart/form-data'>
					

				    <div class="form-group">
				      <label for="nome">Nome</label>
				      <input type="text" class="form-control" id="nome" name="nome" value="<?=$curso->nome?>" placeholder="Infome o Nome">
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
				    <input type="hidden" name="id" value="<?=$curso->id?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
                                    <a href='index_curso.php' class="btn btn-danger">Cancelar</a>
			
			<?php endif; ?>
                          </div>
		

	<script type="text/javascript" src="../js/custom_curso.js"></script>
</body>
</html>


