<?php
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);
use SirmaICS\Requests\NomenclaturesRequest;

include "vendor/autoload.php";
$ne = new NomenclaturesRequest();
var_dump( $ne->getCountries());
