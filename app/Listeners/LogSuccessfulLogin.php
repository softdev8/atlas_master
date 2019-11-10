<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        
        $lastLoginCheck =  ActivityLog::where('user_id', $event->user->id)
                                ->where(\DB::raw("DATE(created_at)"), Date('Y-m-d'));
                                
        if ($lastLoginCheck->exists()) {
            $activityUser = $lastLoginCheck->first();
            $activityUser->count_logins += 1;
            $activityUser->save();
        } else {
            $activityUser = new ActivityLog();
            $activityUser->user_id = $event->user->id;
            $activityUser->first_login =  Carbon::now();
            $activityUser->last_login =  Carbon::now();
            $activityUser->count_logins = 1;
            $activityUser->company_id = $event->user->company_id;
            $activityUser->role_id = $event->user->role_id;
            $activityUser->save();
        }
    }
}
