<?php

namespace SirmaICS\Requests;

use GuzzleHttp\Client;
use SirmaICS\ApiController;

/**
 * Class NomenclaturesRequest
 * @package SirmaICS\Requests
 */
class NomenclaturesRequest extends ApiController
{
    /**
     * NomenclaturesRequest constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        parent::__construct($client);
    }


    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getCountries() : \stdClass
    {
        $url = 'locations/countries';

        return $this->postCall($url);
    }

    /**
     * @param $country_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getRegions($country_id) : \stdClass
    {
        $url = '/locations/regions';

        return $this->postCall($url, ['country_id' => $country_id]);

    }

    /**
     * @param $region_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getMunicipalities($region_id) : \stdClass
    {
        $url = '/locations/municipalities';

        return $this->postCall($url, ['region_id' => $region_id]);

    }

    /**
     * @param $municipality_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getCities($municipality_id) : \stdClass
    {
        $url = '/locations/cities';

        return $this->postCall($url, ['municipality_id' => $municipality_id]);

    }

    /**
     * @param $city_id
     * @return mixed|string
     * @throws \Exception
     */
    public function getZip($city_id) : \stdClass
    {
        $url = '/locations/zip';

        return $this->postCall($url, ['city_id' => $city_id]);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getCompanyTypes() : \stdClass
    {
        $url = '/owner/company-types';

        return $this->postCall($url);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getGuiltTypes() : \stdClass
    {
        $url = '/person/guilt-types';

        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleTypes() : \stdClass
    {
        $url = '/objects/vehicle-types';

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

        return $this->postCall($url, ['vehicle_type_id' => $vehicle_type_id]);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleUsage() : \stdClass
    {
        $url = '/objects/vehicle-usage';

        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleColors() : \stdClass
    {
        $url = '/objects/colors';

        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getAssistanceNomenclature() : \stdClass
    {
        $url = '/objects/assistance-nomenclature';

        return $this->postCall($url);

    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getVehicleEngineTypes() : \stdClass
    {
        $url = '/objects/engine-types';

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

        return $this->postCall($url, $data);

    }


}