<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CitiesDataTable;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Get all cities
     *
     * @param CitiesDataTable $dataTable
     * @return mixed
     */
    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->with('country')->with('region')->render('admin.cities.index');
    }

    /**
     * Get cities (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getCitiesAjax(Request $request)
    {
        return City::where('region_id', $request->id)->get();
    }

}
