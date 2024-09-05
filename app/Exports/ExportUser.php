<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportUser implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $users = User::orderBy('name', 'DESC')->get();
        return view('pages.dashboard.user.table',['users' => $users]);
    }
}
