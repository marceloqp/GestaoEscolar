<?php
require '../conexao.php';
// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';
// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome, cpf, senha, id_curso,id_turma FROM tab_alunos';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$alunos = $stm->fetchAll(PDO::FETCH_OBJ);
else:
	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT id, nome, cpf, senha, id_curso,id_turma FROM tab_alunos WHERE nome LIKE :nome OR id LIKE :id';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':nome', $termo.'%');
        $stm->bindValue(':id', $termo.'%');
	$stm->execute();
	$alunos = $stm->fetchAll(PDO::FETCH_OBJ);
endif;
?>




<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>SISTEMA DE GESTÃO ESCOLAR</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>    
    <body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
        <nav class=" navbar-light" style="background-color: #CAE1FF; font-weight: bold;" >
            <div class="container-fluid">
            <div class=" navbar-light navbar-header  ">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Home</a>
            </div>
            <div class="collapse navbar-collapse" >
                <ul class="nav navbar-nav navbar-light">
                    <li><a href="index_aluno.php">Gerenciamento de Alunos </a></li>
                    <li><a href="../curso/index_curso.php">Gerenciamento de Cursos</a></li>
                    <li> <a href="../turma/index_turma.php">Gerenciamento de Turmas</a></li>
                    <li><a href="../movimentacoes/index_movimentacoes.php">Movimentações</a></li>
                    <li><a href="../relatorios/index_relatorios.php">Relatórios</a></li>
                    <li><a href="../contato.php">Contato</a></li>
                </ul>
      
            </div>
        </div>
    </nav>
     <div class='container'>
		<fieldset>

			<!-- Cabeçalho da Listagem -->
			<legend align="center"><h1>Listagem de Alunos</h1></legend>

			<!-- Formulário de Pesquisa -->
			<form align="center" action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o Nome ou RA">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <a href='index_aluno.php' class="btn btn-primary">Ver Todos</a>
			</form>

			<!-- Link para página de cadastro -->
                        <a href='../aluno/cadastro_aluno.php' class="btn btn-success pull-right">Cadastrar Aluno</a>
                        
                        
			<div class='clearfix'></div>

			<?php if(!empty($alunos)):?>

				<!-- Tabela de Clientes -->
                                <table class="table table-striped " style="background-color: #d9edf7;">
					<tr class='active'>
						<th>RA</th>
						<th>NOME</th>
						<th>CPF</th>
						<th>CURSO</th>
						<th>TURMA</th>
						<th>Ação</th>
					</tr>
					<?php foreach($alunos as $aluno):
                                               
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
                                                
                                                
                                                
                                                
                                                
                                                ?>
                                                <tr>
							<td><?=$aluno->id?></td>
							<td><?=$aluno->nome?></td>
							<td><?=$aluno->cpf?></td>
							<td><?=$curso->nome_curso?></td>
							<td><?=$turma->nome_turma?>, <?=$turma->serie_turma?> , <?=$turma->turno_turma?></td>
							<td>
								<a href='editar_aluno.php?id=<?=$aluno->id?>' class="btn btn-primary">Editar</a>
								<a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$aluno->id?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				<!-- Mensagem caso não exista alunos ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem alunos cadastrados!</h3>
			<?php endif; ?>
		</fieldset>
	</div>
        <script type="text/javascript" src="../js/custom_aluno.js"></script>   
    </body>
</html>    