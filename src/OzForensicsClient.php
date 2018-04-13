<?php
/**
 * Created by PhpStorm.
 * User: Rudi
 * Date: 4/9/2018
 * Time: 5:19 PM
 */
namespace OzForensics;

use GuzzleHttp\Client;

class OzForensicsClient{
    protected $api_ip = 'https://oz-services.ru';

    protected $api_folder = 'api';
    protected $api_token = env('ozforensics_token','__');

    protected $api_uri = '';
    protected $client;
    protected $request_options = [];

    public function __construct()
    {
        $this->api_uri = $this->api_ip;

        $this->client = new Client([
            'base_uri' => $this->api_uri,
            'timeout'  => 20.0,
        ]);

        $this->addHeader('X-Forensic-Access-Token',$this->api_token);
        #$this->addHeader('Cache-Control','no-cache');
    }




    public function makeRequest($path,$method='GET')
    {
        $path = $this->api_folder.'/'.$path;
        $response = $this->client->request($method, $path,$this->request_options);

        return $this->getResponse($response);

    }

    public function addHeader($key,$value)
    {
        $this->request_options['headers'][$key] = $value;
    }

    public function setBody($body)
    {
        $this->request_options['body'] = $body;
    }

    public function addFile($var_name,$file_name,$file_path)
    {
        $multipart = [
            'name'     => $var_name,
            'contents' => fopen($file_path.'/'.$file_name, 'r'),
            'filename' => $file_name

        ];

        $this->addMultipart($multipart);
        return $multipart;
    }

    public function addMultipart($multipart)
    {
        $this->request_options['multipart'][] = $multipart;
    }


    protected function getResponse($response)
    {
        if($response->getStatusCode()>199 and $response->getStatusCode() < 300){
            return \GuzzleHttp\json_decode($response->getBody());
        }else{
            return false;
        }
    }
}

