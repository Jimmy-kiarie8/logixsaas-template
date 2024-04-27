<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Permission;
use App\Services\DataTransformService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends BaseController
{

    public function __construct()
    {
        // Set properties specific to IngredientController
        $this->model = new User();
        $this->json = 'users.json';
        $this->title = 'User';
        $this->route = 'users';
        $this->upload = false;


        $this->actions = [
            ['action_name' => 'Edit', 'icon' => 'mdi-pencil', 'color' => 'primary','route' => 'users'],
            ['action_name' => 'Delete', 'icon' => 'mdi-delete', 'color' => 'error','route' => 'users'],
            // Add more actions as needed
        ];
    }

    // public function update(Request $request, $id)
    // {

    //     $trans = new DataTransformService;
    //     $dataValue = $trans->store($request->all());

    //     DB::beginTransaction();

    //     try {
    //         $model = $this->model->create($dataValue);


    //         DB::commit();
    //         return redirect()->back()->with('message', 'Created');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //     }
    //     $user = User::find($id);

    //     $role = Role::find($dataValue['role_id']);

    //     $user->assignRole($role);
    // }

}
