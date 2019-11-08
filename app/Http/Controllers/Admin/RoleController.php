<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\DataTables\RolesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Get all roles
     *
     * @param RolesDataTable $dataTable
     * @return mixed
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }
}
