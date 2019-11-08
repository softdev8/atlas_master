<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RegionsDataTable;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Get all regions
     *
     * @param RegionsDataTable $dataTable
     * @return mixed
     */
    public function index(RegionsDataTable $dataTable)
    {
        return $dataTable->with('country')->render('admin.regions.index');
    }

    /**
     * Get regions (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getRegionsAjax(Request $request)
    {
        return Region::where('country_id', $request->id)->get();
    }


}
