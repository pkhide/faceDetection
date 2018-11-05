<?
namespace Face\Classes;

class faceAPI{
    private $key;
    private $url = "https://westcentralus.api.cognitive.microsoft.com/face/v1.0";

    public function __construct($key){
        $this->key = $key;
    }

    public function detect($image){
        $client = new \GuzzleHttp\Client();
        $result = new $client->request('POST', $this->url."/detect",['body' => $image, 
        'headers' => [
            'Content-Type' => 'application/octet-stream',
            'Ocp-Apim-Subscription-Key' => $this-key,
        ]]);
        return json_decode($result->getBody()->getContents());
    }

    public function verify($faceID1, $faceID2){
        $client= new \GuzzleHttp\Client();
        $result= $client->request('POST', $this->url."/verify", ['json' => ['faceID1'
        => $faceID1, "faceID2" => $faceID2], 'header' => [
            'Content-Type' => 'application/json',
            'Opc-Apim-Subscription-Key' => $this->key,
        ]]);
        return json_decode($result->getBody()->getContents());
    }
}
?>