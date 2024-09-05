<?php

namespace App\Charts;

use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\RiwayatHunian;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WargaHunianChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $hunian = Keluarga::all();
        
        $data = [
            $hunian->where('status', 'Sewa')->count(),
            $hunian->where('status', 'Beli')->count(),
        ];
        $label = [
            'Sewa ('.$hunian->where('status', 'Sewa')->count().' orang)',
            'Beli ('.$hunian->where('status', 'Beli')->count().' orang)',
        ];
        // dd($wargaGender);
        return $this->chart->donutChart()
            ->addData($data)
            ->setLabels($label);
        
    }
}
