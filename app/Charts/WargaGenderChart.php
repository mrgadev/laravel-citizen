<?php

namespace App\Charts;

use App\Models\Warga;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WargaGenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $wargaGender = Warga::all();
        $data = [
            $wargaGender->where('gender', 'Laki-Laki')->count(),
            $wargaGender->where('gender', 'Perempuan')->count()
        ];
        $label = [
            'Laki-Laki ('.$wargaGender->where('gender', 'Laki-Laki')->count().' orang)',
            'Perempuan ('.$wargaGender->where('gender', 'Perempuan')->count().' orang)',
        ];
        // dd($wargaGender);
        return $this->chart->pieChart()
            ->addData($data)
            ->setLabels($label);
    }
}
