    <div class="container">
        
        <div class="row">
            
            <div class="col-12">
                
                 <p>&nbsp;</p>
               
                
            </div>

        </div>

    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/bootstrap.min.js"></script>

    <!-- JQUERY CONFIRM -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <?php if($_GET["erro"]=="senha"): ?>
    <script type="text/javascript">
           
            var c = $.confirm({
                                title: 'Oops, algo deu errado',
                                type: 'red',
                                content: 'Login ou senha incorretos',
                                buttons: {
                                    confirm: {
                                        text: 'Ok', // With spaces and symbols
                                        action: function () {
                                            //location.href=`actions/add-premium.php?id=${usuario}`
                                            c.close();
                                        }
                                    }
                                }
                            }); 

    </script>
    <?php endif; ?>

    <?php if($_POST["novo-cadastro"]): ?>
    <script type="text/javascript">
           
            var c = $.confirm({
                                title: 'Oops, algo deu errado',
                                type: 'red',
                                content: 'Esse e-mail já está cadastrado na nossa plataforma',
                                buttons: {
                                    confirm: {
                                        text: 'Ok', // With spaces and symbols
                                        action: function () {
                                            //location.href=`actions/add-premium.php?id=${usuario}`
                                            c.close();
                                        }
                                    }
                                }
                            }); 

    </script>
    <?php endif; ?>


    <?php if($_GET["reset"]=="sucesso" || $_POST["user_login"]): ?>
    <script type="text/javascript">
           
            var c = $.confirm({
                                title: 'Deu certo',
                                type: 'green',
                                content: 'Instruções para reset de senha enviados por e-mail',
                                buttons: {
                                    confirm: {
                                        text: 'Ok', // With spaces and symbols
                                        action: function () {
                                            //location.href=`actions/add-premium.php?id=${usuario}`
                                            c.close();
                                        }
                                    }
                                }
                            }); 

    </script>
    <?php endif; ?>

    <script type="text/javascript">
        
        function resetDeSenha(){

            var d = $.confirm({
                                title: 'Reset de senha',
                                type: 'blue',
                                content: `

                                    <form name="lostpasswordform" id="lostpasswordform" action="javascript:void(0)" method="post" onsubmit="resetarEmailUsuario()">
                                        <div class="form-group">
                                            <label>E-mail cadastrado:</label>
                                            <input type="text" name="user_login" required class="form-control" id="user_login" class="input" value="" size="20" tabindex="10">
                                        </div>
                                        

                                        <p class="submit">
                                            <button class="btn btn-primary" type="submit">
                                              Resetar senha &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/images/ball.png" alt="Reset de senha">
                                           </button>
                                        </p>

                                    </form>

                                `,
                                buttons: {
                                    confirm: {
                                        text: 'Cancelar', // With spaces and symbols
                                        action: function () {
                                            //location.href=`actions/add-premium.php?id=${usuario}`
                                            d.close();
                                        }
                                    }
                                }
                            }); 

        }


        function resetarEmailUsuario(){

              var email = $("#user_login").val();
              
              var ajaxurl = "<?php echo get_option('home'); ?>/wp-admin/admin-ajax.php";
  
                      let xhr = new XMLHttpRequest();
                       
                      xhr.open('POST', ajaxurl,true);
                      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                      var params = 'action=resetarSenhaUsuario&usuario='+email;
                      
                      // INICIO AJAX VANILLA
                      xhr.onreadystatechange = () => {

                        if(xhr.readyState == 4) {

                          if(xhr.status == 200) {

                            console.log("%c RETORNO DOS DADOS: ","background:#fff000;color:#000;");
                            //console.log(xhr.responseText);  
                            console.log(JSON.parse(xhr.responseText));  

                             var d = $.confirm({
                                title: 'Reset de senha',
                                type: 'green',
                                content: `

                                        Deu certo! Veja instruções enviadas para o seu e-mail.

                                    `,
                                    buttons: {
                                        confirm: {
                                            text: 'ok', // With spaces and symbols
                                            action: function () {
                                                //location.href=`actions/add-premium.php?id=${usuario}`
                                                d.close();
                                            }
                                        }
                                    }
                                }); 

                         
                          }else{
                            
                            console.log("SEM SUCESSO CALL AJAX resetarEmailUsuario()");
                            console.log(xhr.responseText);

                          }

                        }
                    }; // FINAL AJAX VANILLA

                    /* EXECUTA */
                    xhr.send(params);  

        }


    </script>


    
    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/sweetalert2.min.js"></script>

   

    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/wow.min.js"></script>
    <script>
         new WOW().init();
    </script>

    <?php wp_footer(); ?>

    <!-- DROPDOWN HOVER -->
    <script src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/bootstrap-dropdownhover.js"></script>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</body>
</html>