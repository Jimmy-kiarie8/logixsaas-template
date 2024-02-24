<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadImport implements ToModel, WithHeadingRow
{
    private $importedData = [];

    public function model(array $row)
    {
        // Create a new instance of your model and map the columns
        $data = [
            'phone' => $row['phone'],
            'name' => $row['name'],
            'email' => $row['email'],
            'address' => $row['address'],
            'city' => $row['city'],
            'notes' => $row['notes'],
            'status' => $row['status'],
        ];

        // Store the data
        $this->importedData[] = $data;

        // Create a new instance of your model and return it
        return new Lead($data);
    }

    public function getImportedData()
    {
        return $this->importedData;
    }
}
