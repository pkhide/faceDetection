<?
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

$imageAnnotator = new ImageAnnotatorClient();

$path = '‎⁨/07.png';
$image = file_get_contents($path);
$response = $imageAnnotator->faceDetection($image);
$faces = $response->getFaceAnnotations();

if ($faces && $outFile) {
    $imageCreateFunc = [
        'png' => 'imagecreatefrompng',
        'gd' => 'imagecreatefromgd',
        'gif' => 'imagecreatefromgif',
        'jpg' => 'imagecreatefromjpeg',
        'jpeg' => 'imagecreatefromjpeg',
    ];
    $imageWriteFunc = [
        'png' => 'imagepng',
        'gd' => 'imagegd',
        'gif' => 'imagegif',
        'jpg' => 'imagejpeg',
        'jpeg' => 'imagejpeg',
    ];

    copy($path, $outFile);
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if (!array_key_exists($ext, $imageCreateFunc)) {
        throw new \Exception('Unsupported image extension');
    }
    $outputImage = call_user_func($imageCreateFunc[$ext], $outFile);

    foreach ($faces as $face) {
        $vertices = $face->getBoundingPoly()->getVertices();
        if ($vertices) {
            $x1 = $vertices[0]->getX();
            $y1 = $vertices[0]->getY();
            $x2 = $vertices[2]->getX();
            $y2 = $vertices[2]->getY();
            imagerectangle($outputImage, $x1, $y1, $x2, $y2, 0x00ff00);
        }
    }
}

call_user_func($imageWriteFunc[$ext], $outputImage, $outFile);
printf('Output image written to %s' . PHP_EOL, $outFile);
?>