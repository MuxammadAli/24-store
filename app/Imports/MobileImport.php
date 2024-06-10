<?php


namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class MobileImport implements ToModel
{
    public function model(array $row)
    {
        return $row;
    }
}
