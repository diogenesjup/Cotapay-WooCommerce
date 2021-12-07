    <!-- SIDEBAR EM CURSO -->
    <div class="sidebar-em-curso">
         
         <!-- VOLTAR -->
         <div class="row header-sidebar">
            <div class="col-9">
                
                <a href="<?php echo get_option('home'); ?>/minha-conta" title="VOLTAR" class="btn btn-primary">
                   <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/ball-outro-lado.png" alt="VOLTAR"> VOLTAR
                </a>

            </div>
            <div class="col-3 esconder-desktop">
                <a href="javascript:void(0)" onclick="abrirFecharNavegacaoEmCurso();" title="Fechar o menu">
                   <i class="fa fa-times"></i>
                </a>
            </div>
         </div>
         <!-- VOLTAR -->

         <!-- INDICE CURSO -->
         <div class="indice-curso">
           
              <h1><?php the_title(); ?></h1>

              <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>

              <nav>
                <ul id="listaDeAulas">
                  <!--
                  <li class="assistido">
                    <a href="#" title="Aula 01 - Nome da lição ou módulo">
                        <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/play-opacidade.svg" alt="Play"> Aula 01 - Nome da lição ou módulo
                    </a>
                  </li>
                -->
                  
                </ul>
              </nav>

         </div>
         <!-- INDICE CURSO -->


    </div>
    <!-- SIDEBAR EM CURSO -->

    <!-- AREA EM CURSO -->
    <div class="area-em-curso">

       <section class="header-area-em-curso">
          <div class="row">
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-10 coluna-um">
                  <h2 id="tituloDaAula">
                    <small></small> 
                    <span></span>
                  </h2>
              </div>
              <div class="col-2 navegacao-em-curso-mobile">
                 <a href="javascript:void(0)" onclick="abrirFecharNavegacaoEmCurso();" title="Abrir o menu">
                    <i class="fa fa-bars"></i>
                 </a>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 coluna-dois text-right">
                  <a href="javascript:void(0)" onclick="proximaAula();" title="PRÓXIMA AULA" class="btn btn-primary  btn-proxima-aula">
                      PRÓXIMA AULA  <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/ball.png" alt="PRÓXIMA AULA">
                  </a>
              </div>
          </div>
       </section>

       <section class="work-area-em-curso" id="workAreaEmCurso">
           
           
           <div class="row">
              <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 capa-aula-interna" id="midiaAula">
                  
                     <div class="col-12"> 
                       <p class="carregando-conteudo">
                         <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/loading.gif">
                         carregando conteúdo
                       </p>
                     </div>

              </div>
           </div>


           <!-- CONTEUDO AULA -->
           <div class="row">
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 offset-xl-2 offset-lg-2 offset-md-2 offset-sm-2 conteudo-da-aula" id="conteudoAula">
                  
                     

              </div>
           </div>
           <!-- CONTEUDO AULA -->


           <!-- AREA DE ARQUIVOS -->
           <div class="row">
             <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 offset-xl-2 offset-lg-2 offset-md-2 offset-sm-2 arquivos-da-aula">

                 <div class="row" id="listaArquivos">

                     <!-- ARQUIVO 
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                         <div class="arquivo">
                             <a href="#" title="Nome do arquivo, ou título do tema">
                                <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/zip.svg" alt="Nome do arquivo">
                                Nome do arquivo, ou título do tema
                                <small>Subtítulo ou call to action</small>
                             </a>
                         </div>
                     </div>
                     ARQUIVO -->

                 </div>

             </div>
           </div>
           <!-- AREA DE ARQUIVOS -->



           <!-- AREA TESTE -->
           <div class="row">
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 offset-xl-2 offset-lg-2 offset-md-2 offset-sm-2">
                    <div class="caixa-teste" id="caixaTeste" style="opacity: 0;">
                       
                       <!-- CONTEUDO DO TESTE -->
                       <div id="contentCaixaTeste"></div> 
                       <!-- CONTEUDO DO TESTE -->

                       <!-- ACTIONS DO TESTE -->
                       <div id="actionCaixaTeste">
                       </div>
                       <!-- ACTIONS DO TESTE -->


                   </div>

              </div>
           </div> 
           <!-- AREA TESTE -->




       </section>

       <!-- FOOTER -->
       <section class="footer-area-em-curso">
           <div class="row">
               <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 offset-xs-1 offset-lg-1 offset-md-1 offset-sm-1 col-12">
                    
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 coluna-um">
                            
                            <a href="<?php echo get_option('home'); ?>/minha-conta">
                               <img src="<?php echo get_option('home'); ?>/wp-content/uploads/2021/06/logo.png" alt="Diogenes Junior Treinamentos e Cursos">
                            </a>

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 coluna-dois text-right">
                            <a href="javascript:void(0)" onclick="proximaAula();" title="PRÓXIMA AULA" class="btn btn-primary btn-proxima-aula">
                                PRÓXIMA AULA <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/ball.png" alt="PRÓXIMA AULA">
                            </a>
                        </div>
                    </div>

               </div>
           </div>
       </section>
       <!-- FOOTER -->

    </div>
    <!-- AREA EM CURSO -->

