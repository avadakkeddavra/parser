<?php
namespace controllers;

use core\Controller;
use models\MainModel;
use components\Parser;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Guzzle\Http\Message\Response;
use GuzzleHttp\Psr7\Request;


class MainController extends Controller
  {

   public static function sort($id,$id_prod,array $data)
   {
   		$count = 0;
		foreach ($data as $value) {
			if($value['d'] == $id || $value['c'] == $id_prod)
			{
				$count++;
			}
		}
		return $count;
   } 

   public function indexAction()
   {

      $client = new Client();
     
      $response = $client->post('https://ru.cs.deals/ajax/botsinventory',['headers' => [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
        'Accept'     => 'application/json, text/javascript, */*; q=0.01',
        'cookie'      => '__cfduid=da2f61f2dabf0764036a70d73f6091b021504081007; sessionID=j5djtqt1lfbk78qv6scq7b6ia8; lang=ru; _ga=GA1.2.622372034.1504081014; _gid=GA1.2.1931684779.1504081014',
        'accept-encoding' => 'gzip, deflate, br',
        'accept-language' => 'ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
        'content-length' => 0,
        'content-type' => 'application/json',
        'origin' => 'https://ru.cs.deals',
        'referer' => 'https://ru.cs.deals/',
        'x-requested-with' => 'XMLHttpRequest'
    ],'future' => true]);

      $data = $response->json();
      $data = $data['response'];
      $relations = [];
      foreach($data as $key => $item) :
		if(!is_string($item['d']))
		{
			$relations[] = $item;
		}
		endforeach;

		$outputData = []; //output data array, already sorted
		foreach($data as $key => $item){
			 if(is_string($item['m'])):
			 	$outputData[$key]['title'] = $item['d'];
			 	$outputData[$key]['quantity'] = MainController::sort($key,$item['c'],$relations);
			 	$outputData[$key]['price'] = $item['v'];
			 endif;
		}
	
      return $this->view->generate('mail', 'home.php',$outputData);
   }

   public function parseAction()
   {
      $client = new Client();
     
      $response = $client->post('https://ru.cs.deals/ajax/botsinventory',['headers' => [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
        'Accept'     => 'application/json, text/javascript, */*; q=0.01',
        'cookie'      => '__cfduid=da2f61f2dabf0764036a70d73f6091b021504081007; sessionID=j5djtqt1lfbk78qv6scq7b6ia8; lang=ru; _ga=GA1.2.622372034.1504081014; _gid=GA1.2.1931684779.1504081014',
        'accept-encoding' => 'gzip, deflate, br',
        'accept-language' => 'ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
        'content-length' => 0,
        'content-type' => 'application/json',
        'origin' => 'https://ru.cs.deals',
        'referer' => 'https://ru.cs.deals/',
        'x-requested-with' => 'XMLHttpRequest'
    ],'future' => true]);

      $data = $response->json();
      $data = $data['response'];
      $relations = [];
      foreach($data as $key => $item) :
		if(!is_string($item['d']))
		{
			$relations[] = $item;
		}
		endforeach;

		$outputData = []; //output data array, already sorted
		foreach($data as $key => $item){
			 if(is_string($item['m'])):
			 	$outputData[$key]['title'] = $item['d'];
			 	$outputData[$key]['quantity'] = MainController::sort($key,$item['c'],$relations);
			 	$outputData[$key]['price'] = $item['v'];
			 	$outputData[$key]['time'] =  date('h:i:s');
			 endif;
		}
	
      echo json_encode($outputData);
   }

  }

?>
