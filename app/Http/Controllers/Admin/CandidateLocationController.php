<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CandidatesLocationsDataTable;
use App\Http\Requests\Admin\CandidateLocationSave;
use App\Http\Requests\Admin\CandidateLocationUpdate;
use App\Models\Candidate;
use App\Models\CandidateLocation;
use App\Models\City;
use App\Models\Country;
use App\Models\FirmLocation;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateLocationController extends Controller
{
    /**
     * Get all candidates locations
     *
     * @param CandidatesDataTable $dataTable
     * @return mixed
     */
    public function index(CandidatesLocationsDataTable $dataTable, Candidate $candidate)
    {
        return $dataTable->with('candidate', $candidate)->with('location')->render('admin.candidates.locations.index');
    }

    /**
     * Render Candidate create page
     *
     * @param Candidate $candidate
     * @return mixed
     */
    public function create(Candidate $candidate)
    {
        $countries = Country::all();

        return view('admin.candidates.locations.create')
            ->withCandidate($candidate)
            ->withCountries($countries);
    }

    /**
     * Create new Candidate location from admin-panel
     *
     * @param CandidateLocationSave $request
     * @param Candidate $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CandidateLocationSave $request, Candidate $candidate)
    {
        CandidateLocation::create($request->all());

        session()->flash('success', 'Candidate location create successfully');

        return redirect()->route('admin.candidates.locations.index', $candidate->id);
    }

    /**
     * Edit Candidate location by ID
     *
     * @param Candidate $candidate
     * @param $id
     * @return mixed
     */
    public function edit(Candidate $candidate, $id)
    {
        $userLocation  = CandidateLocation::where('id', $id)->first();
        $countries     = Country::all();

        return view('admin.candidates.locations.edit')
            ->withCandidate($candidate)
            ->withUserLocation($userLocation)
            ->withCountries($countries);
    }

    /**
     * Update Candidate location by ID
     *
     * @param CandidateLocationUpdate $request
     * @param Candidate $candidate
     * @param CandidateLocation $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CandidateLocationUpdate $request, Candidate $candidate, CandidateLocation $location)
    {
        $location->update($request->all());

        session()->flash('success', 'Candidate location updated successfully');

        return redirect()->route('admin.candidates.locations.index', $candidate->id);
    }

    /**
     * Destroy Candidate location by ID
     *
     * @param Candidate $candidate
     * @param $id
     * @return string
     */
    public function destroy(Candidate $candidate, $id)
    {
        $item = CandidateLocation::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }

    /**
     * Get regions for candidate firm (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getRegionsAjax(Request $request)
    {
        $firmRegions = FirmLocation::where('country_id', $request->id)->where('firm_id', $request->firm)->get();

        return Region::whereIn('id', explode(",", $firmRegions->implode('region_id', ', ')) )->get();
    }


    /**
     * Get cities for candidate firm (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getCitiesAjax(Request $request)
    {
        $firmRegions = FirmLocation::where('region_id', $request->id)->where('firm_id', $request->firm)->get();

        return City::whereIn('id', explode(",", $firmRegions->implode('city_id', ', ')) )->get();
    }

    /**
     * Get location (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getLocationAjax(Request $request)
    {
        return FirmLocation::where('city_id', $request->id)->where('firm_id', $request->firm)->get();
    }
}
