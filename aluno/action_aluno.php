<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Sistema de Cadastro de Alunos</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container box-mensagem-crud'>
		<?php 
		require '../conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id    = (isset($_POST['id'])) ? $_POST['id'] : '';
		$nome  = (isset($_POST['nome'])) ? $_POST['nome'] : '';
		$cpf   = (isset($_POST['cpf'])) ? str_replace(array('.','-'), '', $_POST['cpf']): '';
		$id_curso = (isset($_POST['curso'])) ? $_POST['curso'] : '';
		$id_turma = (isset($_POST['turma'])) ? $_POST['turma'] : '';
                $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';


		// Valida os dados recebidos
		$mensagem = '';
		if ($acao == 'editar' && $id == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
	    endif;

	    // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'):
			if ($nome == '' || strlen($nome) < 3):
				$mensagem .= '<li>Favor preencher o Nome.</li>';
		    endif;

			if ($cpf == ''):
			   $mensagem .= '<li>Favor preencher o CPF.</li>';
		    elseif(strlen($cpf) < 11):
				  $mensagem .= '<li>Formato do CPF inválido.</li>';
		    endif;
			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;
		endif;



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$sql = 'INSERT INTO tab_alunos (nome, cpf, id_curso, id_turma, senha)
							   VALUES(:nome,:cpf, :curso, :turma, :senha)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':cpf', $cpf);
			$stm->bindValue(':curso', $id_curso);
			$stm->bindValue(':turma', $id_turma);
			$stm->bindValue(':senha', $senha);
			
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_aluno.php'>";
		endif;


		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'):

			if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0): 

				// Verifica se a foto é diferente da padrão, se verdadeiro exclui a foto antiga da pasta
				if ($foto_atual <> 'padrao.jpg'):
					unlink("fotos/" . $foto_atual);
				endif;

				$extensoes_aceitas = array('bmp' ,'png', 'svg', 'jpeg', 'jpg');
			    $extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));

			     // Validamos se a extensão do arquivo é aceita
			    if (array_search($extensao, $extensoes_aceitas) === false):
			       echo "<h1>Extensão Inválida!</h1>";
			       exit;
			    endif;
 
			     // Verifica se o upload foi enviado via POST   
			     if(is_uploaded_file($_FILES['foto']['tmp_name'])):  
			             
			          // Verifica se o diretório de destino existe, senão existir cria o diretório  
			          if(!file_exists("fotos")):  
			               mkdir("fotos");  
			          endif;  
			  
			          // Monta o caminho de destino com o nome do arquivo  
			          $nome_foto = date('dmY') . '_' . $_FILES['foto']['name'];  
			            
			          // Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino  
			          if (!move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$nome_foto)):  
			               echo "Houve um erro ao gravar arquivo na pasta de destino!";  
			          endif;  
			     endif;
			else:

			 	$nome_foto = $foto_atual;

			endif;

			$sql = 'UPDATE tab_clientes SET nome=:nome, email=:email, cpf=:cpf, data_nascimento=:data_nascimento, telefone=:telefone, celular=:celular, status=:status, foto=:foto ';
			$sql .= 'WHERE id = :id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':email', $email);
			$stm->bindValue(':cpf', $cpf);
			$stm->bindValue(':data_nascimento', $data_ansi);
			$stm->bindValue(':telefone', $telefone);
			$stm->bindValue(':celular', $celular);
			$stm->bindValue(':status', $status);
			$stm->bindValue(':foto', $nome_foto);
			$stm->bindValue(':id', $id);
                        //echo(var_dump($stm));
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_cliente.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

			
			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM tab_alunos WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index_aluno.php'>";
		endif;
		?>

	</div>
</body>
</html>