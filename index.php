<html>
<head>
    <title>Face Detect Sample</title>
</head>
<body>
<?
$ocpApimSubscriptionKey = '9316f559557d4c71b63d2aa0bcb7ccee';
$uriBase = 'https://westcentralus.api.cognitive.microsoft.com/face/v1.0';
$imageUrl="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/6/2017/07/04140436/Obama-photos-750x229.jpg";
//$imageUrl="http://www.superandoseuslimites.com.br/wp-content/uploads/2016/12/pnl-para-pilotos.jpg";
//$imageUrl ='https://upload.wikimedia.org/wikipedia/commons/3/37/Dagestani_man_and_woman.jpg';

require_once 'HTTP/Request2.php';
$request = new Http_Request2($uriBase . '/detect');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $ocpApimSubscriptionKey
);
$request->setHeader($headers);

$parameters = array(
    // Request parameters
    'returnFaceId' => 'true',
    'returnFaceLandmarks' => 'false',
    'returnFaceAttributes' => 'age,gender,headPose,smile,facialHair,glasses,' .
        'emotion,hair,makeup,occlusion,accessories,blur,exposure,noise');
$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

$body = json_encode(array('url' => $imageUrl));
$request->setBody($body);

try
{
    $response = $request->send();
    echo "<pre>" .
        json_encode(json_decode($response->getBody()), JSON_PRETTY_PRINT) . "</pre>";
}
catch (HttpException $ex)
{
    echo "<pre>" . $ex . "</pre>";
}
?>
</body>
</html>