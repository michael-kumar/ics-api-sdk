<?php

namespace SirmaICS\Requests;

use SirmaICS\ApiController;

/**
 * Class NomenclaturesRequest
 * @package SirmaICS\Requests
 */
class NomenclaturesRequest extends  ApiController
{
    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getCountries(){
        $url = '/locations/countries';
        $this->setMethod('GET');
        return $this->postCall($url);
    }

    /**
     * @param $country_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getRegions($country_id)
    {
        $url = '/locations/regions';
        $this->setMethod('GET');
        return $this->postCall($url,['country_id' => $country_id]);
        
    }

    /**
     * @param $region_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getMunicipalities($region_id)
    {
        $url = '/locations/municipalities';
        $this->setMethod('GET');
        return $this->postCall($url,['region_id' => $region_id]);
        
    }

    /**
     * @param $municipality_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getCities($municipality_id)
    {
        $url = '/locations/cities';
        $this->setMethod('GET');
        return $this->postCall($url,['municipality_id' => $municipality_id]);
        
    }

    /**
     * @param $city_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getZip($city_id)
    {
        $url = '/locations/zip';
        $this->setMethod('GET');
        return $this->postCall($url,['city_id' => $city_id]);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getCompanyTypes()
    {
        $url = '/owner/company-types';
        $this->setMethod('GET');
        return $this->postCall($url);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getGuiltTypes()
    {
        $url = '/person/guilt-types';
        $this->setMethod('GET');
        return $this->postCall($url);
        
    }

}