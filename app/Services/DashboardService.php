<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardService
{

    // Get the total number of sales
    public function getTotalSales()
    {
        $totalSales = Sale::count();
        return $totalSales;
    }

    // Get the total number of sales
    public function getTodayDelivery()
    {
        $totalSales = Sale::where('delivery_status', 'Delivered')->whereDate('delivered_at', now())->count();
        return $totalSales;
    }
    // Get the total number of sales
    public function getTodayReturns()
    {
        $totalSales = Sale::where('delivery_status', 'Returned')->whereDate('returned_at', now())->count();
        return $totalSales;
    }
    // Get the total number of sales
    public function getTodayDispatches()
    {
        $totalSales = Sale::where('delivery_status', 'Dispatched')->whereDate('dispatched_at', now())->count();
        return $totalSales;
    }

    // Get the total revenue (assuming amount is stored in a 'sales' table column)
    public function getTotalRevenue()
    {
        $totalRevenue = Sale::sum('shipping_charges');
        return $totalRevenue;
    }

    // Get the average delivery time (assuming 'delivery_date' is when the order was placed and 'delivered_at' is the actual delivery time)
    public function getAverageDeliveryTime()
    {
        $averageDeliveryTime = Sale::whereNotNull('delivered_at')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, delivery_date, delivered_at)) as average_time'))
            ->value('average_time');

        return $averageDeliveryTime;
    }

    // Get the number of active drivers
    public function getActiveDriversCount()
    {
        $activeDriversCount = Driver::where('active', 1)->count();
        return $activeDriversCount;
    }

    // Get the total distance covered by all deliveries
    public function getTotalDistanceCovered()
    {
        $totalDistance = Sale::sum('distance');
        return $totalDistance;
    }






    public function getSalesOverTimeData()
    {
        $salesData = Sale::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('month')
            ->get();

        $labels = $salesData->pluck('month');
        $counts = $salesData->pluck('count');

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Sales Over Time',
                    'data' => $counts,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ]
            ]
        ];
    }
    public function getDelayedOrders()
    {
        $activeDrivers = Sale::where('delivery_delayed', true)->count();

        return $activeDrivers;
    }
    public function getOntimeOrders()
    {
        $activeDrivers = Sale::where('delivery_delayed', false)->count();

        return $activeDrivers;
    }

    public function getTotalDistanceCoveredData()
    {
        $totalDistance = Sale::sum('distance');

        return [
            'totalDistance' => $totalDistance
        ];
    }




    // Charts
    public function getSalesByCategoryData()
    {
        $salesByCategory = Sale::select('category', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();

        return [
            'labels' => $salesByCategory->pluck('category'),
            'datasets' => [
                [
                    'label' => 'Sales by Category',
                    'data' => $salesByCategory->pluck('count'),
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                    'borderWidth' => 1
                ]
            ]
        ];
    }
    public function getDeliveriesByStatusData()
    {
        $deliveriesByStatus = Sale::select('delivery_status', DB::raw('COUNT(*) as count'))
            ->groupBy('delivery_status')
            ->get();

        $labels = $deliveriesByStatus->pluck('delivery_status');
        $counts = $deliveriesByStatus->pluck('count');

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Deliveries by Status',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#E7E9ED', '#4BC0C0'
                    ],
                    'hoverOffset' => 4
                ]
            ]
        ];
    }
    public function getRevenueOverTimeData()
    {
        $revenueData = Sale::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(amount) as total')
        )
            ->groupBy('month')
            ->get();

        return [
            'labels' => $revenueData->pluck('month'),
            'datasets' => [
                [
                    'label' => 'Revenue Over Time',
                    'data' => $revenueData->pluck('total'),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    public function getProfitMarginOverTimeData()
    {
        $profitData = Sale::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('(SUM(amount) - SUM(shipping_charges)) / SUM(amount) * 100 as profit_margin')
        )
            ->whereNotNull('shipping_charges')
            ->groupBy('month')
            ->get();

        return [
            'labels' => $profitData->pluck('month'),
            'datasets' => [
                [
                    'label' => 'Profit Margin (%)',
                    'data' => $profitData->pluck('profit_margin'),
                    'backgroundColor' => 'rgba(255, 206, 86, 0.2)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }
    public function getDriverPerformanceData()
    {
        $driverPerformance = Sale::select('drivers.name', DB::raw('COUNT(sales.id) as delivery_count'))
            ->join('drivers', 'sales.driver_id', '=', 'drivers.id')
            ->groupBy('drivers.name')
            ->orderBy('delivery_count', 'desc')
            ->get();

        return [
            'labels' => $driverPerformance->pluck('name'),
            'datasets' => [
                [
                    'label' => 'Deliveries Completed',
                    'data' => $driverPerformance->pluck('delivery_count'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    public function getMonthlySalesData() {
        // Get the current year. You might want to make this dynamic based on user input or other criteria.
        $currentYear = now()->year;

        $monthlySalesData = Sale::select(
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('COUNT(*) as total_sales')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        $labels = $monthlySalesData->pluck('month')->toArray();
        $sales = $monthlySalesData->pluck('total_sales')->toArray();

        // Format for the chart
        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Monthly Sales',
                    'data' => $sales,
                    'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
                    'borderColor' => 'rgba(0, 123, 255, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];

        return $data;
    }

    // tables
    // Get sales grouped by delivery status
    public function getSalesByDeliveryStatus()
    {
        $salesByDeliveryStatus = Sale::select('delivery_status', DB::raw('COUNT(*) as count'))
            ->groupBy('delivery_status')
            ->get();

        return $salesByDeliveryStatus;
    }

    // Get delivery status counts for the dashboard
    public function getDeliveryStatusCounts()
    {
        $deliveredCount = Sale::where('delivery_status', 'Delivered')->count();
        $pendingCount = Sale::where('delivery_status', 'Pending')->count();
        $cancelledCount = Sale::where('delivery_status', 'Cancelled')->count();
        $returnedCount = Sale::where('delivery_status', 'Returned')->count();

        return [
            'Delivered' => $deliveredCount,
            'Pending' => $pendingCount,
            'Cancelled' => $cancelledCount,
            'Returned' => $returnedCount,
        ];
    }

    // Get sales grouped by date for a line chart
    public function getSalesOverTime()
    {
        $salesOverTime = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->take(7)
            ->latest()
            ->get();

        return $salesOverTime;
    }

}
