<?php

namespace App\Http\Controllers\Search;

use App\Http\Requests\Api\ReportGetRequest;
use App\Http\Resources\Initial\ResponseResource;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    /**
     * Get report from front end and save it
     *
     * @param ReportGetRequest $request
     * @return ResponseResource
     */
    public function report(ReportGetRequest $request)
    {
        $report = Report::create($request->all());

        return new ResponseResource([
            'report' => $report,
        ]);
    }

}