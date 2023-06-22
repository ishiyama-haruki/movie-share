<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>
    <div id="userDetail" class="w-3/4 mx-auto my-10 p-5 bg-white">
        @if (session('flash_message'))
            <div class="text-blue-600 text-center">
                {{ session('flash_message') }}
            </div>
        @endif
        <h2 class="text-center mb-5 h2">{{ $user->name }}</h2>
        <div class="card bg-white">
            <div class="card-header">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <li class="mr-2">
                    <span @click="pushTab" :class="[historyFlag ? 'text-blue-600 bg-gray-100 dark:text-blue-500':'hover:text-gray-600 hover:bg-gray-50 dark:hover:text-gray-300']" class="cursor-pointer inline-block p-4 rounded-t-lg active dark:bg-gray-800">視聴履歴</span>
                </li>
                <li class="mr-2">
                    <span @click="pushTab" :class="[interestFlag ? 'text-blue-600 bg-gray-100 dark:text-blue-500':'hover:text-gray-600 hover:bg-gray-50 dark:hover:text-gray-300']" class="cursor-pointer inline-block p-4 rounded-t-lg dark:hover:bg-gray-800">気になるリスト</span>
                </li>
            </ul>
            </div>
            <div class="card-body">
                <table class="w-full text-left text-gray-500 dark:text-gray-400" v-show="historyFlag">
                    <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10">タイトル</th>
                            <th scope="col" class="leading-10" class="text-center">評価</th>
                            <th scope="col" class="leading-10" class="text-center">視聴回数</th>
                            <th scope="col" class="leading-10">感想</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movieHistories as $movieHistory)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td><img class="object-cover w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $movieHistory->movie->title }}</td>
                            <td class="align-middle text-center">{{ $movieHistory->evaluation }}/5</td>
                            <td class="align-middle text-center">{{ $movieHistory->viewing_count }}回</td>
                            <td class="align-middle">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
                            <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline text-xs">履歴詳細</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="w-full text-left text-gray-500 dark:text-gray-400" v-show="interestFlag">
                    <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10">タイトル</th>
                            <th scope="col" class="leading-10" class="text-center">公開日</th>
                            <th scope="col" class="leading-10">概要</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interests as $interest)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td><img class="object-cover w-full rounded h-24 md:h-24 md:w-auto" src="{{  $interest->movie->img_path }}" alt=""></td>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $interest->movie->title }}</td>
                            <td class="align-middle text-center">{{ $interest->movie->release_date }}</td>
                            <td class="align-middle">{{ Str::limit($interest->movie->overview, 40, '...') }}</td>
                            <td><a href="{{ route('movieDetail', ['id' => $interest->movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline text-xs">映画情報</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>