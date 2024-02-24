<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Notifications\SendOTP;
use App\Services\DataGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Kutia\Larafirebase\Facades\Larafirebase;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice = Invoice::paginate(100);
        $clients = Client::paginate(100);

        $jsonFile = public_path('data/invoice.json'); // Get the full path to the JSON file


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

        return Inertia::render('Orders/Invoice/index', [
            'data' => $invoice,
            'form_data' => $jsonData,
            'headers' => $headers,
            'clients'=> $clients,
            'title' => 'Invoices',
            'modelRoute' => 'invoice',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $trans = new DataTransformService;
        $dataValue = $trans->store($data);

        $dataValue['password'] = Str::random(8);
        User::create($dataValue);

        return redirect()->back()->with('message', 'User created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driver_groups = Invoice::find($id);

        $jsonFile = public_path('data/invoice.json'); // Get the full path to the JSON file

        $trans = new DataTransformService;
        return $trans->data_edit_transform($jsonFile, $driver_groups);
    }
}
