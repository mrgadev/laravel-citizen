<?php

namespace App\Charts;

use App\Models\Warga;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WargaAgamaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $wargaGender = Warga::all();
        $data = [
            $wargaGender->where('agama', 'Islam')->count(),
            $wargaGender->where('agama', 'Katolik')->count(),
            $wargaGender->where('agama', 'Hindu')->count(),
            $wargaGender->where('agama', 'Buddha')->count(),
            $wargaGender->where('agama', 'Konghuchu')->count(),
            $wargaGender->where('agama', 'Protestan')->count()
        ];
        $label = [
            'Islam ('.$wargaGender->where('agama', 'Islam')->count().' orang)',
            'Katolik ('.$wargaGender->where('agama', 'Katolik')->count().' orang)',
            'Hindu ('.$wargaGender->where('agama', 'Hindu')->count().' orang)',
            'Buddha ('.$wargaGender->where('agama', 'Buddha')->count().' orang)',
            'Konghuchu ('.$wargaGender->where('agama', 'Konghuchu')->count().' orang)',
            'Protestan ('.$wargaGender->where('agama', 'Protestan')->count().' orang)',
        ];
        // dd($wargaGender);
        return $this->chart->donutChart()
            ->addData($data)
            ->setLabels($label);
    }
}
