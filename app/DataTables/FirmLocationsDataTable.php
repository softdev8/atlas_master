<?php

namespace App\DataTables;

use App\Models\FirmLocation;
use Yajra\DataTables\Services\DataTable;

class FirmLocationsDataTable extends DataTable
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
            ->editColumn('country_id', function ($item) {
                return '<span class="badge label badge-dark">'.$item->country->title.'</span>';
            })
            ->editColumn('region_id', function ($item) {
                return '<span class="badge label badge-dark">'.$item->region->title.'</span>';
            })
            ->editColumn('city_id', function ($item) {
                if(isset($item->city->title)){
                    return '<span class="badge label badge-dark">'.$item->city->title.'</span>';
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($item) {
                return '<a href="locations/'.$item->id.'/edit" class="btn btn-success btn-xs" title="Region Edit">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
						<button type="button" class="btn-delete btn btn-danger btn-xs" value="/admin/firms/'.$this->firm->id.'/locations/'.$item->id.'/delete" title="Region Delete">
							<i class="fa fa-times"></i>
						</button>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FirmLocation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FirmLocation $model)
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
            'country_id'    => ['title' => 'country', 'width' => '120px'],
            'region_id'     => ['title' => 'region', 'width' => '120px'],
            'city_id'       => ['title' => 'city', 'width' => '120px'],
            'address',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FirmLocations_' . date('YmdHis');
    }
}
