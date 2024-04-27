<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Imports\LeadImport;
use App\Models\Client;
use App\Models\Lead;
use App\Services\DataTransformService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends BaseController
{
    public function __construct()
    {
        // parent::__construct(); // Call parent constructor to initialize properties

        // Set properties specific to IngredientController
        $this->model = new Client();
        $this->json = 'clients.json';
        $this->title = 'Client';
        $this->route = 'clients';
        $this->upload = false;

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
