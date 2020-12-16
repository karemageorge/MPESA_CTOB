  <?php

  


// function generateToken(){
  $consumerKey = '5R9khgKLFGGyvIKKaaEtX1ABCy8VtvJA'; //Fill with your app Consumer Key
  $consumerSecret = 'YrEjIuPRPfP5Lvjm'; // Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  echo $access_token;

  curl_close($curl);

// }

// function registerURL(){ 

  $C2b_url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $C2b_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => '7487467',
    'ResponseType' => 'completed',
    'ConfirmationURL' => 'http://karemaspeaks.co.ke/confirmation/index.php',
    'ValidationURL' => 'http://karemaspeaks.co.ke/validation_Url/index.php'
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  
  echo $curl_response;
// }

// function simulateTransaction(){
$url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/simulate';
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
  
  
    $curl_post_data = array(
            //Fill in the request parameters with valid values
           'ShortCode' => '600000',
           'CommandID' => 'CustomerPayBillOnline',
           'Amount' => '1000',
           'Msisdn' => '254708374149',
           'BillRefNumber' => 'test'
    );
  
    $data_string = json_encode($curl_post_data);
  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
    $curl_response = curl_exec($curl);
    print_r($curl_response);
  
    echo $curl_response;
  //  }


// $data = file_get_contents('php://input');
// $handle = fopen('validation.txt','w');
// fwrite($handle, $data);

  ?>
  