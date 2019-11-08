<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PracticeAreasDataTable;
use App\Http\Requests\Admin\PracticeAreaSave;
use App\Http\Requests\Admin\PracticeAreaUpdate;
use App\Models\FilterPracticeArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PracticeAreaController extends Controller
{
    /**
     * Get all practices areas
     *
     * @param PracticeAreasDataTable $dataTable
     * @return mixed
     */
    public function index(PracticeAreasDataTable $dataTable)
    {
        return $dataTable->render('admin.practices.index');
    }

    /**
     * Render Practices create page
     */
    public function create()
    {
        return view('admin.practices.create');
    }

    /**
     * Create new Practices from admin-panel
     *
     * @param PracticeAreaSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PracticeAreaSave $request)
    {
        FilterPracticeArea::create($request->all());

        session()->flash('success', 'Practice Area create successfully');

        return redirect()->route('admin.practices.index');
    }

    /**
     * Edit Practices by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $area = FilterPracticeArea::findOrFail($id);

        return view('admin.practices.edit')->withArea($area);
    }

    /**
     * Update Practices by ID
     *
     * @param PracticeAreaUpdate $request
     * @param FilterPracticeArea $practiceArea
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PracticeAreaUpdate $request, FilterPracticeArea $practiceArea)
    {
        $practiceArea->update($request->all());

        session()->flash('success', 'Practice Area updated successfully');

        return redirect()->route('admin.practices.index');
    }


    /**
     * Destroy Practices by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $area = FilterPracticeArea::findOrFail($id);
        if($area){
            $area->delete();
            return 'Delete complete';
        }
    }
}