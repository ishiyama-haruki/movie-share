<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画一覧') }}
        </h2>
    </x-slot>
    <div class="w-3/4 mx-auto my-10 p-5 bg-white">
        @if (session('flash_message'))
            <div class="text-blue-600 text-center">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="card bg-white">
            <table class="w-full text-left text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="leading-10"></th>
                        <th scope="col" class="leading-10">タイトル</th>
                        <th scope="col" class="leading-10">公開日</th>
                        <th scope="col" class="leading-10">概要</th>
                        <th scope="col" class="leading-10">履歴数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td><img class="object-cover w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movie->img_path }}" alt=""></td>
                        <td class="align-middle"><a href="{{ route('movieDetail', ['id' => $movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movie->title }}</a></td>
                        <td class="align-middle">{{ $movie->release_date }}</td>
                        <td class="align-middle">{{ Str::limit($movie->overview, 40, '...') }}</td>
                        <td class="algin-middle">{{ $movie->movieHistories()->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>