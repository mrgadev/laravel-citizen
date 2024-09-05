<?php

namespace App\Exports;

use App\Models\Hunian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportHousings implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $housings = Hunian::orderBy('id', 'ASC')->get();
        return view('pages.dashboard.hunian.table',['housings' => $housings]);
    }
}
