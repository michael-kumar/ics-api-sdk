<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 11:53 ч.
 */

namespace SirmaICS\Requests;


use SirmaICS\ApiController;

class PolicyRequests extends  ApiController
{
    public function policyNote(array $data) : \stdClass
    {
        $url = '/policy/note';

        return $this->postCall($url,$data);

    }

    public function policyFullInfo(array $data) : \stdClass
    {
        $url = '/policy/full-info';
        $this->setMethod('GET');
        return $this->postCall($url,$data);

    }

    public function policyPrint($hash) : \stdClass
    {
        $url = '/policy/print/'.$hash;
        $this->setMethod('GET');
        return $this->postCall($url);
    }


}