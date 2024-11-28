<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit User List</title>
</head>
<body>
<!-- ========== HEADER ========== -->
<header>
    <nav class="font-sans flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-gray-100 shadow sm:items-baseline w-full">
    <div class="flex items-center justify-center">
        <a href="javascript:history.back()">
          <img src="{{ asset('../../img/Logo2.png') }}" alt="Logo" class="block h-10 w-auto">
      </a>
    </div>
    </nav>
  </header>
<!-- ========== END HEADER ========== -->

<div class ="md:container md:mx-auto px-20 pt-5 pb-5 bg-neutral-700 rounded-lg mt-4">
    <div class="grid-rows-5">
        <div class="border-b-2 border-neutral-100 px-3 py-2 dark:border-white/20">
            <h2 class="mb-2 text-xl text-white font-medium leading-tight">Edit user</h2>
        </div>
        <form enctype="multipart/form-data" action="{{route('admin.updateuser',$user->id)}}" method="post">
            @method('put')
            @csrf
            <div class="mb-6 mt-3">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" value="{{ old('name', $user->name) }}" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('name')
                <p class="text-white">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="text" value="{{ old('email',$user->email) }}" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('email')
                <p class="text-white">{{$message}}</p>
                @enderror
            </div>

            <div>
                <button type="button" value="Submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><input type="submit" value="Update"></button>
            </div>
        </form>
    </div>
    
</div>
@include('footer')
</body>
</html>