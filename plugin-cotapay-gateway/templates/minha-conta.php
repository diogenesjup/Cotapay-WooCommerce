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
                         <div class="foto-perfil" style="background: url('<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/profile.png') transparent no-repeat;background-size: cover;background-position: center center;border-radius: 100%;">
                             &nbsp;
                         </div>
                         <h3>
                             <?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?>
                             <small>
                                 <a href="<?php echo $url_pagina_meus_dados; ?>" title="editar perfil">
                                     editar perfil
                                 </a>
                             </small>
                         </h3>
                     </div>

                     <nav>
                         <ul>
                             <li class="ativo">
                                 <a href="<?php echo $url_pagina_principal_minha_conta; ?>" title="Minha Conta">Minha Conta</a>
                             </li>
                             <li>
                                 <a href="<?php echo $url_pagina_meus_pedidos; ?>" title="Pedidos">Pedidos</a>
                             </li>
                         </ul>
                     </nav>
                </div>
            </div>
            <!-- SIDEBAR -->

            <!-- CONTEUDO -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 conteudo">

                <h2 class="titulo-conteudo">Minha Conta</h2>

                <div class="row botoes-especiais">
                  
                  <!-- COLUNA
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                     <a href="<?php echo get_option('home'); ?>/minha-conta/meus-cursos" title="Meus Cursos">
                       Meus Cursos <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Meus Cursos">
                     </a>
                  </div>
                   COLUNA -->
                  
                  <!-- COLUNA -->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                     <a href="<?php echo $url_pagina_meus_pedidos; ?>" title="Pedidos">
                       Meus Pedidos <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Pedidos">
                     </a>
                  </div>
                  <!-- COLUNA -->

                  <!-- COLUNA -->
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                     <a href="<?php echo $url_pagina_meus_dados; ?>" class="continuar-curso" title="Meus dados">
                       Meus dados <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Meus dados">
                       <small>Atualize informações e dados pessoais</small>
                     </a>
                  </div>
                  <!-- COLUNA -->

                </div>

                <div class="caixa conteudo-principal">
                    
                    <h3>
                      <?php echo $titulo_saudacao; ?>
                    </h3>
                    <p>
                      <?php echo $texto_saudacao; ?>
                    </p>

                </div>
            </div>
            <!-- CONTEUDO -->

        </div>
    </div>

</section>
<!-- CONTENT DASHBOARD -->

<?php endwhile; endif; ?>
<?php require("footer-ead.php"); ?>