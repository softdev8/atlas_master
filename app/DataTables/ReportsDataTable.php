<?php

namespace App\DataTables;

use App\Models\Report;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
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
            ->editColumn('status', function ($item) {
                if($item->status == 0){
                    return '<span class="badge label badge-danger">New</span>';
                } elseif ($item->status == 1){
                    return '<span class="badge label badge-warning">In process</span>';
                } else {
                    return '<span class="badge label badge-primary">Complete</span>';
                }
            })
            ->editColumn('user_id', function ($item) {
                return $item->user['name'];
            })
            ->editColumn('candidate_id', function ($item) {
                return $item->candidate->forename.' '.$item->candidate->surname;
            })
            ->addColumn('action', function ($item) {
                return '<a href="reports/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Report Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/reports/'.$item->id.'/delete" title="Report Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Report $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Report $model)
    {
        return $model->newQuery()->select();
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
            'user_id'       => ['title' => 'user'],
            'candidate_id'  => ['title' => 'candidate'],
            'status',
            'created_at'    => ['width' => '90px'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Reports_' . date('YmdHis');
    }
}
