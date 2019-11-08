<?php

namespace App\DataTables;

use App\Models\FilterSubSpecialism;
use App\User;
use Yajra\DataTables\Services\DataTable;

class SubSpecialismsDataTable extends DataTable
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
            ->editColumn('specialism_id', function ($item) {
                return '<span class="badge label badge-dark">'.$item->specialism->title.'</span>';
            })
            ->addColumn('action', function ($item) {
                return '<a href="subs/'.$item->id.'/edit" class="btn btn-success btn-xs" title="SubSpecialism Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/subs/'.$item->id.'/delete" title="SubSpecialism Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FilterSubSpecialism $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FilterSubSpecialism $model)
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
            'title',
            'specialism_id' => ['title' => 'specialism'],
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
        return 'SubSpecialisms_' . date('YmdHis');
    }
}
