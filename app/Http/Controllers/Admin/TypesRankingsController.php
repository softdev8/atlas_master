<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TypesRankingsDataTable;
use App\Http\Requests\Admin\TypesRankingSave;
use App\Http\Requests\Admin\TypesRankingUpdate;
use App\Models\FilterType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesRankingsController extends Controller
{
    /**
     * Get all Type&Rankings
     *
     * @param TypesRankingsDataTable $dataTable
     * @return mixed
     */
    public function index(TypesRankingsDataTable $dataTable)
    {
        return $dataTable->render('admin.types.index');
    }

    /**
     * Render Type&Rankings create page
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Create new Type&Rankings from admin-panel
     *
     * @param TypesRankingSave $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TypesRankingSave $request)
    {
        if($request->flag == 'rank'){
            FilterType::create($request->all());
        } else {
            FilterType::create($request->except(['min', 'max']));
        }

        session()->flash('success', 'Type&Rankings create successfully');

        return redirect()->route('admin.types.index');
    }

    /**
     * Edit Type&Rankings by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $type = FilterType::findOrFail($id);

        return view('admin.types.edit')->withType($type);
    }

    /**
     * Update Type&Rankings by ID
     *
     * @param TypesRankingUpdate $request
     * @param FilterSpecialism $specialism
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TypesRankingUpdate $request, FilterType $type)
    {
        if($request->flag == 'rank'){
            $type->update($request->all());
        } else {

            $type->update([
                'title' => $request->title,
                'flag'  => $request->flag,
                'min'   => null,
                'max'   => null,
            ]);
        }

        session()->flash('success', 'Type&Rankings updated successfully');

        return redirect()->route('admin.types.index');
    }

    /**
     * Destroy Type&Rankings by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = FilterType::findOrFail($id);
        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
