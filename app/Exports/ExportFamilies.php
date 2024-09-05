<?php

namespace App\Exports;

use App\Models\Warga;
use App\Models\Keluarga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportFamilies implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $families = Keluarga::orderBy('nomor_kk', 'ASC')->get();
        return view('pages.dashboard.keluarga.table',['families' => $families]);
    }
}
