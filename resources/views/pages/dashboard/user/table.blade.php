<h2 class="font-semibold text-2xl">Data User</h2>
<table class=" w-full dark:text-gray-300">
    <!-- Table header -->
    <thead class="text-xs uppercase text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-700 dark:bg-opacity-50 rounded-sm">
        <tr>
            <th class="p-2">
                <div class="font-semibold">No</div>
            </th>

            <th class="p-2">
                <div class="font-semibold">Nama</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Email</div>
            </th>
            <th class="p-2">
                <div class="font-semibold">Role</div>
            </th>
        </tr>
    </thead>
    <!-- Table body -->
    <tbody class="text-sm font-medium divide-y divide-gray-100 dark:divide-gray-700/60">
        <!-- Row -->
        @forelse ($users as $key => $user)    
        <tr class="py-4 w-full">
            <td class="p-2">
                {{$key + 1}}
                
            </td>
            <td class="p-2 ">
                <p>{{$user->name}}</p>
            </td>
            <td class="p-2 ">
                <p>{{$user->email}}</p>
            </td>
            <td class="p-2 ">
                <p>{{$user->email}}</p>
            </td>
            <td class="p-2 ">
                <p>{{ucfirst($user->role)}}</p>
            </td>

        </tr>
        @empty
        <tr>
            Tidak ada data!
        </tr>
        @endforelse
        
    </tbody>
</table>