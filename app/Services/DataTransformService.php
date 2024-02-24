<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Driver;
use App\Models\DriverGroup;
use App\Models\Sale;

class DataTransformService
{

    public function data_transform($jsonFile)
    {

        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $jsonData = json_decode($jsonContents, true);

            $fetchClients = false;
            $fetchSales = false;
            $fetchDriverGroup = false;
            $fetchDriver = false;

            // Check if client_id or sale_id is present in the JSON data
            foreach ($jsonData as $item) {
                if ($item['type'] == 'select') {
                    if ($item['model'] == 'client_id') {
                        $fetchClients = true;
                    } elseif ($item['model'] == 'sale_id') {
                        $fetchSales = true;
                    } elseif ($item['model'] == 'driver_group_id') {
                        $fetchDriverGroup = true;
                    } elseif ($item['model'] == 'driver_id') {
                        $fetchDriver = true;
                    }
                }
            }

            // Fetch data conditionally
            if ($fetchClients) {
                $clients = Client::select('id', 'name')->take(100)->get();
            }
            if ($fetchSales) {
                $sales = Sale::select('id', 'order_no')->take(100)->get();
            }
            if ($fetchDriverGroup) {
                $driverGroup = DriverGroup::select('id', 'name')->take(100)->get();
            }
            if ($fetchDriver) {
                $drivers = Driver::select('id', 'name')->take(100)->get();
            }


            // Rest of the logic for transformation
            foreach ($jsonData as $key => &$item) {


                if ($fetchClients && $item['type'] == 'select' && $item['model'] == 'client_id') {
                    $item['items'] = $clients;

                    foreach ($item['items'] as &$item) {
                        $item['value'] = $item['id'];
                        $item['label'] = $item['name'];
                    }
                } elseif ($fetchSales && $item['type'] == 'select' && $item['model'] == 'sale_id') {
                    $item['items'] = $sales;

                    foreach ($item['items'] as &$item) {
                        $item['value'] = $item['id'];
                        $item['label'] = $item['order_no'];
                    }
                } elseif ($fetchDriverGroup && $item['type'] == 'select' && $item['model'] == 'driver_group_id') {
                    $item['items'] = $driverGroup;

                    foreach ($item['items'] as &$item) {
                        $item['value'] = $item['id'];
                        $item['label'] = $item['name'];
                    }
                } elseif ($fetchDriver && $item['type'] == 'select' && $item['model'] == 'driver_id') {
                    $item['items'] = $drivers;

                    foreach ($item['items'] as &$item) {
                        $item['value'] = $item['id'];
                        $item['label'] = $item['name'];
                    }
                }


                // elseif ($fetchPlots && $item['type'] == 'select' && $item['model'] == 'plot_id') {
                //     $item['items'] = $plots;

                //     foreach ($item['items'] as &$item) {
                //         $item['value'] = $item['id'];
                //         $item['label'] = $item['plot_no'];
                //     }
                // }
            }
        } else {
            return response('JSON file not found', 404);
        }

        return $jsonData;
    }

    public function store($data)
    {
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
        return $dataValue;
    }

    public function data_edit_transform($jsonFile, $data)
    {
        if (file_exists($jsonFile)) {
            $jsonContents = file_get_contents($jsonFile);
            $jsonData = json_decode($jsonContents, true);

            // Fetch the client record from the database
            if (!$data) {
                return response('Client not found', 404);
            }

            // Rest of your logic...

            // Replace values with database record
            foreach ($jsonData as $key => &$item) {
                if ($item['type'] == 'text') {
                    // Check if the model corresponds to a column in the data record
                    if (isset($data->{$item['model']})) {
                        $item['value'] = $data->{$item['model']}; // Replace the value
                    }
                } elseif ($item['type'] == 'select' && $item['model'] == 'category') {
                    // The 'category' field seems to be a special case
                    // If the category is stored in the database, retrieve it like this:
                    // $item['value'] = $data->category;
                }

                // Your existing logic for 'select' type items...
            }

            return $jsonData;
        } else {
            return response('JSON file not found', 404);
        }
    }


}
