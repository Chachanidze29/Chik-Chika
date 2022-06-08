<?php

namespace App\Jobs;

use App\Mail\SendAggregatedInfoMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendAggregatedInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            SendAggregatedIntoToUser::dispatch($user);
        }
    }
}
