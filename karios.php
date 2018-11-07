<?
// set variables
$queryUrl = "http://api.kairos.com/detect";
$imageObject = '{"image":"https://media.kairos.com/liz.jpg"}';
$APP_ID = "5f758a52";
$APP_KEY = "c285c744c2892109755557dd91244b8a";

$request = curl_init($queryUrl);


// set curl optional
curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request, CURLOPT_POSTFIELDS, $imageObject);
curl_setopt($request, CURLOPT_HTTPHEADER, array(
    "Content-type: application/json",
    "app_id:" . $APP_ID,
    "app_key:" . $APP_KEY
    )
);

// test comment for git push
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($request);

// show api response
echo $response;

// close session
curl_close($request);


?>