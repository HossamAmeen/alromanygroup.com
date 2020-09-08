<?php namespace App\Helpers;
use Auth;
use Request;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Requests;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Topic;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use App\Models\PrefsModel;
class APIHelper  {

   /*to do
   * check crsf $except urls
    *
    */
   const TOKEN = "nuwsadfPEW/%#x5KQ68P1Uhj2ex/UQY";
   const FIREBASE_TOKEN ="AAAA9qZucDs:APA91bE2cynI7aOo5lZVhZTpvzJzpHBo5-25JqrhCc0UkYZx7N0r56babdAoafSa0giXm_NKOq7ZKzkYlT1a8XtQibfUPzL-qUaKY5I_J9cIm3m9J3dN141ReqCF3_jzzxtLuVIbzeeTDWhLRsvZ2HWL7YZBZLcTLQ";


   public static function send_notification($id,$title, $isNews = false){

      $server_key = APIHelper::FIREBASE_TOKEN;
      $client = new Client();
      $client->setApiKey($server_key);
      $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

      $message = new Message();
      $message->setPriority('high');
      $message->addRecipient(new Topic('elmasria'));
      $message
          ->setNotification(new Notification(PrefsModel::get_title_value(), $title))
          ->setData(['id' => $id, 'isNews'=>$isNews])
      ;

      $response = $client->send($message);
//      var_dump($response);
//      var_dump($response->getStatusCode());
//      var_dump($response->getBody()->getContents());
   }
}//end File Helper