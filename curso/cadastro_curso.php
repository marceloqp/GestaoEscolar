<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Cursos</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body style="background-image: url(../imagens/diploma-e-mortarboard_23-2147504572.jpg);background-size: 100%; background-position: top;">
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Cadastro de Cursos</h1></legend>
			
			<form action="action_curso.php" method="post" id='form-contato' enctype='multipart/form-data'>	
			    <div class="form-group">
			      <label for="nome">Nome</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
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
                              <select class="form-control" name="periodo" id="periodo">
                                  <option>Matutino</option>
                                  <option>Diurno</option>
                                  <option>Integral</option>
                                  <option>Noturno</option>
                                  
                                  
                              </select>
			     
			    </div>
                            
			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
                            <a href='index_curso.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
            <script type="text/javascript" src="../js/custom_curso.js"></script>
	</div>
    
</body>
</html>