<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportWarga implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $wargas = Warga::orderBy('nama', 'ASC')->get();
        return view('pages.dashboard.warga.table',['wargas' => $wargas]);
    }
}
