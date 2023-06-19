if (location.pathname.startsWith("/create")) {
    const app = {
        data() {
            return {
                searchText: '',
                searchResultList: [],
                selectedMovie: {},
                selectedFlag: false
            }
        },
        methods: {
            search: function() {
                axios.get('https://api.themoviedb.org/3/search/movie?api_key=8a22ccaf72d02a8af20469c4924ac7a7&language=ja-JA&page=1&query='+this.searchText)
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
                this.selectedMovie.poster_path = "https://image.tmdb.org/t/p/w300_and_h450_bestv2/" + this.selectedMovie.poster_path
                this.searchResultList = []
                this.searchText = ""
                this.selectedFlag = true
            },
            removeMovie: function() {
                this.selectedMovie = {}
                this.selectedFlag = false
            }
        }
       
    }

    Vue.createApp(app).mount('#createForm')
}