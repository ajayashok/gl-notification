<?php

namespace GlPackage\NotificationManager\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class EmailService
{
    protected $vendorId;
    protected $engine;
    protected $fromAddress;
    protected $fromName;
    protected $mailer;

    //create custructor
    public function __construct(){
        $this->vendorId = auth()?->user()?->id;
        $this->engine = 'email';
        $this->fromAddress = config('mail.from.address');
        $this->fromName = config('mail.from.name');
    }

    public function sendMessage($smtpSettings,$emailData)
    {
        if ($smtpSettings) {
            // Fetch dynamic mail settings from request or database
           try {
               $body = $emailData['body'];
               $view = $emailData['view'];

               $this->setMailConfig($smtpSettings);
                
               // Send the email
               if($view)
                   $response = Mail::send($view, $emailData, function ($message) use ($emailData) {
                       $message->to($emailData['to_address'])
                               ->subject($emailData['subject']);
                               
                       // Attach files if any
                       foreach ($emailData['attachments'] as $attachment) {
                           $message->attach($attachment);
                       }
                   });
               else
                   $response = Mail::raw($body, function ($message) use ($emailData) {
                       $message->to($emailData['to_address'])
                               ->subject($emailData['subject']);

                       // Attach files if any
                       foreach ($emailData['attachments'] as $attachment) {
                           $message->attach($attachment);
                       }
                   });

               if ($response) {
                   return true;
               } else {
                   throw new \Exception('Failed to send mail message.');
               }
           } catch (\Exception $e) {
               \Log::info($e->getMessage());
           }
       } else {
           throw new \Exception('Mail configuration not found for vendor.');
       }
    }

    public function getEngine(){
        return $this->engine;
    }

    public function setMailConfig($mailSettings)
    {
        config([
            'mail.mailers.smtp.host' => $mailSettings->smtp_host,
            'mail.mailers.smtp.port' => $mailSettings->smtp_port,
            'mail.mailers.smtp.username' => $mailSettings->username,
            'mail.mailers.smtp.password' => $mailSettings->password,
            'mail.mailers.smtp.encryption' => $mailSettings->encryption,
            'mail.from.address' => $this->fromAddress,
            'mail.from.name' => $this->fromName
        ]);

        // Laravel 7 or below compatibility
        config([
            'mail.driver' => $mailSettings->smtp_driver,
            'mail.host' => $mailSettings->smtp_host,
            'mail.port' => $mailSettings->smtp_port,
            'mail.username' => $mailSettings->username,
            'mail.password' => $mailSettings->password,
            'mail.encryption' => $mailSettings->encryption
        ]);
    }
}
