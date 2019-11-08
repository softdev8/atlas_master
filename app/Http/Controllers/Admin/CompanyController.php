<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CompaniesDataTable;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Get all companies
     *
     * @param CompaniesDataTable $dataTable
     * @return mixed
     */
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('admin.companies.index');
    }

    /**
     * Render company create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Save new company
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Company::create($request->all());

        session()->flash('success', 'Company create successfully');

        return redirect()->route('admin.companies.index');
    }

    /**
     * Edit Company by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $company = Company::where('id', $id)->first();

        return view('admin.companies.edit')->withCompany($company);
    }

    /**
     * Update Report by ID
     *
     * @param Request $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $company->update($request->all());

        session()->flash('success', 'Company updated successfully');
        return redirect()->route('admin.companies.index');
    }

    /**
     * Destroy Report by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Company::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
