<?php


namespace App\Services;

use Illuminate\Support\Str;

class SmsGatewayService
{
    /**
     * @var
     */

    private $apiToken;

    /**
     * @var
     */

    private $sid;

    /**
     * @var
     */

    private $domain;

    /**
     * @var
     */

    private $receiver;

    /**
     * @var
     */

    private $message;

    /**
     * SmsGatewayService constructor.
     */
    public function __construct()
    {
        $this->apiToken = config('smssslwireless.api_token');
        $this->domain = config('smssslwireless.domain');
        $this->sid = config('smssslwireless.sid');
    }

    /**
     * @param $receiver
     * @return $this
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Send single sms execution process
     *
     * @return bool|string
     * @throws \Exception
     */
    public function send()
    {
        try {
            $params = [
                "api_token" => $this->apiToken,
                "sid" => $this->sid,
                "csms_id" => Str::random(10),
                "msisdn" => $this->receiver,
                "sms" => $this->message,
            ];

            $url = trim($this->domain, '/') . "/api/v3/send-sms";
            $params = json_encode($params);

            return $this->execute($url, $params);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Execute curl request
     *
     * @param $url
     * @param $params
     * @return bool
     * @throws \Exception
     */
    private function execute($url, $params)
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept:application/json',
            ]);

            $response = curl_exec($ch);

            curl_close($ch);

            return json_decode($response, true);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
