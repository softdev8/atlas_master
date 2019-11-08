<?php

namespace App\DataTables;

use App\Models\FilterSpecialism;
use App\User;
use Yajra\DataTables\Services\DataTable;

class SpecialismsDataTable extends DataTable
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
            ->editColumn('area_id', function ($item) {
                return '<span class="badge label badge-dark">'.$item->area->title.'</span>';
            })
            ->addColumn('action', function ($item) {
                return '<a href="specialisms/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Specialism Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/specialisms/'.$item->id.'/delete" title="Specialism Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FilterSpecialism $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FilterSpecialism $model)
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
            'area_id'       => ['title' => 'practice area'],
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
        return 'Specialisms_' . date('YmdHis');
    }
}
