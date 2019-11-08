<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CandidatesDataTable;
use App\Http\Requests\Admin\CandidateSave;
use App\Http\Requests\Admin\CandidateUpdate;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\CandidateLink;
use App\Models\Firm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateController extends Controller
{
    /**
     * Get all candidates
     *
     * @param CandidatesDataTable $dataTable
     * @return mixed
     */
    public function index(CandidatesDataTable $dataTable)
    {
        return $dataTable->with('firm')->render('admin.candidates.index');
    }

    /**
     * Render Candidate create page
     */
    public function create()
    {
        $firms = Firm::all();

        return view('admin.candidates.create')->withFirms($firms);
    }

    /**
     * Create new Candidate from admin-panel
     *
     * @param CandidateSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CandidateSave $request)
    {
        $candidate = Candidate::create($request->except(['jobs','links']));

        foreach($request->links as $link){
            if($link){
                CandidateLink::create([
                    'candidate_id' => $candidate->id,
                    'link' => $link
                ]);
            }
        }

        foreach($request->jobs as $key => $job){
            if($job['previous_firm'] != null){
                CandidateJob::create([
                    'candidate_id' => $candidate->id,
                    'previous_firm' => $job['previous_firm'],
                    'previous_date' => $job['previous_date'],
                ]);
            }
        }

        session()->flash('success', 'Candidate create successfully');

        return redirect()->route('admin.candidates.index');
    }

    /**
     * Edit Candidate by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $candidate = Candidate::with('links')->with('jobs')->where('id', $id)->first();
        $firms = Firm::all();

        return view('admin.candidates.edit')->withCandidate($candidate)->withFirms($firms);
    }

    /**
     * Update Candidate by ID
     *
     * @param CandidateUpdate $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CandidateUpdate $request, Candidate $candidate)
    {
        $candidate->update($request->except(['jobs','links']));

        CandidateJob::where('candidate_id', $candidate->id)->delete();
        CandidateLink::where('candidate_id', $candidate->id)->delete();

        foreach($request->links as $link){
            if($link){
                CandidateLink::create([
                    'candidate_id' => $candidate->id,
                    'link' => $link
                ]);
            }
        }

        foreach($request->jobs as $key => $job){
            if($job['previous_firm'] != null){
                CandidateJob::create([
                    'candidate_id' => $candidate->id,
                    'previous_firm' => $job['previous_firm'],
                    'previous_date' => $job['previous_date'],
                ]);
            }
        }

        session()->flash('success', 'Firm updated successfully');

        return redirect()->route('admin.candidates.index');
    }

    /**
     * Destroy Candidate by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Candidate::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
