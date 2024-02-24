<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Services\DataTransformService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Permission::paginate(100);

        $jsonFile = public_path('data/permissions.json'); // Get the full path to the JSON file


        $trans = new DataTransformService;
        $jsonData = $trans->data_transform($jsonFile);

        $headers = [];
        $headers[] = ['title' => 'Created At', 'key' => 'created_at'];

        foreach ($jsonData as $item) {
            if ($item['table_display']) {
                $headers[] = [
                    'title' => $item['label'],
                    'key' => $item['model']
                ];
            }
        }

        $headers[] = ['title' => 'Actions', 'key' => 'actions'];

        return Inertia::render('Views/index', [
            'data' => $roles,
            'form_data' => $jsonData,
            'headers' => $headers,
            'title' => 'Permission',
            'modelRoute' => 'permissions',
            'upload' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $dataValue = [];

        foreach ($data as $item) {
            $model = $item['model'];
            if ($item['type']  == 'radio') {
                $value = ($item['value'] == 'Yes') ? true : false;
            } else {
                $value = $item['value'];
            }

            $dataValue[$model] = $value;
        }

        Permission::create($dataValue);

        return redirect()->back()->with('message', 'Role created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $insurance = Permission::find($id);

        $jsonFile = public_path('data/permissions.json'); // Get the full path to the JSON file

        $trans = new DataTransformService;
        return $trans->data_edit_transform($jsonFile, $insurance);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
