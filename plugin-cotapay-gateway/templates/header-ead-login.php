<?php 

// RECUPERAR DADOS SALVOS DO PLUGIN
$logo = get_field("logo",99500);
$url_pagina_principal_minha_conta = get_the_permalink(get_field("url_pagina_principal_minha_conta",99500));
$url_pagina_meus_pedidos = get_the_permalink(get_field("url_pagina_meus_pedidos",99500));
$url_pagina_meus_dados = get_the_permalink(get_field("url_pagina_meus_dados",99500));
$url_pagina_autenticacao = get_the_permalink(get_field("url_pagina_autenticacao",99500));
$titulo_saudacao = get_field("titulo_saudacao",99500);
$texto_saudacao = get_field("texto_saudacao",99500);

// TESTAR SE O USUÁRIO ESTÁ LOGADO
if(is_user_logged_in()):

  header("Location: ".$url_pagina_principal_minha_conta);

endif;

?>
<!--
#
# DIOGENES OLIVEIRA DOS SANTOS JUNIOR
# WWW.DIOGENESJUNIOR.COM.BR
# CONTATO@DIOGENESJUNIOR.COM.BR
#
-->
<!DOCTYPE html>
<html lang="pt-br"><head>
<?php
          if ( ! function_exists( '_wp_render_title_tag' ) ) {
              function theme_slug_render_title() {
          ?>
          <title><?php wp_title( '|', true, 'right' ); ?></title>
          <?php
              }
              add_action( 'wp_head', 'theme_slug_render_title' );
          }
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">


<!-- HERANÇA DO TEMA -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css?v=<?php echo date("dmYhisu"); ?>" type="text/css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/diogenes.css?v=<?php echo date("dmYHisu"); ?>" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/woocommerce.css?v=<?php echo date("dmYHisu"); ?>" type="text/css">


<link rel="stylesheet" type="text/css" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/sweetalert2.min.css">
<!-- ICONES -->
<link rel="stylesheet" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/font-awesome.min.css">

<!-- ANIMATE -->
<link rel="stylesheet" type="text/css" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/animate.css">
<!-- DROPDOWN -->
<link href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/bootstrap-dropdownhover.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;500;700&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
<!-- font-family: 'Raleway', sans-serif; font-family: 'Roboto', sans-serif; -->
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<!-- font-family: 'Lato', sans-serif; -->

<!-- ALERTS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<!-- OWL -->
<link rel="stylesheet" type="text/css" href="<?php echo get_option('home'); ?>/wp-content/plugins/plugin-minha-conta-rifa/templates/front-end/css/owl.carousel.min.css">

<?php wp_head(); ?>

</head>
<body class="login-cadastro">


