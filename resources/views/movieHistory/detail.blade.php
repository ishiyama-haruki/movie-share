<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('履歴詳細') }}
        </h2>
    </x-slot>
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
    <div class="w-3/4 mx-auto p-5  my-10 bg-white">
        @if (Auth::id() == $movieHistory->user_id || $movieHistory->accessible)
            @if (Auth::id() == $movieHistory->user_id)
            <form action="{{ url('/save')}}"> 
                {{ csrf_field() }}
                <div class="mb-5 ml-3">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                        </svg>
                        <h2 class="font-bold text-2xl">{{ $movieHistory->user->name }}</h2>    
                    </div>
                    <div class="flex items-end">
                        <p>{{ $movieHistory->user->comment }}</p>        
                    </div>
                </div>
                <div class="w-full mx-auto mt-4 flex flex-col items-center border border-gray-200 rounded-lg shadow md:flex-row">
                    @if ($movieHistory->movie->img_path)
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movieHistory->movie->img_path }}" alt="">
                    @else
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ asset('img/no_img.png') }}" alt="">
                    @endif
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="{{ route('movieDetail', ['id' => $movieHistory->movie->id]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $movieHistory->movie->title }}</a></h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->movie->overview }}</p>
                        
                        <div class="flex w-full justify-between mt-2">
                            <div class="w-1/3">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">公開日</label>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->movie->release_date }}</p>
                            </div>
                            <div class="w-1/3">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">評価</label>
                                <select name="evaluation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value=5 @if ($movieHistory->evaluation==5) selected @endif>大満足</option>
                                    <option value=4 @if ($movieHistory->evaluation==4) selected @endif>満足</option>
                                    <option value=3 @if ($movieHistory->evaluation==3) selected @endif>普通</option>
                                    <option value=2 @if ($movieHistory->evaluation==2) selected @endif>いまいち</option>
                                    <option value=1 @if ($movieHistory->evaluation==1) selected @endif>残念</option>
                                </select>
                            </div>
                            <div class="w-1/4">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">非公開設定</label>
                                <select name="accessible" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value=1 @if ($movieHistory->accessible==1) selected @endif>公開</option>
                                    <option value=0 @if ($movieHistory->accessible==0) selected @endif>非公開</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex w-full justify-between mt-2">
                            <div class="w-1/3">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">視聴日</label>
                                <input type="date" name="viewing_date" value="{{ $movieHistory->viewing_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-1/3">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">視聴場所</label>
                                <select name="place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="映画館" @if ($movieHistory->place=='映画館') selected @endif>映画館</option>
                                    <option value="NetFlix" @if ($movieHistory->place=='NetFlix') selected @endif>NetFlix</option>
                                    <option value="Amazon Prime" @if ($movieHistory->place=='Amazon Prime') selected @endif>Amazon Prime</option>
                                    <option value="Fulu" @if ($movieHistory->place=='Fulu') selected @endif>Fulu</option>
                                    <option value="Other" @if ($movieHistory->place=='Other') selected @endif>その他</option>
                                </select>
                            </div>
                            <div class="w-1/4">
                                <label for="" class="block text-sm font-medium text-gray-900 dark:text-white">視聴回数</label>
                                <input type="number" value="{{ $movieHistory->viewing_count }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></input>
                            </div>
                        </div>
                        <label for="" class="block mt-2 text-sm font-medium text-gray-900 dark:text-white">感想</label>
                        <textarea name="impression" value="{{ $movieHistory->impression }}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $movieHistory->impression }}</textarea>
                        <div class="mt-2 flex justify-end">
                            <button type="submit" formmethod="POST" formaction="{{ route('historyUpdate', $movieHistory->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">更新</button>
                            <button type="submit" formmethod="GET" formaction="{{ route('historyDelete', $movieHistory->id) }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">削除</button>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <div>
                    <div class="mb-5 ml-3">
                        <div class="flex items-center mb-2">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                            </svg>
                            <h2 class="font-bold text-2xl">{{ $movieHistory->user->name }}</h2>    
                        </div>
                        <div class="flex items-end">
                            <p>{{ $movieHistory->user->comment }}</p>        
                        </div>
                    </div>
                    <div class="flex flex-col items-center border border-gray-200 rounded-lg shadow md:flex-row">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-full md:w-auto md:rounded-none md:rounded-l-lg" src="{{ $movieHistory->movie->img_path }}" alt="">
                        <div class="flex flex-col justify-between py-4 px-8 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $movieHistory->movie->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->movie->overview }}</p>        
                            <div class="flex w-full justify-between mt-3">
                                <div class="w-1/6">
                                    <label for="" class="block text-md font-bold text-gray-900 dark:text-white">公開日</label>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->movie->release_date }}</p>
                                </div>
                                <div class="w-1/6">
                                    <label for="" class="block text-md font-bold text-gray-900 dark:text-white">評価</label>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->evaluation }}</p>
                                </div>
                                <div class="w-1/6">
                                    <label for="" class="block text-md font-bold text-gray-900 dark:text-white">視聴回数</label>
                                    <p class="mb-3 font-normal text-center text-gray-700 dark:text-gray-400">{{ $movieHistory->viewing_count }}</p>
                                </div>
                                <div class="w-1/6">
                                    <label for="" class="block text-md font-bold text-gray-900 dark:text-white">視聴日</label>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->viewing_date }}</p>
                                </div>
                                <div class="w-1/6">
                                    <label for="" class="block text-md font-bold text-gray-900 dark:text-white">場所</label>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->place }}</p>
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <label for="" class="block text-md font-bold text-gray-900 dark:text-white">感想</label>
                                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $movieHistory->impression }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class=" mt-14 border border-gray-200 rounded-lg shadow">
                <form method="GET">
                    <table class="w-full text-left text-gray-500 dark:text-gray-400">
                        <tbody class="overflow-y-auto">
                                @foreach($movieHistory->comments()->get() as $comment)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td>
                                            <a href="{{ $comment->user->id }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $comment->user->name }}</a>
                                        </td>
                                        <td>{{ $comment->message }}</td>
                                        <td>
                                            @if ($comment->user->id == Auth::id())
                                                <button type="submit" formaction="{{ route('commentDelete', ['id' => $comment->id ]) }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 m-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">削除</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </form>
                <form action="{{ route('commentStore') }}" method="POST" class="flex items-center justify-between m-2">
                    {{ csrf_field() }}
                    <input type="hidden" name="movie_history_id" value="{{$movieHistory->id}}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="text" name="message" class="w-2/3 mr-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="コメントを投稿する">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">投稿</button>
                </form>
            </div>
        @else 
            <p>この動画は非公開です</p>
        @endif
    </div>
    
</x-app-layout>