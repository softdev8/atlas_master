<?php

namespace App\DataTables;

use App\Models\Firm;
use Yajra\DataTables\Services\DataTable;

class FirmsDataTable extends DataTable
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
            ->addColumn('action', function ($item) {
                return '<a href="firms/'.$item->id.'/locations" class="btn btn-info btn-xs" title="Firm Locations">
                           <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </a>
                        <a href="firms/'.$item->id.'/salaries" class="btn btn-purple btn-xs" title="Firm Salaries">
                            <i class="fa fa-usd" aria-hidden="true"></i> 
                        </a>
                        <a href="firms/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Firm Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/firms/'.$item->id.'/delete" title="Firm Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Firm $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Firm $model)
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
            'type',
            'ranking',
            'website',
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
        return 'Firms_' . date('YmdHis');
    }
}
