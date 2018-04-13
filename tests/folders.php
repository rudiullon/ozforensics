<?php
include('../vendor/autoload.php');
include('../src/OzForensicsClient.php');
include('../src/Folder.php');


$f = new \OzForensics\Folder();


#$folder_list = Folder::getList();


$result  = \OzForensics\Folder::putImage('502f9c18-9b3c-4d1d-9091-158a33df9b38','image1','foto1.jpg', 'D:\\www\\packages\\ozforensics\\tests\\images');
#$uploaded2 = $f->addFile('foto2','foto2.jpg','D:\\www\\packages\\ozforensics\\tests\\images\\foto2.jpg');
#$uploaded3 = $f->addFile('foto3','foto3.jpg','D:\\www\\packages\\ozforensics\\tests\\images\\foto3.jpg');

#$result = $f->save();

#$result = \OzForensics\Folder::getImages('502f9c18-9b3c-4d1d-9091-158a33df9b38');

echo '<pre>';


var_dump($result);

/*
$client = new  GuzzleHttp\Client([
    'base_uri' => 'https://oz-services.ru',
    'timeout'  => 20.0,
]);

try {
    $response = $client->request('POST', 'api/folders', [
        'headers' => [
            'X-Forensic-Access-Token' => '3f9cab9923e91183ab75fe574db76559ecbdb580cec0aa1588177647f0b9c69865b5f17823ee98ccb6762b3f477f59d9e26feace2b71d157f3c4c18a611b8a6a',
            'Content-Type'  => 'application/x-www-form-urlencoded'

        ],

        'multipart' => [
            [
                'name' => 'field_name',
                'contents' => 'abc'
            ],
            [
                'name' => 'file_name',
                'contents' => fopen('D:\\www\\packages\\ozforensics\\tests\\images\\foto1.jpg', 'r')
            ],
            [
                'name' => 'other_file',
                'contents' => 'D:\\www\\packages\\ozforensics\\tests\\images\\foto2.jpg',
                'filename' => 'image2.jpg'
            ]
        ]
    ]);
}catch (Exception $e)
{
    var_dump(
        $e->getCode(),
        $e->getFile(),
        $e->getLine(),
        $e->getMessage()
    );
}

if(@$response){
    var_dump(
        $response->getStatusCode(),
        $response->getReasonPhrase(),
        json_decode($response->getBody())
    );
}
*/

echo '</pre>';