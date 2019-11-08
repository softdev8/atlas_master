<?php

namespace App\Http\Controllers\Admin;

use App\Imports\CandidateImport;
use App\Jobs\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ToolsController extends Controller
{
    /**
     * Render impoert/export page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.tools.index');
    }

    /**
     * Parse xls file and insert candidates to DB
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importCandidates(Request $request)
    {
        Excel::import(new CandidateImport, $request->file('candidates'));

        return redirect('/admin/tools')->with('success', 'All good!');
    }
}
