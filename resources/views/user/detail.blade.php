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
        <div class="md:w-1/2 w-5/6 mx-auto flex flex-col items-center pb-10">
            @if ($user->img_path)
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset($user->img_path) }}" alt="Bonnie image"/>
            @else
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('img/movie_share_logo.png') }}" alt="">
            @endif
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->comment }}</span>
            @if (Auth::id() == $user->id)
                <div class="flex mt-4 space-x-3 md:mt-6">
                    <a href="{{ route('profileUpdateForm') }}"  class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">プロフィールの編集</a>
                </div>
            @endif
        </div>
        <div class="card bg-white">
            <div class="card-header">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                <li class="mr-2">
                    <span @click="pushTab" :class="[historyFlag ? 'text-blue-600 bg-gray-200':'hover:text-gray-600 hover:bg-gray-100']" class="cursor-pointer inline-block p-4 rounded-t-lg active">視聴履歴({{count($movieHistories)}}件)</span>
                </li>
                <li class="mr-2">
                    <span @click="pushTab" :class="[interestFlag ? 'text-blue-600 bg-gray-200':'hover:text-gray-600 hover:bg-gray-100']" class="cursor-pointer inline-block p-4 rounded-t-lg">気になるリスト({{count($interests)}}件)</span>
                </li>
            </ul>
            </div>
            <div class="card-body">
                <table class="w-full text-left text-gray-500" v-show="historyFlag">
                    <thead class="text-gray-700 bg-gray-200">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10 text-sm md:text-base">タイトル</th>
                            <th scope="col" class="leading-10 text-sm md:text-base text-center md:text-left">評価</th>
                            <th scope="col" class="leading-10 text-center md:table-cell hidden">視聴日</th>
                            <th scope="col" class="leading-10 md:table-cell hidden">感想</th>
                            <th scope="col" class="leading-10"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movieHistories as $movieHistory)
                            @if (Auth::id() == $user->id) 
                                <tr class="bg-white border-b">
                                    @if ($movieHistory->movie->img_path)
                                        <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                                    @else
                                    <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                                    @endif
                                    <td class="w-1/2 md:w-1/3 font-medium text-sm md:text-base text-gray-900 whitespace-wrap">{{ $movieHistory->movie->title }}</td>
                                    <td class="align-middle text-center md:table-cell hidden">
                                        <x-evaluation evaluation="{{ $movieHistory->evaluation }}" />
                                    </td>
                                    <td class="md:hidden align-middle text-sm text-center">
                                        {{ $movieHistory->evaluation }}/5
                                    </td>
                                    <td class="align-middle px-2 text-center md:table-cell hidden">{{ $movieHistory->viewing_date }}</td>
                                    <td class="align-middle md:table-cell hidden">{{ Str::limit($movieHistory->impression, 30, '...') }}</td>
                                    <td class="px-2"><x-accessible accessible="{{ $movieHistory->accessible }}"></x-accessible></td>
                                    <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="block font-medium text-sm md:text-base text-blue-600 underline hover:no-underline">履歴</a></td>
                                </tr>
                            @elseif ($movieHistory->accessible)
                                <tr class="bg-white border-b">
                                    @if ($movieHistory->movie->img_path)
                                        <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{  $movieHistory->movie->img_path }}" alt=""></td>
                                    @else
                                        <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                                    @endif
                                    <td class="w-1/2 md:w-1/3 text-sm md:text-base font-medium text-gray-900 whitespace-wrap">{{ $movieHistory->movie->title }}</td>
                                    <td class="align-middle text-center md:table-cell hidden">
                                        <x-evaluation evaluation="{{ $movieHistory->evaluation }}" />
                                    </td>
                                    <td class="md:hidden align-middle text-sm text-center">
                                        {{ $movieHistory->evaluation }}/5
                                    </td>
                                    <td class="align-middle px-2 text-center md:table-cell hidden">{{ $movieHistory->viewing_date }}</td>
                                    <td class="align-middle md:table-cell hidden">{{ Str::limit($movieHistory->impression, 30, '...') }}</td>
                                    <td></td>
                                    <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="block font-medium text-sm md:text-base text-blue-600 underline hover:no-underline">履歴</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <table class="w-full text-left text-gray-500" v-show="interestFlag">
                    <thead class="text-gray-700 bg-gray-200">
                        <tr>
                            <th scope="col" class="leading-10"></th>
                            <th scope="col" class="leading-10 text-sm md:text-base">タイトル</th>
                            <th scope="col" class="leading-10 text-sm md:text-base text-center md:text-left">評価</th>
                            <th scope="col" class="leading-10 text-center md:table-cell hidden">公開日</th>
                            <th scope="col" class="leading-10 md:table-cell hidden">概要</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interests as $interest)
                        <tr class="bg-white border-b">
                            @if ($interest->movie->img_path)
                                <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{  $interest->movie->img_path }}" alt=""></td>
                            @else
                                <td class="w-1/6 md:w-auto"><img class="object-contain w-full rounded h-auto md:h-24 md:w-auto" src="{{ asset('img/no_img.png') }}" alt=""></td>
                            @endif
                            <td class="md:w-auto w-1/2 text-sm md:text-base font-medium text-gray-900 whitespace-wrap">{{ $interest->movie->title }}</td>
                            <td class="align-middle text-center md:table-cell hidden">
                                <x-evaluation evaluation="{{ $interest->movie->movieHistories->avg('evaluation') }}" />
                            </td>
                            <td class="md:hidden align-middle text-sm text-center">
                                {{ $interest->movie->movieHistories->avg('evaluation') }}/5
                            </td>
                            <td class="align-middle text-center md:table-cell hidden">{{ $interest->movie->release_date }}</td>
                            <td class="align-middle md:table-cell hidden">{{ Str::limit($interest->movie->overview, 30, '...') }}</td>
                            <td><a href="{{ route('movieDetail', ['id' => $interest->movie->id]) }}" class="block font-medium text-sm md:text-base text-center text-blue-600 underline hover:no-underline">映画情報</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>