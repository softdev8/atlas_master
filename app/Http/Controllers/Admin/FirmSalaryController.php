<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FirmSalariesDataTable;
use App\Http\Requests\Admin\SalarySave;
use App\Http\Requests\Admin\SalaryUpdate;
use App\Models\Firm;
use App\Models\FilterPqeLevel;
use App\Models\FirmSalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirmSalaryController extends Controller
{
    /**
     * Get all firm salaries
     *
     * @param FirmSalariesDataTable $dataTable
     * @param Firm $firm
     * @return mixed
     */
    public function index(FirmSalariesDataTable $dataTable, Firm $firm)
    {
        return $dataTable->with('firm', $firm)->render('admin.firms.salaries.index');
    }

    /**
     * Render Firm create page
     *
     * @param Firm $firm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Firm $firm)
    {
        $levels = FilterPqeLevel::all();

        return view('admin.firms.salaries.create')->withFirm($firm)->withLevels($levels);
    }

    /**
     * Create new Firm from admin-panel
     *
     * @param Firm $firm
     * @param SalarySave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SalarySave $request, Firm $firm)
    {
        FirmSalary::create($request->all());

        session()->flash('success', 'Salary add successfully');

        return redirect()->route('admin.firms.salaries.index', $firm->id);
    }

    /**
     * Edit Firm by ID
     *
     * @param Firm $firm
     * @param $id
     * @return mixed
     */
    public function edit(Firm $firm, $id)
    {
        $levels = FilterPqeLevel::all();
        $salary = FirmSalary::findOrFail($id);

        return view('admin.firms.salaries.edit')
            ->withFirm($firm)
            ->withSalary($salary)
            ->withLevels($levels);
    }

    /**
     * Update Firm by ID
     *
     * @param SalaryUpdate $request
     * @param Firm $firm
     * @param FirmSalary $salary
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SalaryUpdate $request, Firm $firm, FirmSalary $salary)
    {
        $salary->update($request->all());

        session()->flash('success', 'Salary updated successfully');

        return redirect()->route('admin.firms.salaries.index',  $firm->id);
    }


    /**
     * Destroy User by ID
     *
     * @param Firm $firm
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Firm $firm, $id)
    {
        $item = FirmSalary::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
