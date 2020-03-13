<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 11:54 ч.
 */

namespace Tests;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SirmaICS\Requests\PolicyRequests;
use SirmaICS\Requests\ShortRequests;

/**
 * Class PolicyRequestsTest
 * @package Tests
 */
class PolicyRequestsTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $mockHandler;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var PolicyRequests
     */
    private $api;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $this->client      = new Client(
            [
                'handler'  => HandlerStack::create($this->mockHandler),
                'base_uri' => 'https://ics-api.ics365.com/',
            ]
        );
        $this->api         = new PolicyRequests();
        $this->api->setClient($this->client);

    }

    /**
     * @test
     */
    public function policy_note()
    {
        $data        = [
            'insurer'           => 'dzi',
            'type'              => 'note',
            'insurance_type'    => 'GO',
            'owner_ein'         => 1111114444,
            'owner_person_type' => 2,
            'upn'               => 'BG/00/000000',
            'number'            => 1,
            'sticker'           => 11111111,
            'office'            => 1,
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"note":{"number":"19122014710497","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/note\/dzi\/print.php?&CLIENT=VIVACOM&note_number=19122014710497&hash=c8b5743a-7cf0-c645-b802-01fd73f2b326&doctype=note"},"desc":""}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->policyNote($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
        self::assertObjectHasAttribute('note', $response->result);
        self::assertObjectHasAttribute('number', $response->result->note);
        self::assertObjectHasAttribute('pdf_url', $response->result->note);
    }


    /**
     * @test
     */
    public function policy_full_info()
    {
        $data        = [
            'insurer'        => 'dzi',
            'person_type'    => '2',
            'insurance_type' => 'GO',
            'ein'            => 1111114444,
            'policy'         => 'BG/00/000000',
            'upn'            => 'BG/00/000000',
            'reg_num'        => 'CA1231O',
            'office'         => 1,
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"fullinfo":{"payments":{"1":{"premium":58.25,"tax":1.17,"premium_with_tax":71.42,"number":"1","maturity":"2019-09-21","covered_from":"2019-09-22 00:00:00","covered_to":"2019-12-21 23:59:59","payed":1},"2":{"premium":58.25,"tax":1.17,"premium_with_tax":59.42,"number":"2","maturity":"2019-12-21","covered_from":"2019-12-22 00:00:00","covered_to":"2020-03-21 23:59:59","payed":0},"3":{"premium":58.25,"tax":1.17,"premium_with_tax":59.42,"number":"3","maturity":"2020-03-21","covered_from":"2020-03-22 00:00:00","covered_to":"2020-06-21 23:59:59","payed":0},"4":{"premium":58.25,"tax":1.17,"premium_with_tax":59.42,"number":"4","maturity":"2020-06-21","covered_from":"2020-06-22 00:00:00","covered_to":"2020-09-21 23:59:59","payed":0}},"start_data":"2019-09-22","end_data":"2020-09-21","issue_data":"2019-09-22","policy_no":"BG\/06\/119002629549","installments":4,"client_ein":"7811063960","client_name":"\u041c\u0418\u041b\u041a\u041e \u0414\u0418\u041c\u0427\u0415\u0412 \u0410\u0421\u0415\u041d\u041e\u0412","reg_num":"EH8116BH","has_outer_comission":1},"premium":58.25,"tax":1.17,"premium_with_tax":71.42,"number":"1","maturity":"2019-09-21","covered_from":"2019-09-22 00:00:00","covered_to":"2019-12-21 00:00:00"}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));

        $response = $this->api->policyFullInfo($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
        self::assertObjectHasAttribute('fullinfo', $response->result);
        self::assertObjectHasAttribute('premium', $response->result);
        self::assertObjectHasAttribute('tax', $response->result);
        self::assertObjectHasAttribute('premium_with_tax', $response->result);
        self::assertObjectHasAttribute('maturity', $response->result);
        self::assertObjectHasAttribute('covered_from', $response->result);
        self::assertObjectHasAttribute('covered_to', $response->result);
        self::assertObjectHasAttribute('payments', $response->result->fullinfo);
        self::assertObjectHasAttribute('policy_no', $response->result->fullinfo);
        self::assertObjectHasAttribute('installments', $response->result->fullinfo);
        self::assertObjectHasAttribute('start_data', $response->result->fullinfo);
        self::assertObjectHasAttribute('issue_data', $response->result->fullinfo);
        self::assertObjectHasAttribute('end_data', $response->result->fullinfo);
    }

    /**
     * @test
     */
    public function policy_print()
    {
        $data        = '12093812903823901ajdsajiopd2iodj2o'; // the hash
        $responseApi = '123123123123123123123123123'; // content of the pdf
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '1111111'])));
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => $responseApi])));

        $response = $this->api->policyPrint($data);
        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
    }
}