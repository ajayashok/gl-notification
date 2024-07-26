<?php

namespace GlPackage\NotificationManager\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    protected $vendorId;
    protected $apiUrl;
    protected $engine;
    protected $version;

    //create custructor
    public function __construct(){
        $this->vendorId = auth()?->user()?->id;
        $this->apiUrl = 'https://graph.facebook.com/';
        $this->engine = 'whatsapp';
        $this->version = 'v19.0';
    }

    public function sendMessage($whatsappConfig,$whatsappData)
    {
        if ($whatsappConfig) {
            // Whatsapp API endpoint for sending messages
            $url = $this->apiUrl.'/'.$this->version.'/'.$whatsappConfig->waba_id."/messages";

            $parameters = $this->checkParameters($whatsappData);
            $buttons = $this->checkButtons($whatsappData);
            $components = $this->checkComponents($parameters,$buttons);

            // Send the message
            $params = [
                        "messaging_product" => "whatsapp",
                        "to" => $whatsappData['mobile'],
                        "type" => "template"
                    ];
            $params['template'] = [
                "name" => $whatsappData['template'],
                "language" => [
                    "code" => "en"
                ]
            ];
            if(!empty($components['components'])) 
                $params['template']["components"] = $components['components'];

            try {
                $client = new Client();

                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$whatsappConfig->token
                ];

                $response = $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                    // 'verify'  => false,
                ]);

                $response = json_decode($response->getBody(),true);
                
                if ($response) {
                    return true;
                } else {
                    return false;
                }

            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }

        } else {
            throw new \Exception('Whatsapp configuration not found for vendor.');
        }
    }

    private function checkParameters($whatsappData){
        if (isset($whatsappData['parameters']))
            return [
                "type" => "body",
                "parameters" => $whatsappData['parameters']
            ];
        else
            return [];
    }

    private function checkButtons($whatsappData){
        if (isset($whatsappData['buttons']))
            return [
                "type" => "button",
                "sub_type" => "url",
                "index" => 0,
                "parameters" => $whatsappData['buttons']
            ];
        else
            return [];
    }

    private function checkComponents($parameters,$buttons){
        $components['components'] = [];
        if (!empty($parameters['parameters']) && !empty($buttons['parameters']))
            $components['components'] = [$parameters,$buttons];
        elseif(!empty($parameters['parameters']))
            $components['components'] = [$parameters];
        elseif(!empty($buttons['parameters']))
            $components['components'] = [$buttons];
        else
            $components['components'] = [];  
    
        return $components;
    }
}
