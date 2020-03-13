<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 10:18 ч.
 */

namespace SirmaICS\Requests;


use SirmaICS\ApiController;

/**
 * Class ShortRequests
 * @package SirmaICS\Requests
 */
class ShortRequests extends ApiController
{
    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function shortCalc(array $data) : \stdClass
    {
        $url = 'liability/short';

        return $this->postCall($url,$data);

    }

    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function shortIssue(array $data) : \stdClass
    {
        $url = 'liability/policy-short';

        return $this->postCall($url,$data);
    }

    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function shortIssueWithPayment(array $data) : \stdClass
    {
        $url = 'liability/policy-and-payment-short';

        return $this->postCall($url,$data);

    }

}