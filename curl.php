<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8088",
  CURLOPT_URL => "http://148.70.223.113:8088/user/userAuthorized",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"publicKey\": \"0e67f628aaa315620497aa3edf0980a0\",\n    \"secretKey\": \"3ab227dcf68ee6fc88a0f839262c560a\",\n    \"timestamp\": \"1591457019872\",\n    \"accountId\": \"1\",\n    \"sellerId\": \"123456\",\n    \"sellerToken\": \"sdfafdasdasdasdasd\",\n    \"developerId\": \"123123123\",\n    \"amazonAccountId\": \"whb199330@163.com\",\n    \"marketplaceId\": \"europe\",\n    \"operator\": \"1\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Length: 332",
    "Content-Type: application/json",
    "Host: 148.70.223.113:8088",
    "Postman-Token: 1773e1c4-f1cd-4130-b022-51f6ab403718,e6cdaf8d-0100-4563-9d99-414e0bd3ca1f",
    "User-Agent: PostmanRuntime/7.20.1",
    "cache-control: no-cache"
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