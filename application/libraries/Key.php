<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Key{
    
	 private $fcm_server_key = 'AAAAtkmcuU0:APA91bFAhB746O53uKjEgvI0HfrO6dzYuhj8kax8EpfcMG0V7cdFTtbhUqR3nWQL49yWdhF3AdHwjrbre2vtnO5eqoFHmG5v06wVOztn4I9_ZqYPmW7Jmz35slwVOut1-smasgm7FjuO ';
	private function get_fcm_server_key() {
        return $this->fcm_server_key;
    }
     public function _send_fcm($reg_id,$message) {
         if(json_decode($message)->direct_link == '#'){
             $direct_link = base_url('login');
         }
         else{
             $direct_link = json_decode($message)->direct_link;
         }
//         $fields = array(
//            'to' => $reg_id,
//            'data' => array(
//                'title' => 'TELEMEDICINE', 
//                'body' => $message
//            ),
//            'notification' => array(
//                'title' => 'TELEMEDICINE LINTASARTA',
//                'icon' => 'https://cdn1.iconfinder.com/data/icons/button-glyph/64/button_2-24-512.png',
//                'body' => json_decode($message)->keterangan,
//                'click_action' => $direct_link
//            )
//        );
         $fields = array(
            'to' => $reg_id,
            'data' => array(
                'title' => 'TELEMEDICINE', 
                'body' => $message
            )
        );
        $headers = array(
            'Authorization:key=' . $this->get_fcm_server_key(),
            'Content-Type:application/json'
        );       
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        echo $response;
    }
}

?>