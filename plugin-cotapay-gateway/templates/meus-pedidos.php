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

                <h2 class="titulo-conteudo">Meus pedidos</h2>

                <div class="caixa conteudo-principal woocommerce">

                    <?php if(!$_GET["pedido"]): ?>

                    <p>Veja abaixo os seus últimos pedidos:</p>
                    
                    <?php 


                      $my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
                        'order-number'  => __( 'Order', 'woocommerce' ),
                        'order-date'    => __( 'Date', 'woocommerce' ),
                        'order-status'  => __( 'Status', 'woocommerce' ),
                        'order-total'   => __( 'Total', 'woocommerce' ),
                        'order-actions' => '&nbsp;',
                      ) );

                      $customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
                        'numberposts' => $order_count,
                        'meta_key'    => '_customer_user',
                        'meta_value'  => get_current_user_id(),
                        'post_type'   => wc_get_order_types( 'view-orders' ),
                        'post_status' => array_keys( wc_get_order_statuses() ),
                      ) ) );

                      if ( $customer_orders ) : 

                    ?>

                    <table class="shop_table shop_table_responsive my_account_orders">

                        <thead>
                          <tr>
                            <?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
                              <th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
                            <?php endforeach; ?>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ( $customer_orders as $customer_order ) :
                            $order      = wc_get_order( $customer_order );
                            $item_count = $order->get_item_count();
                            ?>
                            <tr class="order">
                              <?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
                                <td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
                                  <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
                                    <?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

                                  <?php elseif ( 'order-number' === $column_id ) : ?>
                                    <a href="?pedido=<?php echo $order->get_order_number(); ?>">
                                      <?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?>
                                    </a>

                                  <?php elseif ( 'order-date' === $column_id ) : ?>
                                    <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

                                  <?php elseif ( 'order-status' === $column_id ) : ?>
                                    <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

                                  <?php elseif ( 'order-total' === $column_id ) : ?>
                                    <?php
                                    /* translators: 1: formatted order total 2: total order items */
                                    printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );
                                    ?>

                                  <?php elseif ( 'order-actions' === $column_id ) : ?>
                                    <?php
                                    $actions = wc_get_account_orders_actions( $order );
                      
                                    if ( ! empty( $actions ) ) {
                                      foreach ( $actions as $key => $action ) {
                                        echo '<a href="?pedido=' . $order->get_order_number()  . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
                                      }
                                    }
                                    ?>
                                  <?php endif; ?>
                                </td>
                              <?php endforeach; ?>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    <?php endif; ?>

                    <?php endif; // IF DO GET DO PEDIDO ?>

                    <?php if($_GET["pedido"]): ?>
                    <?php 

                      $pedido = $_GET["pedido"];
                      $order_id = $pedido;

                      $order = wc_get_order( $order_id );

                    ?>
                    <h3>Pedido: #<?php echo $pedido; ?>
                      
                      <a href="<?php echo $url_pagina_meus_pedidos; ?>" class="btn btn-default" style="float: right;border: 1px solid #f2f2f2;font-size: 14px;" title="Voltar">
                       <i style="padding-right: 10px;" class="fa fa-angle-left"></i> Voltar para todos os pedidos
                      </a>

                    </h3>

                    <p>
                      Detalhes do pedido:
                    </p>

                    <div class="woocommerce">
                       
                       <p><?php
                          /* translators: 1: order number 2: order date 3: order status */
                          printf(
                            __( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
                            '<mark class="order-number">' . $order->get_order_number() . '</mark>',
                            '<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
                            '<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
                          );
                        ?></p>

                        <?php if ( $notes = $order->get_customer_order_notes() ) : ?>
                          <h2><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
                          <ol class="woocommerce-OrderUpdates commentlist notes">
                            <?php foreach ( $notes as $note ) : ?>
                            <li class="woocommerce-OrderUpdate comment note">
                              <div class="woocommerce-OrderUpdate-inner comment_container">
                                <div class="woocommerce-OrderUpdate-text comment-text">
                                  <p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
                                  <div class="woocommerce-OrderUpdate-description description">
                                    <?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
                                  </div>
                                    <div class="clear"></div>
                                  </div>
                                <div class="clear"></div>
                              </div>
                            </li>
                            <?php endforeach; ?>
                          </ol>
                        <?php endif; ?>

                        <?php do_action( 'woocommerce_view_order', $order_id ); ?>

                    </div>


                    <?php endif;?>

                </div>
            </div>
            <!-- CONTEUDO -->

        </div>
    </div>

</section>
<!-- CONTENT DASHBOARD -->


<?php endwhile; endif; ?>
<?php require("footer-ead.php"); ?>