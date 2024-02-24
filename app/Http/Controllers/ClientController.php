<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Imports\LeadImport;
use App\Models\Client;
use App\Models\Lead;
use App\Services\DataTransformService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(100);

        $jsonFile = public_path('data/clients.json'); // Get the full path to the JSON file

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
            'data' => $clients,
            'form_data' => $jsonData,
            'headers' => $headers,
            'title' => 'Clients',
            'modelRoute' => 'clients',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
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
        Client::create($dataValue);

        return redirect()->back()->with('message', 'Contact created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    public function edit($id)
    {
        $driver_groups = Client::find($id);

        $jsonFile = public_path('data/clients.json'); // Get the full path to the JSON file

        $trans = new DataTransformService;
        return $trans->data_edit_transform($jsonFile, $driver_groups);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, $id)
    {

        Client::find($id)->update($request->all());

        return redirect()->back()->with('message', 'Contact updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Process the uploaded file using Laravel Excel
        $import = new LeadImport;
        $response = Excel::toArray($import, $request->file('file'));

        $leads = $response[0];

        // Get the imported data

        // Insert the imported data into the database
        foreach ($leads as $data) {
            $client = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'notes' => $data['notes'],
                'status' => $data['status'],
            ];
            $client = Client::create($client);

            $data['client_id'] = $client->id;
            Lead::create($data);
        }

        return redirect()->back()->with('message', 'Contact uploaded');

        return response()->json(['message' => 'File uploaded and data inserted successfully']);

    }

    public function client_search($search) {
        return Client::where('name', 'LIKE', "%{$search}%")->get();
    }
}
