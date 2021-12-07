<?php if(!$_GET["certificado"]): ?>
<?php require("header-ead.php"); ?>
<?php 

function validarConclusaoCurso($emailUsuario, $idUsuario, $idCurso){
  
   $all_metas = get_user_meta( $idUsuario );

   $busca = $all_metas["curso_historico_conclusao"];

   $a = 0;
   while($a<count($busca)):

      $json_hist = json_decode($all_metas["curso_historico_conclusao"][$a]);

      if($json_hist->curso==$idCurso){
        return true;
      }

    $a++;

   endwhile;

   return false;

}

?>
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
                             <li><a href="<?php echo get_option('home'); ?>/minha-conta/meus-cursos" title="">Meus Cursos</a></li>
                             <li><a href="<?php echo get_option('home'); ?>/minha-conta/meus-pedidos" title="">Pedidos</a></li>
                             <li class="ativo"><a href="<?php echo get_option('home'); ?>/minha-conta/certificados" title="">Certificados</a></li>
                         </ul>
                     </nav>
                </div>
            </div>
            <!-- SIDEBAR -->

            <!-- CONTEUDO -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12 conteudo">

                <h2 class="titulo-conteudo">Meus Certificados</h2>

                <div class="caixa conteudo-principal">
                    
                    <p>
                      Nessa sessão você pode gerar os certificados dos cursos que concluiu:
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

                             if(validarConclusaoCurso( $current_user->user_email, $current_user->ID, get_the_ID() )):

                              $tem_curso_concluido=1;

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
                                           <a href="?certificado=<?php echo get_the_ID(); ?>" title="Ver curso" class="btn btn-primary" target="_blank">
                                              Acessar certificado
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
<?php endif; // IF DO GET CERTIFICADO ?>

<?php if($_GET["certificado"]): 

   global $current_user; get_currentuserinfo(); 

   $id_usuario = $current_user->ID;
   $id_curso   = $_GET["certificado"];

   $all_metas = get_user_meta( $id_usuario );

   $busca = $all_metas["curso_historico_conclusao"];

   $a = 0;
   $entrei = 0;

   while($a<count($busca)):

      $json_hist = json_decode($all_metas["curso_historico_conclusao"][$a]);

      if($json_hist->curso==$id_curso){
        $data_curso =  $json_hist->data;
        $entrei = 1;
      }

    $a++;

   endwhile;

   // USUARIO ESTA TENTANDO MUDAR A URL PARA ACESSAR O CERTIFICADO DE OUTRO CURSO
   if($entrei==0 || $id_usuario=="") header("Location: ".get_option('home')."/minha-conta/certificados");
   
         $carga_horaria_total = get_field("carga_horaria_total",$id_curso);
         $imagem_cabecalho = get_field("imagem_cabecalho",134);
         $background_marca_dagua = get_field("background_marca_dagua",134);
         $imagem_assinaturas = get_field("imagem_assinaturas",134);
         $imagem_rodape = get_field("imagem_rodape",134);
         
         $nome_curso = get_the_title($id_curso);
         $nome_aluno = $current_user->first_name ." ". $current_user->last_name;
         $texto_do_evento_cert = "Concluiu o curso <strong>".$nome_curso."</strong> com aproveitamento do treinamento, com carga horária de <strong>".$carga_horaria_total."</strong>, concluído no dia de ".$data_curso;

        // GERANDO NOVO PDF 
        $stylesheet = '@page { 
            sheet-size: A4-L; 
             margin: 0px;
             border-bottom: 10px solid #015c92;
          }

          /*---------------------------------
            IMPORTS
          -----------------------------------*/
          @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
          @media print {

           body { 
            padding: 0px !important;

             }
             h1{
              font-family: Arial; 
              color:#000;
              text-align: center;
              margin-left: 45px;
              margin-right: 45px;
              width: auto;
              padding: 25px;
              padding-top: 0px;
              font-weight: bold;
             }
             h1 strong{
              font-family: Arial; 
             }
             h2{
              font-family: Arial; 
              color: #000;
              text-align: center;
              width: auto;
              margin-top: -250px !important;
              font-size: 28px;
             }
             h2 small{
               display: block;  
               font-family: Arial; 
               font-size: 14px; 
             }
             .ementa{
              padding: 25px;
              padding-top: 0px;
              font-family: Arial !important;
              border:1px solid #666;
              margin-left: 95px;
              margin-right: 95px;
              text-align: center;
             }
             .ementa *..ementa p{
              font-family: Arial !important;
             }

          }
          ';

        $parcial = '<br><br><img src="'.$imagem_cabecalho.'" style="width:100%;height:auto;" />';

        $parcial = $parcial."<h1 style='padding-top:0;color:#028084;'>Work Medicina e Segurança do Trabalho</h1>";
        $parcial = $parcial."<h2 style='margin-top:-180px !important;color:#028084'><small style='color:#000'>certifica que</small><br> ".$nome_aluno."</h2>";

        $parcial = $parcial."<div class='ementa' style='margin-top:-45px;border:none !important;font-size:20px;line-height:30px;'>";

        $parcial = $parcial.$texto_do_evento_cert;

        $parcial = $parcial."</div>";
       

        $parcial = $parcial."<img src='".$imagem_rodape."' style='width:100%;' />";

         //echo $parcial;
       
          //require("/pdf/MPDF57/mpdf.php");
          require("pdf6/mpdf.php");

          // IMPRIMIR NA TELA

          $mpdf=new mPDF();

          $mpdf->SetWatermarkImage($background_marca_dagua);

          $mpdf->showWatermarkImage = true;
             
          $mpdf->WriteHTML($stylesheet,1);
         
          $mpdf->WriteHTML($parcial,2);
                      
          $mpdf->Output();
         
          exit();


endif; ?>