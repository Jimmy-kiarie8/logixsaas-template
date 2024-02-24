<?php

namespace App\Http\Controllers;


use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\DataTransformService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        $users = User::paginate(100);

        $jsonFile = public_path('data/users.json'); // Get the full path to the JSON file


        $trans = new DataTransformService;
        $jsonData = $trans->data_transform($jsonFile);

        $headers = [];
        $headers[] = ['title' => 'Created At', 'key' => 'created_at'];

        foreach ($jsonData as $item) {
            $headers[] = [
                'title' => $item['label'],
                'key' => $item['model']
            ];
        }

        $headers[] = ['title' => 'Actions', 'key' => 'actions'];

        return Inertia::render('Views/index', [
            'data' => $users,
            'form_data' => $jsonData,
            'headers' => $headers,
            'title' => 'Users',
            'modelRoute' => 'users',
            'upload' => false
        ]);
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'id');

        return view('tickets.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $trans = new DataTransformService;
        $dataValue = $trans->store($data);

        $dataValue['password'] = Str::random(8);
        User::create($dataValue);

        return redirect()->back()->with('message', 'User created');
    }

    public function edit($id)
    {
        $driver_groups = User::find($id);

        $jsonFile = public_path('data/users.json'); // Get the full path to the JSON file

        $trans = new DataTransformService;
        return $trans->data_edit_transform($jsonFile, $driver_groups);
    }

    public function update(EditUserRequest $request, User $user)
    {
        if ($request->has('password')) {
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        $user->update([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : '',
        ]);

        $user->syncRoles($request->input('role'));

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index');
    }
}
