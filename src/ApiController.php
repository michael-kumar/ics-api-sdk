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
        if ($data != false && !empty($data)) {
            $options['form_params'] = $data;
        }

        try {
            $response = $this->guzzle->request($this->method, $this->apiUrl.$url, $options);
        } catch (\Exception $e) {
            $error = new \stdClass();
            $error->success = 0;
            $error->error = $e->getMessage();
            return $error;
        }

        return json_decode($response->getBody()->getContents());
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