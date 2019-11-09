<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use App\User;



class ActivityLogAction
{
    /**
     * 
     *
     * @params: $user_id, $actionName
     * 
     */
    static function ActivityFire($user_id, $actionName) {

        $ActionLog = ActivityLog::where('user_id', $user_id)
        ->where(\DB::raw("DATE(created_at)"), Date('Y-m-d'))->first();

        switch($actionName) {
            case 'searchRun':
                if (isset($ActionLog)) {
                    $ActionLog->count_searches +=1;
                    $ActionLog->save();
                }   
                break;
            case 'projectSave':
                if (isset($ActionLog)) {
                    $ActionLog->count_projects_created +=1;
                    $ActionLog->save();
                }   
                break;
            case 'searchSave':
                if (isset($ActionLog)) {
                    $ActionLog->count_saved_searches +=1;
                    $ActionLog->save();
                }   
                break;
            case 'projectExport':
                if (isset($ActionLog)) {
                    $ActionLog->count_projects_exported +=1;
                    $ActionLog->save();
                }   
                break;
            case 'linkedin':
                if (isset($ActionLog)) {
                    $ActionLog->count_linkedin_link_clicks +=1;
                    $ActionLog->save();
                    return true;
                }   
                break;
            case 'firmlink':
                if (isset($ActionLog)) {
                    $ActionLog->count_firm_link_clicks +=1;
                    $ActionLog->save();
                    return true;
                }   
                break;
                
            default:
                break;
        }
        
        
    }
}
