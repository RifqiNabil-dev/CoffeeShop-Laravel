<x-app-layout>
    <x-slot name="title">
        User List
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="justify-items-center text-gray-950">
        @if (Session::has('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
        @endif
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <div class="grid grid-flow-col justify-stretch">
                            <div><h2 class="mb-2 text-3xl text-dark font-medium leading-tight">List User</h2></div>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Username
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Update at
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Created at
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Image
                                        </th>
                                        <th scope="col" class="text-center px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user )
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$user-> name}}
                                        </th>
                                        <td class="text-center px-6 py-4">
                                            {{$user-> email}}
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            {{\Carbon\Carbon::parse($user->update_at)->format('H:i, d M Y')}}
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            {{\Carbon\Carbon::parse($user->created_at)->format('H:i, d M Y')}}
                                        </td>
                                        <td class="justify-items-center">
                                            @if ($user->image != "")
                                                <img width="100" src="{{asset('uploads/images/'.$user->image)}}" alt="">
                                            
                                            @endif
                                        </td>
                                        <td class="text-center px-6 py-4">
                                        <button type="button" class=" text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        <a href="{{route('admin.edituser',$user->id)}}">Edit</a>
                                        </button>
                                            
                                            <form action="{{route('admin.dltuser',$user->id)}}" method="post" onclick="confirmDelete(event, this)">
                                                @csrf
                                                <button type="button" class=" text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                <input type="submit" value="Delete">
                                                </button>
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                    
                                    @endif

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(event, button) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure delete it?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            }
    </script>
</x-app-layout>