<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Log;
class linewebhook extends Model
{
  public static function sent($data,$arrayHeader)
   {
       $strUrl = "https://api.line.me/v2/bot/message/push";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL,$strUrl);
       curl_setopt($ch, CURLOPT_HEADER, false);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       $result = curl_exec($ch);
       curl_close ($ch);
         Log::info($result);

   }
   public static function getprofile($mid)
   {
       $accessToken = "CSauZ7fd6W7nv6ycXkR1q5opd1MYmtmv2H6r/wYT0cpcjvzaznd5BmtdWv3asW32eb3fEJRdip3/rUCGZVZTzmZ1S8x09x+wYJLDYcruLvq/qdhLanwxyCYoSg/3+7l6WPri4ybXxs8D2wBQb+J/RwdB04t89/1O/w1cDnyilFU=";
       //  $lineSettingBusiness = LineSettingBusiness::where('active', 1)->first();
       $curl = curl_init();
       curl_setopt_array($curl, array(
           CURLOPT_URL => "https://api.line.me/v2/bot/profile/".$mid,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "GET",
           CURLOPT_HTTPHEADER => array(
               "authorization: Bearer ".$accessToken,
               "cache-control: no-cache",
           ),
       ));
       $response = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);
       if ($err) {
           echo "cURL Error #:" . $err;
       } else {
           echo $response;
       }
       return json_decode($response,true);
   }
}
