<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FirmsDataTable;
use App\Models\FilterType;
use App\Models\Firm;
use App\Http\Requests\Admin\FirmSave;
use App\Http\Requests\Admin\FirmUpdate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirmController extends Controller
{
    /**
     * Get all firms
     *
     * @param FirmsDataTable $dataTable
     * @return mixed
     */
    public function index(FirmsDataTable $dataTable)
    {
        return $dataTable->render('admin.firms.index');
    }

    /**
     * Render Firm create page
     */
    public function create()
    {
        $types = FilterType::where('flag', 'type')->get();

        return view('admin.firms.create')->withTypes($types);
    }

    /**
     * Create new Firm from admin-panel
     *
     * @param FirmSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FirmSave $request)
    {
        Firm::create($request->all());

        session()->flash('success', 'Firm create successfully');

        return redirect()->route('admin.firms.index');
    }

    /**
     * Edit Firm by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $firm = Firm::findOrFail($id);
        $types = FilterType::where('flag', 'type')->get();

        return view('admin.firms.edit')->withFirm($firm)->withTypes($types);
    }

    /**
     * Update Firm by ID
     *
     * @param FirmUpdate $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FirmUpdate $request, Firm $firm)
    {
        $firm->update($request->all());

        session()->flash('success', 'Firm updated successfully');

        return redirect()->route('admin.firms.index');
    }


    /**
     * Destroy User by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Firm::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
