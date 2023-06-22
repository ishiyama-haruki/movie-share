if (location.pathname.startsWith("/user")) {
    const app = {
        data() {
            return {
                historyFlag: true,
                interestFlag: false
            }
        },
        methods: {
            pushTab: function() {
                this.historyFlag = !this.historyFlag
                this.interestFlag = !this.interestFlag
            },
        }
       
    }

    Vue.createApp(app).mount('#userDetail')
}