<?php

namespace App\Exports;

use App\Models\Mountaineering;
use Maatwebsite\Excel\Concerns\FromCollection;

class MountaineeringExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mountaineering::all();
    }
}
