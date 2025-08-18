<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Services\MicrosoftGraphMailService;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['microsoft-graph'];
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Send the notification via Microsoft Graph.
     */
    public function toMicrosoftGraph($notifiable)
    {
        try {
            $verificationUrl = $this->verificationUrl($notifiable);
            
            $subject = 'Verify Your Email Address';
            
            // FIXED: Check if view exists, fallback to service template
            try {
                $body = view('auth.verify-email', [
                    'user' => $notifiable,
                    'verificationUrl' => $verificationUrl,
                    'appName' => config('app.name')
                ])->render();
            } catch (\Exception $e) {
                // Fallback to service template if view doesn't exist
                $mailService = new MicrosoftGraphMailService();
                $body = $mailService->getVerificationEmailTemplate($verificationUrl, $notifiable->name);
            }

            $mailService = new MicrosoftGraphMailService();
            return $mailService->sendEmail(
                $notifiable->email,
                $subject,
                $body,
                true
            );
        } catch (\Exception $e) {
            \Log::error('Error in VerifyEmailNotification: ' . $e->getMessage());
            throw $e; // Re-throw to let Laravel handle it
        }
    }
}