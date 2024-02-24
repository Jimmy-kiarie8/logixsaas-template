<?php

namespace App\Http\Controllers;

use App\Models\Callcenter;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Plot;
use App\Models\Project;
use App\Models\Sale;
use App\Models\Saleofficer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return Inertia::render('Reports/index', [
            'clients' => $clients,
        ]);
    }

    public function getHeader($data, $ignore)
    {
        $headers = [];

        if (!empty($data)) {
            $firstRow = $data->first(); // Assuming it's a collection

            if ($firstRow) {
                foreach ($firstRow->toArray() as $key => $value) {
                    // Check if the key is not an internal Laravel attribute (starts with an underscore)
                    if (!Str::startsWith($key, '_') && !is_object($value) && !is_array($value) && !in_array($key, $ignore)) {
                        $headers[] = [
                            'title' => ucfirst(str_replace('_', ' ', $key)),
                            'key' => $key,
                        ];
                    }
                }
            }
        }

        return  $headers;
    }

    public function generateAgentPerformanceReport(Request $request)
    {

        $date = [
            $request->start_date,
            $request->end_date
        ];
        $data = User::select(
            'users.name',
            DB::raw('COUNT(CASE WHEN callcenters.status = "completed" THEN 1 ELSE NULL END) as completed_count'),
            DB::raw('COUNT(CASE WHEN callcenters.status = "missed" THEN 1 ELSE NULL END) as missed_count'),
            DB::raw('COUNT(CASE WHEN leads.status = "converted" THEN 1 ELSE NULL END) as converted_count'),
            DB::raw('COUNT(leads.id) as total_leads')
        )
            ->leftJoin('callcenters', 'users.id', '=', 'callcenters.agent_id')
            ->leftJoin('leads', 'users.id', '=', 'leads.agent_id')
            ->groupBy('users.id', 'users.name')
            ->paginate(100);

        $ignore = [];
        $headers = $this->getHeader($data, $ignore);
        return response()->json(['data' => $data, 'headers' => $headers]);
    }


    /**
     * Display the Project Overview Report.
     */
    public function projectOverview(Request $request)
    {
        // Implement logic to generate the Project Overview Report
        // ...
        $date = [
            $request->start_date,
            $request->end_date
        ];
        $data = Project::withCount(['plots', 'plots as plots_sold_count' => function ($query) {
            $query->where('status', 'Sold');
        }])->get()->map(function ($project) {
            $project->plots_available_count = $project->plots_count - $project->plots_sold_count;
            $project->total_revenue = $project->plots()->where('is_sold', true)->sum('selling_price');
            return $project;
        });


        $ignore = [];
        $headers = $this->getHeader($data, $ignore);
        return response()->json(['data' => $data, 'headers' => $headers]);
    }

    /**
     * Display the Plot Status Report.
     */
    public function plotStatus()
    {
        // Implement logic to generate the Plot Status Report
        // ...
        $data = Plot::select('project_id', 'id', 'plot_no', 'status')
            ->with('project')
            ->paginate(100);


        $data->transform(function ($plot) {
            $plot->project_name = $plot->project->name;
            return $plot;
        });


        $ignore = ['id', 'project_id'];
        $headers = $this->getHeader($data, $ignore);
        return response()->json(['data' => $data, 'headers' => $headers]);
    }

    // Define other report methods here...

    /**
     * Display the Sales Report.
     */
    public function salesReport()
    {
        // Implement logic to generate the Sales Report
        // ...
        $data = Sale::select('id', 'client_id', 'plot_id', 'created_at', 'amount')
            ->with('client', 'plot')
            ->paginate(100);
        $data->transform(function($sale) {
            $sale->client_name = $sale->client->name;
            $sale->plot_no = $sale->plot->plot_no;

            return $sale;
        });
        $ignore = ['id', 'client_id', 'plot_id'];
        $headers = $this->getHeader($data, $ignore);
        return response()->json(['data' => $data, 'headers' => $headers]);
    }

    /**
     * Display the Payment Report.
     */
    public function paymentReport()
    {
        // Implement logic to generate the Payment Report
        // ...
        $data = Payment::select('id', 'invoice_id', 'date', 'amount', 'payment_method')
            ->with(['invoice' => function ($query) {
                $query->select('id', 'client_id', 'amount', 'due_date')
                    ->with('client:id,name');
            }])
            ->paginate(100);



        $ignore = [];
        $headers = $this->getHeader($data, $ignore);
        return response()->json(['data' => $data, 'headers' => $headers]);
    }


    public function generateLeadStatusReport(Request $request)
    {

        // $date = [
        //     $request->start_date,
        //     $request->end_date
        // ];
        // $data = Lead::select(
        //     'status',
        //     DB::raw('COUNT(*) as count')
        // )
        //     ->groupBy('status')
        //     ->paginate(100);



        // $headers = $this->getHeader($data, $ignore);
        // return response()->json(['data' => $data, 'headers' => $headers]);
    }
}
