<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映画詳細') }}
        </h2>
    </x-slot>
    @if (session('flash_message'))
        <div class="text-blue-600 text-center my-5">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="md:w-3/4 w-full mx-auto mt-4 bg-white md:p-5 py-5">
        <div class="flex flex-col items-center border border-gray-200 rounded-lg shadow md:flex-row">
            @if ($movie->img_path)
                <img class="object-contain w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movie->img_path }}" alt="">
            @else
                <img class="object-contain w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ asset('img/no_img.png') }}" alt="">
            @endif
            <div class="flex flex-col justify-between p-4 leading-normal">
                <div class="flex items-center mb-3">
                    <h5 class="mr-5 text-2xl font-bold tracking-tight text-gray-900">{{ $movie->title }}</h5>
                    <x-evaluation evaluation="{{ $movie->movieHistories->avg('evaluation') }}" />
                </div>
                <div class="flex mb-3">
                    <div class="w-1/3 px-1">
                        <label for="" class="block text-sm font-medium text-gray-900">公開日</label>
                        <p class="font-normal text-gray-700">{{ $movie->release_date }}</p>
                    </div>
                    <div class="w-2/3 px-1">
                        <label for="" class="flex items-center text-sm font-medium text-gray-900">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path fill-rule="evenodd" d="M19.7 3.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.84c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.84A4.225 4.225 0 0 0 .3 3.038a30.148 30.148 0 0 0-.2 3.206v1.5c.01 1.071.076 2.142.2 3.206.094.712.363 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.15 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965c.124-1.064.19-2.135.2-3.206V6.243a30.672 30.672 0 0 0-.202-3.206ZM8.008 9.59V3.97l5.4 2.819-5.4 2.8Z" clip-rule="evenodd"/>
                            </svg>
                            予告URL
                        </label>
                        <a href="{{ 'https://youtube.com/watch?v=' . $movie->youtube_id }}" target="_blank" class="font-medium text-blue-600 underline hover:no-underline">{{ 'https://youtube.com/watch?v=' . $movie->youtube_id }}</a>
                    </div>
                </div>
                <p class="mb-3 font-normal text-gray-700">{{ $movie->overview }}</p>       
                <div class="flex justify-end mt-2">
                    <a href="{{ route('createByMovie', ['id' => $movie->id]) }}" class="mr-3 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">履歴登録する</a>
                    @if ($interestId)
                        <a href="{{ route('removeInterest', ['id' => $interestId]) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">気になるから外す</a>
                    @else
                        <a href="{{ route('storeInterest', ['id' => $movie->id]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">気になる</a>
                    @endif
                </div> 
            </div>
        </div>
        <div class="mt-5 border border-gray-200 rounded-lg shadow text-left text-gray-500">
            <table class="w-full">
                <thead class="text-gray-700 bg-gray-200">
                    <tr>
                        <th scope="col" class="leading-10">ユーザー</th>
                        <th scope="col" class="leading-10">評価</th>
                        <th scope="col" class="leading-10 md:table-cell hidden">視聴日</th>
                        <th scope="col" class="leading-10 md:table-cell hidden">感想</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movie->movieHistories()->get() as $movieHistory)
                        @if (Auth::id() == $movieHistory->user_id || $movieHistory->accessible)
                            <tr class="bg-white border-b">
                                <td class="leading-10"><a href="{{ route('profile', ['id' => $movieHistory->user->id]) }}" class="font-medium text-blue-600 underline hover:no-underline">{{ $movieHistory->user->name }}</a></td>
                                <td class="leading-10"><x-evaluation evaluation="{{ $movieHistory->evaluation }}" /></td>
                                <td class="leading-10 md:table-cell hidden">{{ $movieHistory->viewing_date }}</td>
                                <td class="leading-10 md:table-cell hidden">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
                                <td><a href="{{ route('historyDetail', ['id' => $movieHistory->id]) }}" class="font-medium text-blue-600 underline hover:no-underline">履歴</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>