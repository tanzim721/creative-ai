<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ZendeskService
{
    private $baseUrl;
    private $auth;

    public function __construct()
    {
        $this->baseUrl = config('services.zendesk.base_url');
        $this->auth = [
            config('services.zendesk.email') . '/token',
            config('services.zendesk.api_token')
        ];
    }

    /**
     * Upload file to Zendesk and return upload token
     */
    public function uploadFile(UploadedFile $file): string
    {
        try {
            $filename = $file->getClientOriginalName();
            $url = $this->baseUrl . '/uploads.json?filename=' . urlencode($filename);

            $response = Http::withBasicAuth($this->auth[0], $this->auth[1])
                ->withHeaders(['Content-Type' => 'application/binary'])
                ->withBody(file_get_contents($file->getRealPath()), 'application/binary')
                ->post($url);

            if ($response->successful()) {
                return $response->json()['upload']['token'];
            }

            throw new Exception('File upload failed: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Zendesk file upload error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create ticket in Zendesk
     */
    public function createTicket(array $data): array
    {
        try {
            $url = $this->baseUrl . '/tickets.json';

            // Handle file upload if present
            $uploadToken = null;
            if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
                $uploadToken = $this->uploadFile($data['attachment']);
            }

            // Prepare ticket data
            $ticketData = [
                'ticket' => [
                    'requester' => [
                        'name' => $data['name'],
                        'email' => $data['email']
                    ],
                    'subject' => $data['subject'],
                    'comment' => [
                        'body' => $data['message']
                    ],
                    'priority' => 'normal',
                    'type' => 'question',
                    'status' => 'new'
                ]
            ];

            // Add upload token if file was uploaded
            if ($uploadToken) {
                $ticketData['ticket']['comment']['uploads'] = [$uploadToken];
            }

            $response = Http::withBasicAuth($this->auth[0], $this->auth[1])
                ->post($url, $ticketData);

            if ($response->successful()) {
                return $response->json()['ticket'];
            }

            throw new Exception('Ticket creation failed: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Zendesk ticket creation error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get ticket by ID
     */
    public function getTicket(int $ticketId): array
    {
        try {
            $url = $this->baseUrl . '/tickets/' . $ticketId . '.json';

            $response = Http::withBasicAuth($this->auth[0], $this->auth[1])
                ->get($url);

            if ($response->successful()) {
                return $response->json()['ticket'];
            }

            throw new Exception('Failed to retrieve ticket: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Zendesk get ticket error: ' . $e->getMessage());
            throw $e;
        }
    }
}