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

                <h2 class="titulo-conteudo">Meus Cursos</h2>

                <div class="caixa conteudo-principal">
                    
                    <p>
                      Nessa sessão você pode acompanhar seus cursos em que está matriculado:
                    </p>

                    <div class="row loop-cursos-interna">
                    <?php 

                        global $current_user; get_currentuserinfo(); 

                        $the_query = new WP_Query( 'post_type=cursos&showposts=-1&posts_per_page=-1' ); 

                        if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) : $the_query->the_post(); 

                          $produtos_do_curso = get_field("produtos_do_curso");

                          // VALIDAR A COMPRA DO PRODUTO
                          $a = 0;
                          $tem_curso_comprado = 0;
                          while($a<count($produtos_do_curso)):

                             $id_produto = $produtos_do_curso[$a];

                             if(wc_customer_bought_product( $current_user->user_email, $current_user->ID, $id_produto )):

                              $tem_curso_comprado=1;

                              $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                              $category_detail=get_the_category(get_the_ID()); // $categories[0]->name

                              ?>

                                <!-- CURSO -->
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 dashboard-loop-curso">
                                    <div class="dashboard-caixa-curso">
                                        
                                         <!-- CAPA CURSO -->
                                         <div class="capa-curso" style="background: url('<?php echo $image[0]; ?>') #f2f2f2 no-repeat;background-size: cover;background-position: center center;">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">&nbsp;
                                              <span class="badge badge-secondary"><?php echo $categories[0]->name; ?></span>
                                            </a>
                                         </div>
                                         <!-- CAPA CURSO -->

                                         <h2>
                                           <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                              <?php the_title(); ?>
                                           </a>
                                         </h2>
                                         <?php the_field("resumo_do_curso"); ?>
                                         
                                         <p>
                                           <a href="<?php the_permalink(); ?>" title="Ver curso" class="btn btn-primary">
                                              Ver curso
                                           </a>
                                         </p>

                                    </div>
                                </div>
                                <!-- CURSO -->

                              <?php

                            endif;

                            $a++;
                          endwhile;
                          // VALIDAR A COMPRA DO PRODUTO

                        endwhile;
                        wp_reset_postdata();
                        endif;

                    ?>
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