<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>
    <div class="w-3/4 mx-auto my-10 p-5 bg-white">
        @if (session('flash_message'))
            <div class="text-blue-600 text-center">
                {{ session('flash_message') }}
            </div>
        @endif
        <h2 class="text-center mb-5 h2">{{ $user->name }}</h2>
        <div class="card bg-white">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">視聴履歴</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">気になるリスト</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">タイトル</th>
                            <!-- <th scope="col">視聴日</th> -->
                            <th scope="col" class="text-center">評価</th>
                            <!-- <th scope="col">場所</th> -->
                            <!-- <th scope="col" class="text-center">視聴回数</th> -->
                            <th scope="col">感想</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movieHistories as $movieHistory)
                        <tr>
                            <td><img class="object-cover w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                            <td class="align-middle">{{ $movieHistory->movie->title }}</td>
                            <!-- <td class="align-middle">{{ $movieHistory->viewing_date }}</td> -->
                            <td class="align-middle text-center">{{ $movieHistory->evaluation }}/5</td>
                            <!-- <td class="align-middle">{{ $movieHistory->place }}</td> -->
                            <!-- <td class="align-middle text-center">{{ $movieHistory->viewing_count }}回</td> -->
                            <td class="align-middle">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
                            <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">詳細</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>