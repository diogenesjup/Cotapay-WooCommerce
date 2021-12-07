<?php require("header-ead-login.php"); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   

<div class="container area-login">


  <div class="row">
      
      <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 col-12">
          
          <div class="row">
            <div class="col-12 logo-login">
                <a href="<?php echo get_option('home'); ?>/" title="Voltar para o site">
                    <img src="<?php echo $logo; ?>" alt="Diogenes Junior Treinamentos e Cursos Logo" style="max-width: 300px;">
                </a>
            </div>
          </div>

          <div class="row">
             <div class="col-xl-5 col-md-5 col-lg-5 col-sm-5 col-12">
                  
                  <form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
                     
                     <div class="form-group">
                        <label>Login</label>
                        <input type="text" name="log" class="form-control" placeholder="Login" required>
                     </div>

                     <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="pwd" class="form-control" placeholder="Senha" required>
                     </div>

                     <div class="form-group">
                       <button class="btn btn-primary" type="submit">
                          Entrar Portal <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Login">
                       </button>
                     </div>

                  </form>

                  <p class="helpers">
                      <a href="javascript:void(0)" onclick="resetDeSenha()" title="Esqueci minha senha">Esqueci minha senha</a>
                  </p>

                  <div id="pass-strength-result"></div>



               </div>


               <div class="col-xl-5 col-md-5 col-lg-5 col-sm-5 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 col-12" style="margin-top:-65px;">
                  <h3 style="font-weight: bold;margin-bottom: 30px;">Cadastro</h3>
                  <form method="post" action="<?php the_permalink(); ?>">
                     
                     <input type="hidden" name="novo-cadastro" value="sim" />
                     <input type="hidden" name="cap" value="5" />

                     <div class="form-group">
                        <label>Nome Completo</label>
                        <input type="texto" name="nome" class="form-control" placeholder="Seu nome completo" required>
                     </div>

                     <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="login" class="form-control" placeholder="Endereço de E-mail" required>
                     </div>

                     <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                     </div>

                     <div class="form-group">
                       <button class="btn btn-primary">
                          Criar nova conta <img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Criar nova conta">
                       </button>
                     </div>

                  </form>

                 

               </div>
            </div>

      </div>

  </div>

</div>



<?php endwhile; endif; ?>
<?php require("footer-ead-login.php"); ?>