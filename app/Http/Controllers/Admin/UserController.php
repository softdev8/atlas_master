<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Requests\Admin\UserRegistr;
use App\Http\Requests\Admin\UserRegistration;
use App\Http\Requests\Admin\UserUpdate;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Services\CropPictureService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Get all users
     *
     * @param UsersDataTable $dataTable
     * @return mixed
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->with('role')->with('company')->render('admin.users.index');
    }

    /**
     * Render User create page
     */
    public function create()
    {
        $companies = Company::all();
        $roles = Role::all();

        return view('admin.users.create')->withCompanies($companies)->withRoles($roles);
    }

    /**
     * Create new User from admin-panel
     *
     * @param UserRegistration $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRegistration $request)
    {
        User::create([
            'name'              => $request['name'],
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
            'remember_token'    => str_random(20),
            'company_id'        => $request['company_id'],
            'role_id'           => $request['role_id'],
            'csv'               => 0,
            'status'            => 1
        ]);

        session()->flash('success', 'User create successfully');

        return redirect()->route('admin.users.index');
    }

    /**
     * Edit User by ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $companies = Company::all();

        return view('admin.users.edit')->withUser($user)->withRoles($roles)->withCompanies($companies);
    }

    /**
     * Update User by ID
     *
     * @param UserUpdate $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdate $request, User $user)
    {
        if($request->avatar){
            $request['data_url'] = 'data:image/jpeg;base64';
            $request['avatar'] = CropPictureService::cropPicture($user->avatar, $request);
        }

        if(isset($request->status)){
            if($request->status == 'on'){
                $request['status'] = 1;
            }
        } else {
            $request['status'] = 0;
        }

        if(isset($request->csv)){
            if($request->csv == 'on'){
                $request['csv'] = 1;
            }
        } else {
            $request['csv'] = 0;
        }

        $user->update($request->all());

        session()->flash('success', 'User updated successfully');

        return redirect()->route('admin.users.index');
    }


    /**
     * Destroy User by ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user){

            Storage::disk('public')->delete($user->avatar);

            $user->delete();
            return 'Delete complete';
        }
    }

}
