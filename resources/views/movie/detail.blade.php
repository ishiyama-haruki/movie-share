<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画詳細') }}
        </h2>
    </x-slot>
    @if (session('flash_message'))
        <div class="text-blue-600 text-center my-5">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="w-3/4 mx-auto mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movie->img_path }}" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $movie->title }}</h5>
            <div class="w-1/3 px-1">
                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">公開日</label>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movie->release_date }}</p>
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movie->overview }}</p>       
            <div class="flex justify-end mt-2">
                @if ($interestId)
                    <a href="{{ route('removeInterest', ['id' => $interestId]) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">気になるから外す</a>
                @else
                    <a href="{{ route('storeInterest', ['id' => $movie->id]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">気になる</a>
                @endif
            </div> 
        </div>
    </div>
    <table class="mt-5 mx-auto w-3/4 text-left text-gray-500 dark:text-gray-400">
        <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="leading-10">ユーザー</th>
                <th scope="col" class="text-center leading-10">評価</th>
                <th scope="col" class="leading-10">視聴日</th>
                <th scope="col" class="leading-10">感想</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movie->movieHistories()->get() as $movieHistory)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="leading-10"><a href="{{ route('profile', ['id' => $movieHistory->user->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movieHistory->user->name }}</a></td>
                <td class="text-center leading-10">{{ $movieHistory->evaluation }}/5</td>
                <td class="leading-10">{{ $movieHistory->viewing_date }}</td>
                <td class="leading-10">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>