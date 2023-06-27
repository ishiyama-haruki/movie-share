<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画一覧') }}
        </h2>
    </x-slot>
    <form action="{{ route('movieSearch') }}" method="get" class="w-1/2 mt-5 mx-auto flex items-center">
        <input type="text" name="title" class="w-1/2 mr-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="映画タイトル">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">検索</button>
    </form>
    <div class="w-3/4 mx-auto my-5 p-5 bg-white">
        @if (session('flash_message'))
            <div class="mb-5 text-blue-600 text-center">
                {{ session('flash_message') }}
            </div>
        @endif
        @if (count($movies) == 0)
            <div class="mb-5 text-lg font-medium text-gray-900 dark:text-white text-center">
                お目当ての映画は存在しませんでした。ぜひ登録してくれよな！
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
                        <td class="algin-middle text-center">{{ $movie->movieHistories()->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>