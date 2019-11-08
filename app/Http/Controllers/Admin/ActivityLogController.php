<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ActivityLogDataTable;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ActivityLogExportRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Initial\ResponseResource;
use Carbon\Carbon;


class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityLogDataTable $dataTable)
    {
        return $dataTable->render('admin.activitylogs.index');
    }

    /**
     * Export Activity Logs
     */

    public function export(Request $request) {
        $user = Auth::user();

        if ($user->can('AccessToReports')) {
           
            if (!empty($request->selected_activitylog_ids)) {
                $activitylogs = ActivityLog::with('user')->whereIn('id', $request->selected_activitylog_ids)->orderBy('user_id')          
                    ->where('created_at', '>=', $request->start_date)
                    ->where('created_at', '<=', $request->end_date)          
                    ->get();

                $activitylogsGroup = ActivityLog::groupBy('user_id')             
                    ->selectRaw('user_id, SUM(count_logins) as count_logins, 
                        SUM(count_searches) as count_searches,
                        SUM(count_projects_created) as count_projects_created,
                        SUM(count_projects_exported) as count_projects_exported,
                        SUM(count_saved_searches) as count_saved_searches,
                        SUM(count_firm_link_clicks) as count_firm_link_clicks,
                        SUM(count_linkedin_link_clicks) as count_linkedin_link_clicks')
                    ->where('created_at', '>=', $request->start_date)
                    ->where('created_at', '<=', $request->end_date)         
                    ->whereIn('id', $request->selected_activitylog_ids)->get();

                      
                $activitylogsData = $this->groupByLogData($activitylogs, $activitylogsGroup);

                return new ResponseResource([
                    'activitylogs' => $activitylogsData,
                ]);
            } else {
                return new ResponseResource(['errors' => ['no_item' => ['no this item in DB']]]);
            }
        } else {
            return new ResponseResource(['errors' => ['denied' => ['access denied']]]);
        }
    }

    private function groupByLogData($activitylogs, $activitylogsGroup) {

        $data = array();

        foreach ($activitylogsGroup as $group) {
            foreach ($activitylogs as $log) {
                if ($group->user_id == $log->user_id) {
                    $item_array = array(
                        'name' => $log->user->name,
                        'date' => Carbon::parse($log->created_at)->format('Y-m-d'),
                        'first_login'=>Carbon::parse($log->first_login)->format('H:i:s'),
                        'last_logout'=>Carbon::parse($log->last_logout)->format('H:i:s'),
                        'count_logins'=>$log->count_logins,
                        'count_searches'=>$log->count_searches,
                        'count_projects_created'=>$log->count_projects_created,
                        'count_projects_exported'=>$log->count_projects_exported,
                        'count_saved_searches'=>$log->count_saved_searches,
                        'count_firm_link_clicks'=>$log->count_firm_link_clicks,
                        'count_linkedin_link_clicks'=>$log->count_linkedin_link_clicks
                    );
                    array_push($data, $item_array);
                }
            }

            $groupdataByUser = array(
                'name' => 'User Total',  //'name' => $log->user->name,
                'date' => '',
                'first_login'=>'',
                'last_logout'=>'',
                'count_logins'=>$group->count_logins,
                'count_searches'=>$group->count_searches,
                'count_projects_created'=>$group->count_projects_created,
                'count_projects_exported'=>$group->count_projects_exported,
                'count_saved_searches'=>$group->count_saved_searches,
                'count_firm_link_clicks'=>$group->count_firm_link_clicks,
                'count_linkedin_link_clicks'=>$group->count_linkedin_link_clicks
            );

            $empty_array = array(
                'name' => '',  //'name' => $log->user->name,
                'date' => '',
                'first_login'=>'',
                'last_logout'=>'',
                'count_logins'=>'',
                'count_searches'=>'',
                'count_projects_created'=>'',
                'count_projects_exported'=>'',
                'count_saved_searches'=>'',
                'count_firm_link_clicks'=>'',
                'count_linkedin_link_clicks'=>''
            );

            array_push($data, $groupdataByUser, $empty_array);
        }

        return $data;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
