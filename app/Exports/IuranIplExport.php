<?php

namespace App\Exports;

use App\Models\IuranIpl;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class IuranIplExport implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $bills = IuranIpl::orderBy('id', 'DESC')->get();
        return view('pages.dashboard.iuran_ipl.table',['bills' => $bills]);
    }
}
