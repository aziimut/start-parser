<?php
header('Content-type: text/html; charset=utf-8');
require_once 'vendor/autoload.php';
require_once 'phpQuery.php';

//=====================================================================
//=========[Functionc]=================================================
//=====================================================================
function request($url, $postdata = null, $cookiefile = 'tmp/cookie.txt'){
//инициализируем cUrl
$ch = curl_init($url);
//возвращает данные
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//следовать за редиректом
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// отключение проверок https
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//прокси сервер
curl_setopt($ch, CURLOPT_PROXY, '185.142.208.160:35367');
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
curl_setopt($ch, CURLOPT_TIMEOUT, 9);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
//useragent
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0');
//cookie
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
//====================================================================
if($postdata){
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
}
//записываем в переменную
$html = curl_exec($ch);
//Закрыли дескриптор
curl_close($ch);

return $html;

}


//=====================================================================
//=========[My codes]==================================================
//=====================================================================

file_put_contents('tmp/cookie.txt','');

/*пример запроса
$post = [
  'username' => '*********',
  'password' => '*********'
];
$html = request('https://index.php?route=common/login', $post);
echo $html;
*/

//phpQuery

$html = request('https://besplatka.ua/kharkov/nedvizhimost/prodazha-komercheskoy-nedvizhimosti/pomeshenie-svobodnogo-naznacheniya?currency=USD');
//$html = request('http://httpbin.org/ip'); xprint($html);//проверка прокси

$doc = phpQuery::newDocument($html);

$messages_lists = trim($doc->find('.messages-list:eq(1)')->text());






xprint($messages_lists);









phpQuery::unloadDocuments();
