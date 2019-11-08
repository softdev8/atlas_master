<?php

namespace App\DataTables;

use App\Models\FirmSalary;
use Yajra\DataTables\Services\DataTable;

class FirmSalariesDataTable extends DataTable
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
            ->editColumn('firm_id', function ($item) {
                return $item->firm->title;
            })
            ->addColumn('action', function ($item) {
                return '<a href="salaries/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Region Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/firms/'.$this->firm->id.'/salaries/'.$item->id.'/delete" title="Region Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FirmSalary $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FirmSalary $model)
    {
        return $model->newQuery()->select()->where('firm_id', $this->firm->id);
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
            'firm_id'       => ['title' => 'firm'],
            'pqe'           => ['width' => '120px'],
            'min'           => ['width' => '120px'],
            'max'           => ['width' => '120px'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FirmSalaries_' . date('YmdHis');
    }
}
