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
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="alert alert-danger text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Auth::id() == $user->id)
            <form action="{{ route('profileUpdate', ['id' => $user->id]) }}" method="post" class="mb-5 ml-3">
                {{ csrf_field() }}
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                    </svg>
                    <input type="text" name="name" value="{{ $user->name }}" class="ml-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex items-end">
                    <textarea name="comment" id="" cols="40" rows="3" value="{{ $user->comment }}" class="block p-2.5 w-1/2 mr-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $user->comment }}</textarea>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">更新</button>
                </div>
            </form>
        @else
            <div class="mb-5 ml-3">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                    </svg>
                    <h2 class="font-bold text-2xl">{{ $user->name }}</h2>    
                </div>
                <div class="flex items-end">
                    <p>{{ $user->comment }}</p>        
                </div>
            </div>
        @endif

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