<?php

namespace App\DataTables;

use App\Models\ActivityLog;
use App\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class ActivityLogDataTable extends DataTable
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
            ->editColumn('user_id', function ($item) {
                return $item->user['name'];
            })
            ->editColumn('company_id', function ($item) {
                return $item->company['title'];
            })
            ->editColumn('email', function ($item) {
                return $item->user['email'];
            })
            ->editColumn('role_id', function ($item) {
                return $item->role['title'];
            })
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="log_check" value="'.$item->id.'"/>';
            })
            ->escapeColumns(['']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityLog $model)
    {
      
        $returnData = $model->newQuery()->with('user')->select();
        $user_role = Auth::user()->role_id;

        $company_id = Auth::user()->company_id;

        if ($user_role == 5) {
            $returnData = $returnData->where('role_id', '<>', 5);
        } else if($user_role == 2) {
            $returnData = $returnData->where('company_id', $company_id)
            ->where('role_id', '<>', 5)->where('role_id', '<>', 2);
        }

        if(!empty(request()->start_date) && !empty(request()->end_date)) {

            $returnData = $returnData
                ->where('created_at', '>=', request()->start_date)
                ->where('created_at', '<=', request()->end_date);          
        } else {
            
        }

        return $this->applyScopes($returnData);
       
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        $attributes = ['data' => 'function(d) {
            d.start_date = $("#start_date").val();
            d.end_date = $("#end_date").val();
         }'];

        return $this->builder()
            ->columns($this->getColumns())
            // ->minifiedAjax()
            ->ajax($attributes)
            ->parameters([

                'lengthMenu' => ['50','100'],
                'order'   => [[3, 'desc']],
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
            'checkbox' => ['width' => '20px', 'title' => '<input type="checkbox" name="checkAll" id="checkAll" />', 'orderable' => false],
            'user_id' => ['title' => 'Name'],
            'email' => ['title' => 'Email'],
            'company_id' => ['title' => 'Company'],
            'role_id'       => ['title' => 'Role'],
            'created_at' => ['title' => 'Created At'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Activity_' . date('YmdHis');
    }
}
