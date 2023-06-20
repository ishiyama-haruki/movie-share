<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画詳細') }}
        </h2>
    </x-slot>
    <div class="w-3/4 mx-auto mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movie->img_path }}" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $movie->title }}</h5>
            <div class="w-1/3 px-1">
                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">公開日</label>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movie->release_date }}</p>
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movie->overview }}</p>        
        </div>
    </div>
    <table class="table w-3/4 mx-auto mt-4">
        <thead>
            <tr>
                <th scope="col">ユーザー</th>
                <th scope="col" class="text-center">評価</th>
                <th scope="col">視聴日</th>
                <th scope="col">感想</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movie->movieHistories()->get() as $movieHistory)
            <tr>
                <td class=""><a href="{{ route('profile', ['id' => $movieHistory->user->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movieHistory->user->name }}</a></td>
                <td class="">{{ $movieHistory->evaluation }}/5</td>
                <td class="">{{ $movieHistory->viewing_date }}</td>
                <td class="">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>