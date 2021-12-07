var posicao = 1;
var aulaAtual = 0;
var aprovado = "sim";
var controleTeste = 0;

// RECUPERAR OS DADOS DO CURSO E DO ALUNO
function obterDadosCursosUsuario(){

					  console.log("AGUARDANDO OS DADOS:");

					  var ajaxurl = homeUrl+"/wp-admin/admin-ajax.php";
  
                      let xhr = new XMLHttpRequest();
                       
                      xhr.open('POST', ajaxurl,true);
                      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                      var params = 'action=dadosCursoUsuario&curso='+idCurso+"&usuario="+idUsuario;
                      
                      // INICIO AJAX VANILLA
                      xhr.onreadystatechange = () => {

                        if(xhr.readyState == 4) {

                          if(xhr.status == 200) {

                          	console.log("%c RETORNO DOS DADOS: ","background:#fff000;color:#000;");
                            //console.log(xhr.responseText);  
                            console.log(JSON.parse(xhr.responseText));  

                            var dados = JSON.parse(xhr.responseText);   

                            // SALVAR NA MEMÓRIA
                            localStorage.setItem("dadosCursoUsuario",JSON.stringify(dados));
                            localStorage.setItem("totAulas",dados.conteudo_do_curso.length);
                           	
                           	// ALIMENTAR O HTML

                           	// AULAS
                           	var aulas = -1;

                           	$("#listaDeAulas").html(`

                           	    ${dados.conteudo_do_curso.map((n) => {
                           	    	   
                           	    	   aulas = aulas + 1;

                                       return `

                                           <li id="aula${aulas}" data-pos="${aulas}" class="nao-lido">
						                     <a href="javascript:void(0)" onclick="irParaUmaPosicaoNoCurso(${aulas})" title="${n.nome_da_aula}">
						                        <img src="${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-opacidade.svg" alt="Play"> ${n.nome_da_aula}
						                     </a>
						                  </li>                                

                                       `

                                }).join('')}
		
                           	`);

                           	// A ULTIMA AULA POR PADRAO NAO PODE SER PULADA (EXPERIMENTAL)
                           	$("#listaDeAulas li:last-child a").removeAttr("onclick");

                           	
                           	// OUTROS CONTEÚDOS
                           	$("#tituloDaAula small").html(`0${posicao}`);
                           	$("#tituloDaAula span").html(`${dados.conteudo_do_curso[0].nome_da_aula}`);

                           	$("#midiaAula").html(``);

                           	if(dados.conteudo_do_curso[0].imagem_explanacao_aula!="" && dados.conteudo_do_curso[0].imagem_explanacao_aula!=null){
                           	  
                           	   $("#midiaAula").append(`<img src="${dados.conteudo_do_curso[0].imagem_explanacao_aula}" style="width:100%;height:auto;margin-bottom:20px;" />`);
                            
                            }

                           	$("#midiaAula").append(`${dados.conteudo_do_curso[0].video_da_aula}`);

                           	$("#conteudoAula").html(`${dados.conteudo_do_curso[0].conteudo_da_aula}`);

                           	if(dados.conteudo_do_curso[0].arquivos_da_aula.length>0){

		                           	var arquivos = -1;
		                           	
		                           	$("#listaArquivos").html(`

			                           		${dados.conteudo_do_curso[0].arquivos_da_aula.map((n) => {
			                           	    	   
			                           	    	   arquivos = arquivos + 1;

			                                       return `

			                                            <!-- ARQUIVO -->
									                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
									                         <div class="arquivo">
									                             <a href="${n.arquivo.link}" target="_blank" title="${n.arquivo.title}">
									                                <img src="${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/zip.svg" alt="${n.arquivo.title}">
									                                ${n.arquivo.title}
									                                <small>${n.arquivo.filename}</small>
									                             </a>
									                         </div>
									                    </div>
									                    <!-- ARQUIVO -->                              

			                                       `

			                                }).join('')}

		                           	`);

                            }

                            // MUDAR O PLAY
                            $(`#aula${aulaAtual} img`).attr("src",`${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-ativo.svg`);
                            $(`#aula${aulaAtual}`).removeClass("nao-lido");
                            $(`#aula${aulaAtual}`).addClass("ativo");

                            // SALVAR HISTORICO DO ALUNO
                            salvarHistoricoAluno(idCurso,idUsuario,posicao,0);

                            // ATUALIZAR A BARRA DE PROGRESSO
                    		atualizarBarraProgreso(idCurso);
                           

                          }else{
                            
                            console.log("SEM SUCESSO CALL AJAX obterDados()");
                            console.log(xhr.responseText);

                          }

                        }
                    }; // FINAL AJAX VANILLA

                    /* EXECUTA */
                    xhr.send(params);


}


