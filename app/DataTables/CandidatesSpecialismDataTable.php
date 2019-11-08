<?php

namespace App\DataTables;

use App\Models\CandidateSpecialism;
use App\Models\CandidateSubSpecialism;
use App\User;
use Yajra\DataTables\Services\DataTable;

class CandidatesSpecialismDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('candidate_id', function ($item) {
                return $item->candidate->forename.' '.$item->candidate->surname;
            })
            ->editColumn('area_id', function ($item) {
                return $item->area->title;
            })
            ->editColumn('specailism_id', function ($item) {
                if(isset($item->specialism->title)){
                    return $item->specialism->title;
                } else {
                    return '-';
                }
            })
            ->editColumn('subspecialism_id', function ($item) {
                if(isset($item->subspecialism->title)){
                    return $item->subspecialism->title;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($item) {
                return '<a href="specialisms/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Region Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/candidates/'.$this->candidate->id.'/specialisms/'.$item->id.'/delete" title="Region Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CandidateSubSpecialism $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CandidateSubSpecialism $model)
    {
        return $model->newQuery()->select()->where('candidate_id', $this->candidate->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '100px'])
            ->parameters([
                'lengthMenu' => ['15', '25', '50'],
                'order'   => [[0, 'desc']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'                => ['width' => '20px'],
            'candidate_id'      => ['title' => 'candidate', 'width' => '250px'],
            'area_id'           => ['title' => 'practice area'],
            'specailism_id'     => ['title' => 'specailism'],
            'subspecialism_id'  => ['title' => 'sub specialism'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CandidatesSpecialism_' . date('YmdHis');
    }
}
