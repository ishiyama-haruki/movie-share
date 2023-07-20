<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>
    <div>
        @if (session('flash_comment'))
            <div class="text-blue-600 text-center mt-5">
                {{ session('flash_comment') }}
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
        <form action="{{ route('profileUpdate', ['id' => Auth::id()]) }}" method="POST">
            {{ csrf_field() }}
            <div class="mb-6 w-1/2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">ユーザー名</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6 w-1/2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">メールアドレス</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">自己紹介</label>
                <textarea name="comment" value="{{ Auth::user()->comment }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ Auth::user()->comment }}</textarea>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="block font-medium text-sm md:text-base text-blue-600 underline hover:no-underline">マイページへ</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">更新</button>
            </div>
            
        </form>
    </div>

</x-app-layout>