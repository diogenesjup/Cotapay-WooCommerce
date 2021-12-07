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
                             <li>
                                 <a href="<?php echo $url_pagina_principal_minha_conta; ?>" title="Minha Conta">Minha Conta</a>
                             </li>
                             <li class="ativo">
                                 <a href="<?php echo $url_pagina_meus_pedidos; ?>" title="Pedidos">Pedidos</a>
                             </li>
                         </ul>
                     </nav>
                </div>
            </div>
            <!-- SIDEBAR -->

            <!-- CONTEUDO -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 conteudo">

                <h2 class="titulo-conteudo">Editar perfil</h2>

                <div class="caixa conteudo-principal">
                    
                    <p>
                     Nessa área você pode atualizar o seu perfil e outras informações
                    </p>

                    <form method="post" action="<?php the_permalink(); ?>">
                        
                        <div class="row">

                            <div class="form-group col-6">
                              <label for="first-name">Primeiro nome</label>
                              <input class="text-input form-control" name="first_name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                            </div>

                            <div class="form-group col-6">
                              <label for="last-name">Sobrenome</label>
                              <input class="text-input form-control" name="last_name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                            </div>

                            <div class="form-group col-6">
                              <label for="billing_email">E-mail</label>
                              <input class="text-input form-control" name="billing_email" type="text" id="billing_email" value="<?php the_author_meta( 'billing_email', $current_user->ID ); ?>" />
                            </div>

                            <div class="form-group col-6">
                              <label for="billing_cellphone">Celular</label>
                              <input class="text-input form-control" name="billing_cellphone" type="text" id="billing_cellphone" value="<?php the_author_meta( 'billing_cellphone', $current_user->ID ); ?>" />
                            </div>

                            <div class="form-group col-6">
                              <label for="password">Senha de acesso</label>
                              <input class="text-input form-control" name="password" type="text" id="password" value="" placeholder="Alterar senha" />
                            </div>

                        </div>

                        <div class="row">

                        <div class="form-group col-12 text-right">
                           <button type="submit" class="btn btn-default" style="border:1px solid #ccc;min-width: 200px;">Atualizar informações</button>
                        </div>

                        </div>


                    </form>

                    <?php 

                      // ATUALIZAR OS DADOS
                      if ( !empty( $_POST['first_name'] ) )
                       update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first_name'] ) );

                     if ( !empty( $_POST['last_name'] ) )
                       update_user_meta( $current_user->ID, 'last_name', esc_attr( $_POST['last_name'] ) );

                     if ( !empty( $_POST['billing_email'] ) )
                       update_user_meta( $current_user->ID, 'billing_email', esc_attr( $_POST['billing_email'] ) );

                     if ( !empty( $_POST['billing_cellphone'] ) )
                       update_user_meta( $current_user->ID, 'billing_cellphone', esc_attr( $_POST['billing_cellphone'] ) );

                     if ( !empty( $_POST['password'] ) && $_POST['password']!="" )
                        wp_set_password( $_POST['password'], $current_user->ID );
                       
                    ?>

                </div>
            </div>
            <!-- CONTEUDO -->

        </div>
    </div>

</section>
<!-- CONTENT DASHBOARD -->


<?php endwhile; endif; ?>
<?php require("footer-ead.php"); ?>