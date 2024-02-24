<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Inertia\Inertia;

class DashboardController extends Controller
{

    protected $dashboard;

    public function __construct(DashboardService $dashboard)
    {
        $this->dashboard = $dashboard;
    }




    public function index()
    {
        $getTotalSales = $this->getTotalSales();
        $getTotalRevenue = $this->getTotalRevenue();
        $getAverageDeliveryTime = $this->getAverageDeliveryTime();
        $getActiveDriversCount = $this->getActiveDriversCount();
        $getTotalDistanceCovered = $this->getTotalDistanceCovered();
        $getSalesByDeliveryStatus = $this->getSalesByDeliveryStatus();
        $getDeliveryStatusCounts = $this->getDeliveryStatusCounts();
        $getSalesOverTime = $this->getSalesOverTime();

        return Inertia::render('Dashboard/index', [
        ]);
    }


    public function analytics()
    {
        // $user = User::find(Auth::id());
        $dashboard = $this->dashboard;

        $total = $dashboard->getTotalSales();
        $data = [
            [
                'label' => 'Total Sales',
                'value' => ($dashboard->getTotalSales()),
                'icon' => 'mdi-cart',
                'iconColor' => 'success',
            ],
            [
                'label' => 'Total Revenue',
                'value' => ($dashboard->getTotalRevenue()),
                'icon' => 'mdi-cash',
                'iconColor' => 'error',
            ],
            [
                'label' => 'Average Delivery Time',
                'value' => ($dashboard->getAverageDeliveryTime()),
                'icon' => 'mdi-clock',
                'iconColor' => 'primary',
            ],
            [
                'label' => 'Active Drivers',
                'value' => ($dashboard->getActiveDriversCount()),
                'icon' => 'mdi-bike',
                'iconColor' => 'warning',
            ],
            [
                'label' => 'Delayed Orders',
                'value' => ($dashboard->getDelayedOrders()),
                'icon' => 'mdi-clock-remove',
                'iconColor' => 'red',
            ],
            [
                'label' => 'Ontime Orders',
                'value' => ($dashboard->getOntimeOrders()),
                'icon' => 'mdi-clock-check',
                'iconColor' => 'success',
            ],
            [
                'label' => 'Total Distance Covered',
                'value' => ($dashboard->getTotalDistanceCovered()),
                'icon' => 'mdi-speedometer',
                'iconColor' => 'primary',
            ],
            [
                'label' => 'Today Delivery',
                'value' => ($dashboard->getTodayDelivery()),
                'icon' => 'mdi-check-circle',
                'iconColor' => 'success',
            ],
            [
                'label' => 'Today Returns',
                'value' => ($dashboard->getTodayReturns()),
                'icon' => 'mdi-cancel',
                'iconColor' => 'red',
            ],
            [
                'label' => 'Today Dispatches',
                'value' => ($dashboard->getTodayDispatches()),
                'icon' => 'mdi-send',
                'iconColor' => 'info',
            ],


            // getTodayDelivery
            // getTodayReturns
            // getTodayDispatches
        ];

        // Tables
        $salesByDeliveryStatus = $dashboard->getSalesByDeliveryStatus();
        $deliveryStatusCounts = $dashboard->getDeliveryStatusCounts();
        $salesOverTime = $dashboard->getSalesOverTime();


        // Chats
        $deliveriesByStatusData = $dashboard->getDeliveriesByStatusData();
        $revenueOverTimeData = $dashboard->getRevenueOverTimeData();
        $profitMarginOverTimeData = $dashboard->getProfitMarginOverTimeData();
        $driverPerformanceData = $dashboard->getDriverPerformanceData();
       $monthlySalesData = $dashboard->getMonthlySalesData();

        return Inertia::render('Dashboard/index', [
            'data' => $data,
            'total' => $total,


            'deliveriesByStatusData' => $deliveriesByStatusData,
            'revenueOverTimeData' => $revenueOverTimeData,
            'profitMarginOverTimeData' => $profitMarginOverTimeData,
            'driverPerformanceData' => $driverPerformanceData,
            'monthlySalesData' => $monthlySalesData,


            'salesByDeliveryStatus' => $salesByDeliveryStatus,
            'deliveryStatusCounts' => $deliveryStatusCounts,
            'salesOverTime' => $salesOverTime,

        ]);
    }
}
