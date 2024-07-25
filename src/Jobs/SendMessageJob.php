<?php

namespace GlPackage\NotificationManager\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $service;
    public $configuration;
    public $object;
    /**
     * Create a new job instance.
     */
    public function __construct($service,$configuration,$object)
    {
        $this->service = $service;
        $this->configuration = $configuration;
        $this->object = $object;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->service->sendMessage($this->configuration,$this->object);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
