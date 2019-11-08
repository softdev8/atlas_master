<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountriesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Get all countries
     *
     * @param CountriesDataTable $dataTable
     * @return mixed
     */
    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('admin.countries.index');
    }


}
