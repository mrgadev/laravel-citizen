<?php

namespace App\Exports;

use App\Models\Satpam;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SatpamExport implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $satpams = Satpam::orderBy('id', 'ASC')->get();
        return view('pages.dashboard.satpam.table',['satpams' => $satpams]);
    }
}
