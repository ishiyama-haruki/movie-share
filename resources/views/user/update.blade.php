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
        <form action="{{ route('profileUpdate', ['id' => Auth::id()]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ Auth::id() }}">
            {{ csrf_field() }}
            <div class="mb-6 md:w-1/2 w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">ユーザー名</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-6 md:w-1/2 w-full">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">メールアドレス</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <span class="text-xs">メールアドレスはパスワードリセットの際に必要になります。<br>必ず実在するメールアドレスを設定してください。</span>
            </div>
            <div class="mb-6 md:w-1/2 w-full">
                <label for="img_path" class="block mb-2 text-sm font-medium text-gray-900">プロフィール画像</label>
                <div class="flex items-center justify-center">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="image" class="hidden" />
                    </label>
                </div> 
            </div>
            <div class="mb-6">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">自己紹介</label>
                <textarea name="comment" value="{{ Auth::user()->comment }}" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ Auth::user()->comment }}</textarea>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="block font-medium md:text-sm text-xs md:text-base text-blue-600 underline hover:no-underline">マイページへ</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm md:w-auto w-1/3 sm:w-auto px-5 py-2.5 text-center">更新</button>
            </div>
            
        </form>
    </div>

</x-app-layout>