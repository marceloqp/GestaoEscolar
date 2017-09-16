/* Atribui ao evento submit do formulário a função de validação de dados */
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

/* Atribui ao evento keypress do input cpf a função para formatar o CPF */
var inputCPF = document.getElementById("cpf");
if (inputCPF != null && inputCPF.addEventListener) {                   
    inputCPF.addEventListener("keypress", function(){mascaraTexto(this, '###.###.###-##')});
} else if (inputCPF != null && inputCPF.attachEvent) {                  
    inputCPF.attachEvent("onkeypress", function(){mascaraTexto(this, '###.###.###-##')});
}


/* Função para formatar dados conforme parâmetro enviado, CPF, DATA, TELEFONE e CELULAR */
function mascaraTexto(t, mask){
	var i = t.value.length;
	var saida = mask.substring(1,0);
	var texto = mask.substring(i);

	if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
	}
}
/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null) { 
	for ( var i = 0; i < linkExclusao.length; i++ ) {
		(function(i){
			var id_aluno = linkExclusao[i].getAttribute('rel');

			if (linkExclusao[i].addEventListener){
		    	linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_aluno);});
			}else if (linkExclusao[i].attachEvent) { 
				linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_aluno);});
			}
		})(i);
	}
}

/* Função para exibir um alert confirmando a exclusão do registro*/
function confirmaExclusao(id){
	retorno = confirm("Deseja excluir esse Registro?");

	if (retorno){

	    //Cria um formulário
	    var formulario = document.createElement("form");
	    formulario.action = "action_aluno.php";
	    formulario.method = "post";

		// Cria os inputs e adiciona ao formulário
	    var inputAcao = document.createElement("input");
	    inputAcao.type = "hidden";
	    inputAcao.value = "excluir";
	    inputAcao.name = "acao";
	    formulario.appendChild(inputAcao); 

	    var inputId = document.createElement("input");
	    inputId.type = "hidden";
	    inputId.value = id;
	    inputId.name = "id";
	    formulario.appendChild(inputId);

	    //Adiciona o formulário ao corpo do documento
	    document.body.appendChild(formulario);

	    //Envia o formulário
	    formulario.submit();
	}
}
/* Função para validar os dados antes da submissão dos dados */
function validaCadastro(evt){
	var nome = document.getElementById('nome');
	var cpf = document.getElementById('cpf');
	var senha = document.getElementById('senha');
	var confirmasenha = document.getElementById('confirmasenha');
	var contErro = 0;


	/* Validação do campo nome */
	caixa_nome = document.querySelector('.msg-nome');
	if(nome.value == ""){
		caixa_nome.innerHTML = "Favor preencher o Nome";
		caixa_nome.style.display = 'block';
		contErro += 1;
	}else{
		caixa_nome.style.display = 'none';
	}

	/* Validação do campo preco */
	caixa_cpf = document.querySelector('.msg-cpf');
	if(cpf.value == ""){
		caixa_cpf.innerHTML = "Favor preencher o CPF";
		caixa_cpf.style.display = 'block';
		contErro += 1;
	}else {
		caixa_cpf.style.display = 'none';
	}
        
        caixa_senha = document.querySelector('.msg-senha');
        if(senha.value == "" ){
            caixa_senha.innerHTML = "Favor digitar a senha";
            caixa_senha.style.display = 'block';
            contErro +=1;
        }else {
		caixa_senha.style.display = 'none';
	}
	
        caixa_confirmasenha = document.querySelector('.msg-confirmasenha');
        if( senha.value === confirmasenha.value){
          caixa_confirmasenha.style.display = 'none';
        
       }else { 
	caixa_confirmasenha.innerHTML = "Senha não confere";
        caixa_confirmasenha.style.display = 'block';
        contErro +=1;  	
           
	}
        
        
        if(contErro > 0){
		evt.preventDefault();
	}
}