// CARREGANDO
function carregando(){

	console.log("CARREGANDO CONTEÚDO");
    
    $("#midiaAula").html(`

    		<div class="col-12"> 
               <p class="carregando-conteudo">
                <img src="${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/loading.gif">
                carregando conteúdo
              </p>
            </div>

    `);
	$("#conteudoAula").html(``);
	$("#listaArquivos").html(``);

}


// SALVAR HISTORICO DO ALUNO
function salvarHistoricoAluno(idCurso,idUsuario,posicao,conclusao,nota){
    
    				  var ajaxurl = homeUrl+"/wp-admin/admin-ajax.php";
  
                      let xhr = new XMLHttpRequest();
                       
                      xhr.open('POST', ajaxurl,true);
                      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                      var params = 'action=salvarHistoricoAluno&curso='+idCurso+"&usuario="+idUsuario+"&posicao="+posicao+"&conclusao="+conclusao+"&nota="+nota;
                      
                      // INICIO AJAX VANILLA
                      xhr.onreadystatechange = () => {

                        if(xhr.readyState == 4) {

                          if(xhr.status == 200) {

                          	console.log("%c RETORNO DOS DADOS HISTORICO DO ALUNO: ","background:#fff000;color:#000;");
                            //console.log(xhr.responseText);  
                            console.log(JSON.parse(xhr.responseText));  

                            var dados = JSON.parse(xhr.responseText);  
                            localStorage.setItem("historicoAluno",JSON.stringify(dados));

 						  }else{
                            
                            console.log("SEM SUCESSO CALL AJAX salvarHistoricoAluno()");
                            console.log(xhr.responseText);

                          }

                        }

                    }; // FINAL AJAX VANILLA

                    /* EXECUTA */
                    xhr.send(params);

}

// ATUALIZAR A BARRA DE PROGRESSO
function atualizarBarraProgreso(idCurso){
   
   // CONVERTER O TITPO
   idCurso = idCurso.toString();
   var totAulas = localStorage.getItem("totAulas");
   var totAulasOriginal = totAulas;
   totAulas--;
   
   var dados = JSON.parse(localStorage.getItem("historicoAluno"));
   var numAula = 1;
   var jaConcluido = 0;

   var historicoCurso = dados.metas.curso_historico;
   var historicoTestes = dados.metas.curso_historico_teste;
   var historicoConclusao = dados.metas.curso_historico_conclusao;

   // SE O USUÁRIO JÁ TIVER CONCLUIDO O CURSO, VAMOS DAR 100% LOGO
   for(let i = 0;i<historicoConclusao.length;i++){

   		var histTemp = JSON.parse(historicoConclusao[i]);
   		
   		if(histTemp.curso==idCurso){
   			
   			console.log("USUARIO JA CONCLUIU O CURSO");
   			jaConcluido = 1;

   			$(".progress-bar").css("width","100%");
   			$(".progress-bar").attr("aria-valuenow","100");
   			$(".progress-bar").html("100%");

   			// LEVAR O USUÁRIO PARA A ULTIMA AULA
   			irParaUmaPosicaoNoCurso(totAulas);
   			i = historicoConclusao.length + 1;

   			/*
   			$( "#listaDeAulas li" ).addClass("assistido");
   			$( "#listaDeAulas li" ).removeClass("nao-lido");

   			$( "#listaDeAulas li.ativo img" ).attr("src",`${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-opacidade.svg`);
			*/
   		}

   }

   // CONTABILIZAR AS OUTRAS AULAS QUE O USUARIO JA DEVE TER ASSISTIDO
   for(let i = 0;i<historicoCurso.length;i++){

   		var histTemp = JSON.parse(historicoCurso[i]);
   		var pos = histTemp.posicao;

   		if(histTemp.curso==idCurso){
   			pos--;
   			$(`#aula${pos}`).removeClass("nao-lido");
   			$(`#aula${pos}`).addClass("assistido");
   		}

   }

   progredirBarraDeProgresso();

}

