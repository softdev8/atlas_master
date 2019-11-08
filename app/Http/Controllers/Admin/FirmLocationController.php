<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FirmLocationsDataTable;
use App\Http\Requests\Admin\FirmLocationSave;
use App\Http\Requests\Admin\FirmLocationUpdate;
use App\Models\FirmLocation;
use App\Models\Firm;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirmLocationController extends Controller
{
    /**
     * Get all firm locations
     *
     * @param FirmLocationsDataTable $dataTable
     * @param Firm $firm
     * @return mixed
     */
    public function index(FirmLocationsDataTable $dataTable, Firm $firm)
    {
        return $dataTable->with('firm', $firm)->render('admin.firms.locations.index');
    }

    /**
     * Render Firm locations create page
     *
     * @param Firm $firm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Firm $firm)
    {
        $countries = Country::all();
        return view('admin.firms.locations.create')->withFirm($firm)->withCountries($countries);
    }

    /**
     * Create new Firm locations from admin-panel
     *
     * @param Firm $firm
     * @param FirmLocationSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FirmLocationSave $request, Firm $firm)
    {
        FirmLocation::firstOrCreate($request->except('_token'));

        session()->flash('success', 'Location create successfully');

        return redirect()->route('admin.firms.locations.index', $firm->id);
    }

    /**
     * Edit Firm location by ID
     *
     * @param Firm $firm
     * @param $id
     * @return mixed
     */
    public function edit(Firm $firm, $id)
    {
        $location = FirmLocation::findOrFail($id);
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        return view('admin.firms.locations.edit')
            ->withFirm($firm)
            ->withLocation($location)
            ->withCountries($countries)
            ->withRegions($regions)
            ->withCities($cities);
    }

    /**
     * Update Firm location by ID
     *
     * @param FirmLocationUpdate $request
     * @param Firm $firm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FirmLocationUpdate $request, Firm $firm, FirmLocation $location)
    {
        $location->update($request->all());

        session()->flash('success', 'Location updated successfully');

        return redirect()->route('admin.firms.locations.index',  $firm->id);
    }


    /**
     * Destroy Firm location by ID
     *
     * @param Firm $firm
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Firm $firm, $id)
    {
        $item = FirmLocation::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }

}
