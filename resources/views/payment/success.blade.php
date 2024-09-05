<x-guest-layout>
    <div class="flex flex-col gap-3 items-center justify-center">
        <img src="{{asset('images/icons8-receipt-approved-100.png')}}" alt="">
        <h1 class="text-2xl font-semibold">Terimakasih!</h1>
        <p class="text-center">Kamu telah berhasil melakukan pembayaran tagihan <b>{{strtolower($transaction->nama_tagihan)}}</b> sebesar</p>
        <p class="font-semibold text-2xl">Rp. {{number_format($transaction->jumlah_tagihan,0,',','.')}}</p>

        <div class="flex items-center gap-3">
            {{-- <a href="#" class="p-2 text-blue-600 border rounded-md border-blue-600 hover:text-white hover:bg-blue-600 transition-all">Cetak receipt</a> --}}
            <a href="{{route('dashboard-warga')}}" class="p-2 bg-blue-600 text-white rounded-md hover:bg-blue-800 transition-all">Kembali ke dasbor</a>
        </div>
    </div>
</x-guest-layout>