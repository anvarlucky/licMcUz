<?php

namespace App\Exports;

use App\Models\Expertice;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExperticesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expertice::all();
    }
}
