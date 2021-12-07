<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit; // SAIR DA PÁGINA SE ACESSADA DIRETAMENTE PELO NAVEGADOR HTTP 80
}

?>
<style type="text/css">
  .wrap h1{
    display: none;
  }
  .diogenes-box{
     position: relative;
      display: block;
      background: #fff;
      border: 0px solid #ccc;
      padding: 30px;
      padding-top: 20px;
      padding-bottom: 65px;
      margin-top: 25px;
      border-radius: 14px;
      max-width: 90%;
  }

  .diogenes-col{
    position: relative;
    display: block;
    width: 95%;
  }

  .diogenes-col h2.titulo{
    font-size: 24px;
  }

  .stats-box{
      padding-top: 22px;
  }

  .stats-box .stats{
    position: relative;
      display: inline-block;
      float: none;
      background: #f0f0f0;
      width: 25%;
      margin-right: 14px;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 20px;
      padding-top: 0px;
  }
    
    .stats-box .stats h2{
       font-weight: bold;
      font-size: 32px;
      line-height: unset;
      text-align: right;
      line-height: 2px;

    }
  .stats-box .stats h2 small{
    display: block;
      font-weight: bold;
      font-size: 15px;
      color: #000;
      padding-bottom: 16px;
      float: left;
  }

  .stats-box .stats a, .stats-box .stats a:hover{
    height: auto;
      padding: 0 16px;
      float: right;
      margin: 0 0px 0 0;
      border-radius: 5px;
      border: 1px solid #FFF;
      background: 0;
      font: 600 10px/31px "Poppins",Arial,sans-serif;
      color: #FFF;
      background: #CB17A5;
      text-decoration: none;
  }
  /*

  .diogenes-box table{
    position: relative;
      background: #f2f2f2;
      width: 500px;
      max-width: 100%;
      margin-top: 30px;
  }
  #retornoFiltroCotas table{
    padding: 20px;
  }

  #retornoFiltroCotas table thead{
    text-align: left !important;
  }

  #retornoFiltroCotas table thead th{
    padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
      padding-top: 10px;
  }
  */

  .acf-form-submit{
    padding-top: 20px;
  }

  footer{
    text-align: right;
  }

  .acf-field.acf-field-image.acf-field-604537f299967,
  .acf-field.acf-field-repeater.acf-field-603383374d4fd{
    display: none !important;
  }
  

</style>

<div class="diogenes-box">
   
   <div class="diogenes-col">

      <h2>Configurações Integração <img src="https://www.cotapay.com.br/images/logo/Cabecalho.png" style="width:190px;height:auto;vertical-align: middle;margin-left: 7px;"></h2>
      <p>&nbsp;</p>

    <?php acf_form_head(); ?>
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
      
        <?php acf_form(array(
            'post_id'       => 34343,
            'post_title'    => false,
            'post_content'  => false,
            'submit_value'  => __('Atualizar Informações'),
            'html_updated_message'  => '<div id="message" class="updated"><p>Informações atualizadas com sucesso!</p></div>',
        )); ?>
     
        </div><!-- #content -->
    </div><!-- #primary -->


  </div>

</div>