<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>
    <div>
        @if (session('flash_message'))
            <div class="text-blue-600 text-center mt-5">
                {{ session('flash_message') }}
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
    <div id="userDetail" class="2xl:w-3/4 md:w-4/5 w-full mx-auto mt-5 md:p-5 py-5 bg-white">
        @if (Auth::id() == $user->id)
            <form action="{{ route('profileUpdate', ['id' => $user->id]) }}" method="post" class="mb-8 md:mx-0 mx-2">
                {{ csrf_field() }}
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                    </svg>
                    <input type="text" name="name" value="{{ $user->name }}" required class="ml-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
                        <path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
                    </svg>
                    <span class="block text-xl ml-3">{{ $user->email }}</span>
                </div>
                <span class="block text-sm ml-3 mb-3">
                    ＊メールアドレスはパスワードリセットの際に必要となります。実在するメールアドレスを設定してください。<br class="md:hidden inline">
                    (<a href="{{ route('email') }}" class="text-blue-600 underline dark:text-blue-500 hover:no-underline">メールアドレス変更</a>)
                </span>
                <div class="flex items-end w-full">
                    <textarea name="comment" id="" cols="40" rows="3" value="{{ $user->comment }}" class="md:w-1/2 w-3/4 block p-2.5 mr-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $user->comment }}</textarea>
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
                    <span @click="pushTab" :class="[historyFlag ? 'text-blue-600 bg-gray-200 dark:text-blue-500':'hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300']" class="cursor-pointer inline-block p-4 rounded-t-lg active dark:bg-gray-800">視聴履歴({{count($movieHistories)}}件)</span>
                </li>
                <li class="mr-2">
                    <span @click="pushTab" :class="[interestFlag ? 'text-blue-600 bg-gray-200 dark:text-blue-500':'hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300']" class="cursor-pointer inline-block p-4 rounded-t-lg dark:hover:bg-gray-800">気になるリスト({{count($interests)}}件)</span>
                </li>
            </ul>
            </div>
            <div class="card-body overflow-y-auto max-h-272">
                <table class="w-full text-left text-gray-500 dark:text-gray-400" v-show="historyFlag">
                    <thead class="text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10">タイトル</th>
                            <th scope="col" class="leading-10">評価</th>
                            <th scope="col" class="leading-10 text-center md:table-cell hidden">視聴回数</th>
                            <th scope="col" class="leading-10 md:table-cell hidden">感想</th>
                            <th scope="col" class="leading-10"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="overflow-y-auto max-h-96">
                        @foreach ($movieHistories as $movieHistory)
                            @if (Auth::id() == $user->id) 
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    @if ($movieHistory->movie->img_path)
                                        <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                                    @else
                                        <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                                    @endif
                                    <td class="md:w-auto w-1/2 font-medium text-gray-900 whitespace-wrap dark:text-white">{{ $movieHistory->movie->title }}</td>
                                    <td class="align-middle text-center md:table-cell hidden">
                                        <x-evaluation evaluation="{{ $movieHistory->evaluation }}" />
                                    </td>
                                    <td class="md:hidden align-middle">
                                        {{ $movieHistory->evaluation }}/5
                                    </td>
                                    <td class="align-middle text-center md:table-cell hidden">{{ $movieHistory->viewing_count }}回</td>
                                    <td class="align-middle md:table-cell hidden">{{ Str::limit($movieHistory->impression, 30, '...') }}</td>
                                    <td><x-accessible accessible="{{ $movieHistory->accessible }}"></x-accessible></td>
                                    <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">履歴</a></td>
                                </tr>
                            @elseif ($movieHistory->accessible)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    @if ($movieHistory->movie->img_path)
                                        <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                                    @else
                                        <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                                    @endif
                                    <td class="md:w-auto w-1/2 font-medium text-gray-900 whitespace-wrap dark:text-white">{{ $movieHistory->movie->title }}</td>
                                    <td class="align-middle text-center">
                                        <x-evaluation evaluation="{{ $movieHistory->evaluation }}" />
                                    </td>
                                    <td class="md:hidden align-middle">
                                        {{ $movieHistory->evaluation }}/5
                                    </td>
                                    <td class="align-middle text-center md:table-cell hidden">{{ $movieHistory->viewing_count }}回</td>
                                    <td class="align-middle md:table-cell hidden">{{ Str::limit($movieHistory->impression, 30, '...') }}</td>
                                    <td></td>
                                    <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">履歴</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <table class="w-full text-left text-gray-500 dark:text-gray-400" v-show="interestFlag">
                    <thead class="text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10">タイトル</th>
                            <th scope="col" class="leading-10">評価</th>
                            <th scope="col" class="leading-10 text-center md:table-cell hidden">公開日</th>
                            <th scope="col" class="leading-10 md:table-cell hidden">概要</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="overflow-y-auto max-h-96">
                        @foreach ($interests as $interest)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            @if ($interest->movie->img_path)
                                <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{  $interest->movie->img_path }}" alt=""></td>
                            @else
                                <td><img class="object-contain w-full rounded h-24 md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                            @endif
                            <td class="md:w-auto w-1/2 font-medium text-gray-900 whitespace-wrap dark:text-white">{{ $interest->movie->title }}</td>
                            <td class="align-middle text-center md:table-cell hidden">
                                <x-evaluation evaluation="{{ $interest->movie->movieHistories->avg('evaluation') }}" />
                            </td>
                            <td class="md:hidden align-middle">
                                {{ $interest->movie->movieHistories->avg('evaluation') }}/5
                            </td>
                            <td class="align-middle text-center md:table-cell hidden">{{ $interest->movie->release_date }}</td>
                            <td class="align-middle md:table-cell hidden">{{ Str::limit($interest->movie->overview, 30, '...') }}</td>
                            <td><a href="{{ route('movieDetail', ['id' => $interest->movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">映画情報</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>