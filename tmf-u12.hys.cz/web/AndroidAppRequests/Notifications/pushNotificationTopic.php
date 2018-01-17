<?php
function notifikuj($titulek,$text){
// API access key from Google API's Console
define('API_ACCESS_KEY', 'AAAAOHAxnRQ:APA91bE2yiwkTDRU-1RlU4Tna5rBfrj5AEoqFQdfzcSYH-nIxaLUoErx1JzyjHdFongNODuvvnKf55d8TfKMntxELlbSu_Z2TYBQXXHGU2diq1tEI1qb5wZmPw99ukW9eh8n77VoCtKX' );
// prep the bundle
$msg = array
(
    'body'  => "$text",
    'title'     => "$titulek",
    'vibrate'   => 1,
    'sound'     => 1,
);

$fields = array
(
    'to'  => '/topics/pokladnaU12',
    'notification'          => $msg
);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
}
?>