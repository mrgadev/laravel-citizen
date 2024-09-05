<?php

namespace App\Exports;

use App\Models\Paguyuban;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPaguyubans implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $paguyubans = Paguyuban::orderBy('id', 'ASC')->get();
        return view('pages.dashboard.paguyuban.table',['paguyubans' => $paguyubans]);
    }
}
