/**
*  ------------------------------------------------------------------------------------------------
*
*
*   INIT
*
*
*  ------------------------------------------------------------------------------------------------
*/
console.log("COTAPAY INICIALIZADO");


//jQuery('body input[type="radio"][name="cotapay_meio_de_pagamento"]').click(function () {
jQuery(document).on("click", 'input[type="radio"][name="cotapay_meio_de_pagamento"]' , function() {

	console.log("METODO DE PAGAMENTO COTAPAY SELECIONADO:");

		// CARTAO DE CREDITO
		if (jQuery(this).attr("value") == "woo-cotapay-cartaodecredito") {

			console.log("CARTÃO DE CRÉDITO");

			jQuery(".cotapay-pagamento-content").hide(0);
	    	jQuery(".cotapay-pagamento-cartaodecredito").fadeIn(500);

		}

		
		// BOLETO BANCARIO
		if (jQuery(this).attr("value") == "woo-cotapay-boletobancario") {

			console.log("BOLETO BANCÁRIO");

			jQuery(".cotapay-pagamento-content").hide(0);
	        jQuery(".cotapay-pagamento-boletobancario").fadeIn(500);

		}
		
		
		// LINK DE PAGAMENTO
		if (jQuery(this).attr("value") == "woo-cotapay-linkdepagamento") {

			console.log("LINK DE PAGAMENTO");

			jQuery(".cotapay-pagamento-content").hide(0);
	        jQuery(".cotapay-pagamento-linkdepagamento").fadeIn(500);

		}

});



/**
*  ------------------------------------------------------------------------------------------------
*
*
*   MASCARAS CARTÂO DE CRÉDITO
*
*
*  ------------------------------------------------------------------------------------------------
*/
jQuery(document).ready(function(){
  
  jQuery("#cotapay_cc_cardholder").inputmask("9999-9999-9999-9999");
  jQuery("#cotapay_cc_validade").inputmask("99/99");
  jQuery("#cotapay_cc_cvv").inputmask("999");

});

/**
*  ------------------------------------------------------------------------------------------------
*
*
*   VERIFICAR BANDEIRA DO CARTÂO DE CRÉDITO
*
*
*  ------------------------------------------------------------------------------------------------
*/

// CAPTURAR O INPUT
function verificarBandeiraCartao(numeroCartao){

	var bandeira = cotapayCreditCard.getCardFlag(numeroCartao);

	//console.log("MATCH BANDEIRA CARTAO:");
	//console.log(bandeira);

	if(bandeira!=false){

		jQuery("#cotapay_bandeira_cartao").val(bandeira);

	}

}



var cotapayCreditCard = {

    /**
    * getCardFlag
    * Return card flag by number
    *
    * @param cardnumber
    *
    * All Regex code based from https://gist.github.com/gusribeiro/263a165db774f5d78251
    * 
    */
    getCardFlag: function(cardnumber) {
        var cardnumber = cardnumber.replace(/[^0-9]+/g, '');

        var cards = {
            VISA      : /^4[0-9]{12}(?:[0-9]{3})/,
            MASTERCARD : /^5[1-5][0-9]{14}/,
            DINERS    : /^3(?:0[0-5]|[68][0-9])[0-9]{11}/,
            AMEX      : /^3[47][0-9]{13}/,
            ELO  : /^6(?:011|5[0-9]{2})[0-9]{12}/,
            HIPERCARD  : /^606282|^3841(?:[0|4|6]{1})0/,
            ELO        : /^4011(78|79)|^43(1274|8935)|^45(1416|7393|763(1|2))|^50(4175|6699|67[0-6][0-9]|677[0-8]|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9])|^627780|^63(6297|6368|6369)|^65(0(0(3([1-3]|[5-9])|4([0-9])|5[0-1])|4(0[5-9]|[1-3][0-9]|8[5-9]|9[0-9])|5([0-2][0-9]|3[0-8]|4[1-9]|[5-8][0-9]|9[0-8])|7(0[0-9]|1[0-8]|2[0-7])|9(0[1-9]|[1-6][0-9]|7[0-8]))|16(5[2-9]|[6-7][0-9])|50(0[0-9]|1[0-9]|2[1-9]|[3-4][0-9]|5[0-8]))/,
            JCB        : /^(?:2131|1800|35\d{3})\d{11}/,
            AURA      : /^(5078\d{2})(\d{2})(\d{11})$/
        };

        for (var flag in cards) {
            if(cards[flag].test(cardnumber)) {
                return flag;
            }
        }

        return false;
    }

}

















