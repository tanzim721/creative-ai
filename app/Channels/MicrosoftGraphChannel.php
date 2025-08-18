<?php

namespace App\Channels;

use App\Services\MicrosoftGraphMailService;
use Illuminate\Notifications\Notification;

class MicrosoftGraphChannel
{
    protected $mailService;

    public function __construct(MicrosoftGraphMailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            if (!method_exists($notification, 'toMicrosoftGraph')) {
                Log::warning('Notification does not have toMicrosoftGraph method');
                return false;
            }

            $result = $notification->toMicrosoftGraph($notifiable);
            
            if ($result) {
                Log::info('Email sent successfully via Microsoft Graph to: ' . $notifiable->email);
                return true;
            } else {
                Log::error('Failed to send email via Microsoft Graph to: ' . $notifiable->email);
                return false;
            }
            
        } catch (\Exception $e) {
            Log::error('Error sending email via Microsoft Graph: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Optionally, you can fallback to regular mail here
            // Mail::to($notifiable->email)->send(new VerificationMail($notifiable));
            
            return false;
        }
    }
}