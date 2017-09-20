<!DOCTYPE html>
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
                    <li><a href="../aluno/index_aluno.php">Gerenciamento de Alunos </a></li>
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
                    <li><a href="index_relatorios.php">Relatórios</a></li>
                
                </ul>
      
            </div>
            </div>
        </nav>
        <br>
        
    <div class="dropdown">
        <a style="" class="btn btn-info " data-toggle="dropdown">
    RELATÓRIO DE ALUNOS
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
      <li><a href="r_alunos.php">Lista de Alunos</a></li>
      <li><a href="r_alunos_turma.php">Alunos por Turma</a></li>
      <li><a href="r_alunos_faltas.php">Relatorio de Frequencia</a></li>
      <li><a href="r_alunos_nota.php">Notas</a></li>
      
  </ul>
        <a href='r_cursos.php' class="btn btn-info">LISTAGEM DE CURSOS</a>
        <a href='r_turmas.php' class="btn btn-info">LISTAGEM DE TURMAS</a>
</div>
     
    </body>
