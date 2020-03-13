<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 10:20 ч.
 */

namespace Tests;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SirmaICS\Requests\NomenclaturesRequest;
use SirmaICS\Requests\ShortRequests;

/**
 * Class ShortRequestsTest
 * @package Tests
 */
class ShortRequestsTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected $mockHandler;
    /**
     * @var NomenclaturesRequest
     */
    private $api;

    public function setUp()
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $this->client = new Client([
            'handler' => HandlerStack::create($this->mockHandler),
            'base_uri' => 'https://ics-api.ics365.com/',
        ]);
        $this->api = new ShortRequests();
        $this->api->setClient($this->client);

    }

    /**
     * @test
     */
    public function short_calc()
    {
        $data = [
            'insurers' => ['euroins','dzi'],
            'owner_ein' => 1111114444,
            'owner_experience' => 5,
            'reg_num' => 'CA1234O',
            'usage' => 'Лични нужди'
        ];
        $responceApi = '{"success":1,"result":{"groupama":{"success":1,"result":{"calc":{"premium_with_tax":229.2,"premium":212.94,"gf":12,"policy_id":"100005203675","policy_no":"6600190000437155","tax":4.23,"installments":{"1":{"premium_with_tax":229.2,"premium":211.57,"tax":4.23,"gf":12,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-12-16 23:59:59"}},"full_installments_breakdown":{"1":{"1":{"premium_with_tax":229.2,"premium":211.57,"tax":4.23,"gf":12,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-12-16 23:59:59"}},"2":{"1":{"premium_with_tax":122.38,"premium":106.84,"tax":2.14,"gf":12,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"2":{"premium_with_tax":110.38,"premium":106.84,"tax":2.14,"gf":0,"number":2,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-12-16 23:59:59"}},"4":{"1":{"premium_with_tax":68.41,"premium":53.93,"tax":1.08,"gf":12,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-03-15 23:59:59"},"2":{"premium_with_tax":56.43,"premium":53.95,"tax":1.08,"gf":0,"number":2,"maturity":"2020-03-16","covered_from":"2020-03-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"3":{"premium_with_tax":56.43,"premium":53.95,"tax":1.08,"gf":0,"number":3,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-09-15 23:59:59"},"4":{"premium_with_tax":56.43,"premium":53.95,"tax":1.08,"gf":0,"number":4,"maturity":"2020-09-16","covered_from":"2020-09-16 00:00:00","covered_to":"2020-12-16 23:59:59"}}}},"desc":""}},"dallbogg":{"success":1,"result":{"calc":{"full_installments_breakdown":{"2":{"1":{"premium_with_tax":133.88,"premium":118.09,"tax":2.39,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"2":{"premium_with_tax":120.46,"premium":118.1,"tax":2.36,"gf":0,"sticker":0,"number":2,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-12-15 23:59:59"}},"4":{"1":{"premium_with_tax":73.9,"premium":59.3,"tax":1.2,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 00:00:00","covered_to":"2020-03-15 23:59:59"},"2":{"premium_with_tax":60.48,"premium":59.29,"tax":1.19,"gf":0,"sticker":0,"number":2,"maturity":"2020-03-16","covered_from":"2020-03-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"3":{"premium_with_tax":60.48,"premium":59.29,"tax":1.19,"gf":0,"sticker":0,"number":3,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-09-15 23:59:59"},"4":{"premium_with_tax":60.48,"premium":59.29,"tax":1.19,"gf":0,"sticker":0,"number":4,"maturity":"2020-09-16","covered_from":"2020-09-16 00:00:00","covered_to":"2020-12-15 23:59:59"}}}}}},"generali":{"success":1,"result":{"calc":{"full_installments_breakdown":{"1":{"1":{"premium":207.39,"premium_with_tax":222.11,"tax":4.12,"gf":12,"number":1,"maturity":"2019-12-15","covered_from":"2019-12-15 11:19:23","covered_to":"2020-12-14 23:59:59"}},"2":{"1":{"premium":106.9,"premium_with_tax":119.61,"tax":2.11,"gf":12,"number":1,"maturity":"2019-12-15","covered_from":"2019-12-15 11:19:23","covered_to":"2020-06-14 23:59:59"},"2":{"premium":106.9,"premium_with_tax":107.61,"tax":2.11,"gf":0,"number":2,"maturity":"2020-06-14","covered_from":"2020-06-14 00:00:00","covered_to":"2020-12-13 23:59:59"}},"4":{"1":{"premium":55.65,"premium_with_tax":67.33,"tax":1.08,"gf":12,"number":1,"maturity":"2019-12-15","covered_from":"2019-12-15 11:19:23","covered_to":"2020-03-14 23:59:59"},"2":{"premium":55.65,"premium_with_tax":55.33,"tax":1.08,"gf":0,"number":2,"maturity":"2020-03-14","covered_from":"2020-03-14 00:00:00","covered_to":"2020-06-13 23:59:59"},"3":{"premium":55.65,"premium_with_tax":55.33,"tax":1.08,"gf":0,"number":3,"maturity":"2020-06-14","covered_from":"2020-06-14 00:00:00","covered_to":"2020-09-13 23:59:59"},"4":{"premium":55.65,"premium_with_tax":55.35,"tax":1.1,"gf":0,"number":4,"maturity":"2020-09-14","covered_from":"2020-09-14 00:00:00","covered_to":"2020-12-13 23:59:59"}}},"premium_with_tax":0,"tax":0,"premium":0,"gf":0,"installments":null}}},"euroins":{"success":1,"result":{"calc":{"tax":4.24,"gf":12,"premium_with_tax":229.77,"premium":212.13,"installments":{"1":{"premium":212.13,"tax":4.24,"gf":12,"number":1,"premium_with_tax":229.77,"maturity":"2019-12-15","covered_from":"2019-12-16 00:00:00","covered_to":"2020-12-15 23:59:59"}},"full_installments_breakdown":{"1":{"1":{"premium":212.13,"tax":4.24,"gf":12,"number":1,"premium_with_tax":229.77,"maturity":"2019-12-15","covered_from":"2019-12-16 00:00:00","covered_to":"2020-12-15 23:59:59"}},"2":{"1":{"premium":111.01,"tax":2.22,"gf":12,"number":1,"premium_with_tax":126.63,"maturity":"2019-12-15","covered_from":"2019-12-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"2":{"premium":111.01,"tax":2.22,"gf":0,"number":2,"premium_with_tax":114.63,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-12-15 23:59:59"}},"4":{"1":{"premium":54.82,"tax":1.1,"gf":12,"number":1,"premium_with_tax":69.32,"maturity":"2019-12-15","covered_from":"2019-12-16 00:00:00","covered_to":"2020-03-15 23:59:59"},"2":{"premium":54.84,"tax":1.1,"gf":0,"number":2,"premium_with_tax":57.34,"maturity":"2020-03-16","covered_from":"2020-03-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"3":{"premium":54.84,"tax":1.1,"gf":0,"number":3,"premium_with_tax":57.34,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-09-15 23:59:59"},"4":{"premium":54.84,"tax":1.1,"gf":0,"number":4,"premium_with_tax":57.34,"maturity":"2020-09-16","covered_from":"2020-09-16 00:00:00","covered_to":"2020-12-15 23:59:59"}}}}}},"dzi":{"success":1,"result":{"calc":{"premium_with_tax":220.07,"premium":202.59,"tax":4.08,"offer_id":"430719295030421","gf":12,"installments":{"1":{"premium_with_tax":220.07,"premium":202.59,"tax":4.08,"gf":12,"number":1,"maturity":"2019-12-14","covered_from":"2019-12-15 11:19:35","covered_to":"2020-12-14 23:59:59"}},"full_installments_breakdown":{"1":{"1":{"premium_with_tax":220.07,"premium":202.59,"tax":4.08,"gf":12,"number":1,"maturity":"2019-12-14","covered_from":"2019-12-15 11:19:35","covered_to":"2020-12-14 23:59:59"}},"2":{"1":{"premium_with_tax":118.07,"premium":102.59,"tax":2.08,"gf":12,"number":1,"maturity":"2019-12-14","covered_from":"2019-12-15 11:19:41","covered_to":"2020-06-14 23:59:59"},"2":{"premium_with_tax":106.08,"premium":102.6,"tax":2.08,"gf":0,"number":2,"maturity":"2020-06-14","covered_from":"2020-06-15 00:00:00","covered_to":"2020-12-14 23:59:59"}},"4":{"1":{"premium_with_tax":65.81,"premium":51.35,"tax":1.06,"gf":12,"number":1,"maturity":"2019-12-14","covered_from":"2019-12-15 11:19:48","covered_to":"2020-03-14 23:59:59"},"2":{"premium_with_tax":53.81,"premium":51.35,"tax":1.06,"gf":0,"number":2,"maturity":"2020-03-14","covered_from":"2020-03-15 00:00:00","covered_to":"2020-06-14 23:59:59"},"3":{"premium_with_tax":53.81,"premium":51.35,"tax":1.06,"gf":0,"number":3,"maturity":"2020-06-14","covered_from":"2020-06-15 00:00:00","covered_to":"2020-09-14 23:59:59"},"4":{"premium_with_tax":53.81,"premium":51.35,"tax":1.06,"gf":0,"number":4,"maturity":"2020-09-14","covered_from":"2020-09-15 00:00:00","covered_to":"2020-12-14 23:59:59"}}}},"desc":"\u041f\u0440\u0435\u0434\u043b\u043e\u0436\u0435\u043d\u0438\u0435 \u2116 430719295030421"}},"bulstrad":{"success":0,"error":"Clien Data was successfully changed<br>Object data was successfuly modified<br>\u0417\u0430 \u0441\u043e\u0431\u0441\u0442\u0432\u0435\u043d\u0438\u043a 6401014220 - \u0421\u0422\u0415\u0424\u0427\u041e \u0413\u0415\u041e\u0420\u0413\u0418\u0415\u0412 \u0426\u041e\u0427\u0415\u0412 \u043d\u0430 \u041c\u041f\u0421 EH1244AK OPEL ASTRA, \u043c\u043e\u043b\u044f \u0432\u044a\u0432\u0435\u0434\u0435\u0442\u0435 \u0430\u0434\u0440\u0435\u0441 \u043f\u043e \u0442\u0430\u043b\u043e\u043d \u043d\u0430 \u041c\u041f\u0421"}}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' =>'123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->shortCalc($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success',$response);
        self::assertObjectHasAttribute('result',$response);
        self::assertObjectHasAttribute('calc',$response->result->euroins->result);
        self::assertObjectHasAttribute('full_installments_breakdown',$response->result->euroins->result->calc);
        self::assertObjectHasAttribute('calc',$response->result->dzi->result);
        self::assertObjectHasAttribute('full_installments_breakdown',$response->result->dzi->result->calc);
        self::assertObjectHasAttribute('premium',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('tax',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('tax',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('premium_with_tax',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('number',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('maturity',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('covered_from',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('covered_to',$response->result->dzi->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('premium',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('tax',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('tax',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('premium_with_tax',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('number',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('maturity',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('covered_from',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
        self::assertObjectHasAttribute('covered_to',$response->result->euroins->result->calc->full_installments_breakdown->{1}->{1});
    }

    /**
     * @test
     */
    public function short_issue()
    {
        $data = [
            'insurer' => 'euroins',
            'owner_ein' => 1111114444,
            'owner_experience' => 5,
            'reg_num' => 'CA1234O',
            'usage' => 'Лични нужди',
            'sticker' => 11001100,
            'greencard_number' => 'AA111223',
            'installments' => 4,
            'start_date' => '2020-02-30',
            'office' => 5,
            'owner_person_type' => 2,
            'owner_region' => 'Варна',
            'owner_municipality' => 'Варна',
            'owner_nationality' => 1,
            'owner_city' => 'Варна',
            'owner_zip' => 9000,
            'owner_address' => 'Рандом адрес д',
            'owner_name' => 'Секс Наркотици Рокенрол'
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"calc":{"premium_with_tax":232.32,"premium":210.4,"tax":4.32,"offer_id":"430719295032105","gf":12,"installments":{"1":{"premium_with_tax":67.08,"premium":52.6,"tax":1.08,"gf":12,"number":1,"maturity":"2019-12-20","covered_from":"2019-12-21 00:00:00","covered_to":"2020-03-20 23:59:59"},"2":{"premium_with_tax":55.08,"premium":52.6,"tax":1.08,"gf":0,"number":2,"maturity":"2020-03-20","covered_from":"2020-03-21 00:00:00","covered_to":"2020-06-20 23:59:59"},"3":{"premium_with_tax":55.08,"premium":52.6,"tax":1.08,"gf":0,"number":3,"maturity":"2020-06-20","covered_from":"2020-06-21 00:00:00","covered_to":"2020-09-20 23:59:59"},"4":{"premium_with_tax":55.08,"premium":52.6,"tax":1.08,"gf":0,"number":4,"maturity":"2020-09-20","covered_from":"2020-09-21 00:00:00","covered_to":"2020-12-20 23:59:59"}}},"desc":"","issue":{"policy":{"upn":"BG\/06\/119003493664","issue_date":"2019-12-20 09:48:18","start_date":"2019-12-21 00:00:00","end_date":"2020-12-20 23:59:59","pdf_url":"http:\/\/dispatcher.ics365.com\/ins_xml\/go\/dzi\/print.php?client=VIVACOM&policy_id=1&print_id=100019995176&hash=855243f8-3db2-02d8-3d78-fabef59b4ed5"},"greencard":{"pdf_url":"http:\/\/dispatcher.ics365.com\/ins_xml\/go\/dzi\/print.php?client=VIVACOM&policy_id=1&doctype=greencard&greencard_upn=BG\/06\/119003493664\/01&hash=855243f8-3db2-02d8-3d78-fabef59b4ed5"}}}}
';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' =>'123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->shortIssue($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success',$response);
        self::assertObjectHasAttribute('result',$response);
        self::assertObjectHasAttribute('calc',$response->result);
        self::assertObjectHasAttribute('premium',$response->result->calc);
        self::assertObjectHasAttribute('premium_with_tax',$response->result->calc);
        self::assertObjectHasAttribute('tax',$response->result->calc);
        self::assertObjectHasAttribute('gf',$response->result->calc);
        self::assertObjectHasAttribute('issue',$response->result);
        self::assertObjectHasAttribute('policy',$response->result->issue);
        self::assertObjectHasAttribute('upn',$response->result->issue->policy);
        self::assertObjectHasAttribute('issue_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('start_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('end_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('pdf_url',$response->result->issue->policy);
        self::assertObjectHasAttribute('greencard',$response->result->issue);
        self::assertObjectHasAttribute('pdf_url',$response->result->issue->greencard);
    }

    /**
     * @test
     */
    public function short_issue_with_payment()
    {
        $data = [
            'insurer' => 'euroins',
            'owner_ein' => 1111114444,
            'owner_experience' => 5,
            'reg_num' => 'CA1234O',
            'usage' => 'Лични нужди',
            'sticker' => 11001100,
            'greencard_number' => 'AA111223',
            'installments' => 4,
            'start_date' => '2020-02-30',
            'office' => 5,
            'owner_person_type' => 2,
            'owner_region' => 'Варна',
            'owner_municipality' => 'Варна',
            'owner_nationality' => 1,
            'owner_city' => 'Варна',
            'owner_zip' => 9000,
            'owner_address' => 'Рандом адрес д',
            'owner_name' => 'Секс Наркотици Рокенрол'
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"calc":{"premium_with_tax":269.18,"premium":250.74,"tax":5.04,"gf":12,"sticker":1.4,"installments":{"1":{"premium_with_tax":77.39,"premium":62.7,"tax":1.29,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-15","covered_from":"2019-12-15 14:48:05","covered_to":"2020-03-14 23:59:59"},"2":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":2,"maturity":"2020-03-15","covered_from":"2020-03-15 00:00:00","covered_to":"2020-06-14 23:59:59"},"3":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":3,"maturity":"2020-06-15","covered_from":"2020-06-15 00:00:00","covered_to":"2020-09-14 23:59:59"},"4":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":4,"maturity":"2020-09-15","covered_from":"2020-09-15 00:00:00","covered_to":"2020-12-14 23:59:59"}}},"desc":"","issue":{"policy":{"upn":"BG\/30\/119003438669","id":"10258282","issue_date":"2019-12-15 12:48:05","start_date":"2019-12-15 14:47:14","end_date":"2020-12-15 23:59:59","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/policy\/BG-30-119003438669-74798342-1952-0ffe-2b44-de90a3dd066f.pdf"},"greencard":{"upn":"BG\/30\/119003438669\/01","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/greencard\/BG-30-119003438669-01--b17af1eb-ca1d-7f83-d24b-7d5fa61ab018.pdf"}},"note":{"number":"18475973","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/note\/18475973--f3030ae1-9a6f-2d37-b8eb-b2f07ced0fe8.pdf"}}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' =>'123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->shortIssueWithPayment($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success',$response);
        self::assertObjectHasAttribute('result',$response);
        self::assertObjectHasAttribute('calc',$response->result);
        self::assertObjectHasAttribute('premium',$response->result->calc);
        self::assertObjectHasAttribute('premium_with_tax',$response->result->calc);
        self::assertObjectHasAttribute('tax',$response->result->calc);
        self::assertObjectHasAttribute('gf',$response->result->calc);
        self::assertObjectHasAttribute('issue',$response->result);
        self::assertObjectHasAttribute('policy',$response->result->issue);
        self::assertObjectHasAttribute('upn',$response->result->issue->policy);
        self::assertObjectHasAttribute('issue_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('start_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('end_date',$response->result->issue->policy);
        self::assertObjectHasAttribute('pdf_url',$response->result->issue->policy);
        self::assertObjectHasAttribute('greencard',$response->result->issue);
        self::assertObjectHasAttribute('pdf_url',$response->result->issue->greencard);
        self::assertObjectHasAttribute('note',$response->result);
        self::assertObjectHasAttribute('pdf_url',$response->result->note);
        self::assertObjectHasAttribute('number',$response->result->note);
    }
}