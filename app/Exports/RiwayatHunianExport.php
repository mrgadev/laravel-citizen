<?php

namespace App\Exports;

use App\Models\RiwayatHunian;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RiwayatHunianExport implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $histories = RiwayatHunian::orderBy('id', 'ASC')->get();
        return view('pages.dashboard.riwayat_hunian.table',['histories' => $histories]);
    }
}