// PROGREDIR A BARRA DE PROGRESSO
function progredirBarraDeProgresso(){

	var totAulasOriginal = localStorage.getItem("totAulas");
	var numClasses = 0;

	// SÖ PRECISAMOS ATUALIZAR A BARRA DE PROGRESSO SE O ALUNO NAO TIVER CONCLUIDO O CURSO AINDA
	if($(".progress-bar").attr("aria-valuenow")!=100){
		
		$( "li.assistido" ).each(function() {
		
			numClasses++;

		});

	    var resultadoMedia = totAulasOriginal / numClasses * 100;

	    // ATUALIZAR O HTML DA BARRA DE PROGRESSO
	    $(".progress-bar").css("width",`${resultadoMedia}%`);
   		$(".progress-bar").attr("aria-valuenow",resultadoMedia);
   		$(".progress-bar").html(`${resultadoMedia}%`);

    }

}


// TROCAR O HTML DO BOTAO DE INICIAR OU CONTINUAR O CURSO
function processarBotaoIniciarOuContinuarCurso(){

   var dados = JSON.parse(localStorage.getItem("historicoAluno"));
   var historicoCurso = dados.metas.curso_historico;
   var historicoTestes = dados.metas.curso_historico_teste;
   var historicoConclusao = dados.metas.curso_historico_conclusao;

   for(let i = 0;i<historicoCurso.length;i++){

	   		var histTemp = JSON.parse(historicoCurso[i]);
	   		var pos = histTemp.posicao;

	   		if(histTemp.curso==idCurso){
	   			
	   			$(".cta a").attr("title","Continuar Curso");
	   			$(".cta a").html("Continuar Curso");
	   		}

   }

}




// DIRECIONAR O USUÁRIO PARA UMA AULA ESPECIFICA
function irParaUmaPosicaoNoCurso(aondeQuerIr){

	posicao = aondeQuerIr;
    aulaAtual = aondeQuerIr-1;

    proximaAula();

}



// SHUFFLE DIVS
$.fn.shuffleChildren = function() {
    $.each(this.get(), function(index, el) {
        var $el = $(el);
        var $find = $el.children();

        $find.sort(function() {
            return 0.5 - Math.random();
        });

        $el.empty();
        $find.appendTo($el);
    });
};

