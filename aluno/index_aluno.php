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
        <link rel="stylesheet" type="text/css" href="../css/custom.css"> 
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Movimentações <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../movimentacoes/index_faltas.php">Gerenciar Faltas</a></li>
                            <li><a href="../movimentacoes/index_turmas.php">Gerenciar Turmas</a></li>
                            <li><a href="../movimentacoes/index_notas.php">Gerenciar Notas</a></li>
                        </ul>
                    </li>
                    <li><a href="../relatorios/index_relatorios.php">Relatórios</a></li>
                   
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
                        <br>
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
                                               
						$sql = "SELECT c.nome as nome_curso from tab_cursos c, tab_alunos a WHERE c.id = a.id_curso AND a.id_curso = :id";
                                                $stm = $conexao->prepare($sql);
                                                $stm->bindValue(':id', $aluno->id_curso);
                                                $stm->execute();
                                                $curso = $stm->fetch(PDO::FETCH_OBJ);
                                             
                                                $sql2 = "SELECT t.nome as nome_turma, t.semestre as serie_turma, t.turno as   turno_turma from tab_turmas t, tab_alunos a WHERE t.id = a.id_turma = :id";
                                                $stm = $conexao->prepare($sql2);
                                                $stm->bindValue(':id', $aluno->id_turma);
                                                $stm->execute();
                                                $turma = $stm->fetch(PDO::FETCH_OBJ);
                                                
                                                if($turma==NULL):
                                                $sql3 = "SELECT t.nome as nome_turma, t.semestre as serie_turma, t.turno as   turno_turma from tab_turmas t, tab_alunos a";
                                                $stm = $conexao->prepare($sql3);
                                                $stm->execute();
                                                $turma = $stm->fetch(PDO::FETCH_OBJ);
                                                $turma->nome_turma = "";
                                                $turma->serie_turma = "";
                                                $turma->turno_turma = "";
                                                endif;
                                                
                                               
                                                
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