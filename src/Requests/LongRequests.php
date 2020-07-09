<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 11:27 ч.
 */

namespace SirmaICS\Requests;


use SirmaICS\ApiController;

class LongRequests extends ApiController
{
    public function longCalc(array $data) : \stdClass
    {
        $url = '/liability/calc';

        return $this->postCall($url, $data);
    }

    public function longIssue(array $data) : \stdClass
    {
        $url = '/liability/issue';

        return $this->postCall($url, $data);
    }

    public function longIssueWithPayment(array $data) : \stdClass
    {
        $url = '/liability/policy-and-payment';

        return $this->postCall($url, $data);
    }

}