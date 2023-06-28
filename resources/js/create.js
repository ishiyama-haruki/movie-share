if (location.pathname.startsWith("/create")) {
    const app = {
        data() {
            return {
                userId: null,
                userHistory: [],
                searchText: '',
                searchResultList: [],
                selectedMovie: {},
                searchFlag: false,
                selectedFlag: false,
                existFlag: false
            }
        },
        mounted: function () {
            this.userId = document.getElementById('userId').value;
            this.getUserHistory()
        },
        methods: {
            getUserHistory: function() {
                axios.get("/api/user/" + this.userId)
                .then(response => {
                    this.userHistory = response.data;
                }).catch(err => {
                    console.log('err:', err)
                });
            },
            search: function() {
                this.existFlag = false
                setTimeout(function(){
                    this.searchFlag = true;
                },10000);

                const api_key = process.env.MIX_TMDB_API_KEY
                axios.get('https://api.themoviedb.org/3/search/movie?api_key=' + api_key + '&language=ja-JA&page=1&query='+this.searchText)
                .then(response => {
                    console.log(response.data.results)
                    this.setSearchResult(response.data.results)
                }).catch(err => {
                    console.log('err:', err)
                });
            },
            setSearchResult: function(results) {
                this.searchResultList = results
            },
            selectCandidate: function(index) {
                this.selectedMovie = this.searchResultList[index]


                if (this.userHistory.includes(this.selectedMovie.title)) {
                    this.existFlag = true;
                }

                if (this.selectedMovie.poster_path) {
                    this.selectedMovie.poster_path = "https://image.tmdb.org/t/p/w300_and_h450_bestv2/" + this.selectedMovie.poster_path
                } 

                this.searchResultList = []
                this.searchText = ""
                this.searchFlag = false
                this.selectedFlag = true
                this.setYoutubeId()
            },
            removeMovie: function() {
                this.selectedMovie = {}
                this.selectedFlag = false
                this.existFlag = false
            },
            setYoutubeId: function() {
                axios.get('https://www.googleapis.com/youtube/v3/search', {
                    params: {
                        q: this.selectedMovie.title + '　予告編',
                        type: 'video',
                        part: 'snippet',
                        maxResults: 1,
                        key: process.env.MIX_YOUTUBE_API_KEY
                    }
                })
                .then(response => {
                    let movie = response.data.items[0];
                    this.selectedMovie.youtubeId = movie.id.videoId
                }).catch(err => {
                    console.log('err:', err)
                });
            },
            submit: function() {
                document.getElementById('createForm').submit();
            }
        }
       
    }

    Vue.createApp(app).mount('#createForm')
}