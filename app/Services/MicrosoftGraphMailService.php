<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Microsoft\Graph\GraphServiceClient;
use Microsoft\Graph\Generated\Models\Message;
use Microsoft\Graph\Generated\Models\BodyType;
use Microsoft\Graph\Generated\Models\ItemBody;
use Microsoft\Graph\Generated\Models\Recipient;
use Microsoft\Graph\Generated\Models\EmailAddress;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;

class MicrosoftGraphMailService
{
    protected $clientId;
    protected $clientSecret;
    protected $tenantId;

    public function __construct()
    {
        $this->clientId = config('services.microsoft.client_id');
        $this->clientSecret = config('services.microsoft.client_secret');
        $this->tenantId = config('services.microsoft.tenant_id');
    }

    public function getAccessToken()
    {
        $client = new Client();
        $url = "https://login.microsoftonline.com/{$this->tenantId}/oauth2/v2.0/token";

        $response = $client->post($url, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'https://graph.microsoft.com/.default',
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        return $body['access_token'];
    }

    public function sendMail($to, $subject, $bodyContent)
    {
        $token = $this->getAccessToken();

        $client = new Client();
        $url = 'https://graph.microsoft.com/v1.0/users/azure@vumobile.biz/sendMail';

        $emailData = [
            'message' => [
                'subject' => $subject,
                'body' => [
                    'contentType' => 'HTML',
                    'content' => $bodyContent,
                ],
                'toRecipients' => [
                    ['emailAddress' => ['address' => $to]],
                ],
            ],
        ];

        $client->post($url, [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ],
            'json' => $emailData,
        ]);
    }
    
}