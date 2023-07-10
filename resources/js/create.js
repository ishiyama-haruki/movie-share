if (location.pathname.startsWith("/movieHistory") && location.pathname.endsWith("create")) {
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
            }
        },
        mounted: function () {
            this.userId = document.getElementById('userId').value;
            this.getUserHistory()

            this.setJsonData()
        },
        computed: {
            existFlag: function() {
                if (this.userHistory.includes(this.selectedMovie.title)) {
                    return true
                }
                return false
            }
        },
        methods: {
            setJsonData: function() {
                let json = document.getElementById('movieData').value
                if (json) {
                    this.selectedMovie = JSON.parse(json)
                    this.selectedMovie.poster_path = this.selectedMovie.img_path
                    
                    this.selectedFlag = true
                }
            },
            getUserHistory: function() {
                axios.get("/api/user/" + this.userId)
                .then(response => {
                    this.userHistory = response.data;
                    
                }).catch(err => {
                    console.log('err:', err)
                });
            },
            search: function() {
                this.selectedMovie = {}
                this.selectedFlag = false
                
                this.searchFlag = true;

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
            },
            setYoutubeId: function() {
                axios.get('https://www.googleapis.com/youtube/v3/search', {
                    params: {
                        q: this.selectedMovie.title + '　映画　予告編',
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