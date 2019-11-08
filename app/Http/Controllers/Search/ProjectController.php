<?php

namespace App\Http\Controllers\Search;

use App\Http\Requests\Api\ProjectExportRequest;
use App\Http\Requests\Api\ProjectOpenRequest;
use App\Http\Requests\Api\ProjectSaveRequest;
use App\Http\Requests\Api\ProjectShowRequest;
use App\Http\Requests\Api\ProjectUpdateRequest;
use App\Http\Resources\Initial\ResponseResource;
use App\Models\Candidate;
use App\Models\Project;
use App\Models\ProjectCandidate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Save projects criterias and selected candidates
     *
     * @param ProjectSaveRequest $request
     * @return ResponseResource
     */
    public function save(ProjectSaveRequest $request)
    {
        $project = Project::create([
            'user_id'   => $request->user,
            'title'     => $request->title,
            'criterias' => json_encode($request->except([ 'user', 'title', 'last_open', 'candidates'])),
            'last_open' => $request->last_open,
        ]);

        foreach ($request->candidates as $candidate){
            ProjectCandidate::create([
                'project_id'   => $project->id,
                'candidate_id' => $candidate
            ]);
        }

        /* UPDATING PROJECT SAVING LOG*/

        $activityLogAction = \App\Helpers\ActivityLogAction::ActivityFire(Auth::user()->id, 'projectSave');

        return new ResponseResource([
            'project' => $project,
        ]);
    }

    /**
     * Show projects criterias and selected candidates
     *
     * @param ProjectShowRequest $request
     * @return ResponseResource
     */
    public function showAll(ProjectShowRequest $request)
    {
        $project = Project::with(['candidates' => function($query) {
            $query->select('project_id', 'candidate_id');
        }])->where('user_id', $request->user_id)->get();

        return new ResponseResource([
            'project_collection' => $project,
        ]);
    }

    /**
     * Time when project was last open
     *
     * @param ProjectOpenRequest $request
     * @return ResponseResource
     */
    public function open(ProjectOpenRequest $request){
        $project = Project::where('id', $request->project_id)->where('user_id', $request->user_id)->first();

        if($project){
            $now = Carbon::now()->toDateTimeString();
            $project->update([
                'last_open'=> $now
            ]);

            return new ResponseResource([
                'project_id' => $request->project_id,
                'last_open' => $now,
            ]);
        } else {
            return new ResponseResource(['errors' => [ 'no_item' => [ 'no this item in DB' ] ]]);
        }
    }

    /**
     * Update search criteris by ID
     *
     * @param ProjectUpdateRequest $request
     * @return ResponseResource
     */
    public function update(ProjectUpdateRequest $request)
    {
        $project = Project::where('id', $request->id)->where('user_id', $request->user)->first();

        if($project){
            $project->update([
                'user_id'   => $request->user,
                'title'     => $request->title,
                'criterias' => json_encode($request->except([ 'id', 'user', 'title', 'last_open'])),
                'last_open' => $request->last_open,
            ]);

            /* delete old */
            ProjectCandidate::where('project_id', $project->id)->delete();

            /* create new */
            foreach ($request->candidates as $candidate){
                ProjectCandidate::create([
                    'project_id'   => $project->id,
                    'candidate_id' => $candidate
                ]);
            }

            return new ResponseResource(['success' => true]);
        } else {
            return new ResponseResource(['errors' => [ 'no_item' => [ 'no this item in DB' ] ]]);
        }
    }

    /**
     * Delete projects by ID
     *
     * @param Request $request
     * @return ResponseResource
     */
    public function delete(Request $request)
    {
        $item = Project::where('id', $request->id)->first();

        if($item){
            $item->delete();

            return new ResponseResource(['success' => true]);
        } else {
            return new ResponseResource(['errors' => [ 'no_item' => [ 'no this item in DB' ] ]]);
        }
    }

    /**
     * Prepere data to export project to csv
     *
     * @param ProjectExportRequest $request
     * @return ResponseResource
     */
    public function export(ProjectExportRequest $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if($user->can('AccessToReports')){

            /* UPDATING PROJECT EXPORT LOG*/

            $activityLogAction = \App\Helpers\ActivityLogAction::ActivityFire(Auth::user()->id, 'projectExport');

            $project = Project::with('candidates')->where('id', $request->project_id)->where('user_id', $request->user_id)->first();

            if($project){
                $candidates = Candidate::whereIn('id',$project->candidates->pluck('candidate_id'))
                    ->with('firm')
                    ->with(['areasDetails' => function($query) {
                        $query->select('title')->distinct();
                    }])
                    ->with(['specialismsDetails' => function($query) {
                        $query->select('title')->distinct();
                    }])
                    ->with(['subSpecialismsDetails' => function($query) {
                        $query->select('title')->distinct();
                    }])
                    ->with(['regions'])
                    ->limit(Candidate::MAX_EXPORT)
                    ->get();

                return new ResponseResource([
                    'project'    => $project->title,
                    'candidates' => $candidates,
                ]);
            } else {
                return new ResponseResource(['errors' => [ 'no_item' => [ 'no this item in DB' ] ]]);
            }

        } else {
            return new ResponseResource(['errors' => [ 'denied' => [ 'access denied' ] ]]);
        }
    }
}
