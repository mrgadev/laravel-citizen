<?php

namespace App\Charts;

use App\Models\Warga;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WargaKawinChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $wargaKawin = Warga::all();
        $data = [
            $wargaKawin->where('status_kawin', 'Sudah')->count(),
            $wargaKawin->where('status_kawin', 'Belum')->count()
        ];
        $label = [
            'Sudah ('.$wargaKawin->where('status_kawin', 'Sudah')->count().' orang) ',
            'Belum ('.$wargaKawin->where('status_kawin', 'Belum')->count().' orang) ',

        ];
        // dd($wargaGender);
        // return $this->chart->lineChart()
        //     ->addData($data)
        //     ->setLabels($label);
        return $this->chart->donutChart()
            ->addData($data)
            ->setLabels($label);
    }
}
