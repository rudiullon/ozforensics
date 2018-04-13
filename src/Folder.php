<?php
/**
 * Created by PhpStorm.
 * User: Rudi
 * Date: 4/9/2018
 * Time: 9:09 PM
 */

namespace OzForensics;
use GuzzleHttp\Client;

class Folder extends OzForensicsClient{
    private $method = 'POST';
    private $files = [];

    public function __construct()
    {
        parent::__construct();
    }


    public function save()
    {
        return $this->createFolder();
    }

    private function createFolder()
    {
        $client = new  Client([
            'base_uri' => $this->api_uri,
            'timeout'  => 20.0,
        ]);

        $response = $client->request('POST', 'api/folders', [
            'headers' => [
                'X-Forensic-Access-Token' => $this->api_token,
                'Content-Type'  => 'application/x-www-form-urlencoded'

            ]
        ]);

        $json_response = $this->getResponse($response);

        return ($json_response)?$json_response->folder_id:false;
    }

    public static function getImages($folder_id)
    {
        /**
            "time_created": 1473928090,
            "time_updated": 1473928090, "image_id": "0386bceb-e87d-463d-bcbf-
            d17828b71780",
            "original_url": "http://127.0.0.1:8000/static/33c727a1-3652-4646- a6eb-7dec394243e9/0386bceb-e87d-463d-bcbf- d17828b71780.jpg",
            "thumb_url": "http://127.0.0.1:8000/static/33c727a1-3652-4646- a6eb-7dec394243e9/0386bceb-e87d-463d-bcbf- d17828b71780_thumb.jpg",
            "original_name": "MczOHD2AOts.jpg"
         *
         **/

        $client = new OzForensicsClient;
        return $client->makeRequest('folders/'.$folder_id.'/images');
    }

    public static function putImage($folder_id,$name,$file_name,$file_path)
    {

        $client = new OzForensicsClient;
        $client->addFile($name,$file_name,$file_path);
        return $client->makeRequest('folders/'.$folder_id.'/images','POST');


    }

    public static function deleteImage($folder_id,$image_id)    {

        $client = new OzForensicsClient;
        return $client->makeRequest('folders/'.$folder_id.'/images/'.$image_id,'DELETE');


    }

    public static function launchAnalysys($folder_id)    {

        $client = new OzForensicsClient;
        return $client->makeRequest('folders/'.$folder_id.'/analyses','PATCH');


    }

    public static function getAnalysys($folder_id)    {

        $client = new OzForensicsClient;
        return $client->makeRequest('folders/'.$folder_id.'/analyses','GET');


    }

    public static function getList($offset=0,$limit=100)
    {
        $client = new OzForensicsClient;
        return $client->makeRequest('folders?offset='.$offset.'&limit='.$limit);
    }
    
    
    
    
}