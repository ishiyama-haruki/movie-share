import { createApp } from 'vue';

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

    createApp(app).mount('#userDetail');
}