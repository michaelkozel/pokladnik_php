<?php
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAAOHAxnRQ:APA91bE2yiwkTDRU-1RlU4Tna5rBfrj5AEoqFQdfzcSYH-nIxaLUoErx1JzyjHdFongNODuvvnKf55d8TfKMntxELlbSu_Z2TYBQXXHGU2diq1tEI1qb5wZmPw99ukW9eh8n77VoCtKX' );
    $registrationIds = "e_LkA9X9ifg:APA91bFEEAY9oNS0N54eysqhfz6p-ny98l6p7WUJcexA8Yp6Krw0SykoFXV6AgY3DCIcqQi-rSjoHoOXrgk-Re5QmGQnjL7o9f823Ku6-Y1GuBGpYWxlua2A4k-fW5GiuzkeIVo0rFZd";
#prep the bundle
     $msg = array
          (
		'body' 	=> 'Body  Of Notification',
		'title'	=> 'Title Of Notification',
             	'icon'	=> 'myicon',/*Default Icon*/
              	'sound' => 'mySound'/*Default sound*/
          );
	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
#Echo Result Of FireBase Server
echo $result;