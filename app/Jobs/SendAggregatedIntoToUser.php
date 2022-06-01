<?php

namespace App\Jobs;

use App\Mail\SendAggregatedInfoMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendAggregatedIntoToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lastWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->subWeek()->toDateTimeString();

        $followings = DB::table('follower_user')
            ->where('user_id',$this->user->id)
            ->where('created_at','>',$lastWeekDate)
            ->count();

        $followers = DB::table('follower_user')
            ->where('follower_id',$this->user->id)
            ->where('created_at','>',$lastWeekDate)
            ->count();

        $data = [
            'followers'=>$followers,
            'followings'=>$followings,
            'username'=>$this->user->username
        ];
        Mail::to($this->user)->send(new SendAggregatedInfoMail($data));
    }
}
