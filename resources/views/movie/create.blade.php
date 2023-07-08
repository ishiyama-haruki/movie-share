<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('履歴登録') }}
        </h2>
    </x-slot>
    <form id="createForm" method="POST" action="{{ url('/save')}}" class="w-3/4 mx-auto mt-4"> 
        {{ csrf_field() }}
        <input id="userId" type="hidden" value="{{ Auth::id() }}">
        <div class="relative w-1/2 mx-auto">
            <input type="search" v-model="searchText" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-gray-100 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="映画タイトルを入力">
            <button type="button" @click="search" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
        </div>
        <!-- <div v-show="selectedFlag" class="flex justify-center my-2">
            <button type="button" @click="removeMovie" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">映画を外す</button>
        </div> -->
        <span class="text-center block my-5" v-show="searchFlag && searchResultList.length == 0">
            検索がヒットしませんでした。
        </span>
        <div v-show="searchResultList.length > 0" class=" w-1/2 mx-auto bg-white m-3 p-3 rounded-md">
            <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                <li v-for="(result, index) in searchResultList" @click="selectCandidate(index)" style="cursor: pointer">
                    @{{ result.original_title }}（@{{result.release_date}}）
                </li>
            </ul>
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    <li class="mt-2 text-red-600 text-center">入力内容に不備があります。</li>
                </ul>
            </div>
        @endif
        <div v-show="selectedFlag" class="w-full mx-auto mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row">
            <img v-if="selectedMovie.poster_path" class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" :src="selectedMovie.poster_path">
            <img v-else class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ asset('img/no_img.png') }}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">@{{ selectedMovie.title }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">@{{ selectedMovie.overview }}</p>
                
                <div class="flex w-full justify-between mt-2">
                    <div class="w-1/3">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">公開日</label>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">@{{selectedMovie.release_date}}</p>
                    </div>
                    <div class="w-1/3" v-show="!existFlag">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">評価</label>
                        <select name="evaluation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value=5>大満足</option>
                            <option value=4>満足</option>
                            <option value=3 selected>普通</option>
                            <option value=2>いまいち</option>
                            <option value=1>残念</option>
                        </select>
                    </div>
                    <div class="w-1/4" v-show="!existFlag">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">非公開設定</label>
                        <select name="accessible" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value=1>公開</option>
                            <option value=0>非公開</option>
                        </select>
                    </div>
                </div>
                <div class="flex w-full justify-between mt-2" v-show="!existFlag">
                    <div class="w-1/3">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">視聴日</label>
                        <input type="date" name="viewing_date" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="w-1/3">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">視聴場所</label>
                        <select name="place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="映画館">映画館</option>
                            <option value="NetFlix">NetFlix</option>
                            <option value="Amazon Prime">Amazon Prime</option>
                            <option value="Fulu">Fulu</option>
                            <option value="U-NEXT">U-NEXT</option>
                            <option value="Other">その他</option>
                        </select>
                    </div>
                    <div class="w-1/4"></div>
                </div>
                <div class="mb-3" v-show="!existFlag">
                    <label for="" class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">感想</label>
                    <textarea name="impression" rows="4" required class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="mt-2 flex justify-end" v-show="!existFlag">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">登録</button>
                </div>
                <div class="mt-5" v-show="existFlag">
                    <p class="text-blue-500">この映画は既に登録済みです。必要があればマイページから更新してね！</p>
                </div>
            </div>
        </div>
        <input type="hidden" name="title" :value="selectedMovie.title">
        <input type="hidden" name="original_title" :value="selectedMovie.original_title">
        <input type="hidden" name="overview" :value="selectedMovie.overview">
        <input type="hidden" name="release_date" :value="selectedMovie.release_date">
        <input type="hidden" name="img_path" :value="selectedMovie.poster_path">
        <input type="hidden" name="youtube_id" :value="selectedMovie.youtubeId">
    </form>
    
</x-app-layout>