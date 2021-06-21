<?php

namespace SirmaICS;


use Dotenv\Dotenv;
use GuzzleHttp\Client;

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

    public function setConfiguration()
    {
        $this->apiUsername    = isset($_ENV['SIRMAICS_API_USERNAME'])?$_ENV['SIRMAICS_API_USERNAME'] : null;
        $this->apiPassword    = isset($_ENV['SIRMAICS_API_PASSWORD'])?$_ENV['SIRMAICS_API_PASSWORD'] : null;
        $this->apiCertificate = isset($_ENV['SIRMAICS_API_CERT_PATH'])?$_ENV['SIRMAICS_API_CERT_PATH'] : null;
        $this->apiKey         = isset($_ENV['SIRMAICS_API_KEY_PATH'])?$_ENV['SIRMAICS_API_KEY_PATH'] : null;
        $this->apiUrl         = isset($_ENV['SIRMAICS_API_URL'])?$_ENV['SIRMAICS_API_URL'] : null;

        if(empty($this->apiUsername))
        {
            throw new \Exception('Username not provided');
        }

        if(empty($this->apiPassword))
        {
            throw new \Exception('Password not provided');
        }

        if(empty($this->apiUrl))
        {
            throw new \Exception('Api URL not provided');
        }

        if(empty($this->apiCertificate))
        {
            throw new \Exception('Certificate not provided');
        }

        if(empty($this->apiKey))
        {
            throw new \Exception('Api Key not provided');
        }

        if(!file_exists($this->apiCertificate))
        {
            throw new \Exception('Wrong certificate path - file not found');
        }

        if(!file_exists($this->apiKey))
        {
            throw new \Exception('Wrong certificate key path - file not found');
        }

        $this->guzzle = new \GuzzleHttp\Client();
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

    public function postCall($url, $data = false, $string = true)
    {
        if ($this->token == false) {
            $this->authenticate();
        }

        $options = [
            'headers'         => [
                'Authorization' => 'Bearer '.$this->token,
            ],
            'cert'            => $this->apiCertificate,
            'ssl_key'         => $this->apiKey,
            'timeout'         => 60,
            'connect_timeout' => 60,
        ];
        if ($data != false && !empty($data) && $this->method == 'POST') {
            $options['form_params'] = $data;
        }elseif($data != false && !empty($data) && $this->method == 'GET'){
            $url = $url.'?'.http_build_query($data);
        }

        try {
            $response = $this->guzzle->request($this->method, $this->apiUrl.$url, $options);
        } catch (\Exception $e) {
            $error = new \stdClass();
            $error->success = 0;
            $error->error = $e->getMessage();
            return $error;
        }
        $cleanResponse = $response->getBody()->getContents();
        $response = json_decode($cleanResponse) == null ? $cleanResponse : json_decode($cleanResponse);

        return $response;
    }

    public function authenticate()
    {
        $url  = '/security/authenticate';
        $data = [
            'form_params' => [
                'email'    => $this->apiUsername,
                'password' => $this->apiPassword,
            ],
            'cert'        => $this->apiCertificate,
            'ssl_key'     => $this->apiKey,
        ];

        $response = $this->guzzle->post($this->apiUrl.$url, $data);

        $res = json_decode($response->getBody()->getContents());
        if ($response->getStatusCode() == 200 && $res->success != 0) {
            $this->token = $res->result;
        } else {
            $this->authenticate();
        }
    }

}