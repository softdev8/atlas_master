<?php

namespace App\DataTables;

use App\Models\CandidateLocation;
use App\User;
use Yajra\DataTables\Services\DataTable;

class CandidatesLocationsDataTable extends DataTable
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
            ->addColumn('country', function ($item) {
                return '<span class="badge label badge-dark">'.$item->location->country->title.' </span>
                        <span class="badge label badge-dark">'.$item->location->region->title.' </span>
                        <span class="badge label badge-dark">'.$item->location->city->title.' </span>';
            })
            ->editColumn('location_id', function ($item) {
                return '<span class="badge label badge-dark">'.$item->location->address.'</span>';
            })
            ->addColumn('action', function ($item) {
                return '<a href="locations/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Region Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/candidates/'.$this->candidate->id.'/locations/'.$item->id.'/delete" title="Region Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CandidateLocation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CandidateLocation $model)
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
            'id'            => ['width' => '20px'],
            'candidate_id'  => ['title' => 'candidate', 'width' => '250px'],
            'country'       => ['title' => 'location'],
            'location_id'   => ['title' => 'address'],
            'description',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CandidatesLocations_' . date('YmdHis');
    }
}
