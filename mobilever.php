<?php
session_start();
include 'config.php';
extract($_POST);

if($data == "get"){

   $rand = mt_rand(100000,999999);
   $_SESSION['mobile_otp'] = $rand;

  $field = array(
    "sender_id" => "FSTSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $_POST['number'],
    "message" => "42879",
    "variables" => "{#BB#}",
    "variables_values" => $rand
  );

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($field),
    CURLOPT_HTTPHEADER => array(
      "authorization: GknFQPcmq34Z726jrDLOyxti0XpBUA1TCIWu5owgvHMJadV9fRicPS7uU3K9NadRZtCg54QBIvHMGhV0",
      "cache-control: no-cache",
      "accept: */*",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    
    echo 1;
  }
}

  else if($data == "verify") {
    if($mobileotpfield != $_SESSION['mobile_otp'] )
    {
      echo 0;
    }
    else{
      echo 1;
    }
  }

  ?>