<?php 

function sendsms($telefon, $msg){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://91.204.239.44/broker-api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"messages\": [ { \"recipient\": \"$telefon\", \"message-id\": \"2016256\", \"sms\": { \"originator\": \"3700\", \"content\": { \"text\": \" SamDCHTI sizning arizangiz $msg . To'liq malumotni shaxsiy kabinetdan tekshirishingiz mumkin. \" } } } ] }",
            CURLOPT_HTTPHEADER => array(
             "Authorization: Basic c2FtZGNodGk6ZTkzJiZnQVQ3KXBV",
              "Cache-Control: no-cache",
              "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        print_r($response);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "no";
        }
        else {
            return "ok";
        }
    }
   echo sendsms("998937286867","TEST");