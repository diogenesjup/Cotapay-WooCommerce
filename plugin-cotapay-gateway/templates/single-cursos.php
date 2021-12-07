<?php if($_GET["em-curso"]=="sim"): ?>

      <?php 

        require("header-ead-em-curso.php");
          if ( have_posts() ) : while ( have_posts() ) : the_post(); 

               require("em-curso.php");

           endwhile; endif;
         require("footer-ead-em-curso.php");
         
      ?>   

<?php else: ?>

      <?php require("header-ead.php"); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         
      <!-- CONTENT DASHBOARD -->
      <section class="content-dashboard">
          
          <div class="container">
              <div class="row">
                  
                  <!-- SIDEBAR -->
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                      <div class="caixa sidebar">
                           <div class="header">
                               <div class="foto-perfil" style="background: url('<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/images/profile.png') transparent no-repeat;background-size: cover;background-position: center center;border-radius: 100%;">
                                   &nbsp;
                               </div>
                               <h3>
                                   <?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?>
                                   <small>
                                       <a href="<?php echo get_option('home'); ?>/minha-conta/editar-perfil" title="editar perfil">
                                           editar perfil
                                       </a>
                                   </small>
                               </h3>
                           </div>

                           <nav>
                               <ul>
                                   <li>
                                       <a href="<?php echo get_option('home'); ?>/minha-conta" title="">Minha Conta</a>
                                   </li>
                                   <li class="ativo"><a href="<?php echo get_option('home'); ?>/minha-conta/meus-cursos" title="">Meus Cursos</a></li>
                                   <li><a href="<?php echo get_option('home'); ?>/minha-conta/meus-pedidos" title="">Pedidos</a></li>
                                   <li><a href="<?php echo get_option('home'); ?>/minha-conta/certificados" title="">Certificados</a></li>
                               </ul>
                           </nav>
                      </div>
                  </div>
                  <!-- SIDEBAR -->

                  <!-- CONTEUDO -->
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 conteudo">

                      <h2 class="titulo-conteudo"><?php the_title(); ?></h2>


                      <div class="caixa conteudo-principal dashboard-curso">
                          
                          <div class="row">
                             <!-- COLUNA UM -->
                             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-um">
                                 
                                 <div style="position: sticky;top: 0;left: 0;display: block;">
                                       <?php 

                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

                                     ?>
                                     <!--
                                       <div class="capa-curso">
                                          &nbsp;
                                       </div>
                                     -->
                                     <p>
                                        <img src="<?php echo $image[0] ?>" style="width: 100%;" alt="<?php the_title(); ?>">
                                     </p>
                                     
                                     <h4>Seu Progresso</h4>
                                     <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                     </div>

                                     <!--
                                     <h4>Professores</h4>
                                     <h5>
                                       <div class="foto-professor">
                                         &nbsp;
                                       </div>
                                       <b>Nome do Professor</b><br>
                                       Oferece uma interessante oportunidade para verificação dos índices pretendidos.
                                     </h5>
                                     <h5>
                                       <div class="foto-professor">
                                         &nbsp;
                                       </div>
                                       <b>Nome do Professor</b><br>
                                       Oferece uma interessante oportunidade para verificação dos índices pretendidos.
                                     </h5>
                                     -->

                                     <div class="cta" style="margin-top: -26px;margin-bottom: 25px;">
                                      <a href="<?php the_permalink(); ?>/?em-curso=sim" title="Iniciar Curso" class="btn btn-primary">
                                         Iniciar Curso
                                      </a>
                                    </div>
                                 </div>

                             </div>
                             <!-- COLUNA UM -->

                             <!-- COLUNA DOIS -->
                             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 coluna-dois">

                                <h4>Sobre esse curso</h4>
                                <?php echo get_field("resumo_do_curso"); ?>

                                <h4>Conteúdo</h4>
                                <?php echo get_field("conteudo_do_curso_total"); ?>

                                <h4>Aulas</h4>
                                
                                <?php

                                      if( have_rows('conteudo_do_curso') ):
                                          $num_aulas=0;
                                          while ( have_rows('conteudo_do_curso') ) : the_row();

                                ?>
                                     <p><i style="opacity: 0.5;" class="fa fa-check-circle" aria-hidden="true"></i> <?php the_sub_field("nome_da_aula"); ?></p>
                                <?php

                                          $num_aulas++;
                                          endwhile;
                                     endif;

                               ?>

                                <!--
                                <h3>
                                  <span>Valor do Curso</span>
                                  R$ 899,00
                                  <small>Em até 12x de R$ 89,90</small>
                                </h3>
                                -->

                                <!--<div class="cta">
                                  <a href="<?php the_permalink(); ?>/?em-curso=sim" title="Comprar ou iniciar Curso" class="btn btn-primary">
                                     Comprar ou iniciar Curso
                                  </a>
                                </div>-->

                             </div>
                             <!-- COLUNA DOIS -->

                          </div>

                      </div>

                      
                  </div>
                  <!-- CONTEUDO -->

              </div>
          </div>

      </section>
      <!-- CONTENT DASHBOARD -->

      <?php endwhile; endif; ?>
      <?php require("footer-ead.php"); ?>

<?php endif; ?>