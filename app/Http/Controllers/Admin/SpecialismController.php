<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecialismsDataTable;
use App\Http\Requests\Admin\SpecialismSave;
use App\Http\Requests\Admin\SpecialismUpdate;
use App\Models\FilterPracticeArea;
use App\Models\FilterSpecialism;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialismController extends Controller
{
    /**
     * Get all Specialisms
     *
     * @param SpecialismsDataTable $dataTable
     * @return mixed
     */
    public function index(SpecialismsDataTable $dataTable)
    {
        return $dataTable->with('area')->render('admin.specialisms.index');
    }

    /**
     * Render Specialism create page
     */
    public function create()
    {
        $areas = FilterPracticeArea::all();

        return view('admin.specialisms.create')->withAreas($areas);
    }

    /**
     * Create new Specialism from admin-panel
     *
     * @param SpecialismSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SpecialismSave $request)
    {
        FilterSpecialism::create($request->all());

        session()->flash('success', 'Specialism create successfully');

        return redirect()->route('admin.specialisms.index');
    }

    /**
     * Edit Specialism by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $specialism = FilterSpecialism::findOrFail($id);
        $areas = FilterPracticeArea::all();

        return view('admin.specialisms.edit')->withAreas($areas)->withSpecialism($specialism);
    }

    /**
     * Update Specialism by ID
     *
     * @param SpecialismUpdate $request
     * @param FilterSpecialism $specialism
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SpecialismUpdate $request, FilterSpecialism $specialism)
    {
        $specialism->update($request->all());

        session()->flash('success', 'Practice Area updated successfully');

        return redirect()->route('admin.specialisms.index');
    }

    /**
     * Destroy Specialism by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = FilterSpecialism::findOrFail($id);
        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }

    /**
     * Get specialisms (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getSpecialismsAjax(Request $request)
    {
        return FilterSpecialism::where('area_id', $request->id)->get();
    }
}
