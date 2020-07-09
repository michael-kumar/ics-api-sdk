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

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleTypes() : \stdClass
    {
        $url = '/objects/vehicle-types';
        $this->setMethod('GET');
        return $this->postCall($url);

    }

    /**
     * @param $vehicle_type_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleBodyTypes($vehicle_type_id) : \stdClass
    {
        $url = '/objects/vehicle-body-types';
        $this->setMethod('GET');
        return $this->postCall($url, ['vehicle_type_id' => $vehicle_type_id]);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleUsage() : \stdClass
    {
        $url = '/objects/vehicle-usage';
        $this->setMethod('GET');
        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleColors() : \stdClass
    {
        $url = '/objects/colors';
        $this->setMethod('GET');
        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getAssistanceNomenclature() : \stdClass
    {
        $url = '/objects/assistance-nomenclature';
        $this->setMethod('GET');
        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleEngineTypes() : \stdClass
    {
        $url = '/objects/engine-types';
        $this->setMethod('GET');
        return $this->postCall($url);

    }

    /**
     * @param bool $insurer
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleMarks($insurer = false) : \stdClass
    {
        $data = $insurer == false ? false : ['insurer' => $insurer];
        $url  = '/objects/vehicle-marks';
        $this->setMethod('GET');
        return $this->postCall($url, $data);

    }

    /**
     * @param $mark_id
     * @param bool $insurer
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleModels($mark_id, $insurer = false) : \stdClass
    {
        $data = ['vehicle_mark_id' => $mark_id];
        if ($insurer != false) {
            $data['insurer'] = $insurer;
        }
        $url = '/objects/vehicle-models';
        $this->setMethod('GET');
        return $this->postCall($url, $data);

    }

}