<?php

namespace SirmaICS;


use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use function Couchbase\defaultDecoder;

/**
 * Class ApiController
 * @package SirmaICS
 */
abstract class ApiController
{
    protected $apiUrl;
    protected $guzzle;
    protected $apiUsername;
    protected $apiPassword;
    protected $apiCertificate;
    protected $apiKey;
    protected $token = false;
    protected $method = 'POST';

    public function __construct()
    {
        $this->setConfiguration();
    }

    /**
     * @param Client $client
     * @return void
     */
    public function setClient(Client $client)
    {
        $this->guzzle = $client;
    }

    public function setConfiguration(Client $client = null)
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dotenv->required('SIRMAICS_API_URL')->notEmpty();
        $dotenv->required('SIRMAICS_API_USERNAME')->notEmpty();
        $dotenv->required('SIRMAICS_API_PASSWORD')->notEmpty();
        $dotenv->required('SIRMAICS_API_CERT_PATH')->notEmpty();
        $dotenv->required('SIRMAICS_API_KEY_PATH')->notEmpty();

        $this->apiUsername    = $_ENV['SIRMAICS_API_USERNAME'];
        $this->apiPassword    = $_ENV['SIRMAICS_API_PASSWORD'];
        $this->apiCertificate = $_ENV['SIRMAICS_API_CERT_PATH'];
        $this->apiKey         = $_ENV['SIRMAICS_API_KEY_PATH'];
        $this->apiUrl         = $_ENV['SIRMAICS_API_URL'];

        if(!file_exists($this->apiCertificate))
        {
            throw new \Exception('Wrong certificate path - file not found');
        }

        if(!file_exists($this->apiKey))
        {
            throw new \Exception('Wrong certificate key path - file not found');
        }


    }

    public function setMethod($method)
    {
        if (in_array($method, ['GET', 'POST'])) {
            $this->method = $method;
        } else {
            throw new \Exception('Невалиден метод');
            exit();
        }
    }

    public function postCall($url, $data = false)
    {
        if(empty($this->guzzle)){
            $this->guzzle = new Client();
        }

        if ($this->token == false) {
            $auth = $this->authenticate();
            if($auth !== true){
                return $auth;
            }
        }

        $options = [
            'base_uri' => $this->apiUrl,
            'headers'         => [
                'Authorization' => 'Bearer '.$this->token,
            ],
            'cert'            => $this->apiCertificate,
            'ssl_key'         => $this->apiKey,
            'timeout'         => 60,
            'connect_timeout' => 60,
            'protocols' => ['https']
        ];

        if ($data != false && !empty($data) && $this->method == 'POST') {
            $options['form_params'] = $data;
        }elseif($data != false && !empty($data) && $this->method == 'GET'){
            $url = $url.'?'.http_build_query($data);
        }

        try{
            $response = $this->guzzle->request($this->method,$url,$options);
        }catch (ClientException $e){
            return json_decode($e->getResponse()->getBody(true)->getContents());
        }

        return json_decode($response->getBody()->getContents());
    }

    public function authenticate()
    {

        $url  = 'security/authenticate';
        $data = [
            'base_uri' => $this->apiUrl,
            'form_params' => [
                'email'    => $this->apiUsername,
                'password' => $this->apiPassword,
            ],
            'cert'        => $this->apiCertificate,
            'ssl_key'     => $this->apiKey,
        ];



        try{
            $response = $this->guzzle->post($url, $data);
            $res = json_decode($response->getBody()->getContents());
            $this->token = $res->result;
            return true;
        }catch (ClientException $e){
            return json_decode($e->getResponse()->getBody(true)->getContents());
        }
    }

}