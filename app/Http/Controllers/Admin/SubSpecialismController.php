<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubSpecialismsDataTable;
use App\Http\Requests\Admin\SubSpecialismSave;
use App\Http\Requests\Admin\SubSpecialismUpdate;
use App\Models\FilterSpecialism;
use App\Models\FilterSubSpecialism;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSpecialismController extends Controller
{
    /**
     * Get all SubSpecialisms
     *
     * @param SubSpecialismsDataTable $dataTable
     * @return mixed
     */
    public function index(SubSpecialismsDataTable $dataTable)
    {
        return $dataTable->with('specialism')->render('admin.subs.index');
    }

    /**
     * Render SubSpecialisms create page
     */
    public function create()
    {
        $specialisms = FilterSpecialism::all();

        return view('admin.subs.create')->withSpecialisms($specialisms);
    }

    /**
     * Create new SubSpecialisms from admin-panel
     *
     * @param SubSpecialismSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubSpecialismSave $request)
    {
        FilterSubSpecialism::create($request->all());

        session()->flash('success', 'Sub Specialism create successfully');

        return redirect()->route('admin.subs.index');
    }

    /**
     * Edit SubSpecialisms by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $sub = FilterSubSpecialism::findOrFail($id);
        $specialisms = FilterSpecialism::all();

        return view('admin.subs.edit')->withSub($sub)->withSpecialisms($specialisms);
    }

    /**
     * Update SubSpecialisms by ID
     *
     * @param SubSpecialismUpdate $request
     * @param FilterSubSpecialism $sub
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubSpecialismUpdate $request, FilterSubSpecialism $sub)
    {
        $sub->update($request->all());

        session()->flash('success', 'Practice Area updated successfully');

        return redirect()->route('admin.subs.index');
    }

    /**
     * Destroy SubSpecialisms by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = FilterSubSpecialism::findOrFail($id);
        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
    /**
     * Get sub specialisms (ajax request)
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubSpecialismAjax(Request $request)
    {
        return FilterSubSpecialism::where('specialism_id', $request->id)->get();
    }

}