// IR PARA A PRÓXIMA AULA
function proximaAula(){

	carregando();

	// FORÇAR VOLTAR AO TOPO
	$('html').scrollTop(0);

	var dados = JSON.parse(localStorage.getItem("dadosCursoUsuario"));
	var totAulas = localStorage.getItem("totAulas");
	var j = 0;
	var k = 0;
	var m = 0;
	var imagemPergunta;

	posicao++;
    aulaAtual++;

	if(posicao<=totAulas){

	setTimeout(function(){

							// ALIMENTAR O CONTEÚDO
							$("#actionCaixaTeste").html(``);
							$("#caixaTeste").css("opacity",0);

							$("#contentCaixaTeste").html("");
							$("#actionCaixaTeste").html("");
							

                           	// OUTROS CONTEÚDOS
                           	$("#tituloDaAula small").html(`0${posicao}`);
                           	$("#tituloDaAula span").html(`${dados.conteudo_do_curso[aulaAtual].nome_da_aula}`);

                           	$("#midiaAula").html(``);

                           	if(dados.conteudo_do_curso[aulaAtual].imagem_explanacao_aula!="" && dados.conteudo_do_curso[aulaAtual].imagem_explanacao_aula!=null){
                           	  
                           	   $("#midiaAula").append(`<img src="${dados.conteudo_do_curso[aulaAtual].imagem_explanacao_aula}" style="width:100%;height:auto;margin-bottom:20px;" />`);
                            
                            }

                           	$("#midiaAula").append(`${dados.conteudo_do_curso[aulaAtual].video_da_aula}`);

                           	$("#conteudoAula").html(`${dados.conteudo_do_curso[aulaAtual].conteudo_da_aula}`);

                           	if(dados.conteudo_do_curso[aulaAtual].arquivos_da_aula.length>0){

		                           	var arquivos = -1;
		                           	
		                           	$("#listaArquivos").html(`

			                           		${dados.conteudo_do_curso[aulaAtual].arquivos_da_aula.map((n) => {
			                           	    	   
			                           	    	   arquivos = arquivos + 1;

			                                       return `

			                                            <!-- ARQUIVO -->
									                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
									                         <div class="arquivo">
									                             <a href="${n.arquivo.link}" target="_blank" title="${n.arquivo.title}">
									                                <img src="${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/zip.svg" alt="${n.arquivo.title}">
									                                ${n.nome_do_arquivo}
									                                <small>${n.arquivo.filename}</small>
									                             </a>
									                         </div>
									                    </div>
									                    <!-- ARQUIVO -->                              

			                                       `

			                                }).join('')}

		                           	`);

                            }

                            // MUDAR O PLAY
                            var menosUm = aulaAtual - 1;

                            $(`#listaDeAulas li.ativo`).addClass("assistido");
                            $(`#listaDeAulas li`).removeClass("ativo");

                            $(`#aula${menosUm} img`).attr("src",`${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-opacidade.svg`);
                            $(`#aula${menosUm}`).removeClass("nao-lido");
                            $(`#aula${menosUm}`).addClass("assistido");

                            $(`#aula${aulaAtual} img`).attr("src",`${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-ativo.svg`);
                            $(`#aula${aulaAtual}`).removeClass("nao-lido");
                            $(`#aula${aulaAtual}`).removeClass("assistido");
                            $(`#aula${aulaAtual}`).addClass("ativo");

                            // SALVAR HISTORICO DO ALUNO
                            salvarHistoricoAluno(idCurso,idUsuario,posicao,0);

                            // MUDAR O TEXTO E A  URL DO BOTAO PROXIMO
                            if(posicao==totAulas){

                            	$(".btn-proxima-aula").html(`CONCLUIR <img src="${homeUrl}/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/ball.png" alt="PRÓXIMA AULA">`);
  					            //$(".btn-proxima-aula").attr(`href`,homeUrl+"/minha-conta");

  								$(".btn-proxima-aula").attr(`onclick`,"etapasConcluirCurso()");

                            }

                            // SE TIVERMOS TESTE NA AULA
                            // ANTES DE IRMOS PARA A PRÓXIMA AULA, VAMOS VER SE A AULA TEM TESTE
							for(let i = 0;i<dados.testes.length;i++){

									j = i + 1;

									// TEMOS TESTE!	
									if(dados.testes[i].id_teste==dados.conteudo_do_curso[aulaAtual].teste_da_aula){
										
										// LIMPAR O HTML
										$("#midiaAula").html(``);
										//$("#conteudoAula").html(``);
										$("#caixaTeste").css("opacity",1);

										localStorage.setItem("idTesteEmAndamento",dados.testes[i].id_teste);
										localStorage.setItem("usuario_pode_repetir_o_teste",dados.testes[i].usuario_pode_repetir_o_teste);
										localStorage.setItem("nota_minima_para_aprovacao",dados.testes[i].nota_minima_para_aprovacao);

										$(".conteudo-da-aula").append(`

										  <h4>${dados.testes[i].titulo_do_teste}</h4>
						                  <p>${dados.testes[i].conteudo_apoio_do_teste}</p>

										`);
										

										$("#contentCaixaTeste").html(`

												   <form method="post" action="javascript:void(0)" onsubmit="corrigirTeste()">	
						                         
						                           ${dados.testes[i].questoes_do_teste.map((n) => {
									                           	    	   
									                    k = k + 1;
									                    m = 0;
									                    
									                       if(n.imagem_da_pergunta!=false){
												                 imagemPergunta = `
												                     <p>
													                  <img src="${n.imagem_da_pergunta}" style="width:100%;height:auto" />
													                 </p>
												                 `;
											                }else{
											                 	imagemPergunta = ``;
											                }

									                       return `

									                       	   <div id="perguntaContainer${k}">

									                           <h2>
											                     ${k} - ${n.titulo_da_pergunta}
											                   </h2>
											                   <p>
											                     ${n.texto_apoio_da_pergunta}
											                   </p>

											                   ${imagemPergunta}
											                     
											                   <div class="area-testes">

											                       ${n.alternativas.map((o) => {

											                       		m = m + 1;
											                       		

											                       		return `
											                       			
											                       			

												                       		<div class="form-check">
													                          <input class="form-check-input" type="radio" name="pergunta${k}" required id="pergunta${k}Alt${m}" value="${o.texto_da_alternativa}" texto-pergunta="${n.titulo_da_pergunta}" texto-alternativa="${o.texto_da_alternativa}" data-peso="${n.peso_da_pergunta}" data-correcao="${o.correta_ou_incorreta}">
													                          <label class="form-check-label" for="alt${m}">
													                            ${o.texto_da_alternativa}
													                          </label>
													                       </div>  

											                       		`;

											                       }).join('')}
											                          

											                   </div>
											                   <hr>
											                   </div> <!-- FIM CONTAINER PERGUNTA -->
											                   

									                       `

									               }).join('')}

									               </form>

										`);

										// EMBARALHAR AS ALTERNATIVAS
										$(".area-testes").shuffleChildren();

										$("#actionCaixaTeste").html(`

											     <div class="row">
						                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-um">
						                               <a href="javascript:void(0)" onclick="$('form').submit();" class="btn btn-primary" title="RESPONDER">
						                                   RESPONDER
						                               </a>
						                           </div>
						                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-dois text-right">
						                               <span id="totQuestoes">${dados.testes[i].questoes_do_teste.length}</span> Questões
						                           </div>
						                         </div>

									    `);

									}
							} // FIM FOR DO TESTE

	}, 1500);

  }

}

