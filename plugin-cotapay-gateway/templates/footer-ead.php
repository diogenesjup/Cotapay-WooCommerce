    <div class="container">
        
        <div class="row">
            
            <div class="col-12">
                
                 <p>&nbsp;</p>
                 <p style="text-align: right;">
                   <img src="<?php echo $logo; ?>" style="margin-right: 23px;margin-top: -5px;width: 115px;" alt="<?php echo get_option('blogname'); ?>">
                 </p>
                 
            </div>

        </div>

    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/js/sweetalert2.min.js"></script>

    <script type="text/javascript">

        var idUsuario = <?php 

                            global $current_user; get_currentuserinfo();    
                            echo $current_user->ID; 

                        ?>;
         
         
    </script>
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