<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;


class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        
        $lastLogoutCheck =  ActivityLog::where('user_id', $event->user->id)
                                ->where(\DB::raw("DATE(created_at)"), Date('Y-m-d'));
        
        if ($lastLogoutCheck->exists()) {
            $activityUser = $lastLogoutCheck->first();
            $activityUser->last_logout = Carbon::now();
            $activityUser->save();
        }
    }
}
