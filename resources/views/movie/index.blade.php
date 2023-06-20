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
            <div class="card-body">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">タイトル</th>
                            <th scope="col" class="text-center">公開日</th>
                            <th scope="col">概要</th>
                            <th scope="col">履歴数</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                        <tr>
                            <td><img class="object-cover w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movie->img_path }}" alt=""></td>
                            <td class="align-middle"><a href="{{ route('movieDetail', ['id' => $movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movie->title }}</a></td>
                            <td class="align-middle text-center">{{ $movie->release_date }}</td>
                            <td class="align-middle">{{ Str::limit($movie->overview, 40, '...') }}</td>
                            <td class="algin-middle">{{ $movie->movieHistories()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>