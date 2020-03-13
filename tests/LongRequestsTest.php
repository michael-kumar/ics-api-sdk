<?php
/**
 * @author: Spiridon Georgiev <spiridon.georgiev@sirma.bg>
 * Date: 26.02.20 г.
 * Time: 11:33 ч.
 */

namespace Tests;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SirmaICS\Requests\LongRequests;
use SirmaICS\Requests\ShortRequests;

/**
 * Class LongRequestsTest
 * @package Tests
 */
class LongRequestsTest extends TestCase
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
     * @var LongRequests
     */
    private $api;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $this->client      = new Client(
            [
                'handler'  => HandlerStack::create($this->mockHandler),
                'base_uri' => 'https://ics-api.ics365.com/',
            ]
        );
        $this->api         = new LongRequests();
        $this->api->setClient($this->client);
    }

    /**
     * @test
     */
    public function long_calc()
    {
        $data        = [
            "usage"                    => "Лични нужди",
            "office"                   => "1",
            "vin"                      => "VF1JM0BCH30208838",
            "model"                    => "SCENIC",
            "ip"                       => "127.0.0.1",
            "color"                    => "Сив",
            "insurers"                 => [
                "groupama",
                "dallbogg",
                "generali",
                "euroins",
                "dzi",
                "bulstrad",
            ],
            "places"                   => "5",
            "user"                     => "VIVACOM",
            "mark"                     => "RENAULT",
            "owner_zip"                => "5400",
            "body_type"                => "Седан",
            "owner_country_code"       => "BG",
            "owner_name"               => "Младен Георгиев Лазаров",
            "has_go"                   => "1",
            "owner_address"            => "ул.Генерал Столетов 18",
            "owner_ein"                => "7905232262",
            "engine_volume"            => "1400",
            "owner_nationality"        => "1",
            "owner_municipality"       => "Севлиево",
            "owner_city"               => "Севлиево",
            "has_usual"                => "0",
            "has_casco"                => "0",
            "steering_wheel"           => "0",
            "no_reg_num"               => "0",
            "owner_region"             => "Габрово",
            "reg_num"                  => "EB7654BA",
            "owner_guilt"              => "5",
            "vehicle_type"             => "1",
            "owner_experience"         => "10",
            "engine_type"              => "Бензин",
            "registration_certificate" => "007473045",
            "first_reg"                => "28.01.2004",
            "reg_num_valid_from"       => "28.01.2004",
            "owner_person_type"        => "2",
            "vehicle_kilowatts"        => "72",
        ];
        $responceApi = '{"success":1,"result":{"groupama":{"success":1,"result":{"calc":{"premium_with_tax":374.6,"premium":355.49,"gf":12,"policy_id":"100005204868","policy_no":"6600190000437515","tax":7.08,"installments":{"1":{"premium_with_tax":374.6,"premium":354.12,"tax":7.08,"gf":12,"number":1,"maturity":"2019-12-17","covered_from":"2019-12-17 00:00:00","covered_to":"2020-12-17 23:59:59"}},"full_installments_breakdown":{"1":{"1":{"premium_with_tax":374.6,"premium":354.12,"tax":7.08,"gf":12,"number":1,"maturity":"2019-12-17","covered_from":"2019-12-17 00:00:00","covered_to":"2020-12-17 23:59:59"}},"2":{"1":{"premium_with_tax":195.8,"premium":190.59,"tax":3.81,"gf":0,"number":1,"maturity":"2019-12-17","covered_from":"2019-12-17 00:00:00","covered_to":"2020-06-16 23:59:59"},"2":{"premium_with_tax":183.8,"premium":167.06,"tax":3.34,"gf":12,"number":2,"maturity":"2020-06-17","covered_from":"2020-06-17 00:00:00","covered_to":"2020-12-17 23:59:59"}},"4":{"1":{"premium_with_tax":105.5,"premium":102.06,"tax":2.04,"gf":0,"number":1,"maturity":"2019-12-17","covered_from":"2019-12-17 00:00:00","covered_to":"2020-03-16 23:59:59"},"2":{"premium_with_tax":93.51,"premium":90.3,"tax":1.81,"gf":0,"number":2,"maturity":"2020-03-17","covered_from":"2020-03-17 00:00:00","covered_to":"2020-06-16 23:59:59"},"3":{"premium_with_tax":93.51,"premium":78.54,"tax":1.57,"gf":12,"number":3,"maturity":"2020-06-17","covered_from":"2020-06-17 00:00:00","covered_to":"2020-09-16 23:59:59"},"4":{"premium_with_tax":93.51,"premium":90.3,"tax":1.81,"gf":0,"number":4,"maturity":"2020-09-17","covered_from":"2020-09-17 00:00:00","covered_to":"2020-12-17 23:59:59"}}}},"desc":""}},"dallbogg":{"success":1,"result":{"calc":{"premium_with_tax":236.94,"premium":219.13,"tax":4.41,"gf":12,"sticker":1.4,"installments":{"1":{"premium_with_tax":236.94,"premium":219.13,"tax":4.41,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 11:22:51","covered_to":"2020-12-15 23:59:59"}},"full_installments_breakdown":{"1":{"1":{"premium_with_tax":236.94,"premium":219.13,"tax":4.41,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 11:22:51","covered_to":"2020-12-15 23:59:59"}},"2":{"1":{"premium_with_tax":126.19,"premium":110.55,"tax":2.24,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 11:23:06","covered_to":"2020-06-15 23:59:59"},"2":{"premium_with_tax":112.75,"premium":110.54,"tax":2.21,"gf":0,"sticker":0,"number":2,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-12-15 23:59:59"}},"4":{"1":{"premium_with_tax":70.3,"premium":55.77,"tax":1.13,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-16","covered_from":"2019-12-16 11:23:21","covered_to":"2020-03-15 23:59:59"},"2":{"premium_with_tax":56.89,"premium":55.77,"tax":1.12,"gf":0,"sticker":0,"number":2,"maturity":"2020-03-16","covered_from":"2020-03-16 00:00:00","covered_to":"2020-06-15 23:59:59"},"3":{"premium_with_tax":56.89,"premium":55.77,"tax":1.12,"gf":0,"sticker":0,"number":3,"maturity":"2020-06-16","covered_from":"2020-06-16 00:00:00","covered_to":"2020-09-15 23:59:59"},"4":{"premium_with_tax":56.89,"premium":55.77,"tax":1.12,"gf":0,"sticker":0,"number":4,"maturity":"2020-09-16","covered_from":"2020-09-16 00:00:00","covered_to":"2020-12-15 23:59:59"}}}},"desc":""}},"generali":{"success":0,"error":"\u041e\u0442\u0433\u043e\u0432\u043e\u0440 \u043e\u0442 \u0414\u0436\u0435\u043d\u0435\u0440\u0430\u043b\u0438: ERROR:\u041d\u0435 \u0441\u0430 \u043d\u0430\u043c\u0435\u0440\u0435\u043d\u0438 \u0434\u0430\u043d\u043d\u0438 \u0432 \u0443\u0441\u043b\u0443\u0433\u0430\u0442\u0430 \u043d\u0430 \u041c\u0412\u0420 \u043f\u043e \u0437\u0430\u0434\u0430\u0434\u0435\u043d\u0438\u044f \u043a\u0440\u0438\u0442\u0435\u0440\u0438\u0439."},"euroins":{"success":0,"error":"\u041e\u0442\u0433\u043e\u0432\u043e\u0440 \u043e\u0442 \u0415\u0432\u0440\u043e\u0438\u043d\u0441: \u041c\u041f\u0421\u0442\u043e \u043d\u0435 \u0435 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0438\u0440\u0430\u043d\u043e \u0432 \u041a\u0410\u0422","info":""},"dzi":{"success":0,"error":"\u0413\u0440\u0435\u0448\u043a\u0430: \u041c\u041f\u0421-\u0442\u043e \u0435 \u0441 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u044f \u0432 \u041a\u0410\u0422. \u0412\u044a\u0432\u0435\u0434\u0435\u0442\u0435 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u043e\u043d\u0435\u043d \u043d\u043e\u043c\u0435\u0440 \u0438 \u043d\u043e\u043c\u0435\u0440 \u043d\u0430 \u0421\u0420\u041c\u041f\u0421."},"bulstrad":{"success":0,"error":"Clien Data was successfully changed<br>Object data was successfuly modified<br>T012: ERROR:\u041d\u0435 \u0441\u0430 \u043d\u0430\u043c\u0435\u0440\u0435\u043d\u0438 \u0434\u0430\u043d\u043d\u0438 \u0432 \u0443\u0441\u043b\u0443\u0433\u0430\u0442\u0430 \u043d\u0430 \u041c\u0412\u0420 \u043f\u043e \u0437\u0430\u0434\u0430\u0434\u0435\u043d\u0438\u044f \u043a\u0440\u0438\u0442\u0435\u0440\u0438\u0439.; "}}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->longCalc($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
        self::assertObjectHasAttribute('calc', $response->result->groupama->result);
        self::assertObjectHasAttribute('full_installments_breakdown', $response->result->groupama->result->calc);
        self::assertObjectHasAttribute('calc', $response->result->dallbogg->result);
        self::assertObjectHasAttribute('full_installments_breakdown', $response->result->dallbogg->result->calc);
        self::assertObjectHasAttribute(
            'premium',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'tax',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'tax',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'premium_with_tax',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'number',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'maturity',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'covered_from',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'covered_to',
            $response->result->dallbogg->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'premium',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'tax',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'tax',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'premium_with_tax',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'number',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'maturity',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'covered_from',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
        self::assertObjectHasAttribute(
            'covered_to',
            $response->result->groupama->result->calc->full_installments_breakdown->{1}->{1}
        );
    }

    /**
     * @test
     */
    public function long_issue()
    {
        $data        = [
            "color"                    => "Черен",
            "usage"                    => "Лични нужди",
            "office"                   => "1",
            "installments"             => "4",
            "insurer"                  => "bulstrad",
            "model"                    => "CLIO",
            "vin"                      => "VF1CBCT0533347678",
            "ip"                       => "127.0.0.1",
            "sticker"                  => "75108581",
            "places"                   => "5",
            "user"                     => "VIVACOM",
            "mark"                     => "RENAULT",
            "owner_municipality"       => "Каспичан",
            "owner_city"               => "Каспичан",
            "owner_zip"                => "9930",
            "body_type"                => "Седан",
            "greencard_number"         => "AX121983",
            "start_date"               => "09.02.2020",
            "no_reg_num"               => "0",
            "owner_region"             => "Шумен",
            "owner_name"               => "МУСТАФА САЛИМ МУСТАФА",
            "reg_num"                  => "H1478BT",
            "vehicle_type"             => "1",
            "owner_address"            => "ЧАПАЕВ 14",
            "owner_ein"                => "6501108787",
            "registration_certificate" => "009180944",
            "engine_type"              => "Бензин",
            "engine_volume"            => "1149",
            "first_reg"                => "02.04.2005",
            "owner_nationality"        => "1",
            "owner_person_type"        => "2",
            "has_go"                   => "0",
            "has_casco"                => "0",
            "vehicle_kilowatts"        => "55",
            "owner_experience"         => "10",
            "has_usual"                => "0",
            "owner_guilt"              => "5",
            "steering_wheel"           => "0",
            "policy_id"                => 1,
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"calc":{"premium_with_tax":235.37,"premium":218.01,"tax":4.36,"gf":13,"policy_id":"100013162107","policy_no":"0312047100082310","installments":{"1":{"premium_with_tax":68.6,"premium":53.04,"tax":1.09,"gf":13,"number":1,"maturity":"2020-02-09","covered_from":"2020-02-09 00:00:00","covered_to":"2020-05-08 23:59:59"},"2":{"premium_with_tax":55.59,"premium":53.03,"tax":1.09,"gf":0,"number":2,"maturity":"2020-05-09","covered_from":"2020-05-09 00:00:00","covered_to":"2020-08-08 23:59:59"},"3":{"premium_with_tax":55.59,"premium":53.03,"tax":1.09,"gf":0,"number":3,"maturity":"2020-08-09","covered_from":"2020-08-09 00:00:00","covered_to":"2020-11-08 23:59:59"},"4":{"premium_with_tax":55.59,"premium":53.03,"tax":1.09,"gf":0,"number":4,"maturity":"2020-11-09","covered_from":"2020-11-09 00:00:00","covered_to":"2021-02-08 23:59:59"}}},"desc":"","issue":{"policy":{"upn":"BG\/03\/120000452000","issue_date":"2020-02-07 15:03:35","start_date":"2020-02-09 00:00:00","end_date":"2021-02-08 23:59:59","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/bulstrad\/print.php?client=VIVACOM&upn=BG\/03\/120000452000&policy_id=1&type=policy&hash=6f6dfc6c-b188-2c19-276c-4a2551c51b90"},"greencard":{"pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/bulstrad\/print.php?client=VIVACOM&upn=BG\/03\/120000452000&policy_id=1&type=greencard&hash=6f6dfc6c-b188-2c19-276c-4a2551c51b90"},"note":{"pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/bulstrad\/print.php?client=VIVACOM&upn=20200081082&policy_id=1&type=note&hash=bd338bbb-280b-8137-75a3-c652f9433484"}},"note":{"pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/bulstrad\/print.php?client=VIVACOM&upn=20200081082&policy_id=1&type=note&hash=bd338bbb-280b-8137-75a3-c652f9433484","number":"20200081082"}}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->longIssue($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
        self::assertObjectHasAttribute('calc', $response->result);
        self::assertObjectHasAttribute('premium', $response->result->calc);
        self::assertObjectHasAttribute('premium_with_tax', $response->result->calc);
        self::assertObjectHasAttribute('tax', $response->result->calc);
        self::assertObjectHasAttribute('gf', $response->result->calc);
        self::assertObjectHasAttribute('issue', $response->result);
        self::assertObjectHasAttribute('policy', $response->result->issue);
        self::assertObjectHasAttribute('upn', $response->result->issue->policy);
        self::assertObjectHasAttribute('issue_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('start_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('end_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('pdf_url', $response->result->issue->policy);
        self::assertObjectHasAttribute('greencard', $response->result->issue);
        self::assertObjectHasAttribute('pdf_url', $response->result->issue->greencard);
    }

    /**
     * @test
     */
    public function long_issue_with_payment()
    {

        $data        = [
            "color"                    => "Черен",
            "usage"                    => "Лични нужди",
            "office"                   => "1",
            "installments"             => "4",
            "insurer"                  => "bulstrad",
            "model"                    => "CLIO",
            "vin"                      => "VF1CBCT0533347678",
            "ip"                       => "127.0.0.1",
            "sticker"                  => "75108581",
            "places"                   => "5",
            "user"                     => "VIVACOM",
            "mark"                     => "RENAULT",
            "owner_municipality"       => "Каспичан",
            "owner_city"               => "Каспичан",
            "owner_zip"                => "9930",
            "body_type"                => "Седан",
            "greencard_number"         => "AX121983",
            "start_date"               => "09.02.2020",
            "no_reg_num"               => "0",
            "owner_region"             => "Шумен",
            "owner_name"               => "МУСТАФА САЛИМ МУСТАФА",
            "reg_num"                  => "H1478BT",
            "vehicle_type"             => "1",
            "owner_address"            => "ЧАПАЕВ 14",
            "owner_ein"                => "6501108787",
            "registration_certificate" => "009180944",
            "engine_type"              => "Бензин",
            "engine_volume"            => "1149",
            "first_reg"                => "02.04.2005",
            "owner_nationality"        => "1",
            "owner_person_type"        => "2",
            "has_go"                   => "0",
            "has_casco"                => "0",
            "vehicle_kilowatts"        => "55",
            "owner_experience"         => "10",
            "has_usual"                => "0",
            "owner_guilt"              => "5",
            "steering_wheel"           => "0",
            "policy_id"                => 1,
        ];
        $responceApi = '{"success":1,"error":null,"system_message":null,"result":{"calc":{"premium_with_tax":269.18,"premium":250.74,"tax":5.04,"gf":12,"sticker":1.4,"installments":{"1":{"premium_with_tax":77.39,"premium":62.7,"tax":1.29,"gf":12,"sticker":1.4,"number":1,"maturity":"2019-12-15","covered_from":"2019-12-15 14:48:05","covered_to":"2020-03-14 23:59:59"},"2":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":2,"maturity":"2020-03-15","covered_from":"2020-03-15 00:00:00","covered_to":"2020-06-14 23:59:59"},"3":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":3,"maturity":"2020-06-15","covered_from":"2020-06-15 00:00:00","covered_to":"2020-09-14 23:59:59"},"4":{"premium_with_tax":63.93,"premium":62.68,"tax":1.25,"gf":0,"sticker":0,"number":4,"maturity":"2020-09-15","covered_from":"2020-09-15 00:00:00","covered_to":"2020-12-14 23:59:59"}}},"desc":"","issue":{"policy":{"upn":"BG\/30\/119003438669","id":"10258282","issue_date":"2019-12-15 12:48:05","start_date":"2019-12-15 14:47:14","end_date":"2020-12-15 23:59:59","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/policy\/BG-30-119003438669-74798342-1952-0ffe-2b44-de90a3dd066f.pdf"},"greencard":{"upn":"BG\/30\/119003438669\/01","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/greencard\/BG-30-119003438669-01--b17af1eb-ca1d-7f83-d24b-7d5fa61ab018.pdf"}},"note":{"number":"18475973","pdf_url":"https:\/\/dispatcher.ics365.com\/ins_xml\/go\/prints\/dallbogg\/vivacom\/note\/18475973--f3030ae1-9a6f-2d37-b8eb-b2f07ced0fe8.pdf"}}}';
        $this->mockHandler->append(new Response(200, [], json_encode(['success' => 1, 'result' => '123123123123'])));
        $this->mockHandler->append(new Response(200, [], $responceApi));
        $response = $this->api->longIssueWithPayment($data);

        self::assertInternalType('object', $response);
        self::assertObjectHasAttribute('success', $response);
        self::assertObjectHasAttribute('result', $response);
        self::assertObjectHasAttribute('calc', $response->result);
        self::assertObjectHasAttribute('premium', $response->result->calc);
        self::assertObjectHasAttribute('premium_with_tax', $response->result->calc);
        self::assertObjectHasAttribute('tax', $response->result->calc);
        self::assertObjectHasAttribute('gf', $response->result->calc);
        self::assertObjectHasAttribute('issue', $response->result);
        self::assertObjectHasAttribute('policy', $response->result->issue);
        self::assertObjectHasAttribute('upn', $response->result->issue->policy);
        self::assertObjectHasAttribute('issue_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('start_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('end_date', $response->result->issue->policy);
        self::assertObjectHasAttribute('pdf_url', $response->result->issue->policy);
        self::assertObjectHasAttribute('greencard', $response->result->issue);
        self::assertObjectHasAttribute('pdf_url', $response->result->issue->greencard);
        self::assertObjectHasAttribute('note', $response->result);
        self::assertObjectHasAttribute('pdf_url', $response->result->note);
        self::assertObjectHasAttribute('number', $response->result->note);
    }

}