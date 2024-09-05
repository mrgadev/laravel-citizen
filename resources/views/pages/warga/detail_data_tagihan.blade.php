<x-warga-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard-warga')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="{{route('dashboard-warga.dataTagihan')}}" class=" flex items-center gap-1"><i class="bi bi-receipt-cutoff"></i> Data IPL</a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">info</span> Detail</a>
            </div>
            <a href="{{route('dashboard-warga.export.dataTagihan', $iuranIpl->id)}}" class="px-3 py-2 bg-blue-500 text-white transition-all hover:bg-blue-700 rounded-lg"><i class="bi bi-file-earmark-pdf"></i> Unduh ke PDF</a>
        </div>
        
        <div class="bg-white  rounded-xl shadow-xl p-3">
            <h1 class="mb-5 font-semibold text-2xl">Detail Tagihan</h1>
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <p>{{date('j F Y', strtotime($iuranIpl->created_at))}}</p>
                        <p>{{$iuranIpl->invoice}}</p>
                    </div>
                    <div class="flex flex-col gap-2 w-3/4">
                        <p>{{$iuranIpl->warga->nama}}</p>
                        <p>{{$iuranIpl->warga->alamat}}</p>
                        <p>{{$iuranIpl->warga->telepon}}</p>
                    </div>
                </div>

                @if($iuranIpl->status == 'Lunas')
                <p class="text-2xl font-semibold bg-green-50 border-2 border-green-700 px-3 py-2 rounded-lg text-green-700">{{$iuranIpl->status}}</p>
                @elseif($iuranIpl->status == 'Tertunggak')
                <p class="text-2xl font-semibold bg-yellow-50 border-2 border-yellow-700 px-3 py-2 rounded-lg text-yellow-700">{{$iuranIpl->status}}</p>
                @endif
            </div>
            <hr class="my-10">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="py-2">Nama</th>
                        <th>Jenis</th>
                        <th>Periode</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Iuran IPL</td>
                        <td>{{$iuranIpl->nama_tagihan}}</td>
                        <td>{{$iuranIpl->bulan}} {{$iuranIpl->tahun}}</td>
                        <td>{{date('j F Y', strtotime($iuranIpl->tgl_pembayaran))}}</td>
                        <td>Rp. {{number_format($iuranIpl->jumlah_tagihan,0,',','.')}}</td>
                    </tr>
                </tbody>
            </table>
            <hr class="my-10 border-2 border-slate-800">
            <div class="flex flex-col gap-1">
                <p>Total Tagihan</p>
                <p class="font-semibold text-2xl">Rp. {{number_format($iuranIpl->jumlah_tagihan,0,',','.')}}</p>
            </div>
        </div>
        
    </div>
    @push('addons-script')
        <script>
            const actionToggle = document.querySelector('.toggle-action');
            const actionBody = document.querySelector('.action-body');
            actionToggle.addEventListener('click', function() {
                actionBody.classList.toggle('hidden');
            });
        </script>
    @endpush
</x-warga-layout>