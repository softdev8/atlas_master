<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReportsDataTable;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Get all reports
     *
     * @param ReportsDataTable $dataTable
     * @return mixed
     */
    public function index(ReportsDataTable $dataTable)
    {
        return $dataTable->render('admin.reports.index');
    }


    /**
     * Edit Report by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $report = Report::with('user')->with('candidate')->where('id', $id)->first();

        return view('admin.reports.edit')->withReport($report);
    }

    /**
     * Update Report by ID
     *
     * @param Request $request
     * @param Report $report
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Report $report)
    {
        $report->update([
            'status' => $request->status
        ]);

        session()->flash('success', 'Report status updated successfully');
        return redirect()->route('admin.reports.index');
    }

    /**
     * Destroy Report by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Report::findOrFail($id);

        if($item){
            $item->delete();
            return 'Delete complete';
        }
    }
}
