    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/sweetalert2.min.js"></script>

    <!-- JQUERY CONFIRM -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script type="text/javascript">
        
        // DECLARAR VARIAVEIS GLOBAIS
        var homeUrl   = "<?php echo get_option('home'); ?>";
        var idCurso   = <?php echo get_the_ID(); ?>;
        var urlCurso  = "<?php echo get_the_permalink(); ?>";
        var idUsuario = <?php 

                            global $current_user; get_currentuserinfo();    
                            echo $current_user->ID; 

                        ?>;

    </script>

    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/controllers.js?v=<?php echo date("dmYHisu"); ?>"></script>
    
    <script type="text/javascript">
        
        // OBTER OS DADOS
        setTimeout(function(){ 

            obterDadosCursosUsuario();

        }, 1500);
        
    </script>

    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/wow.min.js"></script>
    <script>
         new WOW().init();
    </script>

    <?php wp_footer(); ?>

    <!-- DROPDOWN HOVER -->
    <script src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-diogenes-lms/templates/front-end/js/bootstrap-dropdownhover.js"></script>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</body>
</html>