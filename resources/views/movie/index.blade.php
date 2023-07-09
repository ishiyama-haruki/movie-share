<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画一覧') }}
        </h2>
    </x-slot>
    <div class="flex justify-center">
        <form action="{{ route('movieSearch') }}" method="get" class="md:w-1/3 w-3/4 mt-5 mx-auto flex items-center">
            <input type="text" name="title" class="md:w-1/2 w-2/3 md:mr-5 mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="映画タイトル">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">検索</button>
        </form>
    </div>
    <h3 class="text-center md:text-3xl text-2xl font-extrabold mt-10 mb-3">現在の登録動画数：{{ count($movies) }}</h3>
    <div class="md:w-3/4 w-full mx-auto my-5 md:p-5 bg-white overflow-y-auto max-h-272">
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
                <thead class="text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-500">
                    <tr>
                        <th scope="col" class="leading-10"></th>
                        <th scope="col" class="leading-10">タイトル</th>
                        <th scope="col" class="leading-10">評価</th>
                        <th scope="col" class="leading-10  md:table-cell hidden">公開日</th>
                        <th scope="col" class="leading-10  md:table-cell hidden">概要</th>
                        <th scope="col" class="leading-10">履歴数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @if ($movie->img_path)
                            <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movie->img_path }}" alt=""></td>
                        @else
                            <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                        @endif
                        <td class="align-middle pl-1 md:w-auto w-3/5"><a href="{{ route('movieDetail', ['id' => $movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movie->title }}</a></td>
                        <td class="align-middle text-center md:table-cell hidden">
                            <x-evaluation evaluation="{{ $movie->movieHistories->avg('evaluation') }}" />
                        </td>
                        <td class="md:hidden align-middle">
                            {{ ceil($movie->movieHistories->avg('evaluation')) }}/5
                        </td>
                        <td class="align-middle  md:table-cell hidden">{{ $movie->release_date }}</td>
                        <td class="align-middle  md:table-cell hidden">{{ Str::limit($movie->overview, 40, '...') }}</td>
                        <td class="algin-middle text-center md:w-1/12 w-auto">{{ $movie->movieHistories()->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>