// CORRIGIR O TESTE
function corrigirTeste(){

	 var idTesteEmAndamento = localStorage.getItem("idTesteEmAndamento",idTesteEmAndamento);
	 var peso = 0;
	 var nota = 0;
	 var feedback = new Array();
	 var textosPerguntas = new Array();
	 var textosAlternativas = new Array();
	 var a = 0;
	 var acertos = 0;
	 var totalRespostas = 0;

	 // FORÇAR VOLTAR AO TOPO
	 $('html').scrollTop(0);

	 // PEGAR TODAS AS RESPOSTAS
	 $( ".form-check-input" ).each(function() {
	    
	    if ($(this).prop('checked')) {

	    	totalRespostas++;

	    	textosPerguntas.push($(this).attr("texto-pergunta"));
	    	textosAlternativas.push($(this).attr("texto-alternativa"));

            if($(this).attr("data-correcao")=="Correta"){
 				nota = nota + parseInt( $(this).attr("data-peso") );

 				feedback.push("sim");
 				acertos++;
            
            }else{
            
            	feedback.push("nao");
            
            }
        }

	 });

	 console.log("NOTA DO ALUNO: "+nota);

	 var nota_minima_para_aprovacao = parseInt(localStorage.getItem("nota_minima_para_aprovacao"));


	 // SALVAR HISTORICO DO ALUNO
     if(nota>=nota_minima_para_aprovacao){

     	salvarHistoricoAluno(idCurso,idUsuario,posicao,1,nota);

     	aprovado="sim";
     
     }else{
     
     	aprovado="nao";
     
     }
     
     //carregando();

     //console.log("RESULTADO DA AVALIAÇÃO:");
     //console.log(textosPerguntas);
     //console.log(textosAlternativas);
     //console.log(feedback);
     //console.log(feedback[2]);

     // ALIMENTAR COM AS RESPOSTAS E OS FEEDBACKS
     $("#contentCaixaTeste").html("");
	 $("#actionCaixaTeste").html("");

     for(let p = 0;p<textosPerguntas.length;p++){

         // FEEDBACK DE ACERTO		
     	 if(feedback[p]=="sim"){
     	 	$("#contentCaixaTeste").append(`

     	 		       <h2>
                         <span><i class="fa fa-check-circle" aria-hidden="true"></i></span> ${textosPerguntas[p]}
                       </h2>

                       <p>
                       	Sua resposta: ${textosAlternativas[p]}
                       </p>

                       <div class="alert alert-success" role="alert">
                          <b>Parabéns!</b> Resposta correta
                       </div>

                       <hr/>
     	 			
     	 	`);

     	 // FEEDBACK DE ERRO
     	 }else{
     	 	$("#contentCaixaTeste").append(`

     	 			   <h2>
                         <span><i class="fa fa-times-circle" aria-hidden="true"></i></span> ${textosPerguntas[p]}
                       </h2>

                       <p>
                       	Sua resposta: ${textosAlternativas[p]}
                       </p>

                       <div class="alert alert-danger" role="alert">
                         <b>Oops!</b> Respostas incorreta.
                       </div>

                       <hr/>

     	 	`);
     	 }	
         		
     }

     // CALCULAR A NOTA FINAL
     var resultadoMedia = totalRespostas / acertos * 100;

     // IMPRIMIR O HTML DO RESULTADO (NOTA/MEDIA)
     if(nota>=nota_minima_para_aprovacao){

		     $("#conteudoAula").html(`

		     		<h4>Resultado do teste: <span style="color: #8BC34A;">${nota}</span>
		            <small style="display:block;font-size: 13px;font-weight: normal;color: #747474;padding-top:12px;">Você foi aprovado no teste</small></h4>

		     `);

     }else{

     		 $("#conteudoAula").html(`

		     		<h4>Resultado do teste: <span style="color: #ff0000;">${nota}</span>
		            <small style="display:block;font-size: 13px;font-weight: normal;color: #747474;padding-top:12px;">Você foi reprovado no teste, nota mínima: ${nota_minima_para_aprovacao}</small></h4>

		     `);

     }


     $("#actionCaixaTeste").html(`

     	  	<div class="row">
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-um action-tentar-novamente">
                       <a href="javascript:void(0)" onclick="repetirTeste();" class="btn btn-default" title="FAZER NOVAMENTE">
                          FAZER NOVAMENTE
                       </a>
                   </div>
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-um text-right">
                       <a href="javascript:void(0)" onclick="finalizarTeste();" class="btn btn-primary" title="FINALIZAR">
                           FINALIZAR
                       </a>
                   </div>
            </div>

     `);

     // USUARIO PODE REPETIR O TESTE?
     if(localStorage.getItem("usuario_pode_repetir_o_teste")!="Sim"){
     	$(".action-tentar-novamente").fadeOut();
     }

}


