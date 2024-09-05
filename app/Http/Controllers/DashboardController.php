<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\DataFeed;
use App\Models\IuranIpl;
use App\Models\Keluarga;
use App\Models\Paguyuban;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Charts\WargaAgamaChart;
use App\Charts\WargaKawinChart;
use App\Charts\WargaGenderChart;
use App\Charts\WargaHunianChart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(WargaGenderChart $wargaGenderChart, WargaKawinChart $wargaKawinChart, WargaAgamaChart $wargaAgamaChart, WargaHunianChart $wargaHunianChart)
    {
        if(Gate::allows('Admin') || Gate::allows('Staff')) {
            $dataFeed = new DataFeed();
            $warga = Warga::all();
            $keluarga = Keluarga::all();
            $satpam = User::where('role', 'Satpam')->get();
            $paguyuban = Paguyuban::all();
            $transactions = IuranIpl::orderBy('id', 'DESC')->limit(5)->get();
            return view('pages.dashboard.dashboard', [
                'dataFeed' => $dataFeed,
                'warga' => $warga,
                'keluarga' => $keluarga,
                'satpam' => $satpam,
                'paguyuban' => $paguyuban,
                'transactions' => $transactions,
                'wargaGenderChart' => $wargaGenderChart->build(),
                'wargaKawinChart' => $wargaKawinChart->build() , 
                'wargaAgamaChart' => $wargaAgamaChart->build() , // Add this line to use the chart
                'wargaHunianChart' => $wargaHunianChart->build() // Add this line to use the chart
            ]);
        } elseif(Gate::allows('Satpam')) {
            return redirect()->route('dashboard-satpam');
        } elseif(Gate::allows('Warga')) {
            return redirect()->route('dashboard-warga');
        }
    }

    public function profile() {
        return view('pages.dashboard.profile');
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
