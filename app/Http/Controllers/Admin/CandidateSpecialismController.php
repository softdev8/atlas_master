<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CandidatesSpecialismDataTable;
use App\Http\Requests\Admin\CandidateSpecialismSave;
use App\Http\Requests\Admin\CandidateSpecialismUpdate;
use App\Models\Candidate;
use App\Models\CandidateArea;
use App\Models\CandidateSpecialism;
use App\Models\CandidateSubSpecialism;
use App\Models\FilterPracticeArea;
use App\Models\FilterSpecialism;
use App\Models\FilterSubSpecialism;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateSpecialismController extends Controller
{
    /**
     * Get all candidates specialisms
     *
     * @param CandidatesSpecialismDataTable $dataTable
     * @return mixed
     */
    public function index(CandidatesSpecialismDataTable $dataTable, Candidate $candidate)
    {
        return $dataTable->with('candidate', $candidate)->render('admin.candidates.specialisms.index');
    }

    /**
     * Render Candidate specialism create page
     *
     * @param Candidate $candidate
     * @return mixed
     */
    public function create(Candidate $candidate)
    {
        $areas = FilterPracticeArea::all();

        return view('admin.candidates.specialisms.create')
            ->withCandidate($candidate)
            ->withAreas($areas);
    }

    /**
     * Create new Candidate specialism from admin-panel
     *
     * @param CandidateSpecialismSave $request
     * @param Candidate $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CandidateSpecialismSave $request, Candidate $candidate)
    {
        //CandidateArea::firstOrCreate($request->only(['candidate_id', 'area_id']));
        //CandidateSpecialism::firstOrCreate($request->only(['candidate_id', 'area_id', 'specialism_id']));
        CandidateSubSpecialism::firstOrCreate($request->only(['candidate_id', 'area_id', 'specialism_id', 'subspecialism_id']));

        session()->flash('success', 'Candidate specialism create successfully');

        return redirect()->route('admin.candidates.specialisms.index', $candidate->id);
    }

    /**
     * Edit Candidate specialism by ID
     *
     * @param Candidate $candidate
     * @param $id
     * @return mixed
     */
    public function edit(Candidate $candidate, $id)
    {
        $userSpecialism  = CandidateSubSpecialism::where('id', $id)->first();
        $areas = FilterPracticeArea::all();
        $specialisms = FilterSpecialism::where('area_id', $userSpecialism->area_id)->get();
        $subs = FilterSubSpecialism::where('specialism_id', $userSpecialism->specialism_id )->get();

        return view('admin.candidates.specialisms.edit')
            ->withCandidate($candidate)
            ->withUserSpecialism($userSpecialism)
            ->withAreas($areas)
            ->withSpecialisms($specialisms)
            ->withSubs($subs);
    }

    /**
     * Update Candidate specialism by ID
     *
     * @param CandidateLocationUpdate $request
     * @param Candidate $candidate
     * @param CandidateSubSpecialism $subspecialism
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CandidateSpecialismUpdate $request, Candidate $candidate, CandidateSubSpecialism $subspecialism)
    {
        $subspecialism->update($request->all());

        session()->flash('success', 'Candidate specialism updated successfully');

        return redirect()->route('admin.candidates.specialisms.index', $candidate->id);
    }

    /**
     * Destroy Candidate specialism by ID
     *
     * @param Candidate $candidate
     * @param $id
     * @return string
     */
    public function destroy(Candidate $candidate, $id)
    {
        $item = CandidateSubSpecialism::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }

}