// REPETIR O TESTE (CASO DISPONIVEL ESA OPÇAO)
function repetirTeste(){

	console.log("REINICIANDO O TESTE:");

	// ENGANAR OS CONTROLES
	posicao--;
    aulaAtual--;

    // REINICIAR
	proximaAula();

}


// FINALIZAR
function finalizarTeste(){

	// PRÓXIMO
	proximaAula();

}


// TENTAR FINALIZAR O CURSO, CASO O ALUNO TENHA TIDO NOTA DE APROVAÇÃO
function etapasConcluirCurso(){

	                if(aprovado=="sim"){

  							var b = $.confirm({
	                            title: 'Você concluiu o curso!',
	                            type: 'green',
	                            columnClass: 'large',
	                            content: 'Você concluiu todas as aulas desse curso',
	                            buttons: {
	                                confirm: {
	                                    text: 'Voltar para Minha Conta', // With spaces and symbols
	                                    action: function () {
	                                        //location.href=`actions/add-premium.php?id=${usuario}`
	                                        b.close();
	                                        location.href=homeUrl+"/minha-conta";
	                                    }
	                                },
	                                cats: {
	                                    text: 'Ir para certificados', // With spaces and symbols
	                                    action: function () {
	                                        //location.href=`actions/add-premium.php?id=${usuario}`
	                                        b.close();
	                                        location.href=homeUrl+"/certificados";
	                                    }
	                                }
	                                
	                            }
	                        });	

  							// SALVAR CONCLUSÃO
	                        salvarHistoricoAluno(idCurso,idUsuario,posicao,2);

  					}else{

  						var b = $.confirm({
	                            title: 'Você quase conseguiu!',
	                            type: 'blue',
	                            columnClass: 'large',
	                            content: 'Para concluir esse curso, você precisa ser aprovado em todos os testes. Que tal tentar novamente?',
	                            buttons: {
	                                confirm: {
	                                    text: 'Voltar para Minha Conta', // With spaces and symbols
	                                    action: function () {
	                                        //location.href=`actions/add-premium.php?id=${usuario}`
	                                        b.close();
	                                        location.href=homeUrl+"/minha-conta";
	                                    }
	                                },
	                                cats: {
	                                    text: 'Recomeçar curso', // With spaces and symbols
	                                    action: function () {
	                                        //location.href=`actions/add-premium.php?id=${usuario}`
	                                        b.close();
	                                        location.href=urlCurso;
	                                    }
	                                }
	                                
	                            }
	                        });	

  					}

}



