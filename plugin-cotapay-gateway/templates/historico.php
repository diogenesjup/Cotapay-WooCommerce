<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit; // SAIR DA PÁGINA SE ACESSADA DIRETAMENTE PELO NAVEGADOR HTTP 80
}

?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<!-- TALVEZ VAMOS USAR BOOTSTRAP -->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style type="text/css">
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
      width: 960px !important;
      margin-left: 0;
      margin-right: auto;
  }

  @media(max-width: 1000px){
    .diogenes-box{
      max-width: 75%;
    }
  }

  .diogenes-col{
    position: relative;
    display: block;
    width: 100%;
  }

  .diogenes-box iframe{
    height: 490px !important;
  }

  .diogenes-box table{
    position: relative;
      width: 100%;
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
  p{
    font-size: 15px;
        margin-bottom: 15px;
  }

    .acf-fields>.acf-field {
        position: relative;
        margin: 0;
        padding: 15px 12px;
        padding-left: 0px !important; 
        border-top: #EEEEEE solid 1px;
    }

    .notice, div.error, div.updated {
        background: #fff;
        border: 1px solid #c3c4c7;
        border-left-width: 4px;
        box-shadow: 0 1px 1px rgb(0 0 0 / 4%);
        margin: 5px 15px 2px;
        padding: 1px 12px;
        margin-left: 0px !important;
    }




.diogenes-box button {
  cursor: pointer;
}

.diogenes-box .container {
  max-width: calc(100% - 24px);
  width: 100%;
  padding: 0 24px;
  margin: 0 auto;
}

.diogenes-box .mob {
  display: none !important;
}

@media screen and (max-width: 460px) {
.diogenes-box .container {
  padding: 0px;
}
  .diogenes-box .mob {
    display: block !important;
  }
}

@media screen and (max-width: 460px) {
  .diogenes-box .desk {
    display: none !important;
  }
}

.diogenes-box .page {
  padding: 24px 0;
  width: 100%;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page.busca .page__content__eventos dd > header,
  .diogenes-box .page.busca .page__content__eventos dd > ul {
    display: none;
  }
  .diogenes-box .page.busca .page__content__itens {
    display: block;
  }
  .diogenes-box .page.busca .page__content__itens .header-mob {
    margin: 0;
    padding: 18px 42px;
    background: #D9E1E7;
  }
  .diogenes-box .page.busca .page__content__itens .header-mob h4 {
    font: 600 18px/1 "Open Sans", sans-serif;
  }
  .diogenes-box .page.busca .page__content__itens ul {
    border-left: 1px solid #D9E1E7;
  }
}

.diogenes-box .page__header {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  padding: 24px 40px;
  border-radius: 10px;
  background: #4673FF;
  margin: 0 0 40px 0;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__header {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header {
    padding: 24px 16px;
  }
}

.diogenes-box .page__header aside {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__header aside:first-child {
    margin: 0 0 24px 0;
  }
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header aside:nth-of-type(2) {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }
}

.diogenes-box .page__header aside h1 {
  margin: 0;
  margin-top: -9px;
  color: #FFFFFF;
  font: 400 24px/1 "Open Sans", sans-serif;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header aside h1 {
    font-size: 18px;
    margin: 0 0 0 16px;
  }
}

.diogenes-box .page__header aside input {
  display: block;
  border-radius: 10px;
  font: 400 15px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__header__busca {
  position: relative;
}

.diogenes-box .page__header__busca::before {
  
}

.diogenes-box .page__header__busca input {
  background: transparent;
    box-shadow: none;
    outline: none;
    color: #000;
    font: 400 16px/1 "Open Sans", sans-serif;
    padding: 14px 24px 15px 024px;
    width: 225px;
    border: 1px solid #000;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header__busca input {
    width: 100%;
  }
}

.diogenes-box .page__header__busca input::-webkit-input-placeholder {
  opacity: .64;
  color: #fff;
  font-weight: 500;
}

.diogenes-box .page__header__busca input:-ms-input-placeholder {
  opacity: .64;
  color: #fff;
  font-weight: 500;
}

.diogenes-box .page__header__busca input::-ms-input-placeholder {
  opacity: .64;
  color: #fff;
  font-weight: 500;
}

.diogenes-box .page__header__busca input::placeholder {
  opacity: .64;
  color: #fff;
  font-weight: 500;
}

.diogenes-box .page__header__calendario {
  position: relative;
  margin: 0 0 0 16px;
  overflow: hidden;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header__calendario {
    margin: 0;
    width: 100%;
    margin: 12px 0 0 0;
  }
}

.diogenes-box .page__header__calendario::after {
  content: url("../front-end/assets/arrow-blue.svg");
  position: absolute;
  top: 46%;
  right: 24px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.diogenes-box .page__header__calendario::before {
  content: url("../front-end/assets/calendar-grey.svg");
  position: absolute;
  top: 54%;
  left: 24px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.diogenes-box .page__header__calendario input {
  width: 240px;
  padding: 14px 24px 14px 64px;
  border: 2px solid #D9E1E7;
  background: #FFFFFF;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__header__calendario input {
    width: 100%;
  }
}

.diogenes-box .page__header__calendario input::-webkit-calendar-picker-indicator, .page__header__calendario input::-webkit-inner-spin-button {
  position: absolute;
  left: -80px;
  top: 0;
  width: 1000%;
  height: 100%;
}

.diogenes-box .page__content {
  padding: 0;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
      -ms-flex-align: start;
          align-items: flex-start;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__content {
    padding: 0;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }
}

.diogenes-box .page__content__eventos {
  position: relative;
  max-width: 305px;
  width: 100%;
  margin: 0 14px 0 0;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__content__eventos {
    max-width: 240px;
    margin: 0 24px 0 0;
  }
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__eventos {
    max-width: 100%;
  }
}

.diogenes-box .page__content__eventos dl dt {
  margin: 0 0 32px 0;
  cursor: pointer;
  color: #005D6E;
  font: 400 19px/1.2 "Open Sans", sans-serif;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
      -ms-flex-align: start;
          align-items: flex-start;
  width: 100%;
  position: relative;
  padding: 0 0 0 32px;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__content__eventos dl dt {
    font-size: 17px;
  }
}

.diogenes-box .page__content__eventos dl dt.active::before {
  top: 6px;
  -webkit-transform: scaleY(-1);
          transform: scaleY(-1);
}

.diogenes-box .page__content__eventos dl dt::before {
  content: url("../front-end/assets/arrow-blue.svg");
  position: absolute;
  top: -3px;
  left: 0;
  -webkit-transition: 300ms ease;
  transition: 300ms ease;
}

.diogenes-box .page__content__eventos dl dd {
  margin: 0 0 32px 0;
  display: none;
}

.diogenes-box .page__content__eventos dl dd.active {
  display: block;
}

.diogenes-box .page__content__eventos dl dd > header {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  margin: 0 0 16px 0;
}

.diogenes-box .page__content__eventos dl dd > header h5 {
  width: 100%;
  text-align: center;
  color: #809FB8;
  font: 300 15px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__content__eventos dl dd > header h5:nth-child(2) {
  padding: 0 48px 0 0;
}

.diogenes-box .page__content__eventos dl dd > ul {
  border: 1px solid #EBEBEB;
      max-height: 400px;
    overflow-y: scroll;
    padding-bottom: 100px;
    position: relative;
    padding-left: 10px;
}

.diogenes-box ul.lista-geral{
    max-height: 438px;
    overflow-y: scroll;
    padding-bottom: 100px;
    position: relative;
}

.diogenes-box .page__content__eventos dl dd > ul li {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  padding: 10px 0;
}

.diogenes-box .page__content__eventos dl dd > ul li:not(:last-child) {
  border-bottom: 1px solid #EBEBEB;
}

.diogenes-box .page__content__eventos dl dd > ul li.active {
  background: #D9E1E7;
}

.diogenes-box .page__content__eventos dl dd > ul li aside {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  width: 100%;
}

.diogenes-box .page__content__eventos dl dd > ul li aside h3 {
  font: 600 18px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__content__eventos dl dd > ul li aside img {
  margin: 0 8px 0 0;
}

.diogenes-box .page__content__eventos dl dd > ul li button {
  margin: 0 16px 0 0;
  background: none !important;
  border: none !important;
}

.diogenes-box .page__content__itens {
  margin: 0px 0 0 0;
  width: 100%;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__itens {
    /*display: none;*/
    margin: 0;
  }
}

.diogenes-box .page__content__itens.active {
  display: block;
}

.diogenes-box .page__content__itens fieldset:disabled input {
  border: unset;
}

.diogenes-box .page__content__itens fieldset:disabled ~ aside div {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

.diogenes-box .page__content__itens fieldset:disabled ~ aside > button {
  display: none;
}

.diogenes-box .page__content__itens fieldset input {
  border: 2px solid #D9E1E7;
  font: 300 16px/1 "Open Sans", sans-serif;
  border-radius: 8px;
  display: block;
  width: 100%;
  min-width: 106px;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  padding: 8px 16px;
  -webkit-transition: 300ms ease;
  transition: 300ms ease;
  margin: 0 12px 0 0;
}

.diogenes-box .page__content__itens fieldset input:first-child {
  min-width: 165px;
}

@media screen and (max-width: 960px) {
  .diogenes-box .page__content__itens fieldset input:first-child {
    min-width: 200px;
  }
}

.diogenes-box .page__content__itens fieldset input:focus {
  border-color: #00C5B5;
}

.diogenes-box .page__content__itens header {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin: 0 0 16px 48px;
}

.diogenes-box .page__content__itens header h5 {
  color: #809FB8;
  font: 300 15px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__content__itens header h5:first-child {
  width: 210px;
}

.diogenes-box .page__content__itens header h5:not(:first-child) {
  width: 98px;
}

.diogenes-box .page__content__itens .header-mob {
  margin-left: 42px;
}

.diogenes-box .page__content__itens .header-mob div {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

.diogenes-box .page__content__itens .header-mob div aside {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.diogenes-box .page__content__itens .header-mob div aside span {
  display: block;
  font: 600 18px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__content__itens .header-mob div aside img {
  margin: 0 8px 0 0;
}

.diogenes-box .page__content__itens .header-mob div button {
  font: 600 15px/1 "Open Sans", sans-serif;
  color: #809FB8;
  background: #D9E1E7;
  border-radius: 8px;
  padding: 10px 28px;
}

.diogenes-box .page__content__itens ul {
  border-left: 10px solid #D9E1E7;
  border-top: 1px solid #D9E1E7;
  border-right: 1px solid #D9E1E7;
  border-bottom: 1px solid #D9E1E7;
}

.diogenes-box .page__content__itens ul li {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  padding: 8px 14px 8px 20px;
}

.diogenes-box .page__content__itens ul li span{
  display: inline-block;
  min-width: 200px;
  max-width: 400px;
  display: inline-block;
  word-break: break-all;
}

@media(max-width: 540px){
  .diogenes-box .page__content__itens ul li span{
   max-width: 100%;
  }
}

.diogenes-box .page__content__itens ul li:not(:last-of-type) {
  border-bottom: 1px solid #D9E1E7;
}

.diogenes-box .page__content__itens ul li fieldset {
  width: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__itens ul li fieldset {
    /* display: none; */
    display: block;
  }
}

.diogenes-box .page__content__itens ul li aside {
  width: 120px;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__itens ul li aside {
   /* display: none; */
  }
}

.diogenes-box .page__content__itens ul li aside div {
  width: 100%;
  display: none;
  position: relative;
}

.diogenes-box .page__content__itens ul li aside div button {
  
  background: none;
  border: none; 
  
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.diogenes-box .page__content__itens ul li aside div button.active svg *[fill="#ebebeb"] {
  fill: #00C5B5;
}

.diogenes-box .page__content__itens ul li aside div button.active svg *[stroke="#ebebeb"] {
  stroke: #00C5B5;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] {
  position: absolute;
  bottom: -8px;
  right: 38px;
  -webkit-transform: translateY(100%);
          transform: translateY(100%);
  background: #EBEBEB;
  border: 2px solid #D9E1E7;
  width: 260px;
  border-radius: 16px;
  padding: 32px;
  display: none;
  z-index: 999;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar].active {
  display: block;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] h4 {
  color: #005D6E;
  font: 500 17px/1.4 "Open Sans", sans-serif;
  margin: 0 0 22px 0;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] fieldset {
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  overflow: hidden;
  position: relative;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] fieldset input {
  padding-top: 12px !important;
  padding-bottom: 12px !important;
  background: #FFFFFF;
  margin: 0 0 14px 0;
  min-width: initial !important;
  width: 100%;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] fieldset input::-webkit-calendar-picker-indicator, .page__content__itens ul li aside div [data-trocar] fieldset input::-webkit-inner-spin-button {
  position: absolute;
  left: -96px;
  top: 0;
  width: 1000%;
  height: 100%;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] .select {
  position: relative;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] .select::before {
  content: url("../front-end/assets/arrow-blue.svg");
  position: absolute;
  top: 50%;
  right: 20px;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] .select select {
  -webkit-appearance: unset;
     -moz-appearance: unset;
          appearance: unset;
  background: #FFFFFF;
  border: 2px solid #D9E1E7;
  font: 300 16px/1 "Open Sans", sans-serif;
  border-radius: 8px;
  display: block;
  width: 100%;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  padding: 12px 16px;
}

.diogenes-box .page__content__itens ul li aside div [data-trocar] button {
  margin: 18px 0 0 0;
  width: 100%;
  border-radius: 8px;
  padding: 14px 28px;
  color: #FFFFFF;
  font: 400 15px/1 "Open Sans", sans-serif;
  background: #809FB8;
}

.diogenes-box .page__content__itens ul li aside div [data-excluir] {
  position: absolute;
  bottom: -8px;
  right: 38px;
  -webkit-transform: translateY(100%);
          transform: translateY(100%);
  background: #EBEBEB;
  border: 2px solid #D9E1E7;
  width: 260px;
  border-radius: 16px;
  padding: 32px;
  display: none;
  z-index: 999;
}

.diogenes-box .page__content__itens ul li aside div [data-excluir].active {
  display: block;
}

.diogenes-box .page__content__itens ul li aside div [data-excluir] h4 {
  color: #005D6E;
  font: 500 17px/1.4 "Open Sans", sans-serif;
  margin: 0 0 16px 0;
}

.diogenes-box .page__content__itens ul li aside div [data-excluir] button {
  width: 100%;
  border-radius: 8px;
  padding: 14px 28px;
  color: #FFFFFF;
  font: 400 15px/1 "Open Sans", sans-serif;
  background: #DE4751;
}

.diogenes-box .page__content__itens ul li aside div:not(:last-child) {
  margin: 0 6px 0 0;
}

.diogenes-box .page__content__itens ul li aside > button {
  width: 100%;
  display: block;
  border-radius: 8px;
  padding: 13px 28px;
  color: #FFFFFF;
  font: 400 15px/1 "Open Sans", sans-serif;
  background: #809FB8;
  border: none;
}

.diogenes-box .page__content__itens ul li .mob {
  width: 100%;
  display: none;
  padding: 10px;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__itens ul li .mob {
    display: block;
  }
}

.diogenes-box .page__content__itens ul li .mob h2 {
  font: 600 18px/1 "Open Sans", sans-serif;
  margin: 0 0 18px 0;
}

.diogenes-box .page__content__itens ul li .mob section {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

.diogenes-box .page__content__itens ul li .mob section div {
  width: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.diogenes-box .page__content__itens ul li .mob section div h5 {
  text-align: center;
  color: #809FB8;
  font: 300 15px/1 "Open Sans", sans-serif;
  margin: 0 8px 0 0;
}

.diogenes-box .page__content__itens ul li .mob section div h4 {
  text-align: center;
  font: 400 14px/1 "Open Sans", sans-serif;
}

.diogenes-box .page__content__itens footer {
  margin: 16px 0 0 32px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: end;
      -ms-flex-pack: end;
          justify-content: flex-end;
}

@media screen and (max-width: 460px) {
  .diogenes-box .page__content__itens footer {
    display: none;
  }
}

.diogenes-box .page__content__itens footer.novo fieldset {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.diogenes-box .page__content__itens footer.novo > button {
  display: none;
}

.diogenes-box .page__content__itens footer button {
  border-radius: 8px;
  padding: 13px 28px;
  color: #FFFFFF;
  font: 400 15px/1 "Open Sans", sans-serif;
  background: #809FB8;
}

.diogenes-box .page__content__itens footer fieldset {
  display: none;
}

.diogenes-box .page__content__itens footer fieldset button {
  background: #809FB8;
}

.diogenes-box .page__content__itens footer > button {
  width: 180px;
  border: none;
  background: #28C76F;
}
/*# sourceMappingURL=main.css.map */


.diogenes-box .data-menor{
  display: block;
    font-size: 13px;
    color: #747474;
    font-weight: normal;
    margin-top: -5px;
    margin-bottom: 3px;
}

.updated.notice.is-dismissible{
  display: none !important;
}



  .diogenes-box{
    position: relative;
      display: block;
      background: #fff;
      border: 1px solid #ccc;
      padding: 0;
      width: 100%;
      padding-bottom: 65px;
      margin-top: 0px;
      font-family: "Open Sans", sans-serif;
      margin-top:30px;
  }

  .diogenes-col{
    position: relative;
    display: block;
    width: 100%;
  }

  .diogenes-box iframe{
    height: 490px !important;
  }

  .diogenes-box table{
    position: relative;
      width: 100%;
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
  p{
    font-size: 15px;
        margin-bottom: 15px;
  }

  p.detalhe-pedido{
    position: absolute;
      display: block;
      left: 10px;
      /* flex: none; */
      /* margin-left: 0; */
      font-size: 12px;
      top: 5px;
      background: #666;
      color: #fff;
      padding: 2px;
      padding-left: 10px;
      padding-right: 10px;
      border-radius: 9px;
  }

  p.detalhe-pedido a, p.detalhe-pedido a:hover{
    color: #fff !important;
    text-decoration: none !important;
  }

  .modal {
      position: fixed;
      top: auto;
      right: 0;
      bottom: 0;
      left: auto;
      z-index: 1050;
      display: none;
      overflow: hidden;
      -webkit-overflow-scrolling: touch;
      outline: 0;
  }

</style>


<div class="diogenes-box">

    <h1 style="font-weight: bold;font-size: 28px;padding-left: 38px;">
      Histórico do Aluno
    </h1>
    
    <?php 

      $usuario = $_GET["usuario"];
      $curso   = $_GET["curso"];

      $user = get_user_by("ID",$usuario);

      $all_metas = get_user_meta( $user->ID );

    ?>
    
    <h3 style="padding-left: 38px;"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?> (<?php echo $user->user_email; ?>)</h3>
    <p>&nbsp;</p>
    <hr>

    <h4 style="padding-left: 38px;">Conclusão</h4>
    <div style="padding: 38px;padding-top: 0px;">

        <table class="wp-list-table widefat fixed striped table-view-list users">
                  <thead>
                    <tr>
                      <td>Curso</td>
                      <td>Data</td>
                    </tr>
                  </thead>
                  <tbody id="listaDeResultadosConclusao">

                      <?php 

                        $a = 0;
                        while($a<count($all_metas["curso_historico_conclusao"])):

                          $registro = json_decode($all_metas["curso_historico_conclusao"][$a]);

                      ?>
                      <tr>
                        <td><?php echo get_the_title($registro->curso); ?></td>
                        <td><?php echo $registro->data; ?></td>
                      </tr>
                      <?php 

                        $a++;
                        endwhile;

                      ?>

                  </tbody>
         </table>

     </div>

    


    <h4 style="padding-left: 38px;">Conclusão de testes</h4>
    <div style="padding: 38px;padding-top: 0px;">

        <table class="wp-list-table widefat fixed striped table-view-list users">
                  <thead>
                    <tr>
                      <td>Curso</td>
                      <td>Data</td>
                      <td>Aula</td>
                      <td>Nota</td>
                    </tr>
                  </thead>
                  <tbody id="listaDeResultadosTestes">

                      <?php 

                        $a = 0;
                        while($a<count($all_metas["curso_historico_teste"])):

                          $registro = json_decode($all_metas["curso_historico_teste"][$a]);

                      ?>
                      <tr>
                        <td><?php echo get_the_title($registro->curso); ?></td>
                        <td><?php echo $registro->data; ?></td>
                        <td><?php echo $registro->posicao; ?></td>
                        <td><?php echo $registro->nota; ?></td>
                      </tr>
                      <?php 

                        $a++;
                        endwhile;

                      ?>

                  </tbody>
         </table>

     </div>







    <h4 style="padding-left: 38px;">Acesso as aulas</h4>
    <div style="padding: 38px;padding-top: 0px;">

        <table class="wp-list-table widefat fixed striped table-view-list users">
                  <thead>
                    <tr>
                      <td>Curso</td>
                      <td>Data</td>
                      <td>Aula</td>
                    </tr>
                  </thead>
                  <tbody id="listaDeResultados">

                      <?php 

                        $a = 0;
                        while($a<count($all_metas["curso_historico"])):

                          $registro = json_decode($all_metas["curso_historico"][$a]);

                      ?>
                      <tr>
                        <td><?php echo get_the_title($registro->curso); ?></td>
                        <td><?php echo $registro->data; ?></td>
                        <td><?php echo $registro->posicao; ?></td>
                      </tr>
                      <?php 

                        $a++;
                        endwhile;

                      ?>

                  </tbody>
         </table>

     </div>

    

</div>
