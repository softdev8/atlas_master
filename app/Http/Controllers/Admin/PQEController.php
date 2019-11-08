<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PQELevelesDataTable;
use App\Http\Requests\Admin\PQELevelSave;
use App\Http\Requests\Admin\PQELevelUpdate;
use App\Models\FilterPqeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PQEController extends Controller
{
    /**
     * Get all PQE Levels
     *
     * @param PQELevelesDataTable $dataTable
     * @return mixed
     */
    public function index(PQELevelesDataTable $dataTable)
    {
        return $dataTable->render('admin.pqes.index');
    }

    /**
     * Render PQE Level create page
     */
    public function create()
    {
        return view('admin.pqes.create');
    }

    /**
     * Create new PQE Level from admin-panel
     *
     * @param PQELevelSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PQELevelSave $request)
    {
        FilterPqeLevel::create($request->all());

        session()->flash('success', 'PQE Level create successfully');

        return redirect()->route('admin.pqes.index');
    }

    /**
     * Edit PQE Level by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $level = FilterPqeLevel::findOrFail($id);

        return view('admin.pqes.edit')->withLevel($level);
    }

    /**
     * Update PQE Level by ID
     *
     * @param PQELevelUpdate $request
     * @param FilterPqeLevel $pqe
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PQELevelUpdate $request, FilterPqeLevel $pqe)
    {
        $pqe->update($request->all());

        session()->flash('success', 'PQE Level updated successfully');

        return redirect()->route('admin.pqes.index');
    }

    /**
     * Destroy PQE Level ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = FilterPqeLevel::findOrFail($id);
        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
