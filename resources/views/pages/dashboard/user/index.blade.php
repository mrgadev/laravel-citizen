<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <div class="mb-4 flex gap-1 sm:mb-0">
                <a href="{{route('dashboard')}}" class=""><span class="material-symbols-rounded">home</span></a>
                <span class="material-symbols-rounded">chevron_right</span>
                <a href="#" class=" flex items-center gap-1 text-blue-600"><span class="material-symbols-rounded">account_circle</span> Data User</a>
            </div>

        </div>
        
        
        <div class="col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <header class="p-4 border-b border-gray-100 dark:border-gray-700/60 flex flex-col gap-2 md:flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Data User</h2>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                    {{-- Filter toggle --}}
                    <a class="bg-blue-500 px-3 py-2 rounded cursor-pointer  text-white transition-all hover:bg-blue-700" title="Filter data" id="showFilter"><i class="bi bi-funnel"></i></a>
                    {{-- Filter modal --}}
                    <div class="inset-0 z-50 bg-gray-500 bg-opacity-75 fixed hidden flex flex-col items-center justify-center min-h-screen w-screen" id="modalFilter">
                        <form  class="transition-all  bg-white rounded-xl shadow-lg p-3 mb-3">
                            <h3 class="font-semibold text-xl mb-3">Filter Data</h3>
                            <div class="flex flex-col gap-3">
                                <div class="flex flex-col gap-2">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="w-full rounded-md border-1 border-gray-4">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" name="email" id="email" class="w-full rounded-md border-1 border-gray-4">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="w-full rounded-md border-1 border-gray-4">
                                        <option value="">--Pilih Role--</option>
                                        <option value="Warga">Warga</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Satpam">Satpam</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="flex gap-2 mt-3">
                                <button class="border-2 border-red-500 text-red-500 px-3 py-2 rounded-lg transition-all hover:bg-red-500 hover:text-white" id="closeFilter">Batal</button>
                                <button type="submit" id="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg transition-all hover:bg-blue-700">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('user.create')}}" class="bg-blue-500 hover:bg-blue-700 transition-all text-white px-3 py-2 rounded flex items-center gap-1"><i class="bi bi-file-earmark-plus"></i> Data baru</a>
                    <a href="{{route('user.export.excel')}}" class="bg-green-700 text-white transition-all px-3 py-2 rounded "><i class="bi bi-file-earmark-spreadsheet"></i> Export as Excel</a> 
                </div>
            </header>
            <div class="p-3">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class=" w-full dark:text-gray-300" id="userTable">
                        <!-- Table header -->
                        <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">No</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nama</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Nomor Telepon</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Email</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold">Role</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
                            {{-- <!-- Row -->
                            @forelse ($users as $key => $user)    
                            <tr class="py-4 w-full">
                                <td class="p-2">
                                    {{$users->firstItem() + $key}}
                                    
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{$user->name}}</p>
                                </td>

                                <td class="p-2 text-center">
                                    <p>{{$user->email}}</p>
                                </td>
                                <td class="p-2 text-center">
                                    <p>{{ucfirst($user->role)}}</p>
                                </td>
                                <td class="p-2">
                                    <div class="text-center flex items-center gap-3">
                                        <a href="{{route('user.edit', $user->id)}}" class="flex items-center gap-1 border bg-blue-500 text-white hover:bg-blue-700 transition-all px-3 py-1 rounded"><span class="material-symbols-rounded text-base">edit</span> Edit</a>
                                        <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center gap-1 bg-red-500 text-white hover:bg-red-700 transition-all px-3 py-1 rounded" onclick="confirm('Apakah kamu ingin mneghapus data ini?') ? setAttribute('type', 'submit') : setAttribute('type', 'button')">
                                                <span class="material-symbols-rounded text-base">delete</span> Hapus
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <p class="bg-red-100 w-full text-red-700 font-semibold p-2 text-center">Tidak ada data!</p>
                            </tr>
                            @endforelse --}}
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('addons-script')
        <script>
            let showFilter = document.querySelector('#showFilter');
            let closeFilter = document.querySelector('#closeFilter');
            let modalFilter = document.querySelector('#modalFilter');
            let body = document.querySelectorAll('body');

            showFilter.addEventListener('click', function() {
                body.style = "backdrop-filter: blur(10px);";
                modalFilter.classList.remove('hidden');
                modalFilter.classList.add('block');
            });
            submit.addEventListener('click', function() {
                body.style = "";
                modalFilter.classList.remove('block');
                modalFilter.classList.add('hidden');
            });
        </script>
        <script>
                var dataTable = $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searchable: true,
                    ajax: {
                        url: '{{route("user.index")}}',
                    },
                    columns : [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        {data: 'name', name: 'name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'email', name: 'email'},
                        {data: 'role', name: 'role'},
                        {
                            data: 'action', 
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ]
                });
                const table = $('#userTable');
                table.on('preXhr.dt', function(e,settings,data) {
                    data.name = $('#name').val();
                    console.log(data.name);

                    data.email = $('#email').val();
                    console.log(data.email);

                    data.role = $('#role').val();
                    console.log(data.role);
                });

                $('#submit').on('click', function() {
                    table.DataTable().ajax.reload();
                    return false;
                })
        </script>
    @endpush
</x-app-layout>