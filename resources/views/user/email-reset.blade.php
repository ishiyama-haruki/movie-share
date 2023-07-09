<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>
    <div>
        @if (session('flash_message'))
            <div class="text-blue-600 text-center mt-5">
                {{ session('flash_message') }}
            </div>
        @endif
        @if ($errors->any())
            <ul class="mt-5">
                @foreach ($errors->all() as $error)
                    <li class="text-red-600 text-center">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="md:w-1/2 w-full mx-auto mt-5 p-5 bg-white border border-gray-200 shadow ">
        <form action="{{ route('emailUpdate', ['id' => Auth::id()]) }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">新しいメールアドレス</label>
                <input type="email" name="email" required value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">更新</button>
            </div>
            
        </form>
    </div>

</x-app-layout>