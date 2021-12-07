<?php
/*
Plugin Name: Plugin Cotapay Gateway
Plugin URI: https://www.cotapay.com.br/
Description: Aceite pagamentos por cartões de crédito, Boleto ou links de pagamento
Author: CotaBank & Diogenes Junior
Version: 1.0.0
Author URI: https://www.cotapay.com.br/
*/
/**
*  ------------------------------------------------------------------------------------------------
*
*
*   URLs DE ATUALIZAÇÕES DO PLUGIN
*
*
*  ------------------------------------------------------------------------------------------------
*/
require "update/plugin-update-checker.php";
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  'https://www.diogenesjunior.com.br/diretorios/plugins/plugin-cotapay-gateway/atualizacoes.json',
  __FILE__, //Full path to the main plugin file or functions.php.
  'plugin-cotapay-gateway'
);

/**
*  ------------------------------------------------------------------------------------------------
*
*
*   REGISTERS
*
*
*  ------------------------------------------------------------------------------------------------
*/
add_theme_support( 'woocommerce' );

add_action( 'wp_enqueue_scripts', 'misha_register_and_enqueue_cotapay' );
 
function misha_register_and_enqueue_cotapay() {

	// MASCARAS INPUT
	wp_register_script( 'cotapay-mask-script', plugins_url( 'js/dist/jquery.inputmask.bundle.js?v='.date("dmYHisu"), __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'cotapay-mask-script' );

	wp_register_script( 'cotapay-mask-phone-script', plugins_url( 'js/dist/inputmask/phone-codes/phone.js?v='.date("dmYHisu"), __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'cotapay-mask-phone-script' );

	wp_enqueue_style( 'style-cotapay-gateway', get_option('home')."/wp-content/plugins/plugin-cotapay-gateway/css/style.css?v=".date("dmYHisu") );
	 
}






/**
*  ------------------------------------------------------------------------------------------------
*
*
*   PAGE TEMPLATES
*
*
*  ------------------------------------------------------------------------------------------------
*/
/*
add_action( 'admin_menu', 'wpse_cotapay_manual_register' );

function wpse_cotapay_manual_register()
{ 
    // PRINCIPAL
    add_menu_page(
        'Cotapay',     // page title
        'Cotapay',     // menu title
        'manage_options',   // capability
        'cotapay-ppc',     // menu slug
        'cotapay_render' // callback function
    );

   
    add_submenu_page( 'cotapay-ppc', 'Configurações', 'Configurações','manage_options', 'configuracoes-cotapay-ppc-ppc', 'cotapay_render_configs');


}

function cotapay_render(){

    $file = plugin_dir_path( __FILE__ ) . "templates/dashboard.php";

    if ( file_exists( $file ) )
        require $file;

}

function cotapay_render_configs(){

    $file = plugin_dir_path( __FILE__ ) . "templates/configuracoes.php";

    if ( file_exists( $file ) )
        require $file;

}
*/

/**
*  ------------------------------------------------------------------------------------------------
*
*
*   API DE CONEXÃO COTAPAY COTABANK (CURL)
*
*
*  ------------------------------------------------------------------------------------------------
*/

// OBTER CHAVE PUBLICA
function cotapay_rsa_public_key($url_conexao){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_conexao.'/v1/getKey',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$result = json_decode( $response, true );

		if($result["status"]==true):

			return $result["publicKey"];
		
		else:
		
			return false;
		
		endif;
		
}


// OBTER TOKEN DE CONEXÃO
function cotapay_token($login,$senha,$pub_key,$url_api){
     	
     	function EncryptData($source,$pub_key){
				  
		   openssl_get_publickey($pub_key);
		   openssl_public_encrypt($source,$crypttext,$pub_key);
				  
		   return(base64_encode($crypttext));

		}

        $senha_encrip = EncryptData($senha,$pub_key);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_api.'/v1/logon',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		  "user": "'.$login.'",
		  "password": "'.$senha_encrip.'"
		}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$result = json_decode( $response, true );

		if($result["status"]==true):

			return $result["token"];
		
		else:
		
			return false;
		
		endif;

} 


// COBRAR CARTÃO DE CREDITO
function cotapay_cartao_de_credito($order,
								   $url_api,$token,$callback_url,
								   $cotapay_bandeira_cartao,
								   $cotapay_numero_cartao,
								   $cotapay_nome_cartao,
								   $cotapay_validade_cartao,
								   $cotapay_cvv_cartao,
								   $cotapay_num_parcelas){

	   $order_data = $order->get_data();

	    $cpf = str_replace(".","",get_post_meta($order->get_id(),'_billing_cpf',true));
		$cpf = str_replace("-","",$cpf);
		$cpf = str_replace(" ","",$cpf);

		$cotapay_numero_cartao = str_replace("-","",$cotapay_numero_cartao);
		$cotapay_numero_cartao = str_replace("_","",$cotapay_numero_cartao);

		$cotapay_cvv_cartao = str_replace("_","",$cotapay_cvv_cartao);

		if($cotapay_num_parcelas=="") $cotapay_num_parcelas = 1;
		if($cotapay_num_parcelas=="1") $tipo_payment = "V";
		if($cotapay_num_parcelas>"1") $tipo_payment = "L";


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_api.'/v2/transaction',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		"pan": "'.$cotapay_numero_cartao.'",
		"capture": true,
		"cardholderName": "'.$cotapay_nome_cartao.'", 
		"expirationDate": "'.$cotapay_validade_cartao.'",
		"cvvStatus": "E",
		"cvv": "'.$cotapay_cvv_cartao.'",
		"brand": "'.$cotapay_bandeira_cartao.'",
		"amount": '.$order_data['total'].',
		"date": "2020-02-06T18:07:10",
		"paymentType": "'.$tipo_payment.'",
		"installments": '.$cotapay_num_parcelas.',
		"site": "GWONLINEHMG",
		"splitMode": false,
		"sellerChannel":"web", 
		"productsCategory":"Equipamentos de Esporte", 
		"customer": {
		"gender":"M", 
		"login":"'.$order_data['billing']['email'].'", 
		"name": "'.$order_data['billing']['first_name'].'",
		"ddd": "11",
		"phone": "962633862",
		"email": "'.$order_data['billing']['email'].'", 
		"documentType": "CPF", 
		"document": "'.$cpf.'", 
		"birthDate": "04/05/1986", 
		"ip": "177.69.0.82", 
		"fingerPrint": "'.$order->get_id(). rand(1,109099) .'", 
		"billing": {
		        "street": "'.$order_data['billing']['address_1'].'",
				"number": "'.get_post_meta($order->get_id(),'_billing_number',true).'",
			    "neighborhood": "'.get_post_meta($order->get_id(),'_billing_neighborhood',true).'",
				"city": "'.$order_data['billing']['city'].'",
				"state": "'.$order_data['billing']['state'].'",
				"country": "'.$order_data['billing']['country'].'",
				"zipcode": "'.str_replace("-", "", $order_data['billing']['postcode']).'"
		    } },
		"products": [
		    {
		        "name": "Novo pedido '.get_bloginfo( 'name' ).'", 
		        "price": '.$order_data['total'].', 
		        "quantity": 1, 
		        "sku": "'.$order->get_id().'"
		} ]
		}',
		  CURLOPT_HTTPHEADER => array(
		    'x-access-token: '.$token,
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$result = json_decode( $response, true );

		// RETORNAR OS DADOS
		if($result["status"]==true):

			return array("status" => $result["status"], "message" => $result["message"], "tid" => $result["tid"]);
		
		else:
		
			return false;
		
		endif;

}


// COBRAR BOLETO BANCÁRIO
function cotapay_boleto_bancario($order,$url_api,$token,$callback_url){

	    $order_data = $order->get_data();

	    $cpf = str_replace(".","",get_post_meta($order->get_id(),'_billing_cpf',true));
		$cpf = str_replace("-","",$cpf);
		$cpf = str_replace(" ","",$cpf);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_api.'/v2/boleto',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
				"amount": '.$order_data['total'].',
				"expirationDate": "'.date("d/m/Y").'",
				"callbackUrl": "'.$callback_url.'",
				"splitMode": false,
				"instructions": "Boleto com vencimento no final de semana, poderá ser pago no próximo dia útil", 
				"email": "'.$order_data['billing']['email'].'", 
				"customer": {
				      "name": "'.$order_data['billing']['first_name'].'",
				      "document": "'.$cpf.'",
				      "address": {
				         "street": "'.$order_data['billing']['address_1'].'",
				         "number": "'.get_post_meta($order->get_id(),'_billing_number',true).'",
				         "complement": "'.$order_data['billing']['address_2'].'",
				         "neighborhood": "'.get_post_meta($order->get_id(),'_billing_neighborhood',true).'",
				         "zipCode": "'.str_replace("-", "", $order_data['billing']['postcode']).'",
				         "city": "'.$order_data['billing']['city'].'",
				         "state": "'.$order_data['billing']['state'].'",
				         "country": "'.$order_data['billing']['country'].'"
				      }
				   }
			}',
		  CURLOPT_HTTPHEADER => array(
		    'x-access-token: '.$token,
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$result = json_decode( $response, true );

		// RETORNAR OS DADOS
		if($result["status"]==true):

			return array("barcode" => $result["barcode"], "digitableLine" => $result["digitableLine"], "url" => $result["url"]);
		
		else:
		
			return false;
		
		endif;

}


// COBRAR LINK DE PAGAMENTO
function cotapay_link_de_pagamento($order,$url_api,$token,$callback_url,$max_parcelas){

	    if($max_parcelas==""):
	    	$max_parcelas = 6;
	    endif;

	    $order_data = $order->get_data();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_api.'/v2/paymentLink',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		    "site": "'.get_bloginfo( 'name' ).'",
		    "transactionDescription": "'.get_bloginfo( 'name' ).'",
		    "callbackUrl": "'.$callback_url.'", 
		    "maxInstallments": "'.$max_parcelas.'",
		    "transactionIdentifier": "'.$order->get_id().'",
		    "products": [
		     {
		       "name": "Pedido #'.$order->get_id().'", 
		       "quantity": 1
		     }],
		    "productsType": "Payment", 
		    "productsValue": '.$order_data['total'].', 
		    "shipping": {
		       "type": "WithoutShipping"
		    }
		}',
		  CURLOPT_HTTPHEADER => array(
		    'x-access-token: '.$token,
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$result = json_decode( $response, true );

		// RETORNAR OS DADOS
		if($result["status"]==true):

			return $result["link"];
		
		else:
		
			return false;
		
		endif;

}



/**
*  ------------------------------------------------------------------------------------------------
*
*
*   GATEWAY WOOCOMMERCE
*
*
*  ------------------------------------------------------------------------------------------------
*/
/*
 * This action hook registers our PHP class as a WooCommerce payment gateway
 */
add_filter( 'woocommerce_payment_gateways', 'cotapay_gateway_class' );
function cotapay_gateway_class( $gateways ) {
	$gateways[] = 'WC_Cotapay_Gateway'; // your class name is here
	return $gateways;
}

/*
 * The class itself, please note that it is inside plugins_loaded action hook
 */
add_action( 'plugins_loaded', 'cotapay_init_gateway_class' );
function cotapay_init_gateway_class() {

	class WC_Cotapay_Gateway extends WC_Payment_Gateway {

 		/**
 		 * Class constructor, more about it in Step 3
 		 */
 		public function __construct() {

		$this->id = 'cotapaygateway'; // payment gateway plugin ID
		$this->icon = 'https://www.cotapay.com.br/images/logo/Cabecalho.png'; // URL of the icon that will be displayed on checkout page near your gateway name
		$this->has_fields = true; // in case you need a custom credit card form
		$this->method_title = 'Cotapay';
		$this->method_description = 'Pagamentos por cartões de crédito, boleto bancário ou link de pagamento'; // will be displayed on the options page

		// gateways can support subscriptions, refunds, saved payment methods,
		// but in this tutorial we begin with simple payments
		$this->supports = array(
			'products'
		);

		// Method with all the options fields
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();
		$this->title = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );
		$this->enabled = $this->get_option( 'enabled' );
		$this->testmode = 'yes' === $this->get_option( 'testmode' );
		$this->private_key = $this->testmode ? $this->get_option( 'test_private_key' ) : $this->get_option( 'private_key' );
		$this->publishable_key = $this->testmode ? $this->get_option( 'test_publishable_key' ) : $this->get_option( 'publishable_key' );

		$this->ambiente  = $this->get_option( 'ambiente' );
		$this->ativar_cartaodecredito = $this->get_option( 'ativar_cartaodecredito' );
		$this->max_parcelas = $this->get_option( 'max_parcelas' );
		$this->ativar_boletobancario = $this->get_option( 'ativar_boletobancario' );
		$this->ativar_linkdepagamento = $this->get_option( 'ativar_linkdepagamento' );
		$this->url_de_conexao_api = $this->get_option( 'url_de_conexao_api' );
		$this->url_de_conexao_api_producao = $this->get_option( 'url_de_conexao_api_producao' );
		$this->login_conexao = $this->get_option( 'login_conexao' );
		$this->senha_conexao = $this->get_option( 'senha_conexao' );


		// This action hook saves the settings
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

		// We need custom JavaScript to obtain a token
		add_action( 'wp_enqueue_scripts', array( $this, 'cotapay_payment_scripts' ) );
		
		// You can also register a webhook here
		// add_action( 'woocommerce_api_{webhook name}', array( $this, 'webhook' ) );

 		}

		/**
 		 *  OPÇÕES DO PLUGIN NA TELA DE ADMINSTRAÇÃO DO WOOCOMMERCE
 		 */
 		public function init_form_fields(){

 			$this->form_fields = array(
				'enabled' => array(
					'title'       => 'Habilitar/Desabilitar',
					'label'       => 'Habilitar Cotapay',
					'type'        => 'checkbox',
					'description' => '',
					'default'     => 'no'
				),
				'title' => array(
					'title'       => 'Título',
					'type'        => 'text',
					'description' => 'Título para ser exibido para o usuário na página de checkout.',
					'default'     => 'Cotapay',
					'desc_tip'    => true,
				),
				'description' => array(
					'title'       => 'Descrição',
					'type'        => 'textarea',
					'description' => 'Texto para ser exibido para o usuário na página de checkout.',
					'default'     => 'Pagamentos por cartões de crédito, boleto bancário ou links de pagamento.',
				),
				'ambiente' => array(
					'title'       => 'Ambiente de teste',
					'label'       => 'Executar em ambiente de teste?',
					'type'        => 'checkbox',
					'description' => 'Realizar transações no ambiente de teste Cotapay',
					'default'     => 'ambiente_de_teste',
					'value'       => 'ambiente_de_teste',
					'desc_tip'    => true,
				),


				'ativar_cartaodecredito' => array(
					'title'       => 'Cartão de crédito',
					'label'       => 'Ativar pagamento com cartão de crédito?',
					'type'        => 'checkbox',
					'default'     => 'sim',
					'value'       => 'sim',
					'desc_tip'    => true,
				),
				'max_parcelas' => array(
					'title'       => 'Número máximo de parcelas',
					'type'        => 'number',
					'description' => 'Quantas parcelas máximas irá aceitar com cartão de crédito? (Parcelas com valor mínimo de R$5,00)',
					'default'     => '6',
					'min'         => '1',
					'max'         => '12',
					'desc_tip'    => true,
				),


				'ativar_boletobancario' => array(
					'title'       => 'Boleto Bancário',
					'label'       => 'Ativar pagamento com boleto bancário?',
					'type'        => 'checkbox',
					'default'     => 'sim',
					'value'       => 'sim',
					'desc_tip'    => true,
				),
				'ativar_linkdepagamento' => array(
					'title'       => 'Link de pagamento',
					'label'       => 'Ativar pagamento com link de pagamento?',
					'type'        => 'checkbox',
					'default'     => 'sim',
					'value'       => 'sim',
					'desc_tip'    => true,
				),


				'url_de_conexao_api' => array(
					'title'       => 'URL de conexão ambiente de teste (homologação)',
					'type'        => 'text',
					'description'     => 'URL informada pela equipe Cotapay',
					'default'     => 'http://52.168.167.13:1211/',
					'desc_tip'    => true,
				),
				'url_de_conexao_api_producao' => array(
					'title'       => 'URL de conexão ambiente produção',
					'type'        => 'text',
					'description'     => 'URL informada pela equipe Cotapay',
					'desc_tip'    => true,
				),
				'login_conexao' => array(
					'title'       => 'Login de acesso',
					'type'        => 'text',
					'description' => 'Login de acesso especifico de acesso à API',
					'desc_tip'    => true,
				),
				'senha_conexao' => array(
					'title'       => 'Senha de acesso',
					'type'        => 'password',
					'description' => 'Senha de acesso especifica de acesso à API',
					'desc_tip'    => true,
				)
			);

		
	 	}

		/**
		 * You will need it if you want your custom credit card form, Step 4 is about it
			
			* $this->ambiente
		    * $this->ativar_cartaodecredito
			* $this->max_parcelas 
			* $this->ativar_boletobancario
			* $this->ativar_linkdepagamento 
			* $this->url_de_conexao_api
			* $this->url_de_conexao_api_producao
			* $this->login_conexao
			* $this->senha_conexao

		 */
		public function payment_fields() {



			// PROCESSAR PARCELAS
			$total_carrinho = WC()->cart->get_cart_contents_total();
			$tot_parcelas   = 0;
			$divisor        = 1;
			$html_parcelas  = "";
			
			while($tot_parcelas<12 && $tot_parcelas<$this->max_parcelas):

				$valor_parcela = $total_carrinho / $divisor;

				if($valor_parcela>=5):
					$html_parcelas = $html_parcelas . '<option value="'.$divisor.'">'.$divisor.'x de R$'.number_format($valor_parcela,2,",",".").'</option>';
				else:
					$tot_parcelas = 13;
				endif;

				$divisor++;
				$tot_parcelas++;

			endwhile;
			// FIM PROCESSAR PARCELAS


			$html_cc = "";
			$html_boleto = "";
			$html_link  = "";


			if($this->ativar_cartaodecredito=="yes"):
				$html_cc = '

					<li class=" payment_method_woo-mercado-pago-custom">
										<input id="cotapay_payment_cartaodecredito" type="radio" class="input-radio" name="cotapay_meio_de_pagamento" value="woo-cotapay-cartaodecredito" checked="checked" data-order_button_text="Pagar com cartão de crédito" >

										 <label for="cotapay_payment_cartaodecredito">
											Pagar com <b>Cartão de Crédito</b></label>

									</li>

				';
			endif;


			if($this->ativar_boletobancario=="yes"):

				$html_boleto = '
			      
			      <li class=" payment_method_woo-mercado-pago-custom">
										<input id="cotapay_payment_boletobancario" type="radio" class="input-radio" name="cotapay_meio_de_pagamento" value="woo-cotapay-boletobancario" data-order_button_text="Pagar com Boleto Bancário">

										 <label for="cotapay_payment_boletobancario">
											Pagar com <b>Boleto Bancário</b></label>

									</li>


				';

			endif;


			if($this->ativar_linkdepagamento=="yes"):

				$html_link = '

					<li class=" payment_method_woo-mercado-pago-custom">
										<input id="cotapay_payment_linkdepagamento" type="radio" class="input-radio" name="cotapay_meio_de_pagamento" value="woo-cotapay-linkdepagamento" data-order_button_text="Pagar com Link de Pagamento">

										<label for="cotapay_payment_linkdepagamento">
											Pagar com <b>Link de Pagamento</b></label>

									</li>

				';

			endif;



			$html = '<ul class="wc_cotapay_payment_methods cotapay_payment_methods cotapay_methods">

						
					'.$html_cc.'
					'.$html_boleto.'
					'.$html_link.'

					
				  </ul>

					<!-- CARTÃO DE CRÉDITO -->
					<div class="cotapay-pagamento-content cotapay-pagamento-cartaodecredito">
				      		
				      	  <input type="hidden" name="cotapay_bandeira_cartao" id="cotapay_bandeira_cartao" value="" />
				      	  	
					      <div class="cotapay-form-group">
					      	<label>Número do cartão</label>
					      	<input type="tel" class="cotapay-form-control" autocomplete="off" placeholder="9999-9999-9999-9999" onchange="verificarBandeiraCartao(this.value)" name="cotapay_numero_cartao" id="cotapay_cc_cardholder" />
					      </div>

					      <div class="cotapay-form-group">
					      	<label>Nome do títular</label>
					      	<input type="text" class="cotapay-form-control" autocomplete="off" placeholder="Exatamente como escrito no cartão" name="cotapay_nome_cartao" id="cotapay_cc_nometitulo" />
					      </div>

					      <div class="cotapay-form-group">
					      	<label>Validade</label>
					      	<input type="tel" class="cotapay-form-control" autocomplete="off" placeholder="MM/AA" name="cotapay_validade_cartao" id="cotapay_cc_validade" />
					      </div>

					      <div class="cotapay-form-group">
					      	<label>CVV</label>
					      	<input type="tel" class="cotapay-form-control" autocomplete="off" placeholder="CVV" name="cotapay_cvv_cartao" id="cotapay_cc_cvv" />
					      </div>

					      <div class="cotapay-form-group">
					      	<label>Número de parcelas</label>
					      	<select class="cotapay-form-control" name="cotapay_num_parcelas" id="cotapay_cc_parcelas">
					      	  '.$html_parcelas.'
					      	</select>
					      </div>

				    </div>

				    <!-- BOLETO -->
					<div class="cotapay-pagamento-content cotapay-pagamento-boletobancario">
				       Na próxima tela, você visualizará o código de barras para pagamento.
				    </div>

				    <!-- LINK DE PAGAMENTO -->
					<div class="cotapay-pagamento-content cotapay-pagamento-linkdepagamento">
				      Na próxima tela, você será redirecionado para o link de pagamento.
				    </div>

				    <script>

				    	// ESTANCIAR AS MASCARAS
				    	jQuery("#cotapay_cc_cardholder").inputmask("9999-9999-9999-9999");
						jQuery("#cotapay_cc_validade").inputmask("99/99");
						jQuery("#cotapay_cc_cvv").inputmask("999");

				    </script>

			';


			echo $html;

		}

		/*
		 *  CUSTOM JAVASCRIPTS PARA PAGAMENTO COM COTAPAY
		 */
	 	public function cotapay_payment_scripts() {

				// APENAS EM PÁGINAS DE CARRINHO E CHECKOUT
				if ( ! is_cart() && ! is_checkout() && ! isset( $_GET['pay_for_order'] ) ) {
					return;
				}

				// COTAPAY HABILITADO
				if ( 'no' === $this->enabled ) {
					return;
				}

				// CASO O USUÁRIO NÃO TENHA INFORMADO O LOGIN E SENHA DE CONEXÃO
				if ( empty( $this->login_conexao ) || empty( $this->senha_conexao ) ) {

					wc_print_notice( "Erro Cotapay: Login ou senha de acesso à API não foram informados nas configurações do WooCommerce", "error" );

					return;

				}

				// let's suppose it is our payment processor JavaScript that allows to obtain a token
				//wp_enqueue_script( 'misha_js', 'https://www.mishapayments.com/api/token.js' );

				// and this is our custom JS in your plugin directory that works with token.js
				wp_register_script( 'woocommerce_cotapay', plugins_url( 'js/cotapay.js?v='.date("dmYHisu"), __FILE__ ), array( 'jquery' ) );

				// in most payment processors you have to use PUBLIC KEY to obtain a token
				//wp_localize_script( 'woocommerce_misha', 'misha_params', array(
				//	'publishableKey' => $this->publishable_key
				//));

				wp_enqueue_script( 'woocommerce_cotapay' );
				
				return true;
	
	 	}

		/*
 		 * Fields validation, more in Step 5
		 */
		public function validate_fields() {

		  return true;

		}

		/*
		 * We're processing the payments here, everything about it is in Step 5
		 */
		public function process_payment( $order_id ) {

		    global $woocommerce;
 
			// we need it to get any order detailes
			$order = wc_get_order( $order_id );

			//$order->payment_complete();

			$ambiente                    = $this->ambiente;
			$ativar_cartaodecredito      = $this->ativar_cartaodecredito;
			$base_max_parcelas           = $this->max_parcelas;
			$ativar_boletobancario       = $this->ativar_boletobancario;
			$ativar_linkdepagamento      = $this->ativar_linkdepagamento;
			$url_de_conexao_api          = $this->url_de_conexao_api;
			$url_de_conexao_api_producao = $this->url_de_conexao_api_producao;
			$login_conexao               = $this->login_conexao;
			$senha_conexao               = $this->senha_conexao;

			if($ambiente==true): 
			   $url_api = $url_de_conexao_api;
		    else:
			   $url_api = $url_de_conexao_api_producao;
			endif;

			$cotapay_meio_de_pagamento = $_POST['cotapay_meio_de_pagamento'];
			$cotapay_bandeira_cartao   = $_POST['cotapay_bandeira_cartao'];
			$cotapay_numero_cartao     = $_POST['cotapay_numero_cartao'];
			$cotapay_nome_cartao       = $_POST['cotapay_nome_cartao'];
			$cotapay_validade_cartao   = $_POST['cotapay_validade_cartao'];
			$cotapay_cvv_cartao        = $_POST['cotapay_cvv_cartao'];
			$cotapay_num_parcelas      = $_POST['cotapay_num_parcelas'];


			// PAGAR COM CARTÃO DE CRÉDITO
			if($cotapay_meio_de_pagamento=="woo-cotapay-cartaodecredito"):

				$chave_rsa = cotapay_rsa_public_key($url_api);

					if($chave_rsa!=false):

						$token     = cotapay_token($login_conexao,$senha_conexao,$chave_rsa,$url_api);

						error_log("CHAVE RSA COTAPAY GERADA:");
						error_log($chave_rsa);

						$order->add_order_note( 'Método de pagamento escolhido pelo usuário: <b>Cotapay Cartão de crédito</b>.', true );
						$order->add_order_note( 'Número de parcelas escolhido pelo usuário: <b>'.$cotapay_num_parcelas.'</b>.', true );

						// REALIZAR O PAGAMENTO
						$status_pagamento = cotapay_cartao_de_credito($order,
																	  $url_api,
																	  $token,
																	  $this->get_return_url($order),
																	  $cotapay_bandeira_cartao,
																	  $cotapay_numero_cartao,
																	  $cotapay_nome_cartao,
																	  $cotapay_validade_cartao,
																	  $cotapay_cvv_cartao,
																	  $cotapay_num_parcelas);

						if($status_pagamento["status"]==true && $status_pagamento["message"]=="CONFIRMED"):

							// LIMPAR O CARRINHO
							$woocommerce->cart->empty_cart();

							// ATUALIZAR O STATUS PARA PROCESSANDO
							$order->update_status( 'wc-processing' );

							wc_reduce_stock_levels( $order->get_id() );

							add_post_meta($order->get_id(),"cotapay_cartao_de_credito","sim",true);
							add_post_meta($order->get_id(),"cotapay_cartao_de_credito_tid",$status_pagamento["tid"],true);

							// REDIRECIONAR PARA OUTRA PÁGINA
							return array(
								'result' => 'success',
								'redirect' => $this->get_return_url( $order )
								
							);
				 
							return true;

						else:

								error_log("NÃO CONSEGUIMOS REALIZAR PAGAMENTO COM CARTÃO DE CRÉDITO COTAPAY");

								return array(
									'result' => 'error'
								);

								return false;

						endif;	


					else:

							error_log("NÃO CONSEGUIMOS GERAR A CHAVE RSA COTAPAY");

							return array(
								'result' => 'error'
							);

							return false;

					endif;


			endif;
			// FIM PAGAMENTO CARTÃO DE CRÉDITO


			// PAGAR COM BOLETO BANCÁRIO
			if($cotapay_meio_de_pagamento=="woo-cotapay-boletobancario"):

				    $chave_rsa = cotapay_rsa_public_key($url_api);

					if($chave_rsa!=false):

						$token     = cotapay_token($login_conexao,$senha_conexao,$chave_rsa,$url_api);

						error_log("CHAVE RSA COTAPAY GERADA:");
						error_log($chave_rsa);

						$order->add_order_note( 'Método de pagamento escolhido pelo usuário: <b>Cotapay Boleto Bancário</b>.', true );

						// LIMPAR O CARRINHO
						$woocommerce->cart->empty_cart();

						$order->update_status( 'wc-on-hold' );

						wc_reduce_stock_levels( $order->get_id() );

						// CRIAR O BOLETO
						$object_boleto = cotapay_boleto_bancario($order,$url_api,$token,$this->get_return_url( $order ));

						if($object_boleto):

							// some notes to customer (replace true with false to make it private)
							$order->add_order_note( 'Pedido recebido, aguardando o pagamento. ', true );
							$order->add_order_note( 'Código de barras do boleto gerado: '.$object_boleto["digitableLine"], true );
							$order->add_order_note( 'URL de pagamento para o boleto gerado: '.$object_boleto["url"], true );

							add_post_meta($order->get_id(),"cotapay_boleto","sim",true);
							add_post_meta($order->get_id(),"cotapay_boleto_linha_digitavel",$object_boleto["digitableLine"],true);
							add_post_meta($order->get_id(),"cotapay_boleto_link_boleto",$object_boleto["url"],true);
				 
							// REDIRECIONAR PARA OUTRA PÁGINA
							return array(
								'result' => 'success',
								'redirect' => $this->get_return_url( $order )
								
							);
				 
							return true;

						else:

								error_log("NÃO CONSEGUIMOS GERAR O BOLETO BANCÁRIO COTAPAY");

								return array(
									'result' => 'error'
								);

								return false;

						endif;	


					else:

							error_log("NÃO CONSEGUIMOS GERAR A CHAVE RSA COTAPAY");

							return array(
								'result' => 'error'
							);

							return false;

					endif;

			endif;
			// FIM BOLETO


			// PAGAR COM LINK DE PAGAMENTO
			if($cotapay_meio_de_pagamento=="woo-cotapay-linkdepagamento"):

					$chave_rsa = cotapay_rsa_public_key($url_api);

					if($chave_rsa!=false):

						$token     = cotapay_token($login_conexao,$senha_conexao,$chave_rsa,$url_api);

						error_log("CHAVE RSA COTAPAY GERADA:");
						error_log($chave_rsa);

						$order->add_order_note( 'Método de pagamento escolhido pelo usuário: <b>Cotapay Link de Pagamento</b>.', true );

						// LIMPAR O CARRINHO
						$woocommerce->cart->empty_cart();

						$order->update_status( 'wc-on-hold' );

						wc_reduce_stock_levels( $order->get_id() );

						// CRIAR O LINK DE PAGAMENTO
						$url_link_pagamento = cotapay_link_de_pagamento($order,$url_api,$token,$this->get_return_url( $order ),$base_max_parcelas);

						if($url_link_pagamento):

							// some notes to customer (replace true with false to make it private)
							$order->add_order_note( 'Pedido recebido, aguardando o pagamento. ', true );
							$order->add_order_note( 'Link de pagamento gerado: '.$url_link_pagamento, true );
				 
							// REDIRECIONAR PARA OUTRA PÁGINA
							return array(
								'result' => 'success',
								'redirect' => $url_link_pagamento
								
							);
				 
							return true;

						else:

								error_log("NÃO CONSEGUIMOS GERAR O LINK DE PAGAMENTO COTAPAY");

								return array(
									'result' => 'error'
								);

								return false;

						endif;	


					else:

							error_log("NÃO CONSEGUIMOS GERAR A CHAVE RSA COTAPAY");

							return array(
								'result' => 'error'
							);

							return false;

					endif;
				

			endif;
			// FINAL LINK DE PAGAMENTO
 
					
	 	}


		/*
		 *  WEBHOOK DE PROCESSAMENTO
		 */
		public function webhook() {

			// OBTER O PEDIDO
		    $order = wc_get_order( $_GET['id'] );
			
			// SETAR O PAGAMENTO COMO COMPLETO
			$order->payment_complete();

			// REDUZIR A QUANTIDADE DE ESTOQUE
			$order->reduce_order_stock();

			// DEBUG NO LOG
			update_option('webhook_debug', $_GET);

			return true;
					
	 	}
 	}
}



// RETORNO INFO DE PAGAMENTO PARA O USUÁRIO
add_action( 'woocommerce_thankyou', 'cotapay_add_content_thankyou', 4 );
  
function cotapay_add_content_thankyou($order_id) {

	// IMPRIMIR AS INFORMAÇÕES PARA PAGAMENTO DO BOLETO NA TELA DE OBRIGADO
	if(get_post_meta($order_id,"cotapay_boleto",true)=="sim"):

			echo '<h2 class="cotapay-titulo-boleto" style="text-align:center">
					<small style="display:block;margin-left:auto;margin-right:auto">CÓDIGO DO BOLETO</small>
					'.get_post_meta($order_id,"cotapay_boleto_linha_digitavel",true).'
			</h2>
			<p style="text-align:center">
				<a href="'.get_post_meta($order_id,"cotapay_boleto_link_boleto",true).'" class="button" target="_blank" title="Visualizar boleto bancário">Visualizar boleto bancário</a>
			</p>

			';

	endif;
   
   
}


		

?>