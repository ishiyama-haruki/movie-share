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
    <div class="w-3/4 mx-auto mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movie->img_path }}" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <div class="flex items-center mb-3">
                <h5 class="mr-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $movie->title }}</h5>
                <div class="flex">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($movie->movieHistories->avg('evaluation') > $i)
                            <svg class="w-6 h-6 mr-1 text-gray-800 dark:text-white" aria-hidden="true" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 19C14.9706 19 19 14.9706 19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10C1 14.9706 5.02944 19 10 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 11C15 13.038 12.761 15.5 10 15.5C7.239 15.5 5 13.038 5 11C5 12.444 15 12.444 15 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.5 8C7.32843 8 8 7.32843 8 6.5C8 5.67157 7.32843 5 6.5 5C5.67157 5 5 5.67157 5 6.5C5 7.32843 5.67157 8 6.5 8Z" fill="currentColor"/>
                                <path d="M13.5 8C14.3284 8 15 7.32843 15 6.5C15 5.67157 14.3284 5 13.5 5C12.6716 5 12 5.67157 12 6.5C12 7.32843 12.6716 8 13.5 8Z" fill="currentColor"/>
                            </svg>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="flex mb-3">
                <div class="w-1/3 px-1">
                    <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">公開日</label>
                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $movie->release_date }}</p>
                </div>
                <div class="w-2/3 px-1">
                    <label for="" class="flex items-center text-sm font-medium text-gray-900 dark:text-white">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path fill-rule="evenodd" d="M19.7 3.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.84c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.84A4.225 4.225 0 0 0 .3 3.038a30.148 30.148 0 0 0-.2 3.206v1.5c.01 1.071.076 2.142.2 3.206.094.712.363 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.15 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965c.124-1.064.19-2.135.2-3.206V6.243a30.672 30.672 0 0 0-.202-3.206ZM8.008 9.59V3.97l5.4 2.819-5.4 2.8Z" clip-rule="evenodd"/>
                        </svg>
                        予告URL
                    </label>
                    <a href="{{ 'https://youtube.com/watch?v=' . $movie->youtube_id }}" target="_blank" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ 'https://youtube.com/watch?v=' . $movie->youtube_id }}</a>
                </div>
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movie->overview }}</p>       
            <div class="flex justify-end mt-2">
                @if ($interestId)
                    <a href="{{ route('removeInterest', ['id' => $interestId]) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">気になるから外す</a>
                @else
                    <a href="{{ route('storeInterest', ['id' => $movie->id]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">気になる</a>
                @endif
            </div> 
        </div>
    </div>
    <table class="mt-5 mx-auto w-3/4 text-left text-gray-500 dark:text-gray-400">
        <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="leading-10">ユーザー</th>
                <th scope="col" class="text-center leading-10">評価</th>
                <th scope="col" class="leading-10">視聴日</th>
                <th scope="col" class="leading-10">感想</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movie->movieHistories()->get() as $movieHistory)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="leading-10"><a href="{{ route('profile', ['id' => $movieHistory->user->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movieHistory->user->name }}</a></td>
                <td class="text-center leading-10">{{ $movieHistory->evaluation }}/5</td>
                <td class="leading-10">{{ $movieHistory->viewing_date }}</td>
                <td class="leading-10">{{ Str::limit($movieHistory->impression, 40, '...') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>